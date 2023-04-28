
@extends('template.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$dep_name}} Dashboard</h1>
    </div>


    <!-- Content Row -->
    <div class="row">
        <!--  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">

                               <a href="{{route('vehicle.index','department_id'.'='.$department_id)}}">Total Vehicles </a> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_vehicles}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if($department_id == null )
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="{{route('department.index')}}">Departments</a> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_departments}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{route('vehicle.index', ['status'.'='.'On Road', 'department_id'.'='.$department_id])}}">On Road</a>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$on_road}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-pickup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <a href="{{route('vehicle.index' , ['status'.'='.'Off Road', 'department_id'.'='.$department_id])}}">Off Road</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$off_road}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display:flex; justify-content: center">
        <div class="col-lg-3 mb-4">
            <div class="card bg-gradient-success text-white shadow">
                <div class="card-body">
                    <a style="color: white; font-weight: bold" href="{{route('vehicle.index' , ['entitle'.'='.'entitle', 'department_id'.'='.$department_id])}}">Entitled </a>
                    <div class="text-white-100" style="font-size: 25px">{{$entitle}} &nbsp; <i class=" fa fa-car-side"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card bg-gradient-danger text-white shadow">
                <div class="card-body">
                    <a style="color: white; font-weight: bold" href="{{route('vehicle.index' , ['entitle'.'='.'not_entitle', 'department_id'.'='.$department_id])}}"> Not Entitled</a>
                    <div class="text-white-100" style="font-size: 25px">{{$not_entitle}} &nbsp; <i class="fa fa-car-crash"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <div class="card bg-gradient-info text-white shadow">
                <div class="card-body">
                    <a style="color: white; font-weight: bold" href="{{route('vehicle.index' , ['entitle'.'='.'entitle_above_policy', 'department_id'.'='.$department_id])}}">above Transport Policy</a>
                    <div class="text-white-100" style="font-size: 25px">{{$entitle_transport_policy}} &nbsp; <i class="fa fa-car-alt"></i> </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bar chart vehicle by their condition --}}
    <div class="row">
        {{--<div class="col-md-12" align="center">
            <b> <h6><em>Vehicles by their Condition</em></h6></b>
        </div>--}}
    </div>
    <div class="row">
        @if($department_id == null)
            <div class="col-md-12" align="center">
                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            </div>
           {{-- <div class="card bg-gradient-light col-md-6" align="center">
                <canvas id="barChart" style="width:100%;max-width:600px"></canvas>
            </div>--}}
        </div>
        <div class="row mt-5" align="center">
            <style>
                .statusCard{
                    border-radius: 35px 35px;
                }

            </style>

        {{--<div class="col-md-2">
            <div class="statusCard card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <a href="{{URL::route('vehicle.index', ['reg_no' => 'APF%'])}}"> <h6><b>NonRegistered</b></h6></a>
                </div>
                <div class="text-info text-center mt-2"><h1>{{$non_registered_vehicles}}</h1></div>
            </div>
        </div>--}}

            @foreach($vehicles_condition as $i)
                <div class="col-md-2 mt-2">
                    <div class="statusCard card border-info mx-sm-1 p-3">
                        <div class="text-info text-center mt-3">
                            <a href="{{URL::route('vehicle.index', ['status' => $i->status, 'department_id' => $department_id])}}"> <h6><b>{{$i->status}}</b></h6></a>
                        </div>
                        <div class="text-info text-center mt-2"><h1>{{$i->total}}</h1></div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

   {{-- vehicle body type graph--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="row">
        <hr width="100%">
        <div class="card bg-gradient-light col-md-6">
            <canvas id="horizontalBar"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="yearGraph" ></canvas>
        </div>

    </div>


    <script>
        var xValues = ["CAR", "JEEP", "BIKE", "PICK UP", "TRACTOR", "BUS", "MINI BUS"];
        var yValues = [{{$cars}}, {{$jeeps}}, {{$bikes}}, {{$pickup}}, {{$tractor}},{{$bus}}, {{$mini_bus}}];
        var barColors = [
            "#cc99ff",
            "#66ff99",
            "#6699ff",
            "#ffcc66",
            "#999966",
            "#9933ff",
            "#ffb3b3"
        ];

        var myChart= new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Vehicles by their Body Types"
                }
            }
        });

        document.getElementById("myChart").onclick = function(evt){
            var activePoints = myChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = myChart.data.labels[firstPoint._index];
            var value = myChart.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            if (firstPoint !== undefined)
                //alert(label + ": " + value);
                window.location.href= "{{route('vehicle.index')}}?body_type="+label;
        };
    </script>


    {{--vehicle yearly graph model wise--}}


    <script>
        var xValues = ['< 2000', '< 2010', '> 2010' , '>2020', 'new'];
        var yValues = [{{$less_than_2000}},{{$less_than_2010}},{{$greater_than_2010}}, {{$greater_than_2020}},{{$new_current_year}}];
        var barColors = [
            "#ffd633",
            "#66b3ff",
            "#33ff33",
            "#858796",
            "#e74a3b",
        ];

        new Chart("yearGraph", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Vehicle Models"
                }
            }
        });

    </script>

    <script>
        var xValues =  ["" ,"Non-Registered",
                @foreach ($vehicles_condition as $i)
            [ "{{ $i->status }}  " ,  ],
            @endforeach
             ""
        ];
       // var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
        var yValues = ["","{{$non_registered_vehicles}}",
            @foreach($vehicles_condition as $i) "{{$i->total}}",@endforeach
             ""
        ];
        var barColors = ["#66b3ff", "#66b3ff","#66b3ff", "#66b3ff",  "#66b3ff",  "#66b3ff",  "#66b3ff"];

        var barChart = new Chart("barChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{no
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: "Vehicles by their Condition"
                }
            }
        });

        document.getElementById("barChart").onclick = function(evt){
            var activePoints =barChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = barChart.data.labels[firstPoint._index];
            var value = barChart.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            if (firstPoint !== undefined)
                //alert(label + ": " + value);
               window.location.href= "{{route('vehicle.index')}}?status="+label;
        };
    </script>

    {{--horizontal bar chart for vehicle engine power--}}
    <script>
        new Chart(document.getElementById("horizontalBar"), {
            "type": "horizontalBar",
            "data": {
                "labels": ["< 1300", "< 1600", "< 1800", "< 3000", "> 3000"],
                "datasets": [{
                    "label": "Vehicles by Engine Power",
                    "data": [{{$engine_power_less_1600}}, {{$engine_power_less_1300}}, {{$engine_power_less_1600}}, {{$engine_power_less_1800}}, {{$engine_power_less_3000}},],
                    "fill": false,
                    "backgroundColor": ["#66b3ff", "#66b3ff",
                        "#66b3ff", "#66b3ff", "#66b3ff",
                        "#66b3ff", "#66b3ff"
                    ],
                    /*"borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                    ],*/
                    "borderWidth": 0.5
                }]
            },
            "options": {
                "scales": {
                    "xAxes": [{
                        "ticks": {
                            "beginAtZero": true
                        }
                    }]
                }
            }
        });
    </script>








@endsection
