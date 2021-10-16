@extends('layouts.admin.app')
@section('title','Road Helper | Ambulance List')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Ambulance</h1>
    </div><!-- /.col -->
   
  </div><!-- /.row -->
@endsection
@section('main')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
       
        <!-- /.card -->

        <div class="card" id="reload_section">
          <div class="card-header">
            <h3 class="card-title float-right"><a href="{{ route('ambulance.create') }}" class="btn btn-danger"><i class="fas fa-plus"></i> Add New</a></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
            <table id="item_table" class="table table-bordered table-striped">
              <thead>

              <tr>
                <th width="1%">S.N</th>
                <th width="10%">Company or driver Name</th>
                <th width="8%">Help Number</th>
                <th width="10%">D.Name</th>
                <th width="10%">Dis. Name</th>
                <th width="43%">Address</th>
                <th width="8%">Action</th>
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
            ajax: '{{ route('load_ambulance') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'company_name', name: 'company_name' },
                { data: 'help_number', name: 'help_number' },
                { data: 'division', name: 'division' },
                { data: 'district', name: 'district' },
                { data: 'address', name: 'address' },
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
                         $('#item_table').DataTable().ajax.reload();
                      }

                   }); 
            
              } 
            });
          })
      });


  </script>
@endsection