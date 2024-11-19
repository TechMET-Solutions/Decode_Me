<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\SubCareer;
use Illuminate\Http\Request;

class SubCareerController extends Controller
{

    public function index()
    {
        $subcareer = SubCareer::get();
        $career = Career::get();
        return view('admin.subcareer.index', compact('career', 'subcareer'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // return $request->all();
        $subcareer = new SubCareer;
        $subcareer->name = $request->name;
        $subcareer->career_id = $request->career_id;
        $subcareer->desc = $request->desc;
        $subcareer->save();
        return redirect()->route('admin.subcareerlist')->with('success', 'Data Added Successfully!!!!');
    }

    public function show(SubCareer $subCareer)
    {
        //
    }


    public function edit(SubCareer $subCareer)
    {
        //
    }


    public function update(Request $request, SubCareer $subCareer)
    {
        // return $request->all();
        $subCareer = SubCareer::find($request->sub_career_id);
        $subCareer->name = $request->name;
        $subCareer->desc = $request->desc;
        $subCareer->save();
        return redirect()->back()->with('suceess', 'Data Updated Successfully!!!!');
    }


    public function delete(SubCareer $subCareer, $id)
    {
        $subcareer = SubCareer::find($id);
        $subcareer->delete();
        return redirect()->route('admin.subcareerlist')->with('success', 'Data Delete Successfully!!!!');
    }
}
