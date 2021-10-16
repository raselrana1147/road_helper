@extends('layouts.admin.app')
@section('title','Road Helper | Blood Request')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Blood Request</h1>
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
                <th>Hospital Name</th>
                <th>Blood group</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Blood Needed</th>
                <th>Blood Collected</th>
                <th>Blood Needed At</th>
                <th>Requested At</th>
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
            ajax: '{{ route('get_blood_request') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'hospital_name', name: 'hospital_name' },
                { data: 'blood_group', name: 'blood_group' },
                { data: 'phone', name: 'phone' },
                { data: 'address', name: 'address' },
                { data: 'blood_needed', name: 'blood_needed' },
                { data: 'blood_collected', name: 'blood_collected' },
                { data: 'when_needed', name: 'when_needed' },
                { data: 'request_at', name: 'request_at' },
                
            ],

             language : {
                  processing: 'Processing'
              },
              
        });
    </script>
@endsection
