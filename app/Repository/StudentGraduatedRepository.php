<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface{


    public function index(){
        $students = Student::onlyTrashed()->get();
        return view('pages.Student.Graduated.index',compact('students'));
    }
    public function create(){

        $Grades = Grade::all();
        return view('pages.Student.Graduated.create',compact('Grades'));
    }
    public function softDelete($request){
        $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
           if($students->count() < 1)
           {
               return redirect()->back()->with('error_Graduated',__('لا توجد بيانات في جدول الطلاب'));
           }
           foreach($students as $student){
               $ids = explode(',',$student->id);
               Student::whereIn('id',$ids)->delete();
           }
           toastr()->error(trans('message.delete'));
           return redirect()->route('Graduated.create');
    }
    public function update($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        toastr()->success(trans('message.update'));
        return redirect()->back();

    }
    public function Delete($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
        toastr()->success(trans('message.update'));
        return redirect()->back();

    }

}
