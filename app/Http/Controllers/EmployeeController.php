<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $employees=Employee::all();
        return view('pages.index', compact('employees'));
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
       $employee = new Employee();
        $employee->name = $request->name;
        $employee->department = $request->department;
        $employee->position = $request->position;

        $employee->save();
        return response()->json(['success' => 'data is successful added']);
    }
    public function show($id)
    {
        $employee = new Employee();
    }

    public function edit(Request $request)
    {
        
    }

    public function update(Request $request)
    {
        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->department = $request->department;
        $employee->position = $request->position;
        $employee->save();
        
        return response()->json(['success' => 'done updating']);
    }

    public function destroy(Request $request)
    {
        Employee::where('employeeid', $request->employee_id)->delete();
        return response ()->json(['success'=> 'done' ]);
    }
 
}
