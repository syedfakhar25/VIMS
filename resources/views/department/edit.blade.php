
@extends('template.master')
@section('title')
Manage Departments
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Edit Department
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('department.update', $department->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Department Name</label>
                    <input type="text" name="dep_name" value="{{$department->dep_name}}" class="form-control"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Parent Department</label>
                    <select class="form-control js-example-basic-single" name="parent_id" >
                        @php $departments =  \App\Models\Department::all(); @endphp
                        <option value="0">--Choose--</option>
                        @foreach($departments as $dep)
                            <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Is this the Main Dep?</label>
                    <select class="form-control" name="is_main_dep">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Short Name</label>
                    <input type="text" name="short_name" value="{{$department->short_name}}" class="form-control"  placeholder ="e.g; ITB" />
                </div>

                {{--<div class="col-md-6">
                    <label class="form-label" for="customFile">Focal Person</label>
                    <input type="text" name="focal_person" class="form-control"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Email</label>
                    <input type="email" name="email" class="form-control"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="customFile">Phone #</label>
                    <input type="text" name="phone" class="form-control"  required/>
                </div>--}}
            </div>
            <div class="row">
                <hr width="100%">
            </div>
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


