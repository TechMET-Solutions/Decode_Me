<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CareerClub;
use App\Models\MOM;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;

class CareerClubController extends Controller
{

    public function index()
    {
        $careerclub = CareerClub::get();
        $schoolDetails = SchoolDetail::get();
        $student = User::where('role', 'user')->get();
        //  $moms = MOM::get();
        $moms = MOM::with('student', 'school', 'careerclub')->get();
        $moms->map(function ($mom) {
            $mom->stud_name = $mom->student->name;
            $mom->school_name = $mom->school->name;
            $mom->cc_name = $mom->careerclub->name;
            return $mom;
        });
        return view('admin.careerclub.index', compact('careerclub', 'schoolDetails', 'student', 'moms'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $careerclub = new CareerClub;
        $careerclub->name = $request->name;
        $careerclub->link = $request->link;
        $careerclub->sch_id = $request->school_id;
        $careerclub->leader_name = json_encode($request->leader_name);
        $careerclub->save();
        return redirect()->route('admin.careerclub')->with('success', 'Data Added Successfully!!!!');
    }

    public function update(Request $request)
    {
        // return $request->all();
        $careerclub = CareerClub::find($request->id);
        $careerclub->name = $request->name;
        $careerclub->link = $request->link;
        $careerclub->sch_id = $request->sch_id;
        $careerclub->leader_name = json_encode($request->leader_name);
        $careerclub->save();
        return redirect()->back()->with('success', 'Data Updated Successfully..');
    }

    public function delete(CareerClub $careerClub, $id)
    {
        $careerclub = CareerClub::find($id);
        $careerclub->delete();
        return redirect()->route('admin.careerclub')->with('success', 'Data Deleted Successfully!!!!');
    }
}
