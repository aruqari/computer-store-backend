<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Http\Requests\StoreKatalogRequest;
use App\Http\Requests\UpdateKatalogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $katalog = Katalog::paginate(10);
        return view("products", ["katalog" => $katalog]);
    }
    public function indexMobile()
    {
        $katalog = Katalog::get();
        return response()->json($katalog, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("createProduct");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKatalogRequest $request)
    {
        // menyimpan data file yang diupload ke variabel $file
        // 	$file = $request->file('file');

        //     // nama file
        // echo 'File Name: '.$file->getClientOriginalName();
        // echo '<br>';

        //     // ekstensi file
        // echo 'File Extension: '.$file->getClientOriginalExtension();
        // echo '<br>';

        //     // real path
        // echo 'File Real Path: '.$file->getRealPath();
        // echo '<br>';

        //     // ukuran file
        // echo 'File Size: '.$file->getSize();
        // echo '<br>';

        //     // tipe mime
        // echo 'File Mime Type: '.$file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload

        $data = $request->validated();


        $idp = substr(uniqid(rand(), 1), 0, 6);
        $file = time() . '.' . $data['image']->extension();

        $katalog = new Katalog;
        $katalog->id_katalog = $idp;
        $katalog->nama = $data['nama'];
        $katalog->image = $file;
        $katalog->desc = $data['desc'];
        $katalog->harga = $data['harga'];
        $katalog->stok = $data['stok'];
        $katalog->save();

        $tujuan_upload = public_path('file_uploads');
        $data['image']->move($tujuan_upload, $file);

        // Storage::disk('local')->put($tujuan_upload, $file->getClientOriginalName());
        return redirect()->route('ProductList')->with('success', 'Tersimpan');
        // return redirect('/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Katalog $katalog, string $id_katalog)
    {
        $katalog = Katalog::where("id_katalog", $id_katalog)->first();
        return response()->json($katalog, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_katalog)
    {
        $produk = Katalog::where('id_katalog', $id_katalog)->first();

        return view('editProduct', [
            'id_katalog' => $id_katalog,
            'nama' => $produk->nama,
            'harga' => $produk->harga,
            'stok' => $produk->stok,
            'desc' => $produk->desc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKatalogRequest $request)
    {
        $data = $request->validated();

        $katalog = Katalog::where('id_katalog', $data["id_katalog"])->first();

        if (isset($data['image'])) {
            $filename = $katalog->image;
            $filepath = 'file_uploads/' . $filename;
            File::delete($filepath);

            $newfilename = time() . '.' . $data['image']->extension();
            $tujuan_upload = public_path('file_uploads');
            $data['image']->move($tujuan_upload, $newfilename);

            $katalog->image = $newfilename;
        }

        $katalog->nama = $data["nama"];
        $katalog->harga = $data["harga"];
        $katalog->stok = $data["stok"];
        $katalog->desc = $data["desc"];
        $katalog->save();

        return redirect()->route('ProductList')->with('success', 'Perubahan Tersimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katalog $katalog, Request $request)
    {
        $file = Katalog::where('id_katalog', $request->id_katalog);
        $filepath = 'file_uploads/' . $file->first()->image;

        File::delete($filepath);
        $file->delete();

        return back()->with('success', 'Terhapus');
    }
}
