<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specailization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        return Teacher::all();

    }



    public function StoreTeachers($request){
        try {
                $Teachers = new Teacher();
                $Teachers->Email = $request->Email;
                $Teachers->Password =  Hash::make($request->Password);
                $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
                $Teachers->Specailization_id = $request->Specailization_id;
                $Teachers->Gender_id = $request->Gender_id;
                $Teachers->Joining_Date = $request->Joining_Date;
                $Teachers->Address = $request->Address;
                $Teachers->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Teachers.create');
            }
            catch (Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }

        }

    public function getSpeciailization()
    {
      return  Specailization::all();


    }
    public function getGender()
    {

       return  Gender::all();

    }




    public function EditTeacher($id){
        return Teacher::findOrFail($id);


    }

    public function getAllspeciailaizations(){
        return Specailization::all();

    }
    public function getAllGenders(){
        return Gender::all();
    }
    public function UpdateTeacher($request)
    {
        try
        {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password = Hash::make($request->Password) ;
            $Teachers->Name = ['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $Teachers->Specailization_id = $request->Specailization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('Teachers.index');
        }

        catch(Exception $e)
        {
            return redirect()->back()->with(['error'=>$e->getMessage()]);

        }

    }



}
