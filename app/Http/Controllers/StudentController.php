<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function index(){
        return view('student.index');
    }
    public function store(Request $request){
        $validate=Validator::make($request->all(),[
           "name"=>'required',
           "email"=>'required|email',
           "phone"=>'required',
           "address"=>'required',
        ]);
        if ($validate->fails()){
            return response()->json([
               'status'=>'400',
               'errors'=>$validate->messages(),
            ]);

        }
        else{
            $student=new Student;
            $student->name=$request->name;
            $student->email=$request->email;
            $student->phone=$request->phone;
            $student->address=$request->address;
            $student->save();
            return response()->json([
                'status'=>'200',
                'message'=>'Added',
            ]);

        }

    }
    public function show(){
        $students=Student::all();
//        return $students;
        return response()->json([
            'students'=>$students,
        ]);
    }
    public function edit($id){
        $student=Student::find($id);
        if ($student){
            return response()->json([
               'status'=>200,
               'student'=>$student,
            ]);
        }
        else{
            return response()->json([
                'status'=>400,
                'student'=>"student NotFound",
            ]);
        }
    }
    public function update(Request $request ,$id){

        $validate=Validator::make($request->all(),[
            "name"=>'required',
            "email"=>'required|email',
            "phone"=>'required',
            "address"=>'required',
        ]);
        if ($validate->fails()){
            return response()->json([
                'status'=>'400',
                'errors'=>$validate->messages(),
            ]);

        }
        else{
            $student=Student::find($id);
            if ($student){
                $student->name=$request->name;
                $student->email=$request->email;
                $student->phone=$request->phone;
                $student->address=$request->address;
                $student->update();
                return response()->json([
                    'status'=>'200',
                    'message'=>'updated',
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'student'=>"student NotFound",
                ]);
            }


        }
    }
    public function delete_student($id){
        $student=Student::find($id);
        $student->delete();
        return response()->json([
            'status'=>200,
            'message'=>"student Deleted",
        ]);
    }
}
