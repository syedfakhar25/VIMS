
@extends('template.master')
@section('title')
    Manage Vehicles
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicles
                <a href="{{route('vehicle.create')}}" type="button" class="btn btn-success">
                    &nbsp; <i class="fa fa-plus-circle"></i>&nbsp;Add
                </a>
                <a href="{{route('vehicle_import')}}" type="button" class="btn btn-danger">
                    &nbsp; <i class="fa fa-file"></i>&nbsp;Import CSV
                </a>
            </h6>
            <hr width="100%">
            <form action="" enctype="multipart/form-data">
                <div class="row">
                    <!--<div class="col-md-2">
                        <input type="search" id="reg_no_search" name="reg_no" placeholder="Registraton No" class="form-control" value="">
                    </div>
                    <div class="col-md-2">
                        <input type="search" name="chassis_no" placeholder="Chassis No" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input type="search" name="model" placeholder="Model" class="form-control">
                    </div>-->
                    <div class="col-md-2">
                        <style>
                            .dept{
                                display: block!important;
                            }
                        </style>
                        <select class="form-control <!--js-example-basic-single--> dept" name="department_id">
                            @if(Auth::user()->user_type == 'admin')
                                <option>Department</option>
                                @foreach($departments as $dep)
                                    <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                <!-- <div class="col-md-2">
                        <select class="form-control" name="status">
                            @if(Auth::user()->user_type == 'admin')
                    <option>Status</option>
                    <option value="offroad">Off Road</option>
                    <option value="onroad">On Road</option>
@endif
                    </select>
                </div>-->
                    <!--<div class="col-md-2">
                        <input type="search" name="body_type" placeholder="Body Type" class="form-control">
                    </div>-->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>

                </div>
            </form>
            {{--<div class="col-md-2">
                Total: {{$count_vehicle}}
            </div>--}}
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered " id="vehicle_datatable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>VMS ID</th>
                        <th>Reg No.</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Engine</th>
                        <th>Allottee</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count =1 ;?>

                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{$vehicle->vms_code}}</td>
                            <td>{{$vehicle->reg_no}}</td>
                            <td>{{$vehicle->model}}</td>
                            <td>{{$vehicle->body_type}}</td>
                            <td>{{$vehicle->status}}</td>
                            <td>{{$vehicle->engine_power}} @if($vehicle->engine_power !=NULL || $vehicle->engine_power!='')&nbsp; cc @endif</td>
                            <td>{{$vehicle->allotee}}</td>
                            <td>{{$vehicle->dep_name}}</td>

                            <td colspan="2">
                                <a href="{{route('vehicle.show', $vehicle->id)}}"><i class="fas fa-eye " style="color: darkturquoise"></i></a>
                                <a href="{{route('vehicle.edit', $vehicle->id)}}"><i class="fas fa-edit" style="color: blue"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            {{--<div class="row">
                <div class="col-md-12">{{ $vehicles->links() }}
                </div>
            </div>--}}
        </div>
    </div>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
    <!--<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>-->
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready( function () {
            $.noConflict();
            $('#vehicle_datatable').DataTable({
                "paging": true,
                "pageLength": 10,
            })

            // Add a search box to the DataTable
            $('#reg_no_search').on('keyup', function() {
                console.log($(this).val()); // Debugging output
                console.log($('#vehicle_datatable')); // Debugging output

                if ($.fn.DataTable.isDataTable('#vehicle_datatable')) {
                    $('#vehicle_datatable').DataTable().search($(this).val()).draw();
                }
            });

        });

    </script>
@endsection
