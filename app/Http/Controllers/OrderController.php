<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\HistroqueCartsModel;
use App\Models\MenModel;
use App\Models\OrderModel;
use App\Models\ResultOrder;
use App\Models\ShopModel;
use App\Models\ValidatedOrder;
use App\Models\WomenModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=OrderModel::latest()->paginate(5);
        return view('order.index',compact('orders'));
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
    // public function store(Request $request)
    // {
    //     // استخدام first() للحصول على أول صف يتطابق مع الشرط
    //     $banque = OrderModel::where('select', 'delivery')->first();
    //     $banque2 = OrderModel::where('select', 'cash')->first();
    //     $bankAccount=$request->bankAccount;
    //     //$gggg = OrderModel::where('bankAccount',$bankAccount);
    
    //     if ($banque) {
    //         // إذا وجدنا سجلًا بدون قيمة bankAccount، نحدّثه أو نضيفه بناءً على الحاجة
    //         OrderModel::create(attributes: array_merge($request->all(), ['bankAccount' =>$bankAccount]));
    //         // return redirect()->route('order.index');
    //         return redirect()->route('carte.index')->with('success', 'Achat effectué avec succès!');
    //     } elseif ($banque2) {
    //         // إذا لم نجد أي سجل، نقوم بإضافة السجل الجديد
    //         OrderModel::create(array_merge($request->all(), ['bankAccount' =>'N/A']));
    //         return redirect()->route('carte.index')->with('success', 'Achat effectué avec succès!');
    //         // return redirect()->route('order.index');
    //     }
    // }
 public function store(Request $request)
{
    $products = $request->input('products'); // مصفوفة المنتجات مع التفاصيل
    $userId = $request->user_id;

    // 1. التحقق من توفر الكمية المطلوبة لكل منتج
    foreach ($products as $productId => $details) {
        $title = $details['title'] ?? null;
        $size = $details['size'] ?? null;
        $quantityRequested = $details['quantite'] ?? 0;

        if (!$title || !$size) {
            return redirect()->back()->withErrors("Données du produit incorrectes.");
        }

        // البحث عن المنتج في الجداول الثلاث
        $product = ShopModel::where('title', $title)->where('size', $size)->first()
            ?? MenModel::where('title', $title)->where('size', $size)->first()
            ?? WomenModel::where('title', $title)->where('size', $size)->first();

        if (!$product) {
            return redirect()->back()->withErrors("Produit $title (taille: $size) non trouvé.");
        }

        // التحقق من توفر الكمية
        if ($product->stock < $quantityRequested) {
            return redirect()->back()->withErrors("Stock insuffisant pour le produit $title (taille: $size). Disponible: $product->stock, demandé: $quantityRequested.");
        }
    }

    // 2. إذا الكمية متوفرة لجميع المنتجات، استمر بإنشاء الطلب
    $select = $request->input('select');
    $bankAccount = $request->input('bankAccount');

    $order = OrderModel::create(array_merge($request->all(), [
        'user_id' => $userId,
        'bankAccount' => $select === 'cash' ? $bankAccount : 'N/A'
    ]));

    // 3. تحديث اسم المستخدم في السلة وحذفها
    $userName = $order->nom . ' ' . $order->prenom;
    CartModel::where('user_id', $userId)->update(['user_name' => $userName]);
    CartModel::where('user_id', $userId)->delete();

    return redirect()->route('carte.index')->with('success', 'Achat effectué avec succès!');
}


    /**
     * Display the specified resource.
     */


public function show($orderId)
{
    // جلب طلب واحد حسب الـ id
    $order = OrderModel::findOrFail($orderId);

    // فك تشفير JSON الخاص بالمنتجات
   $products = $order->products; // لأن Laravel حولها تلقائياً إلى array


    return view('order.show', compact('order', 'products'));
}




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderModel $orderModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderModel $orderModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        OrderModel::find($id)->delete();
        return redirect()->route('order.index');
    }

    public function showValidatedOrders()
        {
            $validatedOrders = ValidatedOrder::paginate(4);
            return view('order.validated_orders', compact('validatedOrders'));
        }


public function validateOrder($id)
{
    $order = OrderModel::findOrFail($id);

    // فك JSON المنتجات (Laravel يحولها إلى مصفوفة تلقائياً)
    $products = $order->products;

    foreach ($products as $productId => $details) {

        $quantityToSubtract = $details['quantite'];
        $title = $details['title'];
        $size = $details['size'];

        // 🏬 البحث في Shop
        $product = ShopModel::where('title', $title)
                            ->where('size', $size)
                            ->first();
        if ($product) {
            $product->stock -= $quantityToSubtract;
            if ($product->stock < 0) $product->stock = 0;
            $product->save();
            continue; // إذا وجدناه في shop لا داعي لإكمال البحث
        }

        // 👕 البحث في Men
        $product = MenModel::where('title', $title)
                           ->where('size', $size)
                           ->first();
        if ($product) {
            $product->stock -= $quantityToSubtract;
            if ($product->stock < 0) $product->stock = 0;
            $product->save();
            continue;
        }

        // 👚 البحث في Women
        $product = WomenModel::where('title', $title)
                             ->where('size', $size)
                             ->first();
        if ($product) {
            $product->stock -= $quantityToSubtract;
            if ($product->stock < 0) $product->stock = 0;
            $product->save();
            continue;
        }
    }

    // إضافة الطلب إلى جدول الطلبات المؤكدة
    ValidatedOrder::create([
        'nom' => $order->nom,
        'prenom' => $order->prenom,
        'email' => $order->email,
        'adresse' => $order->adresse,
        'phone' => $order->phone,
        'totalgenerale' => $order->totalgenerale,
        'select' => $order->select,
        'bankAccount' => $order->bankAccount,
        'products' => $order->products, 
        'created_at' => now(),
    ]);

    // حذف الطلب من الطلبات العادية
    $order->delete();

    return redirect()->route('showValidatedOrders')->with('success', 'Commande validée avec succès.');
}


}
