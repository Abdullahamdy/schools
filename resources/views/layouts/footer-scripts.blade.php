<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->

   <script type="text/javaScript"> var plugin_path ='{{asset('assets/js')}}/';</script>



<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>



<script>
    $(document).ready(function(){
        $('select[name="Grade_id"]').on('change',function(){
            var Grade_id = $(this).val();
            if(Grade_id){
                $.ajax({
                    url:"{{URL::to('Get_classrooms')}}/"+Grade_id,
                    type:"Get",
                    dataType:"json",
                    success:function(data){
                        $('select[name="Classroom_id"]').empty();
                        $('select[name="Classroom_id"]').append('<option selected disabled>{{trans('select From Menue')}}</option>');

                        $.each(data,function(Key,Value){
                            $('select[name="Classroom_id"]').append('<option value="'+Key+'">'+Value+'</option>')
                        });

                    },
                });
            }else{
                'AJAX HAS BEEN ERROR';
            }
        });
    });




 </script>







{{-- //with me --}}


<script>
    $(document).ready(function(){
        $('select[name="Classroom_id"]').on('change',function(){
            var Classroom_id = $(this).val();
            if(Classroom_id){
                $.ajax({
                    url:"{{URL::to('Get_Sections')}}/"+Classroom_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled>selectClass</option>');
                        $.each(data,function(k,v){
                            $('select[name="section_id"]').append('<option value="'+ k +'">'+v+'</option>');

                        });
                    },
                });

            }else{
                return 'AJAX HAS BEEN ERROR';
            }

        });

    });
</script>


{{-- new promotion --}}


<script>
    $(document).ready(function(){
        $('select[name="Grade_id_new"]').on('change',function(){
            var Grade_id = $(this).val();
            if(Grade_id){
                $.ajax({
                    url:"{{URL::to('Get_classrooms')}}/"+Grade_id,
                    type:"Get",
                    dataType:"json",
                    success:function(data){
                        $('select[name="Classroom_id_new"]').empty();
                        $('select[name="Classroom_id_new"]').append('<option selected disabled>{{trans('select From Menue')}}</option>');

                        $.each(data,function(Key,Value){
                            $('select[name="Classroom_id_new"]').append('<option value="'+Key+'">'+Value+'</option>')
                        });

                    },
                });
            }else{
                'AJAX HAS BEEN ERROR';
            }
        });
    });




 </script>







{{-- //with me --}}


<script>
    $(document).ready(function(){
        $('select[name="Classroom_id_new"]').on('change',function(){
            var Classroom_id = $(this).val();
            if(Classroom_id){
                $.ajax({
                    url:"{{URL::to('Get_Sections')}}/"+Classroom_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="section_id_new"]').empty();
                        $('select[name="section_id_new"]').append('<option selected disabled>selectClass</option>');
                        $.each(data,function(k,v){
                            $('select[name="section_id_new"]').append('<option value="'+ k +'">'+v+'</option>');

                        });
                    },
                });

            }else{
                return 'AJAX HAS BEEN ERROR';
            }

        });

    });
</script>

