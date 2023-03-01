
@extends('template.master')
@section('title')
    Add Vehicle
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Import CSV
            </h6>
        </div>
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{route('add_import_vehicle')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="form-label" for="customFile">Import CSV</label>
                        <input type="file" name="vehicle_csv1" class="form-control" value="{{old('vehicle_csv1')}}" />
                    </div>
                    <div class="col-md-6 mt-4">
                        <button class="btn btn-success" type="submit">
                            Add
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
