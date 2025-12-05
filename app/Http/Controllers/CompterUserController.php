<?php

namespace App\Http\Controllers;

use App\Models\CompterUserModel;
use Illuminate\Http\Request;

class CompterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listusers=CompterUserModel::paginate(10);
        return view('compteruser.index',compact('listusers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('compteruser.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password=$request->password;
        $confirmpassword=$request->confirm_password;
        $email=$request->email;
        $verefieremail = CompterUserModel::where('email', $email)->first();
        if($password==$confirmpassword && !$verefieremail){
            CompterUserModel::create($request->all());
            return redirect()->route('user.create');
        }else{
            return redirect()->route('comperuser.create')->with("erreur",' ⚠️ Please re-enter the confirmation code to verify your account.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompterUserModel $compterUserModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompterUserModel $compterUserModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompterUserModel $compterUserModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($compterUserModel)
    {
        CompterUserModel::find($compterUserModel)->delete();
        return redirect()->route('comperuser.index');
    }
}
