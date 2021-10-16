@extends('layouts.admin.app')
@section('title','Road Helper | District List')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Districts</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('main')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
       
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title float-right"><a href="{{ route('district.create') }}" class="btn btn-danger"><i class="fas fa-plus"></i> Add New</a></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="item_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Serial</th>
                <th>District Name</th>
                <th>District Code</th>
                <th>Division Name</th>
                <th>Action</th>
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
@section('js')

 <script type="text/javascript">

      var table = $('#item_table').DataTable({
          processing: true,
          responsive: true,
          serverSide: true,
          ordering: true,
          pagingType: "full_numbers",
          ajax: '{{ route('get_district') }}',
          columns: [
              { data: 'id', name: 'id' },
              { data: 'name', name: 'name' },
              { data: 'district_code', name: 'district_code' },
              { data: 'division', name: 'division' },
              { data: 'action', name: 'action' },
          ],

           language : {
                processing: 'Processing'
            },
            
      });
  </script>

  <script>
  
    $(document).ready(function(){

          $('body').on('click','.delete_item',function(){
            let item_id=$(this).attr('item_id');
            swal({
              title: "Do you want to delete?",
              icon: "info",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                   $.ajax({
                      url:$(this).attr('data-action'),
                      method:'post',
                      data:{item_id:item_id},
                      success:function(response){
                        var data=JSON.parse(response);
                         toastr.success(data.message);
                        //$('.hide_item'+item_id).hide();
                        $('#item_table').DataTable().ajax.reload();
                      }

                   });
            
              } 
            });
          })
      });


  </script>
@endsection