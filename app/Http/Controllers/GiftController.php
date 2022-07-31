<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Gift_box;
use App\Models\User;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $datas = Gift::latest()->get();
        $users = User::latest()->get();
        $gift_boxes = Gift_box::latest()->get();
        return view('admin.gift.index', compact('datas', 'users','gift_boxes'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {

        try {
            Gift::create([
                'name'  => $request->name,
            ]);

            return redirect()->route('gift.index')->with('success', 'User Added');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function giveToUser(Request $request)
    {
        try {
            $gift = Gift::find($request->gift_id);
            if($request->user_id){
                $user = User::find($request->user_id);
                $gift->update([
                    'user_id' => $user->id
                ]);
            }else {
                $gift->update([
                    'user_id' => null
                ]);
            }
            return redirect()->back()->with('success', 'Gift Added to User');
        }catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function addToBox(Request $request)
    {
        try {
            $gift = Gift::find($request->gift_id);
            if($request->giftbox_id) {
                $gift_box = Gift_box::find($request->giftbox_id);
                $gift->update([
                    'gift_box_id' => $gift_box->id
                ]);
            }else {
                $gift->update([
                    'gift_box_id' => null
                ]);
            }

            return redirect()->back()->with('success', 'Gift Added to Gift Box  ');
        }catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Gift::find($id);
            $data->update([
                'name'  => $request->name,
            ]);

            return redirect()->route('gift.index')->with('success', 'Gift Edited');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $data = Gift::find($id);
        return view('admin.gift.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = Gift::find($id);

            $data->delete();

            return redirect()->route('gift.index')->with('success', 'Deleted.');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
