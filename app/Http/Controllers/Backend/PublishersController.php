<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Publisher;


class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('backend.pages.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable',
        ]);

        $publishers = new Publisher();
        $publishers->name = $request->name;
        $publishers->link = str_slug($request->name);
        $publishers->outlet = str_slug($request->outlet);
        $publishers->address = str_slug($request->address);
        $publishers->description = $request->description;
        $publishers->save();

        session()->flash('success', 'Publishers has been created !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable',
        ]);

        $publishers = publisher::find($id);
        $publishers->name = $request->name;
        // $publishers->link = str_slug($request->name);
        $publishers->description = $request->description;
        $publishers->save();

        session()->flash('success', 'publishers has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publishers = Publisher::find($id);
        $publishers->delete();

        session()->flash('success', 'publishers has been deleted !!');
        return back();
    }
}


