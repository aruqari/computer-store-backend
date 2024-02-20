<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();
        $requestData = $request->all();
        $firstObject = collect($requestData)->first();

        $idp = substr(uniqid(rand(), 1), 0, 6);
        $pembelian = new Pembelian;
        $pembelian->id_pembelian = $idp;
        $pembelian->id_user = $user->id_user;
        $pembelian->status = "Belum Dibayar";
        $pembelian->total_harga = $firstObject["total_harga"];
        $pembelian->save();

        foreach ($requestData as $data) {

            $detailPembelian = new DetailPembelian;
            $detailPembelian->id_pembelian = $idp;
            $detailPembelian->id_katalog = $data['id_katalog'];
            $detailPembelian->qty = $data['qty'];
            $detailPembelian->subtotal = $data['subtotal'];

            $detailPembelian->save();
        }

        return response()->json($request, 200);
    }
    public function get(Request $request)
    {
        $user = Auth::user();
        $pembelian = Pembelian::where("id_user", $user->id_user)->orderByDesc('created_at')->get();

        return response()->json($pembelian, 200);
    }
    public function getDetail(Request $request)
    {
        $det = DB::table("detail_pembelian")->join("katalog", "detail_pembelian.id_katalog", "=", "katalog.id_katalog")
            ->where('id_pembelian', $request->id_pembelian)->get();
        return response()->json($det, 200);
    }

    public function getById(Request $request)
    {

        $pembelian = Pembelian::where("id_pembelian", $request->id_pembelian)->get();
        return response()->json($pembelian, 200);
    }

    public function index()
    {
        $transaksi = DB::table("pembelian")
            ->select("pembelian.id_pembelian", "pelanggan.nama", "pembelian.created_at", "pembelian.status", "pembelian.id_user")
            ->join("users", "pembelian.id_user", "=", "users.id_user")
            ->join("pelanggan", "users.id_pelanggan", "=", "pelanggan.id_pelanggan")
            ->groupBy("pembelian.id_pembelian", "pelanggan.nama", "pembelian.created_at", "pembelian.status", "pembelian.id_user")->paginate(10);

        // var_dump($transaksi[0]);
        return view("transactions", ["transaksi" => $transaksi]);
    }
    public function show(string $id_pembelian)
    {
        $pembeli = DB::table("pembelian")
            ->where("id_pembelian", $id_pembelian)
            ->join("pelanggan", "pembelian.id_user", "=", "pelanggan.id_pelanggan")
            ->first();

        $detail = DB::table("detail_pembelian")
            ->select("detail_pembelian.*", "katalog.*")
            ->join("katalog", "detail_pembelian.id_katalog", "=", "katalog.id_katalog")
            ->where("id_pembelian", $id_pembelian)
            ->get();


        $total_harga = Pembelian::where("id_pembelian", $id_pembelian)->first()->total_harga;

        return view("detailTransaction", ["detail" => $detail, "total_harga" => $total_harga, "pembeli" => $pembeli]);
    }
    public function status(Request $request)
    {
        $data = Pembelian::where("id_pembelian", $request->id_pembelian)->first();
        $data->status = $request->status;
        $data->save();

        return back()->with('success', 'Status Tesimpan');
    }
}
