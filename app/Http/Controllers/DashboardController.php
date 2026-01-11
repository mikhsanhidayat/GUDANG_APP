<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\bahan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalBahan = bahan::count();
        $lowStockProducts = Product::where('stok_tersedia', '<=', 5)->count();
        $lowStockBahan = bahan::where('stok_tersedia', '<=', 5)->count();
        $lowStockProductList = Product::where('stok_tersedia', '<=', 5)->get();
        $lowStockBahanList = bahan::where('stok_tersedia', '<=', 5)->get();
        return view('halamanutama.index', compact('totalProducts', 'totalBahan', 'lowStockProducts', 'lowStockBahan', 'lowStockProductList', 'lowStockBahanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, dashboard $dashboard)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(dashboard $dashboard)
    // {
    //     //
    // }
}
