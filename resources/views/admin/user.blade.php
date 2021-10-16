@extends('layouts.admin.app')
@section('title','Road Helper | Users')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Users</h1>
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
            <table id="item_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                
                <th>Serial</th>
                <th>Image</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>B.Group</th>
                <th>Details</th>
                <th>Is Paid</th>
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

      <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h4 class="modal-title">User Details Information</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                    
                <div class="card">
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <dl class="row show-detail">

                     
                    </dl>
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

  <!-- /.container-fluid -->
</section>
@endsection

@section('css')
 
@endsection

@section('js')
<script src="{{asset('assets/backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

 <script type="text/javascript">

        var table = $('#item_table').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            ordering: true,
            pagingType: "full_numbers",
            ajax: '{{ route('load_user') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'image', name: 'image' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'blood_group', name: 'blood_group' },
                { data: 'detail', name: 'detail' },
                { data: 'is_paid', name: 'is_paid' },
            ],

             language : {
                  processing: 'Processing'
              },   
        });

    </script>
  <script>
    $(function () {

      $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })


      $('body').on('click','.show-modal',function(){
                 let user_id=$(this).attr('user_id');

                 $.ajax({
                      url:$(this).attr('data-action'),
                      method:'post',
                      data:{user_id:user_id},
                      success:function(response){
                         let data=JSON.parse(response);
                         var $user_data="";
                         var image_url=(data.avatar !==null) ? '{{asset('assets/profile_image')}}'+"/"+data.avatar : '{{asset('assets/profile_image/default.png')}}';
                            user_data='<dt class="col-sm-4">Image</dt><dd class="col-sm-8"><img src="'+image_url+'" style="width:200px;height:200px;border-radius: 50%""></dd>'+

                            '<dt class="col-sm-4">Name</dt>'+
                            '<dd class="col-sm-8">'+data.name+'</dd>'+

                            '<dt class="col-sm-4">E-mail</dt>'+
                            '<dd class="col-sm-8">'+data.email+'</dd>'+

                            '<dt class="col-sm-4">Phone</dt>'+
                            '<dd class="col-sm-8">'+data.phone+'</dd>'+
                            '<dt class="col-sm-4">Blood Group</dt>'+
                            '<dd class="col-sm-8">'+data.blood_group+'</dd>'+

                            '<dt class="col-sm-4">NID</dt>'+
                            '<dd class="col-sm-8">'+((data.nid !=null) ? data.nid : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Passport</dt>'+
                            '<dd class="col-sm-8">'+((data.passport !=null) ? data.passport : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Address</dt>'+
                            '<dd class="col-sm-8">'+((data.address !=null) ? data.address : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Date of birth</dt>'+
                            '<dd class="col-sm-8">'+((data.dob !=null) ? data.dob : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Father Name</dt>'+
                            '<dd class="col-sm-8">'+((data.father_name !=null) ? data.father_name : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Mother Name</dt>'+
                            '<dd class="col-sm-8">'+((data.mother_name !=null) ? data.mother_name : 'Not added')+'</dd>'+

                            '<dt class="col-sm-4">Is Paid</dt>'+
                            '<dd class="col-sm-8">'+((data.is_paid ===2) ? "Yes" : 'No')+'</dd>'+

                            '<dt class="col-sm-4">'+((data.paid_at  !=null) ? 'Paided At' : '')+'</dt>'+
                            '<dd class="col-sm-8">'+((data.paid_at !=null) ? data.paid_at : '')+'</dd>'+

                            '<dt class="col-sm-4">'+((data.expired_at  !=null) ? 'Expired At' : '')+'</dt>'+
                            '<dd class="col-sm-8">'+((data.expired_at !=null) ? data.expired_at : '')+'</dd>'


                         $('.show-detail').html(user_data);
                        }

                       
                      
                   });
                 
                  $('#modal-default').modal('show')
            })

    

      $('body').on('change','.chnagePaidStatus',function(e){
            e.preventDefault();
               let id=$(this).attr('item_id');
            $.ajax({
               url:$(this).attr('data-action'),
               method:'post',
               data:{id:id},
               success:function(response){
                  $('#item_table').DataTable().ajax.reload();
                 var data=JSON.parse(response);
                  toastr.success(data.message);
               }

            });
      });

    });


  </script>
@endsection