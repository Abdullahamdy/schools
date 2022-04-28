<?php
namespace App\Repository;

use App\Models\Blood_Type;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_parent;
use App\Models\Nationalties;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
public function Create_Student(){
    $data['my_classes'] = Grade::all();
    $data['parents'] = My_parent::all();
    $data['Genders'] = Gender::all();
    $data['nationals'] = Nationalties::all();
    $data['bloods'] = Blood_Type::all();
    return view('pages.Student.add',$data);
}
public function Get_classrooms($id){
    $list_classes = Classroom::where('Grade_id',$id)->pluck('Name_Class','id');
    return $list_classes;

}
public function Get_Sections($id){
    $list_section = Section::where('Class_id',$id)->pluck('Name_Section','id');
    return  $list_section;

}
public function store_Student($request){
    DB::beginTransaction();

    try {
        $students = new Student();
        $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $students->email = $request->email;
        $students->password = Hash::make($request->password);
        $students->gender_id = $request->gender_id;
        $students->nationalitie_id = $request->nationalitie_id;
        $students->blood_id = $request->blood_id;
        $students->Date_Birth = $request->Date_Birth;
        $students->Grade_id = $request->Grade_id;
        $students->Classroom_id = $request->Classroom_id;
        $students->section_id = $request->section_id;
        $students->parent_id = $request->parent_id;
        $students->academic_year = $request->academic_year;
        $students->save();

        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

                // insert in image_table
                $images= new Image();
                $images->filename=$name;
                $images->imageable_id= $students->id;
                $images->imageable_type = 'App\Models\Student';
                $images->save();
            }
        }
        DB::commit();

        toastr()->success(trans('messages.success'));
        return redirect()->route('students.create');
    }

    catch (\Exception $e){
        DB::rollBack();
        
    }

}
public function Get_Student(){
  $students =   Student::all();
  return view('pages.Student.index',compact('students'));

}
public function edit($id){
    $data['Grades']=Grade::all();
    $data['parents']=My_parent::all();
    $data['Genders']=Gender::all();
    $data['nationals']=Nationalties::all();
    $data['bloods']=Blood_Type::all();
    $Students = Student::findOrFail($id);
    return view('pages.Student.edit',$data,compact('Students'));

}
public function Update_Student($request){
    try{
$students = Student::findOrFail($request->id);
$students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
$students->email = $request->email;
$students->password = Hash::make($request->password);
$students->gender_id = $request->gender_id;
$students->nationalitie_id = $request->nationalitie_id;
$students->blood_id = $request->blood_id;
$students->Date_Birth = $request->Date_Birth;
$students->Grade_id = $request->Grade_id;
$students->Classroom_id = $request->Classroom_id;
$students->section_id = $request->section_id;
$students->parent_id = $request->parent_id;
$students->academic_year = $request->academic_year;
$students->save();
toastr()->success(trans('message.update'));
return redirect()->route('students.index');
}catch(Exception $e){
    return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

}
}
public function Delete_Student($request){
Student::destroy($request->id);
toastr()->error(trans('message.delete'));
return redirect()->route('students.index');


}
public function show_student($id){
    $Student = Student::findorFail($id);
    return view('pages.student.show',compact('Student'));
}
public function upload_attachment($request){
    foreach($request->file('photos') as $file)
    {
        $name = $file->getClientOriginalName();
        $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

        // insert in image_table
        $images= new Image();
        $images->filename=$name;
        $images->imageable_id = $request->student_id;
        $images->imageable_type = 'App\Models\Student';
        $images->save();
    }
    toastr()->success(trans('messages.success'));
    return redirect()->route('students.show',$request->student_id);


}
public function Download_attachment($studentname,$filename){
    return response()->download(public_path('attachments/students/'.$studentname.'/'.$filename));

}
public function Delete_attachment($request){
    Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

    Image::where('id',$request->id)->where('filename',$request->filename)->delete();
    toastr()->success(trans('messages.success'));
    return redirect()->route('students.show',$request->student_id);
}


}
