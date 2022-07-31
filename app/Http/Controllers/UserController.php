<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $datas = User::latest()->get();
        return view('admin.user.index', compact('datas'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {

        try {
            User::create([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('user.index')->with('success', 'User Added');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);
            $data->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            return redirect()->route('user.index')->with('success', 'User Edited');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.user.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = User::find($id);

            $data->delete();

            return redirect()->route('user.index')->with('success', 'deleted.');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
