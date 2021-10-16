@extends('layouts.admin.app')
@section('title','Road Helper | Touring Place List')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Touring Place</h1>
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
            <h3 class="card-title float-right"><a href="{{ route('touring_place.create') }}" class="btn btn-danger"><i class="fas fa-plus"></i> Add New</a></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" >
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                 <th width="5%">Id</th>
                 <th width="5%">Image</th>
                 <th width="5%">Place Name</th>
                 <th width="5%">Email</th>
                 <th width="5%">H. Number</th>
                 <th width="5%">Division</th>
                 <th width="5%">District</th>
                 <th width="5%">Description</th>
                 <th width="20%">Action</th>

              </tr>
              </thead>

            </table>

          {{--    User Details modal --}}
      
           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title">Touring place description</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                    
                <div class="card">
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                      <div>
                          <img src="" alt="touring place image" class="set_image" style="width: 100%;max-height:200px">
                      </div>
                      <div>
                        <p class="mt-2 tour-description"></p>
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

        var table = $('#myTable').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: true,
            pagingType: "full_numbers",
            ajax: '{{ route('admin_get_touring_place') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'place_name', name: 'place_name' },
                { data: 'email', name: 'email' },
                { data: 'help_number', name: 'help_number' },
                { data: 'division', name: 'division' },
                { data: 'district', name: 'district' },
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
                 let tour_id=$(this).attr('tour_id');

                 $.ajax({
                      url:$(this).attr('data-action'),
                      method:'post',
                      data:{tour_id:tour_id},
                      success:function(response){
                         let data=JSON.parse(response);
                         var image_url=(data.image !==null) ? '{{asset('assets/backend/touring')}}'+"/"+data.image : '{{asset('assets/backend/touring/default.png')}}'
                           $('.set_image').attr('src',image_url);
                           $('.tour-description').html(data.address);
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
                          $('#myTable').DataTable().ajax.reload();
                         
                      }

                   });

              }
            });
          })
      });
  </script>
@endsection
