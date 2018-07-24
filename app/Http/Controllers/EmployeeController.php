<?php

namespace App\Http\Controllers;

use App\Employee;
use Auth;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
//    public function __construct(){
//        $this->middleware('user.check');
//    }
    public function index()
    {
        $employees=Employee::all();
        $currentUser = Auth::user()->nickname;
        return view('pages.index', compact('employees', 'currentUser'));
    } 
    public function getEmp()
    {
        $employees=Employee::all();
        return view('pages.employeesTable', compact('employees'));
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

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'department' => 'required|max:255',
            'position' => 'required|max:255'
        ]);
       $employee = new Employee();
        $employee->name = $request->name;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->save();
        
        return response()->json(['success' => 'data is successful added']);
    }
    public function update(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'department' => 'required|max:255',
            'position' => 'required|max:255'
        ]);
        
        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->save();
        
        return response()->json(['success' => 'done updating']);
    }

    public function destroy(Request $request)
    {
        Employee::where('employee_id', $request->employee_id)->delete();
        return response ()->json(['success'=> 'done' ]);
    }
 
}
