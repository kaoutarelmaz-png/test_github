<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\CommentsModel;
use App\Models\CompterUserModel;
use App\Models\HistoriqueOrderModel;
use App\Models\MenModel;
use App\Models\OrderModel;
use App\Models\ShopModel;
use App\Models\ValidatedOrder;
use App\Models\WomenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    $comment = CommentsModel::count();
    $historiqueOrder = OrderModel::count();
    $mensOrder = MenModel::count();
    $womansOrder = WomenModel::count();
    $shopOrder = ShopModel::count();
    $clients = CompterUserModel::count();
    $products = ShopModel::count() + MenModel::count() + WomenModel::count();
    $ordersCount = OrderModel::count();
    $revenue = ValidatedOrder::sum('totalgenerale');

    // حساب تكرار أسماء المنتجات
    $orders = ValidatedOrder::all();
    $productCount = [];

    foreach ($orders as $order) {
        $prodArray = $order->products; // déjà array

        if (is_array($prodArray)) {
            foreach ($prodArray as $prod) {
                $title = trim(strtolower($prod['title']));

                if (!isset($productCount[$title])) {
                    $productCount[$title] = [
                        'image' => $prod['imager'], // ajouter le nom de l'image
                        'size'  => $prod['size'],
                        'price' => $prod['price'],
                        'orders' => []
                    ];
                }

                $productCount[$title]['orders'][] = [
                    'order_id' => $order->id,
                    'client'   => $order->nom . ' ' . $order->prenom,
                    'total'    => $prod['total'],
                ];
            }
        }
    }

    // Ventes récentes
    $recentSales = ValidatedOrder::orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();




    return view('admin.create', compact(
        'historiqueOrder',
        'comment',
        'mensOrder',
        'womansOrder',
        'shopOrder',
        'clients',
        'products',
        'productCount',
        'recentSales',
        'ordersCount',
        'revenue'
    ));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = AdminModel::where('email', $request->email)
                            ->where('password', $request->password)
                            ->first(); // يجلب أول سجل يطابق الشروط
    
        if ($admin) {
            return redirect()->route('admin.create');
        } else {
            return redirect()->back()->with('Erreur', 'Email ou mot de passe incorrect');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(AdminModel $adminModel) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $edits=AdminModel::find($id);
        return view('admin.edit',compact('edits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $admin = AdminModel::findOrFail($id);

        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = $request->password;
        }

        $admin->save();

        return redirect()->route('AddAdmin')->with('success', 'Admin updated');
        
        // AdminModel::find($id)->update($request->all());
        // return redirect()->route('AddAdmin');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AdminModel::find($id)->delete();
        return redirect()->route('AddAdmin');
    }

    public function AddAdmin(){
        $admins=AdminModel::paginate(6);
        return view('admin.AddAdmin',compact('admins'));
    }
    
    public function AjouterAdmin(){
        return view('admin.ajouterAdmin');
    }
    public function storeAddAdmin(Request $request){
        AdminModel::create($request->all());
        return redirect()->route('AddAdmin');
    }
}
