
@extends('template.master')
@section('title')
    Edit Vehicle
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Vehicle
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('vehicle.update', $vehicle->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Registration No</label>
                        <input type="text" name="reg_no" class="form-control" value="{{$vehicle->reg_no}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Department</label>
                        <select class="form-control" name="department_id">
                            @if(Auth::user()->user_type == 'admin')
                                <option >--Choose--</option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->id }}" {{ $dep->id == $vehicle->department_id ? 'selected' : '' }}>
                                        {{ $dep->dep_name }}
                                    </option>
                                @endforeach
                            @elseif(Auth::user()->user_type == 'department_admin')
                                <option value="{{$user_department->id}}">{{$user_department->dep_name}}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Allotee</label>
                        <input type="text" name="allotee" class="form-control" value="{{$vehicle->allotee}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Maker</label>
                        <input type="text" name="maker" class="form-control"  value="{{$vehicle->maker}}"/>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Body Type</label>
                        <input type="text" name="body_type" class="form-control" value="{{$vehicle->body_type}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Vehicle Type</label>
                        <input type="text" name="vehicle_type" class="form-control" value="{{$vehicle->vehicle_type}}"  />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Model</label>
                        <input type="text" name="model" class="form-control" value="{{$vehicle->model}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Engine Power</label>
                        <input type="text" name="engine_power" class="form-control" value="{{$vehicle->engine_power}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Colour</label>
                        <input type="text" name="colour" class="form-control" value="{{$vehicle->colour}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Engine No</label>
                        <input type="text" name="engine_no" class="form-control" value="{{$vehicle->engine_no}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Chassis No</label>
                        <input type="text" name="chassis_no" class="form-control" value="{{$vehicle->chassis_no}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Type</label>
                        <select class="form-control" name="type">
                            <option value="diesel">Diesel</option>
                            <option value="petrol">Petrol</option>
                            <option value="project">Project (ADP)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Allotted By</label>
                        <input type="text" name="allotted_by" class="form-control" value="{{$vehicle->allotted_by}}" />
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
                        <input type="text" name="meter_reading" class="form-control" value="{{$vehicle->meter_reading}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Fuel Average</label>
                        <input type="text" name="fuel_average" class="form-control" value="{{$vehicle->fuel_average}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Previous Reg No</label>
                        <input type="text" name="prev_reg_no" class="form-control" value="{{$vehicle->prev_reg_no}}" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Status</label>
                        <select class="form-control" name="status">
                            <option>--Choose--</option>
                            @foreach($status_vehicles as $vs)
                                <option value="{{$vs->status}}" @if($vehicle->status === $vs->status) selected @endif>{{$vs->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="customFile">Entitlement</label>
                        <select class="form-control " name="entitle">
                            <option>--Choose--</option>
                            <option value="entitle" @if($vehicle->entitle === 'entitle') selected @endif>Entitle</option>
                            <option value="not_entitle" @if($vehicle->entitle === 'not_entitle') selected @endif>Not Entitle</option>
                            <option value="entitle_above_policy" @if($vehicle->entitle === 'entitle_above_policy') selected @endif>Entitled but above transport policy</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <hr width="100%">
                </div>
                <div class="row">
                    <button class="btn btn-success" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
