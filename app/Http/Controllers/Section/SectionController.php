<?php


namespace App\Http\Controllers\Section;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $Grade_sec = Grade::with(['Sections'])->get();
      $allGrade = Grade::all();
      $teachers = Teacher::all();
      return view('pages.sections.section',compact('Grade_sec','allGrade','teachers'));

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
  public function store(Request $request)
  {
      try{
      $section = new Section();
      $section->Name_Section = ['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
      $section->Grade_id = $request->Grade_id;
      $section->Class_id = $request->Class_id;
      $section->Status =1;
      $section->save();
      $section->teachers()->attach($request->teacher_id);
      toastr()->success(trans('message.success'));
      return redirect()->route('Sections.index');
    }catch(\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);

    }

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
  public function update(Request $request)
  {
    try{
        $section = Section::findOrFail($request->id);
        $section->Name_Section = ['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
        $section->Grade_id = $request->Grade_id;
        $section->Class_id = $request->Class_id;
        if(isset($request->Status)){
            $section->Status =1;

        }else{
            $section->Status =2;

        }

        if(isset($request->teacher_id)){
            $section->teachers()->sync($request->teacher_id);

        }else{
            $section->teachers()->sync(array());
        }

        $section->save();
        toastr()->success(trans('message.update'));
        return redirect()->route('Sections.index');
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
    $class = Section::findOrFail($request->id)->delete();
    toastr()->error(trans('message.delete'));
    return redirect()->route('Sections.index');

  }
  public function getclass($tt){
      $listClasses = Classroom::where("Grade_id",$tt)->pluck("Name_Class","id");
      return $listClasses;

  }

}

?>
