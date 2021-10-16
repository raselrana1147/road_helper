@extends('layouts.admin.app')
@section('title','Road Helper | Add Hotel')
@section('css')
 <link rel="stylesheet" href="{{asset('assets/backend/style/css/summernote.css')}}">
@endsection
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Hotel</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('main')
<div id="message_area" style="display: none"></div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
     
        <div class="col-md-10 offset-1">
          <!-- general form elements -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-right"> <a href="javascript:history.back();" class="btn btn-danger">Back</a></h3>
            </div>
 
            <form data-action="{{ route('hotel.store') }}" method="post" id="add_hotel_form">
              @csrf
              <div class="card-body">
                <div class="row">
                  
                  <div class="form-group col-md-6">
                    <label>Hotel Name</label>
                    <input type="text" class="form-control" name="hotel_name" required="">
                  </div>

                   <div class="form-group col-md-6">
                    <label>Help Number</label>
                    <input type="text" class="form-control" name="help_number" required="">
                  </div>

                  
                </div>

                <div class="row">
                   <div class="form-group col-md-12">
                    <label>Address</label>
                    <textarea id="summernote"name="address" required></textarea>
                  </div>

                </div>

                <div class="row">
                <div class="form-group col-md-6">
                  <label  class="form-group">Division Name</label>
                  <select class="form-control" name="division_id" required id="select_division" data-action="{{route('getAllDistrict')}}">
                    @php
                      $divisions=App\models\admin\Division::all();
                    @endphp
                    @foreach ($divisions as $division)
                     <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                   
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label  class="form-group">District Name</label>
                  <select class="form-control" name="district_id"  required="" id="loadAlldistrict">
                    
                  </select>
                </div>
                </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success" id="submit_button">Add</button>
             
     
                </div>
              </div>
            </form>
          </div>

        </div>
     
     
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection
@section('js')
 <script src="{{asset('assets/backend/style/js/summernote.js')}}"></script>
  <script>

    $(document).ready(function(){
        $('body').on('submit','#add_hotel_form',function(e){
               
                e.preventDefault();
                let formDta = new FormData(this);
                 $('#submit_button').text("Working..").prop('disabled',true);
                $.ajax({
                  url: $(this).attr('data-action'),
                  method: "POST",
                  data: formDta,
                  cache: false,
                  contentType: false,
                  processData: false,
                  success:function(response){
                    let data=JSON.parse(response);
                    if (data.status===200) {
                      $('#message_area').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
                       $('#submit_button').text("Add").prop('disabled',false);
                    }else{
                      $('#message_area').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
                    }
                    $("#add_hotel_form")[0].reset(); 
                    $('#submit_button').text("Add").prop('disabled',false);
                  },

                  error:function(response){
                     
                   
                  }

                });
          });

        $('body').on('change','#select_division',function(){
                  let division_id=$(this).val();

                  $.ajax({
                  url: $(this).attr('data-action'),
                  method: "POST",
                  data:{division_id:division_id},
                  
                  success:function(response){
                    let data=JSON.parse(response);
                    var setItem='';
                    data.districts.forEach(function(item,index){
                       // console.log(item.name)
                        setItem+='<option value="'+item.id+'">'+item.name+'</option>'
                    });

                     $('#loadAlldistrict').html(setItem);
                   
                  },

                  error:function(response){
                   
                   
                  }

                });

          });

        $('#summernote').summernote();
      });
    
  </script>
@endsection