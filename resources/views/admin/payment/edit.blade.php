@extends('layouts.admin.app')
@section('title','Road Helper | Update Payment')
@section('css')
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
      <h1 class="m-0">Payment</h1>
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

        <form data-action="{{ route('payment.update') }}" method="post" id="update_payemnt_form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{$item->id}}">
          <div class="card-body">
            <div class="row">

              <div class="form-group col-md-6">
                <label>Operator Name</label>
                <input type="text" class="form-control" name="operator_name" required="" value="{{$item->operator_name}}">
              </div>

              <div class="form-group col-md-6">
                <label>Banking Number</label>
                <input type="text" class="form-control" name="banking_number" required="" value="{{$item->banking_number}}">
              </div>


                 <div class="form-group col-md-6">
                  <label  class="form-group">Type</label>
                    <select class="form-control" name="type">
                        <option value="">Select One</option>
                        <option value="Agent" {{($item->type=='Agent') ? 'selected' : ''}}>Agent</option>
                        <option value="Personal" {{($item->type=='Personal') ? 'selected' : ''}}>Personal</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                  <label  class="form-group">Referal Number</label>
                  <input type="text" class="form-control" name="ref_number" required="" value="{{$item->ref_number}}">
                </div>



            </div>

            <div class="row">


              <div class="form-group col-md-6">
               
                <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                      <div class="col-sm-10">
                          <input type="file" class="form-control dropify" name="image"  data-default-file="{{($item->image !==null) ? asset('assets/backend/payment/'.$item->image) : asset('assets/backend/payment/default.png') }}">
                      </div>

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

  <script>

    $(document).ready(function(){
        $('body').on('submit','#update_payemnt_form',function(e){

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

       

      

        $('#summernote').summernote();
      });

  </script>
@endsection
