<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Profile::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'image' => 'nullable|image|mimes|:jpg, jpeg, png|max:1999',
        //     'city' => 'required'
        // ]);

        // Move image to storage
        $request->file('image')->store('public/images');

        // // Get original image original name
        // $name = $request->file('image')->getClientOriginalName();

        // // Get image size
        // $size = $request->file('image')->getSize();

        $profile = new Profile();
        $profile->user_id = $request->user_id;
        $profile->city = $request->city;
        $profile->image = $request->file('image')->hashName();
        $profile->save();

        return response()->json(['message' => 'Post created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Profile::findOrFail($id);
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
        // $request->validate([
        //     'image' => 'nullable|image|mimes|:jpg, jpeg, png|max:1999',
        //     'city' => 'required'
        // ]);

        // Move image to storage
        $request->file('image')->store('public/images');

        // // Get original image original name
        // $name = $request->file('image')->getClientOriginalName();

        // // Get image size
        // $size = $request->file('image')->getSize();

        $profile = Profile::findOrFail($id);
        $request->city = $request->city;
        $profile->image = $request->file('image')->hashName();
        $profile->save();

        return response()->json(['message' => 'Post updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::destroy($id);
        if($profile == 1) {
            return response()->json(['message' => 'Profile deleted'], 200);
        }else {
            return response()->json(['message' => 'Cannot delete empty id'], 400);
        }
    }
}
