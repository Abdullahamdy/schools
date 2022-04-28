@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                 تراجع الكل
                                  </button>



  <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>المرحله الدراسيه السابقة</th>
                                            <th>الصف الدراسي السابق</th>
                                            <th>القسم الدراسي السابق</th>
                                            <th>المرحله الدراسيه الحاليه</th>
                                            <th>الصف الدراسي الحالي</th>
                                            <th>القسم الدراسي الحالي</th>
                                            <th>العمليات</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$promotion->Student->name}}</td>
                                            <td>{{$promotion->Grade->Name}}</td>
                                            <td>{{$promotion->Classroom->Name_Class}}</td>
                                            <td>{{$promotion->Section->Name_Section}}</td>
                                            <td>{{$promotion->to_Grade->Name}}</td>
                                            <td>{{$promotion->to_classroom->Name_Class}}</td>
                                            <td>{{$promotion->to_Section->Name_Section}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                </td>
                                            </tr>
      @include('pages.Student.Promotion.Delete_one')


                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">تراجع</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Promotion.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden"name="page_id"value = "1">



                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من تراجع الكل</h5>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                    </div>
                </form>
            </div>

          </div>
        </div>

      </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
