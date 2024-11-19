<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Venue;
use App\Models\Expert;
use App\Models\DMSession;
use App\Models\DMTimeSlot;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\StudentSession;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelDmSessionStudMail;

class DMSessionController extends Controller
{

    public function dmlist()
    {
        $studsession = StudentSession::with('expert', 'student')->orderBy('id', 'desc')->get();
        // return $studsession;
        $studsession->map(function ($ses) {
            $ses->student_name = $ses->student->name;
            $ses->expert_name = $ses->expert->name;
            return $ses;
        });

        // return $studsession;

        foreach ($studsession as $sslist) {
            $time = $sslist->time;
            $times = explode(' to ', $time);

            // Check if the time string has two parts
            if (count($times) === 2) {
                // Attempt to parse the start and end times
                $startTime = Carbon::createFromFormat('h:i A', trim($times[0]))->format('H:i');
                $endTime = Carbon::createFromFormat('h:i A', trim($times[1]))->format('H:i');
                //return $endTime;
                $currentTime = Carbon::now('Asia/Kolkata')->format('H:i');
                // return $currentTime;
                if ($endTime <= $currentTime && $sslist->date == date('Y-m-d')) {
                    // return 'hellow';
                    if ($sslist->status == '0') {
                        // return 'hello';
                        $sst = StudentSession::find($sslist->id);
                        //return $sst;
                        $sst->status = '2';
                        $sst->save();
                    } elseif ($sslist->status == '1') {
                        // return 'hello';
                        $sst = StudentSession::find($sslist->id);
                        //return $sst;
                        $sst->status = '2';
                        $sst->save();
                    }
                } elseif ($sslist->date < date('Y-m-d') && $sslist->status != '3') {
                    // return 'hello';
                    $sst = StudentSession::find($sslist->id);
                    //return $sst;
                    $sst->status = '2';
                    $sst->save();
                }
            }
        }

        //return $studsession;
        return view('admin.dmsession.dmlist', compact('studsession'));
    }

    public function index()
    {
        $dms = DMSession::orderBy('id', 'DESC')->get();
        $expert = Expert::get();
        return view('admin.dmsession.index', compact('dms', 'expert'));
    }

    public function create()
    {
        $venue = Venue::get();
        $dmsession = DMSession::where('date', '<=', date('Y-m-d'))->get();
        $expert = Expert::all();
        $dmtimeslot = DMTimeSlot::all();
        return view('admin.dmsession.create', compact('expert', 'dmtimeslot', 'dmsession', 'venue'));
    }
    // public function getBookedVenues(Request $request)
    // {
    //     $date = $request->query('date');
    //     $bookedVenues = DMSession::where('date', $date)->pluck('venue')->toArray();
    //     return response()->json(['bookedVenues' => $bookedVenues]);
    // }


    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|array|min:1',
        ]);

        $dms = new DMSession;
        $dms->ex_id = $request->ex_id;
        $dms->date = $request->date;
        $dms->mode = $request->mode;
        $dms->venue = $request->venue;
        $dms->time = json_encode($request->time);
        $dms->save();


        return redirect()->route('admin.dmsession')->with('success', 'Data Added Successfully!!!!');
    }


    public function todaysdms(DMSession $dMSession)
    {
        $dms = DMSession::where('date', date('Y-m-d'))->get();
        // return $dms;
        $expert = Expert::get();
        $timeSlots = DMTimeSlot::get();
        return view('admin.dmsession.todays', compact('dms', 'expert', 'timeSlots'));
    }

    public function dmsessioncancel(Request $request, $id)
    {
        $studsession = StudentSession::find($id);
        $student = User::find($studsession->studId);
        $expert = Expert::find($studsession->ex_id);
        //return $expert;
        return view('admin.dmsession.cancelsession', compact('studsession', 'student', 'expert'));
    }
    public function storedmsessioncancel(Request $request, $id)
    {
        // return $request->all();
        $studsession = StudentSession::find($id);
        // return $studsession;
        if ($request->status == 'cancel') {
            $studsession->status = '3';
            $studsession->remark = $request->remark;
            $studsession->save();

            $student = User::find($studsession->studId);
            // return $student;
            $cancelDmSessionMailData = [
                'student_name' => $student->name,
                'date' => $studsession->date,
                'time' => $studsession->time,
                'reason' => $request->remark,
            ];
          //  Mail::to($student->email)->send(new CancelDmSessionStudMail($cancelDmSessionMailData));
            try {
                Mail::to($student->email)->send(new CancelDmSessionStudMail($cancelDmSessionMailData));
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $student->email . ': ' . $e->getMessage());
                return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
            }
        }
        return redirect()->route('admin.dmsessionlist')->with('success', 'Status change successfully');
    }



    public function edit(DMSession $dMSession, $id)
    {
        $dms = DMSession::find($id);
        $expert = Expert::get();
        $dmtimeslot = DMTimeSlot::get();
        return view('admin.dmsession.edit', compact('dms', 'expert', 'dmtimeslot'));
    }


    public function update(Request $request, DMSession $dMSession, $id)
    {
        $dms = DMSession::find($id);
        $dms->ex_id = $request->ex_id;
        $dms->date = $request->date;
        $dms->mode = $request->mode;
        $dms->venue = $request->venue;
        $dms->time = json_encode($request->time);
        $dms->save();
        return redirect()->route('admin.dmsession')->with('success', 'Data Updated Successfully!!!!');
    }


    public function delete(DMSession $dMSession, $id)
    {
        $dms = DMSession::find($id);
        $dms->delete();
        return redirect()->route('admin.dmsession')->with('success', 'Data Deleted Successfully!!!!');
    }

    public function timeSlotIndex()
    {
        $dmtimeslot = DMTimeSlot::get();
        return view('admin.dmsession.dmtimeslot', compact('dmtimeslot'));
    }

    public function storeTimeSlot(Request $request)
    {
        $dmtimeslot = new DMTimeSlot;
        $dmtimeslot->slot = $request->slot;
        $dmtimeslot->save();
        return redirect()->route('admin.dmtimeslot')->with('success', 'Data Added Successfully!!!!');
    }

    public function updateTimeSlot(Request $request, DMTimeSlot $dmts)
    {
        $dmts = DMTimeSlot::find($request->dmtimeslot_id);
        $dmts->slot = $request->slot;
        $dmts->save();
        return redirect()->route('admin.dmtimeslot')->with('success', 'Data Updated Successfully!!!!');
    }

    public function deleteTimeSlot($id)
    {
        $dmts = DMTimeSlot::find($id);
        $dmts->delete();
        return redirect()->route('admin.dmtimeslot')->with('success', 'Data Deleted Successfully!!!!');
    }

    public function storeAdminTakeaway(Request $request)
    {
        // return $request->all();
        $studsession = StudentSession::find($request->sId);
        $studsession->admintakeaway = $request->admintakeaway;
        $studsession->save();
        return redirect()->route('admin.dmsessionlist')->with('success', 'Admin Takeaway Added Successfully');
    }

    public function edittakeaway($id)
    {
        $takeaway = StudentSession::find($id);
        return view('admin.dmsession.edittakeaway', compact('takeaway'));
    }

    public function updatetakeaway(Request $request, $id)
    {
        //return $request->all();
        $takeaway = StudentSession::find($id);
        $takeaway->admintakeaway = $request->admintakeaway;
        $takeaway->takeaway = $request->takeaway;
        $takeaway->save();
        return redirect()->route('admin.dmsessionlist')->with('success', 'Data Updated Successfully!!!!');
    }
}
