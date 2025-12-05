<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=CommentsModel::paginate(6);
        return view('comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comments.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CommentsModel::create($request->all());
        return redirect()->route('comments.create')->with('success', 'Your message has been sent successfully!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(CommentsModel $commentsModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommentsModel $commentsModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentsModel $commentsModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($commentsModel)
    {
        CommentsModel::find($commentsModel)->delete();
        return redirect()->route('comments.index');
    }
}
