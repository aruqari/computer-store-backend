<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserLoginResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (User::where("username", $data["username"])->count() == 1) {
            throw new HttpResponseException(response([
                "errors" => [
                    "username" => [
                        "username telah terdaftar"
                    ]
                ]
            ], 400));
        }

        $idp = substr(uniqid(rand(), 1), 0, 6);

        DB::table('pelanggan')->insert([
            'id_pelanggan' => $idp,
            'nama' => $data["nama"],
            'no_telp' => $data["no_telp"],
            'email' => $data["email"],
            'alamat' => $data["alamat"],
        ]);

        $user = new User($data);
        $user->id_user = $idp;
        $user->id_pelanggan = $idp;
        $user->role = "member";
        $user->password = Hash::make($data["password"]);
        $user->save();

        return (new UserResource($request))->response()->setStatusCode(201);
    }

    public function login(LoginRequest $request): UserLoginResource
    {
        $data = $request->validated();

        $user = User::where("username", $data["username"])->first();

        if (!$user || !Hash::check($data["password"], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => "username atau password salah"
                ]
            ], 401));
        }

        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserLoginResource($user);

    }

    public function loginAdmin(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where("username", $data["username"])->first();

        if (!$user || !Hash::check($data["password"], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => "username atau password salah"
                ]
            ], 401));
        }

        $user->token = Str::uuid()->toString();
        $user->save();
        Auth::login($user);

        return redirect()->route('Admin');
    }

    public function get(Request $request): UserLoginResource
    {
        $user = Auth::user();
        return new UserLoginResource($user);
    }

    public function getPelanggan(Request $request)
    {
        $user = Auth::user();
        $pelanggan = DB::table("pelanggan")->where('id_pelanggan', $user->id_pelanggan)->first();
        return response()->json($pelanggan, 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();
        Auth::logout();

        return response()->json([
            "data" => true,
        ])->setStatusCode(200);
    }

    public function logoutAdmin(Request $request)
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();
        Auth::logout();

        return redirect()->route('loginAdmin');
    }
}
