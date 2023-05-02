
@extends('template.master')
@section('title')
    Manage Departments
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Departments
                <!-- Button trigger modal -->&nbsp;
                <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    &nbsp; <i class="fa fa-plus-circle"></i>&nbsp;Add new
                </a>

            </h6>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('department.store')}}" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Department Name</label>
                                        <input type="text" name="dep_name" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Short Name</label>
                                        <input type="text" name="short_name" class="form-control"  placeholder ="e.g; ITB" required/>
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
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dep_datatable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>S #</th>
                        <th>Name</th>
                        <th>Parent Dept.</th>
                        <th>Main Department?</th>
                        <th>Focal Person</th>
                        {{--<th>Email</th>--}}
                        <th>Phone #</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    @foreach($departments as $dep)
                        <tr>
                            <td>{{$count++}}</td>
                            <td><a href="{{route('dashboard',[ 'department_id' => $dep->id])}}">{{$dep->dep_name}}</a></td>
                            <td>
                                @php $parent = \App\Models\Department::find($dep->parent_id);@endphp
                                @if($parent){{$parent->dep_name}}@endif
                            </td>
                            <td>@if($dep->is_main_dep) <b class="text-success">Yes</b>
                                @else <b class="text-danger">No</b>
                                @endif
                            </td>
                            <td>{{$dep->focal_person}}</td>
                            {{--<td>{{$dep->users()->id}}</td>--}}
                            <td>{{$dep->phone}}</td>
                            <td colspan="2">
                                {{--<form action="{{ route('department.destroy',['department' => $dep->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn"><i class="fas fa-trash" style="color: darkred"></i></button>
                                </form>--}}
                                <a href="{{route('department.edit', $dep->id)}}"><i class="fas fa-edit" style="color: blue"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
     <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>-->
    <script>


        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready( function () {
            $.noConflict();
            $('#dep_datatable').DataTable({
                "paging": true,
                "pageLength": 20,
            })
        });

    </script>

@endsection


