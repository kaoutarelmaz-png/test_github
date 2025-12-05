<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\MenModel;
use App\Models\ShopModel;
use App\Models\WomenModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts=CartModel::with(['mens','womans'])->get();
        $Totalgeneral=CartModel::sum(column: "Total");
        return view('carts.index',compact('carts','Totalgeneral'));
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
        $id = $request->IDwomen ?? $request->IDmen ?? $request->IDshop ;
        if (!$id) {
            return redirect()->back()->with('error', 'Product ID is missing');
        }
    
        // البحث عن المنتج في الجدول الصحيح فقط
        if ($request->has('IDwomen')) {
            $product = WomenModel::find($id);
        } elseif ($request->has('IDmen')) {
            $product = MenModel::find($id);
        } 
        elseif ($request->has('IDshop')) {
            $product = ShopModel::find($id);
        }else {
            return redirect()->back()->with('error', 'Invalid product selection');
        }
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
    
        $title = $product->title;
        $price = $product->price;
        $content = $product->content;
        $size = $product->size;

        $imager = $product->imager;
        $quantity = $request->quantite ?? 1; // الافتراضي 1 إذا لم يتم تمرير كمية
        $total = $price * $quantity;
    
        CartModel::create([
            'imager' => $imager,
            'content' => $content,
            'size' => $size,
            'price' => $price,
            'quantite' => $quantity,
            'Total' => $total,
            'title' => $title,
            'user_id' => $request->user_id, // ربط السلة بالمستخدم مباشرة
        ] + $request->all());

        
    
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(CartModel $cartModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edits=CartModel::find($id);
        return view('carts.edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = CartModel::findOr($id);

        $quantity = $request->input('stock') ?? 1;
        $total = $cart->price * $quantity;

        $cart->update([
            'quantite' => $quantity,
            'Total' => $total
        ]);

        return redirect()->route('carte.index')->with('success', 'Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartModel)
    {
        CartModel::find($cartModel)->delete();
        return redirect()->route('carte.index');
    }
}
