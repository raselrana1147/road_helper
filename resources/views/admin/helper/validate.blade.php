@if ($errors->any())  
@foreach ($errors->all() as $error)
   <div class="alert alert-primary"> <i class="fas fa-exclamation-triangle"></i> {{$error}}</div>
@endforeach
@endif