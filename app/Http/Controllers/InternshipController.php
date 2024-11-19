<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{

    public function internshipList()
    {
        $internship = Internship::get();
        return view('admin.internship.Internshiplist', compact('internship'));
    }


    public function addInternship()
    {
        return view('admin.internship.add');
    }


    public function storeInternship(Request $request)
    {
        $internship = new Internship;
        $internship->company_name = $request->company_name;
        $internship->link = $request->link;
        $internship->field_name = $request->field_name;
        $internship->duration = $request->duration;
        $internship->time = $request->time;
        $internship->joining_date = $request->joining_date;
        $internship->venue = $request->venue;
        $internship->start_date = $request->start_date;
        $internship->end_date = $request->end_date;
        $internship->mode = $request->mode;
        $internship->desc = $request->desc;
        $internship->save();
        return redirect()->route('admin.internshiplist')->with('success', 'Data Added Successfully!!!!');
    }


    public function show(Internship $internship)
    {
        //
    }

    public function edit(Internship $internship, $id)
    {
        $internship = Internship::find($id);
        return view('admin.internship.edit', compact('internship'));
    }


    public function update(Request $request, Internship $internship, $id)
    {
        $internship = Internship::find($id);
        $internship->company_name = $request->company_name;
        $internship->link = $request->link;
        $internship->field_name = $request->field_name;
        $internship->duration = $request->duration;
        $internship->time = $request->time;
        $internship->joining_date = $request->joining_date;
        $internship->venue = $request->venue;
        $internship->start_date = $request->start_date;
        $internship->end_date = $request->end_date;
        $internship->mode = $request->mode;
        $internship->desc = $request->desc;
        $internship->save();
        return redirect()->route('admin.internshiplist')->with('success', 'Data Updated Successfully!!!!');
    }


    public function delete(Internship $internship, $id)
    {
        $internship = Internship::find($id);
        $internship->delete();
        return redirect()->route('admin.internshiplist')->with('success', 'Data Deleted Successfully!!!!');
    }
}
