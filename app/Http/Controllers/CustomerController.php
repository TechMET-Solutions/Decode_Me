<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer()
    {
        $store = Customer::get();
        return view('admin.customer.list', compact('store'));
    }
    public function create()
    {
        return view('admin.customer.create');
    }
    public function store(Request $request)
    {
        // return $request->all();
        $store = new Customer;
        $store->question = $request->question;
        $store->desc = $request->desc;
        $store->status = $request->status ?? 'off';
        $store->save();
        return redirect()->route('admin.customer');
    }

    public function deletequestion(Request $request, $id)
    {
        $store = Customer::find($id);
        $store->delete();
        return back();
    }

    public function editquestion($id)
    {
        $store = Customer::find($id);
        // return $id;
        return view('admin.customer.edit', compact('store'));
    }
    public function updatequestion(Request $request)
    {
        // return $request->all();
        $store = Customer::find($request->id);
        // return $store;
        $store->question = $request->question;
        $store->desc = $request->desc;
        $store->status = $request->status ?? 'off';
        $store->save();
        return redirect()->route('admin.customer');
    }
}
