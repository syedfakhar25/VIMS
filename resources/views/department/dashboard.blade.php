
@extends('template.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{route('vehicle.index', 'department_id' .'=>' .$department->id)}}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Vehicles</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_vehicles}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{route('vehicle.index', ['status'.'=>'.'On Road', 'department_id'.'=>'.$department->id])}}" class="text-xs font-weight-bold text-success text-uppercase mb-1">On Road</a>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$on_road}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-moving  fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{route('vehicle.index', ['status'.'=>'.'Off Road', 'department_id'.'=>'.$department->id])}}" class="text-xs font-weight-bold text-warning text-uppercase mb-1">Off Road</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$off_road}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-pickup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a href="{{route('vehicle.index', ['status'.'=>'.'Not Set', 'department_id'.'=>'.$department->id])}}" class="text-xs font-weight-bold text-danger text-uppercase mb-1">Not Set</a>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$not_set}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-pickup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
