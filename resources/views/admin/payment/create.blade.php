@extends('layouts.admin.app')
@section('title','Road Helper | Add Payment')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Payment</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('css')
    <style>
        .dropify-wrapper{
            width: 59%;
            height: 80%;
        }
    </style>

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
 
            <form data-action="{{ route('payment.store') }}" method="post" id="add_payment_form" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group ">
                  <label >Operator Name</label>
                  <input type="text" class="form-control" name="operator_name" required="">
                </div>

                <div class="form-group">
                  <label  class="form-group">Banking Number</label>
                  <input type="text" class="form-control" name="banking_number" required="">
                </div>

                <div class="form-group">
                  <label  class="form-group">Type</label>
                    <select class="form-control" name="type">
                        <option value="">Select One</option>
                        <option value="Agent">Agent</option>
                        <option value="Personal">Personal</option>
                    </select>
                </div>

                <div class="form-group">
                  <label  class="form-group">Referal Number</label>
                  <input type="text" class="form-control" name="ref_number" required="">
                </div>

                <div class="form-group col-md-6">
                   
                    <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                          <div class="col-sm-10">
                              <input type="file" class="form-control dropify" name="image"  data-default-file="{{ asset('assets/backend/payment/default.png')}}">
                          </div>
                    
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
        $('body').on('submit','#add_payment_form',function(e){
               
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
                    $("#add_payment_form")[0].reset(); 
                    $('#submit_button').text("Add").prop('disabled',false);
                  },

                  error:function(response){
                   
                      if (response.responseJSON.errors['name']) {
                           $('#message_area').html('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i>'+response.responseJSON.errors['name']+'</div>').show();
                      }
                      $('#submit_button').text("Add").prop('disabled',false);
                      
                     $('#submit_button').text("Add").prop('disabled',false);
                   
                  }

                });
          });
      });
    
  </script>
@endsection