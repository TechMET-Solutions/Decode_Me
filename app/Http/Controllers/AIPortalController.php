<?php

namespace App\Http\Controllers;

use App\Models\AIPortal;
use Illuminate\Http\Request;

class AIPortalController extends Controller
{

    public function index()
    {
        $aiportal = AIPortal::get();
        return view('admin.aiportal.index', compact('aiportal'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $aiportal = new AIPortal;
        $aiportal->name = $request->name;
        $aiportal->link = $request->link;
        $aiportal->desc = $request->desc;
        $aiportal->save();
        return redirect()->route('admin.aiportal')->with('success', 'Data Added Successfully!!!!');
    }

    public function update(Request $request, AIPortal $aIPortal)
    {
        // return $request->all();
        $aiportal = AIPortal::find($request->id);
        $aiportal->name = $request->name;
        $aiportal->link = $request->link;
        $aiportal->desc = $request->desc;
        $aiportal->save();
        return redirect()->route('admin.aiportal')->with('success', 'Data Updated Successfully!!!!');
    }

    public function delete(AIPortal $aIPortal, $id)
    {
        $aiportal = AIPortal::find($id);
        $aiportal->delete();
        return redirect()->route('admin.aiportal')->with('success', 'Data Delete Successfully!!!!');
    }
}
