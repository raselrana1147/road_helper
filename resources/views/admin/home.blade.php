@extends('layouts.admin.app')
@section('title','Road Helper | Admin Dashboard')
@section('breadcrumb')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Dashboard</h1>
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection
@section('main')

  <div class="row">
    <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{App\models\admin\PoliceStation::get()->count()}}</h3>

          <p>Total Police Stattions</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('police_station.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{App\models\admin\Ambulance::get()->count()}}</h3>

          <p>Total Ambulances</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{ route('ambulance.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{App\models\admin\Hotel::get()->count()}}</h3>

          <p>Total Hotels</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('hotel.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{App\models\admin\TouringPlace::get()->count()}}</h3>

          <p>Total Touring Places</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('touring_place.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <!-- ./col -->

     <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3>{{App\models\admin\Hospital::get()->count()}}</h3>

          <p>Total Hospitals</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('hospital.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

       <div class="col-lg-2 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{App\models\admin\BloodBank::get()->count()}}</h3>

          <p>Total Blood Banks</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('blood_bank.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>


    <!-- ./col -->
  </div>


@endsection