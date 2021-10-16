@extends('layouts.admin.app')
@section('title','Road Helper | Update Touring Place')
@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/style/css/summernote.css')}}">
    <style>
        .dropify-wrapper{
            width: 59%;
            height: 80%;
        }
    </style>
@endsection
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Touring Place</h1>
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

        <form data-action="{{ route('touring_place.update') }}" method="post" id="update_touring_place_form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$item->id}}">
          <div class="card-body">
            <div class="row">

              <div class="form-group col-md-6">
                <label>Place Name</label>
                <input type="text" class="form-control" name="place_name" required="" value="{{$item->place_name}}">
              </div>

              <div class="form-group col-md-6">
                <label>Help Number</label>
                <input type="text" class="form-control" name="help_number" required="" value="{{$item->help_number}}">
              </div>


            </div>

            <div class="row">

              <div class="form-group col-md-6">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" required="" value="{{$item->email}}">
              </div>

              <div class="form-group col-md-6">
               
                <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                      <div class="col-sm-10">
                          <input type="file" class="form-control dropify" name="image"  data-default-file="{{($item->image !==null) ? asset('assets/backend/touring/'.$item->image) : asset('assets/backend/touring/default.png') }}">
                      </div>

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
                 <option  {{($division->id==$item->division_id) ? 'selected' : ''}} value="{{$division->id}}">{{$division->name}}</option>
                @endforeach

              </select>
            </div>

            <div class="form-group col-md-6">
              <label  class="form-group">District Name</label>
               <span><strong>Current District: {{$item->district->name}}</strong></span>
              <select class="form-control" name="district_id"  required="" id="loadAlldistrict">

              </select>
            </div>
            </div>

              

                <div class="row">
                      <div class="form-group col-md-12">
                          <textarea id="summernote" class="form-control" name="address" required="">{{$item->address}}</textarea>

                      </div>
                  </div>



          <div class="card-footer">
            <button type="submit" class="btn btn-success" id="submit_button">Update</button>


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
        $('body').on('submit','#update_touring_place_form',function(e){

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
                    }else{
                      $('#message_area').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
                    }

                    $('#submit_button').text("Updated").prop('disabled',false);
                  },
                  error:function(response){


                  }

                });
          });

        // load all district

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
