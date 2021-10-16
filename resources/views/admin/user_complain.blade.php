@extends('layouts.admin.app')
@section('title','Road Helper | Users Complain')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Users Complain</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('main')

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
      
        <div class="card" id="reload_section">

          <div class="card-body" >
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                
                <th>Serial</th>
                <th>User Name</th>
                <th>Subject</th>
                <th>Description</th>
  
              </tr>
              </thead>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection

@section('css')
 
@endsection

@section('js')
    <script type="text/javascript">

        var table = $('#myTable').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: true,
            pagingType: "full_numbers",
            ajax: '{{ route('load.user.complain') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'subject', name: 'subject' },
                { data: 'description', name: 'description' },
            ],

             language : {
                  processing: 'Processing'
              },
              
        });
    </script>

 
@endsection