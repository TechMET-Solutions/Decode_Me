<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{

    public function index()
    {
        $career = Career::get();
        return view('admin.career.index', compact('career'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $career = new Career;
        $career->name = $request->name;
        $career->desc = $request->desc;
        $career->save();
        return redirect()->route('admin.careerlist')->with('success', 'Data Added Successfully!!!!');
    }


    public function show(Career $career)
    {
        //
    }


    public function edit(Career $career)
    {
        //
    }


    public function update(Request $request, Career $career)
    {
        //return $request->all();
        $career = Career::find($request->career_id);
        $career->name = $request->name;
        $career->desc = $request->desc;
        $career->save();
        return redirect()->route('admin.careerlist')->with('success', 'Data Updated Successfully!!!!');
    }


    public function delete(Career $career, $id)
    {
        $career = Career::find($id);
        $career->delete();
        return redirect()->route('admin.careerlist')->with('success', 'Data Deleted Successfully!!!!');
    }
}
