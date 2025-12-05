<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class MarketController extends Controller
{

public function index(Request $request)
{
    // API Men
    $men = Http::get("https://fakestoreapi.com/products/category/men's clothing")->json();

    // API Women
    $women = Http::get("https://fakestoreapi.com/products/category/women's clothing")->json();

    // Mixed
    $allProducts = array_merge($men, $women);

    // Counters
    $menCount = count($men);
    $womenCount = count($women);
    $totalProducts = count($allProducts);

    // Pagination يدوي
    $page = $request->get('page', 1); // الصفحة الحالية
    $perPage = 5; // عدد المنتجات في كل صفحة
    
    // حساب البداية والنهاية
    $offset = ($page - 1) * $perPage;
    
    // استخراج المنتجات للصفحة الحالية
    $currentPageProducts = array_slice($allProducts, $offset, $perPage);
    
    // حساب عدد الصفحات
    $totalPages = ceil($totalProducts / $perPage);

    return view('marketing.index', [
        'men' => $men,
        'women' => $women,
        'mix' => $currentPageProducts, // المنتجات للصفحة الحالية
        'menCount' => $menCount,
        'womenCount' => $womenCount,
        'mixCount' => $totalProducts, // العدد الكلي
        'currentPage' => (int)$page,
        'totalPages' => $totalPages,
        'perPage' => $perPage,
        'totalProducts' => $totalProducts
    ]);
}
    public function indexCom(){
        // API Men
        $men = Http::get("https://fakestoreapi.com/products/category/men's clothing")->json();

        // API Women
        $women = Http::get("https://fakestoreapi.com/products/category/women's clothing")->json();

        // Mixed (نمزجهما)
        $mix = array_merge($men, $women);

        // Counters
        $menCount = count($men);
        $womenCount = count($women);
        $mixCount = count($mix);
        return view('marketing.indexCom', compact(
            'men', 'women', 'mix',
            'menCount', 'womenCount', 'mixCount'
        ));
    }
}
