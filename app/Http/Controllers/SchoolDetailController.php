<?php

namespace App\Http\Controllers;

use App\Models\ProgressVideo;
use App\Models\SchoolDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SchoolDetailController extends Controller
{

    public function schoolList()
    {
        $schoolDetail = SchoolDetail::get();
        return view('admin.schooldetails.schoolList', compact('schoolDetail'));
    }


    public function addSchool()
    {
        return view('admin.schooldetails.addSchool');
    }


    public function storeSchool(Request $request)
    {
        // return $request->all();
        $schoolDetail = new SchoolDetail;
        $schoolDetail->school_name = $request->school_name;
        $schoolDetail->school_code = $request->school_code;
        $schoolDetail->school_email = $request->school_email;
        $schoolDetail->school_place = $request->school_place;
        $schoolDetail->status = $request->status;
        $schoolDetail->school_contact = $request->school_contact;
        $schoolDetail->concern_person_name = $request->concern_person_name;
        $schoolDetail->concern_person_phone = $request->concern_person_phone;
        $schoolDetail->alt_contact_person_name = $request->alt_contact_person_name;
        $schoolDetail->alt_contact_person_phone = $request->alt_contact_person_phone;
        $schoolDetail->date_of_join = $request->date_of_join;
        $schoolDetail->save();
        return redirect()->route('admin.schoollist')->with('success', 'Data Added Successfully!!!!');
    }


    public function editSchool(SchoolDetail $schoolDetail, $id)
    {
        $schoolDetail = SchoolDetail::find($id);
        return view('admin.schooldetails.editschool', compact('schoolDetail'));
    }


    public function updateSchool(Request $request, SchoolDetail $schoolDetail, $id)
    {
        $schoolDetail = SchoolDetail::find($id);
        $schoolDetail->school_name = $request->school_name;
        $schoolDetail->school_code = $request->school_code;
        $schoolDetail->school_email = $request->school_email;
        $schoolDetail->school_place = $request->school_place;
        $schoolDetail->status = $request->status;
        $schoolDetail->school_contact = $request->school_contact;
        $schoolDetail->concern_person_name = $request->concern_person_name;
        $schoolDetail->concern_person_phone = $request->concern_person_phone;
        $schoolDetail->alt_contact_person_name = $request->alt_contact_person_name;
        $schoolDetail->alt_contact_person_phone = $request->alt_contact_person_phone;
        $schoolDetail->date_of_join = $request->date_of_join;
        $schoolDetail->save();
        return redirect()->route('admin.schoollist')->with('success', 'Data Update Successfully!!!!');
    }


    public function delete(SchoolDetail $schoolDetail, $id)
    {
        $schoolDetail = SchoolDetail::find($id);
        $schoolDetail->delete();
        return redirect()->route('admin.schoollist')->with('success', 'Data Deleted Successfully!!!!');
    }

    public function status(Request $request, SchoolDetail $schoolDetail, $id)
    {
        // return $id;
        $schoolDetail = SchoolDetail::find($id);
        if ($schoolDetail->status == '0') {
            $schoolDetail->status = '1';
            $schoolDetail->save();
        } elseif ($schoolDetail->status == '1') {
            $schoolDetail->status = '0';
            $schoolDetail->save();
        }

        return back()->with('success', 'Status changed Successfully!!!!');
    }

    public function schoolsListPDF()
    {
        $schools = SchoolDetail::where('status', '0')->get();
        //return  $schools;
        $data = [
            'title' => 'DecodeMe School List',
            'date' => date('d/m/Y'),
            'schools' => $schools
        ];
        $pdf = PDF::loadView('admin.schooldetails.schoolsListPDF', $data);
        return $pdf->download('SchoolList.pdf');
        // $directory = public_path('pdfs');
        // $filePath = $directory . '/SchoolList.pdf';

        // if (!file_exists($directory)) {
        //     mkdir($directory, 0777, true);
        // }

        // $pdf->save($filePath);

        // return back()->with('success', 'PDF downloaded Successfully!!!!');
    }

    public function video()
    {
        // return "test";
        $progressVideos = ProgressVideo::with('student')->get();
        $progressVideos->map(function ($stud) {
            $stud->stud_name = $stud->student->name;
            $stud->stud_std = $stud->student->std;
            return $stud;
        });
        return view('admin.videos.index', compact('progressVideos'));
    }

    public function videoConfirm(Request $request)
    {
        // return $request->all();
        $progressVideos = ProgressVideo::find($request->video_id);
        // return $progressVideos;
        $progressVideos->status = $request->status;
        $progressVideos->save();
        return redirect()->back()->with('success', 'Video Approval/Disapprove done');
    }

   
}
