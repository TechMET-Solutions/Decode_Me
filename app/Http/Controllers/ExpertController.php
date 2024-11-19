<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpertController extends Controller
{

    public function index()
    {
        $expert = Expert::get();
        return view('admin.expert.index', compact('expert'));
    }

    public function addExpert()
    {
        return view('admin.expert.addExpert');
    }

    public function storeExpert(Request $request)
    {
        // return $request->all();
        $expert = new Expert;
        $expert->name = $request->name;
        $expert->phone = $request->phone;
        $expert->email = $request->email;
        $expert->date_of_birth = $request->date_of_birth;
        $expert->qualification = $request->qualification;
        $expert->occupation = $request->occupation;
        $expert->designation = $request->designation;
        $expert->department = $request->department;
        $expert->expertise = $request->expertise;
        $expert->bank_account_holder_name = $request->bank_account_holder_name;
        $expert->account_number = $request->account_number;
        $expert->date_of_join = $request->date_of_join;
        // $expert->date_of_resignation = $request->date_of_resignation;

        if ($request->hasFile('aadhar_card')) {
            $aadhar_card_image = time() . '.' . $request->aadhar_card->extension();
            $request->aadhar_card->move(
                'images',
                $aadhar_card_image
            );
        } else {
            $aadhar_card_image = '';
        }
        $expert->aadhar_card = $aadhar_card_image;

        if ($request->hasFile('pan_card')) {
            $pan_card_image = time() + 1 . '.' . $request->pan_card->extension();
            $request->pan_card->move(
                'images',
                $pan_card_image
            );
        } else {
            $pan_card_image = '';
        }
        $expert->pan_card = $pan_card_image;

        if ($request->hasFile('photo')) {
            $expert_image = time() + 2 . '.' . $request->photo->extension();
            $request->photo->move(
                'images',
                $expert_image
            );
        } else {
            $expert_image = '';
        }
        $expert->photo = $expert_image;

        $expert->desc = $request->desc;
        $expert->save();
        return redirect()->route('admin.expert')->with('success', 'Data Added Successfully!!!!');
    }

    public function edit(Expert $expert, $id)
    {
        $expert = Expert::find($id);
        return view('admin.expert.edit', compact('expert'));
    }

    public function update(Request $request, Expert $expert, $id)
    {
        $expert = Expert::find($id);
        $expert->name = $request->name;
        $expert->phone = $request->phone;
        $expert->email = $request->email;
        $expert->date_of_birth = $request->date_of_birth;
        $expert->qualification = $request->qualification;
        $expert->occupation = $request->occupation;
        $expert->designation = $request->designation;
        $expert->department = $request->department;
        $expert->expertise = $request->expertise;
        $expert->bank_account_holder_name = $request->bank_account_holder_name;
        $expert->account_number = $request->account_number;
        $expert->date_of_join = $request->date_of_join;
        // $expert->date_of_resignation = $request->date_of_resignation;

        if ($request->hasFile('aadhar_card')) {
            $aadhar_card_image = time() . '.' . $request->aadhar_card->extension();
            $request->aadhar_card->move('images', $aadhar_card_image);
            $filePath = public_path('images/' . $expert->aadhar_card);

            if (is_file($filePath)) {
                unlink($filePath);
            }

            $expert->aadhar_card = $aadhar_card_image;
        }

        if ($request->hasFile('pan_card')) {
            $pan_card_image = time() + 1 . '.' . $request->pan_card->extension();
            $request->pan_card->move('images', $pan_card_image);
            $filePath = public_path('images/' . $expert->pan_card);

            if (is_file($filePath)) {
                unlink($filePath);
            }

            $expert->pan_card = $pan_card_image;
        }

        if ($request->hasFile('photo')) {
            $photo_image = time() + 2 . '.' . $request->photo->extension();
            $request->photo->move('images', $photo_image);
            $filePath = public_path('images/' . $expert->photo);

            if (is_file($filePath)) {
                unlink($filePath);
            }

            $expert->photo = $photo_image;
        }

        $expert->desc = $request->desc;
        $expert->save();
        return redirect()->route('admin.expert')->with('success', 'Data Update Successfully!!!!');
    }

    public function delete(Expert $expert, $id)
    {
        $expert = Expert::find($id);
        $expert->delete();
        return redirect()->route('admin.expert')->with('success', 'Data Delete Successfully!!!!');
    }

    public function expertListPDF()
    {
        $experts = Expert::get();
        // return  $experts;
        if (!$experts->isEmpty()) {
            $data = [
                'title' => 'Experts List',
                'date' => date('d/m/Y'),
                'experts' => $experts
            ];
            $pdf = Pdf::loadView('admin.expert.expertListPDF', $data);
            return $pdf->download('ExpertsList.pdf');
        } else {
            return redirect()->back()->with('failed', 'Unable to download PDF because there is no Expert in database');
        }
    }
}
