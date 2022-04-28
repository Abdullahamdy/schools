<?php
namespace App\Http\Controllers\classrooms;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom as RequestsClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $classes = Classroom::all();
    $Grades = Grade::all();
    return view('pages.classRoom.class-room',compact('classes','Grades'));

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
  public function store(RequestsClassroom $request)
  {

      try{
        $validated= $request->validated();
        $list_classes = $request->List_Classes;
        foreach($list_classes as $listClass ){
        $My_classes = new Classroom();
        $My_classes->Name_Class = ['en'=>$listClass['Name_class_en'],'ar'=>$listClass['Name']];
        $My_classes->Grade_id = $listClass['Grade_id'];
        $My_classes->save();
    }
        toastr()->success(trans('message.success'));
        return redirect()->route('Classrooms.index');


      }catch(\Exception $e){
          return redirect()->back()->withErrors(trans('message.exists'));

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
  public function update(RequestsClassroom $request)
  {
    try{
        $validated = $request->validated();
        $class = Classroom::findOrFail($request->id);
        $class->update([
            $class->Name_Class =['ar'=>$request->Name,'en'=>$request->Name_class_en],
            $class->Grade_id = $request->Grade_id,

        ]);
        toastr()->success(trans('message.update'));
        return redirect()->route('Classrooms.index');
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
    $class = Classroom::findOrFail($request->id)->delete();
    toastr()->error(trans('message.delete'));
    return redirect()->route('Classrooms.index');

  }
  public function delete_all(Request $request){
   $delete_all = explode(",",$request->delete_all_id);
  Classroom::whereIn('id',$delete_all)->Delete();
  toastr()->error(trans('message.delete'));
  return redirect()->route('Classrooms.index');

  }
  public function FilterClass(Request $request){
      $Grades = Grade::all();
      $search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
      return view('pages.classRoom.class-room',compact('Grades'))->withSear($search);

  }

}

?>
