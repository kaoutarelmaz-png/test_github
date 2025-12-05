<?php

namespace App\Http\Controllers;

use App\Models\ResultOrder;
use Illuminate\Http\Request;

class ResultOrderController extends Controller
{
     public function index()
    {
        // جلب كل السجلات مع ترتيب تنازلي للتاريخ، مع Pagination
        $resultOrders = ResultOrder::orderBy('created_at', 'desc')->paginate(15);

        return view('resultatOrder.index', compact('resultOrders'));
    }
}