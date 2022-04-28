<?php

namespace App\Http\Controllers\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeGrade;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $grades = Grade::all();
    return view('pages.Grades.Grade',compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(storeGrade $request)
  {
    //   dd($request->all());
    // if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
    //     return redirect()->back()->withErrors(trans('message.exists'));
    // }


try{
    $validated = $request->validated();
    $Grade = new Grade();
    $Grade->Name = ['en'=>$request->Name_en,'ar'=>$request->Name];
    $Grade->Notes = $request->Notes;
    $Grade->save();

      toastr()->success(trans('message.success'));

      return redirect()->route('Grades.index');


}
catch(\Exception $e){
    return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

}

    //   return back();

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(storeGrade $request)   
  {
      try{
$validated = $request->validated();
$Grade = Grade::findOrFail($request->id);
$Grade->update([
    $Grade->Name =['ar'=>$request->Name,'en'=>$request->Name_en],
    $Grade->Notes = $request->Notes,

]);
toastr()->success(trans('message.update'));
return redirect()->route('Grades.index');
      }catch(\Exception $e){
          return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

      }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $myClasses_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');

    if($myClasses_id->count() == 0)
    {


        $Grade = Grade::findOrFail($request->id)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->route('Grades.index');

    }else{
        toastr()->error(trans('message.hasclass'));
        return redirect()->route('Grades.index');
    }





  }

}

?>
