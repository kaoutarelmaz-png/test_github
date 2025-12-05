<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\MenHistorique;
use App\Models\MenModel;
use Illuminate\Http\Request;

class MenController extends Controller
{

    public function AffcherTableMen(){
        $mens=MenModel::latest()->paginate(5);
        return view('men.afficher',compact('mens'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mens=MenModel::all();
        return view('men.index',compact('mens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('men.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             // التحقق من البيانات
    $request->validate([
        "price"=>"required|numeric|min:1",
        'code_article_mens' => 'required|numeric|unique:mens,code_article_mens',
    ], [
        'code_article_mens.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
    ]);
        $imager=$request->file('imager');
        $imagerDB=time().".".$imager->getClientOriginalExtension();
        $imager->storeAs("imager",$imagerDB,'public');
        MenModel::create(array_merge($request->all(),['imager'=>$imagerDB]));
        return redirect()->route('AffcherTableMen');
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    // المنتج المطلوب
    $detaillers = MenModel::findOrFail($id);

    // عدد المنتجات في السلة
    $counts = CartModel::count();

    // جلب كل المنتجات التي لها نفس العنوان
    $menssse = MenModel::where('title', $detaillers->title)->get();

    return view('men.show', compact('detaillers', 'counts', 'menssse'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edits=MenModel::find($id);
        return view('men.edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $product = MenModel::findOrFail($id);
    $request->validate([
        'code_article_mens' => 'required|numeric|unique:mens,code_article_mens,' . $product->id,
    ], [
        'code_article_mens.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
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
            'code_article_mens' => $request->code_article_mens,
        ]);

        return redirect()->route('AffcherTableMen');
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

    return redirect()->route('AffcherTableMen');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        MenModel::find($id)->delete();
        return redirect()->route('AffcherTableMen');
    }
    
    public function StoreFilterMen(Request $request ,$id){
        $filetrsMen=$request->title;
        $recherchers=MenModel::where('title',$filetrsMen)->get();
        return redirect()->route('men.index',compact($recherchers));
    }

    public function historique_index(){
         $historiques = MenHistorique::orderBy('action_date', 'desc')->get();
        return view('men.historique', compact('historiques'));
    }
}
