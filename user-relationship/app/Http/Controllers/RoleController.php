<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::latest()->get();
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
        //     'role' => 'required',
        //     'status' => 'required'
        // ]);

        $role = new Role();
        $role->user_id = $request->user_id;
        $role->role = $request->role;
        $role->status = $request->status;

        $role->save();

        return response()->json(['message' => 'Role created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Role::findOrFail($id);
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
        $request->validate([
            'role' => 'required',
            'status' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->role = $request->role;
        $role->status = $request->status;

        $role->save();

        return response()->json(['message' => 'Role updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::destroy($id);
        if($role == 1) {
            return response()->json(['message' => 'Role deleted'], 200);
        }else {
            return response()->json(['message' => 'Cannot delete empty id'], 400);
        }
    }
}
