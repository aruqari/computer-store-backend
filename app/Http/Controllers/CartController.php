<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function add(CartRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        if ($data["qty"] < 1) {
            if (
                Cart::where([
                    ["id_user", $user->id_user],
                    ["id_katalog", $data["id_katalog"]]
                ])->count() >= 1
            ) {
                Cart::where([
                    ["id_user", $user->id_user],
                    ["id_katalog", $data["id_katalog"]]
                ])->delete();
            } else {
                throw new HttpResponseException(response([
                    "errors" => [
                        "message" => "Jumlah barang minimal 1"
                    ]
                ], 401));
            }

        } elseif (
            Cart::where([
                ["id_user", $user->id_user],
                ["id_katalog", $data["id_katalog"]]
            ])->count() == 1
        ) {
            $cart = Cart::where([
                ["id_user", $user->id_user],
                ["id_katalog", $data["id_katalog"]]
            ])->first();
            $cart->id_katalog = $data["id_katalog"];
            $cart->qty = $data["qty"];
            $cart->subtotal = $data["subtotal"];
            $cart->save();

        } else {
            $cart = new Cart($data);
            $cart->id_user = $user->id_user;
            $cart->save();
        }

        return (new CartResource($request))->response()->setStatusCode(201);

    }

    public function get(Request $request)
    {
        $user = Auth::user();
        $cart = DB::table("cart")
            ->join("katalog", "cart.id_katalog", "=", "katalog.id_katalog")
            ->where('id_user', $user->id_user)->get();
        return response()->json($cart, 200);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        Cart::where('id_user', $user->id_user)->delete();


        return response()->json([
            "data" => true,
        ], 200);
    }
}
