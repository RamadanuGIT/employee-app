<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EmployeeController extends Controller
{
    //
    public function index(){
        return view('dashboard.employee.index',[
            'title' => 'Employee List',
            'employes' => Employee::all()
        ]);
    }

    public function create(){
        return view('dashboard.employee.create',[
            'title' => 'Create Employee',
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'no_employe' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'position' => 'required',
        ]);

        $age = Carbon::parse($request->dob)->age;
        if ($age < 17) {
            return redirect()->back()->withErrors(['dob' => 'Age must be greater than 17']);
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('employee-photo'), $filename);
            $data['photo'] = $filename;
        }

        Employee::create($data);
        return redirect()->route('employee')->with('success','Data successfully Created');

    }

    public function update(Request $request, $id){
        $emp = Employee::findOrFail($id);
        $data = $request->validate([
            'no_employe' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'position' => 'required',
        ]);


        $age = Carbon::parse($request->dob)->age;
        if ($age < 17) {
            return redirect()->back()->withErrors(['dob' => 'Age must be greater than 17']);
        }

        if ($request->hasFile('photo')) {
            if ($emp->photo && file_exists(public_path('employee-photo'. $emp->photo))) {
                unlink(public_path('employee-photo'. $emp->photo));
            }
            $image = $request->file('photo');
            $filename = time() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('employee-photo'), $filename);
            $data['photo'] = $filename;
        }

        $emp->update($data);
        return redirect()->back()->with('success','Update successfully');

    }

    public function destroy($id){
        $emp = Employee::findOrFail($id);

        if ($emp->photo && file_exists(public_path('employee-photo'. $emp->photo))) {
            unlink(public_path('employee-photo'. $emp->photo));
        }

        $emp->delete();
        return redirect()->back()->with('success','Delete Data Successfully');
    }
}
