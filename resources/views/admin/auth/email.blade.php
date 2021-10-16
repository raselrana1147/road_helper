<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Road Helper Login</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div id="message_area" style="display: none">dsda</div>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h4>Road Helper</h4>
      <h5>Forget Password</h5>
    </div>
    <div class="card-body">
      <div id="message_section"></div>
        @include('admin.helper.login_success')
      <form method="post" data-action="{{ route('admin.send.link') }}" id="send_password_reset_link">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" required="">
        </div>
        <div class="row">

          <div class="col-8">
            <button type="submit" class="btn btn-primary" id="submit_button">Send Reset Link</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="{{ route('admin.login') }}">Login</a>
      </p>
    
    </div>
    <!-- /.card-body -->
  </div>
 
</div>

<script src="{{asset('assets/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/backend/dist/js/adminlte.min.js')}}"></script>

<script>
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
</script>

<script>
  $(document).ready(function(){
    $('body').on('submit','#send_password_reset_link',function(e){
           
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
                  $('#message_area').html('<div class="alert alert-success"> <i class="fas fa-check-circle"></i> '+data.message+'</div>').show();
                   $('#submit_button').text("Send Reset Link").prop('disabled',false);
                }else{
                  $('#message_area').html('<div class="alert alert-danger"> <i class="fas fa-times"></i> '+data.message+'</div>').show();
                    $('#submit_button').text("Send Reset Link").prop('disabled',false);
                }
                $("#add_hotel_form")[0].reset(); 
                $('#submit_button').text("Send Reset Link").prop('disabled',false);
              },

              error:function(response){
                 
               
              }

            });
      });

    });
</script>


</body>
</html>
