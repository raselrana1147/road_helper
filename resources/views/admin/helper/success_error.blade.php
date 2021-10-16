@if ($errors->any())  
@foreach ($errors->all() as $error)
   <div class="alert alert-primary"> <i class="fas fa-exclamation-triangle"></i> {{$error}}</div>
@endforeach
@endif


@if (Session::has('error_message'))
	 <div class="alert alert-primary"> <i class="fas fa-exclamation-triangle"></i>  {{Session::get('error_message')}}</div>
@endif

@if (Session::has('success_message'))
	 <div class="alert alert-success"> <i class="fas fa-check-circle"></i>  {{Session::get('success_message')}}</div>
@endif
