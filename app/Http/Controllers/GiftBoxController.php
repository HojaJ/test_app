<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Gift_box;
use App\Models\User;
use Illuminate\Http\Request;

class GiftBoxController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $datas = Gift_box::latest()->get();
        return view('admin.gift_box.index', compact('datas', 'users'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {
        try {
            Gift_box::create([
                'name'  => $request->name,
            ]);

            return redirect()->route('gift_box.index')->with('success', 'Gift Box Added');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function giveToUser(Request $request)
    {
        try {
            $gift_box = Gift_box::find($request->gift_box_id);
            if($request->user_id){
                $user = User::find($request->user_id);
                $gift_box->update([
                    'user_id' => $user->id
                ]);
            }else {
                $gift_box->update([
                    'user_id' => null
                ]);
            }

            return redirect()->back()->with('success', 'Gift Box Added to User  ');
        }catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Gift_box::find($id);
            $data->update([
                'name'  => $request->name,
            ]);

            return redirect()->route('gift_box.index')->with('success', 'Gift Box Edited');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $data = Gift_box::find($id);
        return view('admin.gift_box.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = Gift_box::find($id);
            $data->delete();;
            return redirect()->route('gift_box.index')->with('success', 'Pozuldy.');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
