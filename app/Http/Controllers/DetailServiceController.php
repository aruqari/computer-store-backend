<?php

namespace App\Http\Controllers;

use App\Models\DetailService;
use Illuminate\Http\Request;

class DetailServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_service = DetailService::paginate(10);
        return view("products", ["detail_service" => $detail_service]);
    }
    public function indexMobile()
    {
        $detail_service = DetailService::get();
        return response()->json($detail_service, 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailService $detailService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailService $detailService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailService $detailService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailService $detailService)
    {
        //
    }
}
