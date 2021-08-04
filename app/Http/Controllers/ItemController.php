<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use File;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('name')->get();
        return $items;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mode' => 'required',
            'stats' => 'required',
            'price' => 'required',
            'dropFromLvl' => 'required',
            'dropFromImg' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dropChance' => '',
            'maxLuck' => '',
        ]);
  
        $input = $request->all();
  
        if ($photo = $request->file('photo')) {
            $destinationPath = 'upload/item/';
            $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['photo'] = $profileImage;
        }

        if ($dropFromImg = $request->file('dropFromImg')) {
            $destinationPath = 'upload/mob/';
            $profileImage = date('YmdHis') . "." . $dropFromImg->getClientOriginalExtension();
            $dropFromImg->move($destinationPath, $profileImage);
            $input['dropFromImg'] = $profileImage;
        }
    
        Item::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $item = Item::where('id','=', $id)->first();
        // dd($item);
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        $request->validate([
            'name' => 'required',
            'photo' => '',
            'mode' => 'required',
            'stats' => 'required',
            'price' => 'required',
            'dropFromLvl' => 'required',
            'dropFromImg' => '',
            'dropChance' => '',
            'maxLuck' => '',
        ]);

        $input = $request->all();
        

        if ($photo = $request->file('photo')) {
            File::delete('upload/item/'.$item->photo);
            $destinationPath = 'upload/item/';
            $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $profileImage);
            $input['photo'] = "$profileImage";
        }

        if ($dropFromImg = $request->file('dropFromImg')) {
            File::delete('upload/mob/'.$item->dropFromImg);
            $destinationPath = 'upload/mob/';
            $profileImage = date('YmdHis') . "." . $dropFromImg->getClientOriginalExtension();
            $dropFromImg->move($destinationPath, $profileImage);
            $input['dropFromImg'] = "$profileImage";
        }

        
        $item->update($input);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        File::delete('upload/item/'.$item->photo);
        File::delete('upload/mob/'.$item->dropFromImg);
        $item->delete();
    }
}
