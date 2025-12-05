<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\WomanHistorique;
use App\Models\WomenModel;
use Illuminate\Http\Request;

class WomenController extends Controller
{
        public function AffcherTableWoman(){
         $womans=WomenModel::latest()->paginate(4);
        return view('women.afficher',compact('womans'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $womans=WomenModel::all();
        return view('women.index',compact('womans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('women.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "price" => "required|numeric|min:1",
            "code_article_womans" => "required|numeric|unique:womans,code_article_womans",
        ], [
            'code_article_womans.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
        ]);
        $imager=$request->file('imager');
        $imagerDB=time().'.'.$imager->getClientOriginalExtension();
        $imager->storeAs('imager',$imagerDB,'public');
        WomenModel::create(array_merge($request->all(),['imager'=>$imagerDB]));
        return redirect()->route('AffcherTableWoman');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $womans=WomenModel::find($id);
        $counts=CartModel::count();
        $menssse = WomenModel::where('title', $womans->title)->get();
        return view('women.show',compact('womans','counts','menssse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edits=WomenModel::find($id);
        return view('women.edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request,$id)
{
    $product = WomenModel::findOrFail($id);
    // التحقق من البيانات مع استثناء المنتج الحالي للكود
    $request->validate([
        'code_article_womans' => 'required|numeric|unique:womans,code_article_womans,' . $product->id,
    ], [
        'code_article_womans.unique' => 'هذا الرقم موجود بالفعل، الرجاء إدخال رقم آخر.'
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
            'code_article_womans' => $request->code_article_womans,
        ]);

        return redirect()->route('AffcherTableWoman');
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

    return redirect()->route('AffcherTableWoman');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        WomenModel::find($id)->delete();
        return redirect()->route('AffcherTableWoman');
    }

    public function historique_index(){
            $historiques = WomanHistorique::orderBy('action_date', 'desc')->get();
        return view('women.historique', compact('historiques'));
    }
}
