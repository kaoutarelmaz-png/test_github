<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\ShopHistorique;
use App\Models\ShopModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{

     public function AffcherTableShop(){
       $shops=ShopModel::paginate(5);
        return view('shop.afficher',compact('shops'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops=ShopModel::all();
        return view('shop.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("shop.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     // التحقق من البيانات
    $request->validate([
        "price"=>"required|numeric|min:1",
        'code_article_shops' => 'required|numeric|unique:shops,code_article_shops',
    ], [
        'code_article_shops.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
    ]);
        $imager=$request->file('imager');
        $imagerDB=time().".".$imager->getClientOriginalExtension();
        $imager->storeAs("imager",$imagerDB,'public');
        ShopModel::create(array_merge($request->all(),['imager'=>$imagerDB]));
        return redirect()->route('AffcherTableShop');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detaillers=ShopModel::find($id);
        $counts=CartModel::count();
         $menssse = ShopModel::where('title', $detaillers->title)->get();
        return view('shop.show',compact('detaillers','counts','menssse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edits=ShopModel::find($id);
        return view('shop.edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $product = ShopModel::findOrFail($id);
    // التحقق من البيانات مع استثناء المنتج الحالي للكود
    $request->validate([
        'code_article_shops' => 'required|numeric|unique:shops,code_article_shops,' . $product->id,
    ], [
        'code_article_shops.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
    ]);
    // إذا المستخدم لم يغيّر الصورة
    if (!$request->hasFile('imager')) {
        // نحتفظ بالصورة القديمة كما هي
        $product->update([
            'title'   => $request->title,
            'content' => $request->input('content'),
            'price'   => $request->price,
            'size'    => $request->size,
            'stock'   => $request->stock,
            'code_article_shops' => $request->code_article_shops,
        ]);

        return redirect()->route('AffcherTableShop');
    }

    // إذا غيّر الصورة → نرفع صورة جديدة
    $imager = $request->file('imager');
    $imagerDB = time() . "." . $imager->getClientOriginalExtension();
    $imager->storeAs('imager', $imagerDB, 'public');

    // تحديث باقي البيانات مع الصورة الجديدة
    $product->update(array_merge(
        $request->except('imager'),
        ['imager' => $imagerDB]
    ));

    return redirect()->route('AffcherTableShop');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ShopModel::find($id)->delete();
        return redirect()->route('AffcherTableShop');
    }

    public function historique_index(){
        $historiques = ShopHistorique::orderBy('action_date', 'desc')->get();
        return view('shop.historique', compact('historiques'));
    }
    
    public function search(Request $request)
    {
        $keyword = $request->get('query');

        $results = ShopModel::where('title', 'LIKE', "%$keyword%")
            ->orWhere('content', 'LIKE', "%$keyword%")
            ->orWhere('price', 'LIKE', "%$keyword%")
            ->orWhere('code_article_shops', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($results);
    }
}
