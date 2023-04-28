
@extends('template.master')
@section('title')
    Add Vehicle
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Vehicle
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('vehicle.store')}}" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="form-row">
            <div class="col-md-4">
                <label class="form-label" for="customFile">Registration No</label>
                <input type="text" name="reg_no" class="form-control" value="{{old('reg_no')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Department</label>
                <select class="form-control js-example-basic-single" name="department_id" required>
                    @if(Auth::user()->user_type == 'admin')
                        <option >--Choose--</option>
                        @foreach($departments as $dep)
                            <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                        @endforeach
                    @elseif(Auth::user()->user_type == 'department_admin')
                        <option value="{{$user_department->id}}">{{$user_department->dep_name}}</option>
                    @endif
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Allotee</label>
                <input type="text" name="allotee" class="form-control" value="{{old('allotee')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Maker</label>
                <input type="text" name="maker" class="form-control"  value="{{old('maker')}}"/>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Body Type</label>
                <input type="text" name="body_type" class="form-control" value="{{old('body_type')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Vehicle Type</label>
                <input type="text" name="vehicle_type" class="form-control" value="{{old('vehicle_type')}}"  />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Model</label>
                <input type="text" name="model" class="form-control" value="{{old('model')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Engine Power</label>
                <input type="text" name="engine_power" class="form-control" value="{{old('engine_power')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Colour</label>
                <input type="text" name="colour" class="form-control" value="{{old('colour')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Engine No</label>
                <input type="text" name="engine_no" class="form-control" value="{{old('engine_no')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Chassis No</label>
                <input type="text" name="chassis_no" class="form-control" value="{{old('chassis_no')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Type</label>
                <select class="form-control" name="type">
                    <option value="diesel">Diesel</option>
                    <option value="petrol">Petrol</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Allotted By</label>
                <input type="text" name="allotted_by" class="form-control" value="{{old('allotted_by')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Purchased Type</label>
                <select class="form-control" name="purchase_type">
                    <option value="normal">Normal</option>
                    <option value="donate">Donate</option>
                    <option value="project">Project (ADP)</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Meter Reading</label>
                <input type="text" name="meter_reading" class="form-control" value="{{old('meter_reading')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Fuel Average</label>
                <input type="text" name="fuel_average" class="form-control" value="{{old('fuel_average')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Previous Reg No</label>
                <input type="text" name="prev_reg_no" class="form-control" value="{{old('prev_reg_no')}}" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Status</label>
                <select class="form-control " name="status">
                    <option>--Choose--</option>
                    @foreach($status_vehicles as $vs)
                        <option value="{{$vs->status}}">{{$vs->status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Entitlement</label>
                <select class="form-control " name="entitle">
                    <option>--Choose--</option>
                    <option value="entitle">Entitle</option>
                    <option value="not_entitle">Not Entitle</option>
                    <option value="entitle_above_policy">Entitled but above transport policy</option>
                </select>
            </div>


            {{--<div class="col-md-12">
                <hr width="100%">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Defect Report</label>
                <input type="file" name="" class="form-control" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Allotment Report</label>
                <input type="file" name="" class="form-control" value="" />
            </div>
            <div class="col-md-4">
                <label class="form-label" for="customFile">Electronic File</label>
                <input type="file" name="" class="form-control" value="" />
            </div>--}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="form-label" for="customFile">Remarks</label> <b style="color: red"><em>(Add reason why Auctionable or Off road)</em></b>
                <textarea type="text" name="remarks" class="form-control" value=""></textarea>
            </div>
        </div>
        <div class="row">
            <hr width="100%">
        </div>
                .
        <div class="row">
            <button class="btn btn-success" type="submit">
                Save
            </button>
        </div>
    </form>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
