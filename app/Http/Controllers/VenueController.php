<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{

    public function index()
    {
        $venue = Venue::get();
        return view('admin.venue.index', compact('venue'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $venue = new Venue;
        $venue->venue = $request->venue;
        $venue->save();
        return redirect()->route('admin.venue')->with('success', 'Data Added Successfully!!!!!');
    }


    public function show(Venue $venue)
    {
        //
    }


    public function edit(Venue $venue)
    {
        //
    }


    public function update(Request $request, Venue $venue)
    {
        $venue = Venue::find($request->id);
        //return $request->venue;
        $venue->venue = $request->venue;
        $venue->save();
        return redirect()->route('admin.venue')->with('success', 'Data Updated Successfully!!!!!');
    }

    public function delete($id)
    {
        $venue = Venue::find($id);
        $venue->delete();
        return redirect()->route('admin.venue')->with('success', 'Data Deleted Successfully!!!!!');
    }
}
