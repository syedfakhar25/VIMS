<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type != 'admin'){
            return redirect('dashboard');
        }
        else{
            $departments = Department::with('users')->get();
            //dd($departments);
            return view('department.index')->with([
                'departments' => $departments
            ]);
        }

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
        /*$user = new User();
        $user->name= $request->focal_person;
        $user->email = $request->email;
        $user->user_type = 'department_admin';
        $user->password = Hash::make('12345678');
        $user->save();*/
       // dd($user);
        $department = new Department();
        $department->user_id = 5;
        $department->dep_name = $request->dep_name;
        $department->focal_person = NULL;
        $department->phone = NULL;
        $department->save();

        return redirect()->back()->with([
           'success', 'Department Added Successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);

        return view('department.edit')->with(['department' =>$department]);
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
        $department = Department::find($id);
        $department->parent_id = $request->parent_id;
        $department->dep_name = $request->dep_name;
        $department->is_main_dep = $request->is_main_dep;

        $department->update();
        return  redirect()->route('department.index')->with([
            'success' => 'Department Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        $user= User::find($department->user_id);
        if($user!=NULL){
            $user->delete();
        }
        return redirect()->back()->with([
            'success', 'Department Deleted'
        ]);
    }
}
