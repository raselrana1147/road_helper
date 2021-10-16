@extends('layouts.admin.app')
@section('title','Road Helper | Hospital List')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Hospital</h1>
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
            <h3 class="card-title float-right"><a href="{{ route('hospital.create') }}" class="btn btn-danger"> <i class="fas fa-plus"></i> Add New</a></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
            <table id="item_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="5%">Serial</th>
                <th width="13%">Hospital Name</th>
                <th width="8%">Division Name</th>
                <th width="8%">District Name</th>
                <th width="8%">Help Number</th>
                <th width="12%">Description</th>
                <th width="20%">Action</th>
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

   <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title">Hospital Detail</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                      <div>
                        <p class="mt-2 hospital-description"></p>
                      </div>
                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->
       
                 </div>
                 <div class="modal-footer justify-content-between">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
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
            ajax: '{{ route('get.hospital') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'hospital_name', name: 'hospital_name' },
                { data: 'division', name: 'division' },
                { data: 'district', name: 'district' },
                { data: 'help_number', name: 'help_number' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action' },
            ],

             language : {
                  processing: 'Processing'
              },
              
        });
    </script>

  <script>

    $(document).ready(function(){


              $('body').on('click','.show-modal',function(){
                 let data_id=$(this).attr('data_id');

                 $.ajax({
                      url:$(this).attr('data-action'),
                      method:'post',
                      data:{data_id:data_id},
                      success:function(response){
                         let data=JSON.parse(response);
                           $('.hospital-description').html(data.address);
                        }
                      
                   });
                 
                  $('#modal-default').modal('show')
            })

              

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