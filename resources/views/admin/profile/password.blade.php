@extends('layouts.admin.app')
@section('title','Road Helper | Update Profile')
@section('css')
 
@endsection
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Change Password</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('main')
<div id="message_area" style="display: none"></div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="tab-content">
              <div class="" id=>
                <form data-action="{{ route('admin.password.change') }}"  method="post" class="form-horizontal" id="update_admin_password">
                  @csrf
                  <input type="hidden" name="id" value="{{Auth::user()->id}}">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="cpass" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="npass" required="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Re-type Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control"  name="password_confirmation" required="">
                    </div>
                  </div>

             
                 
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" id="submit_button">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('js')
  <script>

    $(document).ready(function(){
        $('body').on('submit','#update_admin_password',function(e){
               
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
                       $('#submit_button').text("Update").prop('disabled',false);
                    }else{
                      $('#message_area').html('<div class="alert alert-danger"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
                    }
                   
                    $('#submit_button').text("Update").prop('disabled',false);
                  },

                  error:function(response){
                     
                   
                  }

                });
          });
      });
    
  </script>
@endsection