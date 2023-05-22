<!DOCTYPE html>
<html>
<head>
    <title>Azad Jammu & Kashmir VIMS</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .row {
            margin: 0 -15px;
        }

        .col-md-4 {
            float: left;
            width: 33.33%;
            padding: 0 15px;
        }

        .v_heading{
            color: #444;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        hr {
            margin: 20px 0;
            border-top: 1px solid #eee;
        }

        .logo {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" align="center">
                <img src="{{asset('main_logo.png')}}" alt="logo" class="logo">
                <h3>Azad Jammu & Kashmir | Vehicle From VIMS</h3>
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Reg No:</b>&nbsp;@if($vehicle->reg_no) <em>{{$vehicle->reg_no}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Allotee:</b>&nbsp; &nbsp;@if($vehicle->allotee)<em>{{$vehicle->allotee}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Maker:</b>&nbsp; &nbsp;@if($vehicle->maker)<em>{{$vehicle->maker}}</em>@endif
            </div>
            <hr width="100%">
            <div class="col-md-4" align="center">
                <b class="v_heading">Body Type:</b>&nbsp; &nbsp;@if($vehicle->body_type)<em>{{$vehicle->body_type}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Vehicle Type:</b>&nbsp; &nbsp;@if($vehicle->vehicle_type)<em>{{$vehicle->vehicle_type}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Model:</b>&nbsp; &nbsp;@if($vehicle->model)<em>{{$vehicle->model}}</em>@endif
            </div>
            <hr width="100%">
            <div class="col-md-4" align="center">
                <b class="v_heading">Engine Power:</b>&nbsp; &nbsp;@if($vehicle->engine_power)<em>{{$vehicle->engine_power}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Colour:</b>&nbsp; &nbsp;@if($vehicle->colour)<em>{{$vehicle->colour}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Engine No:</b>&nbsp; &nbsp;@if($vehicle->engine_no)<em>{{$vehicle->engine_no}}</em>@endif
            </div>
            <hr width="100%">
            <div class="col-md-4" align="center">
                <b class="v_heading">Chassis No:</b>&nbsp;&nbsp;@if($vehicle->chassis_no) <em>{{$vehicle->chassis_no}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Type:</b>&nbsp; &nbsp;@if($vehicle->type)<em>{{$vehicle->type}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Allotted By:</b>&nbsp; &nbsp;@if($vehicle->allotted_by)<em>{{$vehicle->allotted_by}}</em>@endif
            </div>
            <hr width="100%">
            <div class="col-md-4" align="center">
                <b class="v_heading">Purchase Type:</b>&nbsp;@if($vehicle->purchase_type) <em>{{$vehicle->purchase_type}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Meter Reading:</b>&nbsp; &nbsp;@if($vehicle->meter_reading)<em>{{$vehicle->meter_reading}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Fuel Average:</b>&nbsp; &nbsp;@if($vehicle->fuel_average)<em>{{$vehicle->fuel_average}}</em>@endif
            </div>
            <hr width="100%">
            <div class="col-md-4" align="center">
                <b class="v_heading">Previous Registration No:</b>&nbsp; &nbsp;@if($vehicle->prev_reg_no)<em>{{$vehicle->prev_reg_no}}</em>@endif
            </div>
            <div class="col-md-4" align="center">
                <b class="v_heading">Status:</b>&nbsp;&nbsp;@if($vehicle->status) <em>{{$vehicle->status}}</em>@endif
            </div>
        </div>
    </div>
</div>


