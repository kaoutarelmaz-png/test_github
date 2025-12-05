<?php

namespace App\Http\Controllers;

use App\Models\InventtaireModel;
use App\Models\MenModel;
use App\Models\ShopModel;
use App\Models\WomenModel;
use Illuminate\Http\Request;

class InventtaireController extends Controller
{
        public function create(){
        //
    }
public function index()
{
    // 10 سجلات في كل صفحة
    $inventaires = InventtaireModel::orderBy('id', 'desc')->paginate(5);
    return view('inventaire.index', compact('inventaires'));
}

public function search(Request $request)
{
    $code = $request->code_search_article;

    if(!$code){
        return redirect()->route('inventaire.index');
    }

    $men = MenModel::where('code_article_mens', $code)->first();
    $woman = WomenModel::where('code_article_womans', $code)->first();
    $shop = ShopModel::where('code_article_shops', $code)->first();

    $product = $men ?? $woman ?? $shop;

    // جلب inventaire مع paginate
    $inventaires = InventtaireModel::orderBy('id', 'desc')->paginate(10);

    return view('inventaire.index', compact('product','inventaires'));
}


public function store(Request $request)
{
    $request->validate([
        'code_article' => 'required',
        'title' => 'required',
        'price' => 'required',
        'size' => 'required',
        'stock' => 'required',
        'quantite' => 'required|integer|min:1'
    ]);

    // التحقق إذا كان code_article موجود مسبقًا
    $exists = InventtaireModel::where('code_article', $request->code_article)->first();
    if($exists){
        return back()->with('error', 'هذا الرقم موجود بالفعل في جدول inventaire !');
    }

    InventtaireModel::create([
        'code_article' => $request->code_article,
        'title' => $request->title,
        'price' => $request->price,
        'size' => $request->size,
        'stock' => $request->stock,
        'quantite' => $request->quantite
    ]);

    return back()->with('success', 'Article ajouté à l’inventaire !');
}



    public function show(){
        //
    }

    public function edit($id)
{
    $item = InventtaireModel::findOrFail($id);
    return view('inventaire.edit', compact('item'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'quantite' => 'required|integer|min:0',
    ]);

    $item = InventtaireModel::findOrFail($id);

    // تحديث الكمية فقط
    $item->quantite = $request->quantite;
    $item->save();

    return redirect()->route('inventaire.index')->with('success', 'Quantité mise à jour avec succès !');
}

public function destroy($id)
{
    $item = InventtaireModel::findOrFail($id);
    $item->delete();

    return redirect()->route('inventaire.index')->with('success', 'Article supprimé avec succès !');
}

}
