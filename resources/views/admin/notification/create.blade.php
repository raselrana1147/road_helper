@extends('layouts.admin.app')
@section('title','Road Helper | Notification Create')
@section('css')
   <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Notification</h1>
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
 
            <form data-action="{{ route('notification.store') }}" method="post" id="add_notification_form">
              @csrf
              <div class="card-body">
                
                  <div class="form-group col-12">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" required="">
                  </div>

                <div class="form-group col-12">
                     <label >Content</label>
                     <textarea class="form-control" name="content" cols="10" required="" rows="1" id="content_text"></textarea>
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
<script src="{{asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script>

    $(document).ready(function(){
         $('#content_text').summernote();
        $('body').on('submit','#add_notification_form',function(e){
               
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
                    $("#add_notification_form")[0].reset(); 
                    $('#submit_button').text("Add").prop('disabled',false);
                  },

                  error:function(response){
                     
                   
                  }

                });
          });

      });
    
  </script>
@endsection