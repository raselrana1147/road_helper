@extends('layouts.admin.app')
@section('title','Road Helper | Add District')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">District</h1>
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
 
            <form data-action="{{ route('district.store') }}" method="post" id="add_district_form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label >District Name</label>
                  <input type="text" class="form-control" name="name" required="">
                </div>

                <div class="form-group">
                  <label  class="form-group">District Code</label>
                  <input type="text" class="form-control" name="district_code" required="">
                </div>

                <div class="form-group">
                  <label  class="form-group">Division Name</label>
                  <select class="form-control" name="division_id" >
                    @php
                      $divisions=App\models\admin\Division::all();
                    @endphp
                    @foreach ($divisions as $division)
                     <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                   
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

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
  <script>

    $(document).ready(function(){
        $('body').on('submit','#add_district_form',function(e){
               
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
                    $("#add_district_form")[0].reset(); 
                    $('#submit_button').text("Add").prop('disabled',false);
                  },

                  error:function(response){
                    console.log(response);

                      if (response.responseJSON.errors['name']) {
                           $('#message_area').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>'+response.responseJSON.errors['name']+'</div>').show();
                      }
                      $('#submit_button').text("Add").prop('disabled',false);
                      if (response.responseJSON.errors['district_code']) {
                          $('#message_area').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>'+response.responseJSON.errors['district_code']+'</div>').show();
                        }
                     $('#submit_button').text("Add").prop('disabled',false);
                   
                  }

                });
          });
      });
    
  </script>
@endsection