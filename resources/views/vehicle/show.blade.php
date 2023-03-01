
@extends('template.master')
@section('title')
    Show Vehicle
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicle
                &nbsp; <a  href="{{route('print-sticker', $vehicle->id)}}"  id="" class="text-danger"> <i class="fa fa-download"></i>Download Sticker</a>
            </h6>

        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="" align="center">
                <div class="col-md-6" style="margin-top: 100px" ><img
                        @if($vehicle->body_type == 'BIKE')
                        src="{{asset('img/bike.jpg')}}"
                        @else
                        src="{{asset('img/show-vehicle.png')}}"
                        @endif
                        width="80%">
                </div>
            </div>
            <div class="row">
                <style>
                    .v_heading{
                        color: black;
                    }
                </style>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Reg No:</b>&nbsp; <em>{{$vehicle->reg_no}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Allotee:</b>&nbsp; <em>{{$vehicle->allotee}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Maker:</b>&nbsp; <em>{{$vehicle->maker}}</em>
                </div>
                <hr width="100%">
                <div class="col-md-4" align="center">
                    <b class="v_heading">Body Type:</b>&nbsp; <em>{{$vehicle->body_type}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Vehicle Type:</b>&nbsp; <em>{{$vehicle->vehicle_type}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Model:</b>&nbsp; <em>{{$vehicle->model}}</em>
                </div>
                <hr width="100%">
                <div class="col-md-4" align="center">
                    <b class="v_heading">Engine Power:</b>&nbsp; <em>{{$vehicle->engine_power}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Colour:</b>&nbsp; <em>{{$vehicle->colour}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Engine No:</b>&nbsp; <em>{{$vehicle->engine_no}}</em>
                </div>
                <hr width="100%">
                <div class="col-md-4" align="center">
                    <b class="v_heading">Chassis No:</b>&nbsp; <em>{{$vehicle->chassis_no}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Type:</b>&nbsp; <em>{{$vehicle->type}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Allotted By:</b>&nbsp; <em>{{$vehicle->allotted_by}}</em>
                </div>
                <hr width="100%">
                <div class="col-md-4" align="center">
                    <b class="v_heading">Purchase Type:</b>&nbsp; <em>{{$vehicle->purchase_type}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Meter Reading:</b>&nbsp; <em>{{$vehicle->meter_reading}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Fuel Average:</b>&nbsp; <em>{{$vehicle->fuel_average}}</em>
                </div>
                <hr width="100%">
                <div class="col-md-4" align="center">
                    <b class="v_heading">Previous Registration No:</b>&nbsp; <em>{{$vehicle->prev_reg_no}}</em>
                </div>
                <div class="col-md-4" align="center">
                    <b class="v_heading">Status:</b>&nbsp; <em>{{$vehicle->status}}</em>
                </div>
            </div>
        </div>
    </div>

@endsection


