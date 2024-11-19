<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function question()
    {
        $store = Question::get();
        return view('admin.question.list', compact('store'));
    }
    public function create()
    {
        return view('admin.question.create');
    }
    public function store(Request $request)
    {
        return $request->all();
        $store = new Question;
        $store->question = $request->question;
        $store->desc = $request->desc;
        $store->status = $request->status ? '1' : '0';
        $store->save();
        return redirect()->route('admin.question');
    }

    public function deletequestion(Request $request, $id)
    {
        $store = Question::find($id);
        $store->delete();
        return back();
    }

    public function editquestion($id)
    {
        $store = Question::find($id);
        // return $id;
        return view('admin.question.edit', compact('store'));
    }
    public function updatequestion(Request $request)
    {
        // return $request->all();
        $store = Question::find($request->id);
        // return $store;
        $store->question = $request->question;
        $store->desc = $request->desc;
        $store->status = $request->status ? '1' : '0';
        $store->save();
        return redirect()->route('admin.question');
    }


    public function status(Request $request, Question $question, $id)
    {
        // echo $id;
        $question = Question::find($id);
        if ($question->status == 1) {
            $question->status = 0;
        } elseif ($question->status == 0) {
            $question->status = 1;
        }
        $question->save();
        return back()->with('success', 'Status changed!!!!');
    }
}
