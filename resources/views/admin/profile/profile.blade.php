@extends('layouts.admin.app')
@section('title','Road Helper | Update Profile')
@section('css')
 <style>
     .dropify-wrapper{
         width: 30%;
         height: 80%;
     }
 </style>
@endsection
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Profile</h1>
    </div><!-- /.col -->

  </div><!-- /.row -->
@endsection
@section('main')
<div id="message_area" style="display: none"></div>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="{{(Auth::user()->avatar !=null) ? asset('assets/backend/profile/'.Auth::user()->avatar) : asset('backend/profile/default.jpg')}}"
                   alt="User profile picture">
            </div>
          </div>
          <!-- /.card-body -->
        </div>

      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="tab-content">
              <div class="" id=>
                <form data-action="{{ route('admin.profile') }}"  method="post" class="form-horizontal" enctype="multipart/form-data" id="update_admin_profile">
                  @csrf
                  <input type="hidden" name="id" value="{{Auth::user()->id}}">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" value="{{Auth::user()->email}}" readonly="">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="{{Auth::user()->phone}}" name="phone">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control dropify" name="avatar"  data-default-file="{{(Auth::user()->avatar !=null) ? asset('assets/backend/profile/'.Auth::user()->avatar) : asset('assets/backend/profile/default.jpg')}}">
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
        $('body').on('submit','#update_admin_profile',function(e){

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
                      $('#message_area').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i>'+data.message+'</div>').show();
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
