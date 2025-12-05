<?php

namespace App\Http\Controllers;

use App\Models\CompterUserModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
{
    $user = session('logged_user');
    if (!$user) {
        return redirect()->route('user.create');
    }

    $email = $user->email;

    $query = \App\Models\HistoriqueOrderModel::where('email', $email);

    if ($request->filled('date')) {
        try {
            // تحويل DD/MM/YYYY إلى YYYY-MM-DD
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $query->whereDate('created_at', $date);
        } catch (\Exception $e) {
            return redirect()->back()->with('erreur', 'Format de date invalide, utilisez JJ/MM/AAAA');
        }
    }

    $orders = $query->get();

    return view('users.index', compact('user', 'orders'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $email = $request->email;
    $password = $request->password;

    // التحقق من المستخدم
    $user = CompterUserModel::where('email', $email)
            ->where('password', $password)
            ->first();

    if ($user) {

        // حفظ المستخدم في السيشن
        session(['logged_user' => $user]);

        // توجيه إلى صفحة معلومات المستخدم
        return redirect()->route('user.index');
    }

    return redirect()->route('user.create')
            ->with("erreur", '⚠️ Email ou mot de passe incorrect.');
}


    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        //
    }

}
