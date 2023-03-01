
@extends('template.master')
@section('title')
    Reports
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reporting</h1>
    </div>


    <div class=" row " align="center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class=" table">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Body Type</th>
                        @foreach($body_type_status as $key => $types)
                            <th>{{$key}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    <tr>
                        @foreach($body_type_status as $key => $types)
                            @foreach($types as $key => $value)
                                <td>{{$key}}</td>
                            @endforeach
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-ms-2"></div>
        <div class="col-md-6"></div>
    </div>

@endsection
