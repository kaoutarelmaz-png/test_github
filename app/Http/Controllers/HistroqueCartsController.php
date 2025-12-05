<?php

namespace App\Http\Controllers;

use App\Models\HistroqueCartsModel;
use Illuminate\Http\Request;

class HistroqueCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histroquecarts = HistroqueCartsModel::orderBy('created_at', 'desc')->get();
        return view('histroquecarts.index', compact('histroquecarts'));
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
    public function show(HistroqueCartsModel $histroqueCartsModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistroqueCartsModel $histroqueCartsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistroqueCartsModel $histroqueCartsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistroqueCartsModel $histroqueCartsModel)
    {
        //
    }
}
