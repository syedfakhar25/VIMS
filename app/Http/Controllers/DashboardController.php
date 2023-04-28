<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $department_id = $request->department_id;
        if($user->user_type == 'admin'){
            if(isset($request->department_id) ){
                $department_id = $request->department_id;
                $vehicles = Vehicle::where('department_id', $department_id)->get();
                $total_vehicles = $vehicles->count();
                $on_road = Vehicle::where('status', 'On road')->where('department_id', $department_id)->count();
                $off_road = Vehicle::where('status', 'off road')->where('department_id', $department_id)->count();
                /* $on_road = $on_road->count();
                 $off_road = $off_road->count();*/
                $total_departments = Department::where('id', $department_id)->get();
                $dep_name = $total_departments[0]->dep_name;
                $total_departments = $total_departments->count();

                //body_types
                $cars = Vehicle::where('body_type', 'CAR')->where('department_id', $department_id)->get();
                $jeeps = Vehicle::where('body_type', 'JEEP')->where('department_id', $department_id)->get();
                $bikes = Vehicle::where('body_type', 'MOTOR CYCLE')->where('department_id', $department_id)->get();
                $pickup = Vehicle::where('body_type', 'PICKUP')->where('department_id', $department_id)->get();
                $tractor = Vehicle::where('body_type', 'TRACTOR')->where('department_id', $department_id)->get();
                $bus = Vehicle::where('body_type', 'BUS')->where('department_id', $department_id)->get();
                $mini_bus = Vehicle::where('body_type', 'MINI BUS')->where('department_id', $department_id)->get();

                //year
                $current_year = Date('Y');

                $less_than_2000 = Vehicle::where('model' ,'<', '2000')->where('department_id', $department_id)->get();
                $less_than_2010 = Vehicle::where('model' ,'>=', '2000')->where('model', '<', '2010' )->where('department_id', $department_id)->get();
                $greater_than_2010 = Vehicle::where('model' ,'>=', '2010')->where('department_id', $department_id)->get();
                $greater_than_2020 = Vehicle::where('model' ,'>=', '2020')->where('model', '<' , $current_year)->where('department_id', $department_id)->get();
                $new_current_year = Vehicle::where('model' , '=', $current_year)->where('department_id', $department_id)->get();

                //vehicles condition
                $vehicles_condition=DB::table('vehicles')
                    ->select('status', DB::raw('count(*) as total'))
                    ->groupBy('status')
                    ->where('status', '!=', NULL)
                    ->where('status', '!=', 'Loss')
                    ->where('status', '!=', 'CE Office Muzaffarabad')
                    ->where('status', '!=', '')
                    ->where('status', '!=', 'Accident')
                    ->where('status', '!=', 'On Road')
                    ->where('status', '!=', 'Off Road')
                    ->where('department_id', $department_id)
                    ->get();
                //dd($vehicles_condition);


                //vehicle engine power
                $engine_power_less_1300 = Vehicle::where('engine_power' ,'>=', '600')->where('engine_power', '<=','1300')->where('department_id', $department_id)->get();
                $engine_power_less_1600 = Vehicle::where('engine_power' ,'>', '1300')->where('engine_power', '<=','1600')->where('department_id', $department_id)->get();
                $engine_power_less_1800 = Vehicle::where('engine_power' ,'>', '1600')->where('engine_power', '<=','1800')->where('department_id', $department_id)->get();
                $engine_power_less_3000 = Vehicle::where('engine_power' ,'>', '1800')->where('engine_power', '<=','3000')->where('department_id', $department_id)->get();
                $engine_power_greater_3000 = Vehicle::where('engine_power' ,'>', '3000')->get();


                //non-registered vehicles
                $non_registered_vehicles = DB::table('vehicles')
                    ->where('reg_no','like','APF%')
                    ->where('department_id', $department_id)
                    ->get();

                //entitled
                $entitle= Vehicle::where('entitle', 'entitle')->where('department_id', $department_id)->count();
                $not_entitle= Vehicle::where('entitle', 'not_entitle')->where('department_id', $department_id)->count();
                $entitle_transport_policy= Vehicle::where('entitle', 'entitle_above_policy')->where('department_id', $department_id)->count();
            }
            else{
                $vehicles = Vehicle::all();
                $total_vehicles = $vehicles->count();
                $on_road = Vehicle::where('status', 'On road')->count();
                $off_road = Vehicle::where('status', 'off road')->count();
                /* $on_road = $on_road->count();
                 $off_road = $off_road->count();*/
                $total_departments = Department::all();
                $total_departments = $total_departments->count();
                $dep_name = '';
                //body_types
                $cars = Vehicle::where('body_type', 'CAR')->get();
                $jeeps = Vehicle::where('body_type', 'JEEP')->get();
                $bikes = Vehicle::where('body_type', 'MOTOR CYCLE')->get();
                $pickup = Vehicle::where('body_type', 'PICKUP')->get();
                $tractor = Vehicle::where('body_type', 'TRACTOR')->get();
                $bus = Vehicle::where('body_type', 'BUS')->get();
                $mini_bus = Vehicle::where('body_type', 'MINI BUS')->get();

                //year
                $current_year = Date('Y');

                $less_than_2000 = $vehicles->where('model' ,'<', '2000');
                $less_than_2010 = $vehicles->where('model' ,'>=', '2000')->where('model', '<', '2010' );
                $greater_than_2010 = $vehicles->where('model' ,'>=', '2010');
                $greater_than_2020 = $vehicles->where('model' ,'>=', '2020')->where('model', '<' , $current_year);
                $new_current_year = $vehicles->where('model' , '=', $current_year);


                //vehicles condition
                $vehicles_condition=DB::table('vehicles')
                    ->select('status', DB::raw('count(*) as total'))
                    ->groupBy('status')
                    ->where('status', '!=', NULL)
                    ->where('status', '!=', 'Loss')
                    ->where('status', '!=', 'CE Office Muzaffarabad')
                    ->where('status', '!=', '')
                    ->where('status', '!=', 'Accident')
                    ->where('status', '!=', 'On Road')
                    ->where('status', '!=', 'Off Road')
                    ->get();
                //dd($vehicles_condition);


                //vehicle engine power
                $engine_power_less_1300 = Vehicle::where('engine_power' ,'>=', '600')->where('engine_power', '<=','1300')->get();
                $engine_power_less_1600 = Vehicle::where('engine_power' ,'>', '1300')->where('engine_power', '<=','1600')->get();
                $engine_power_less_1800 = Vehicle::where('engine_power' ,'>', '1600')->where('engine_power', '<=','1800')->get();
                $engine_power_less_3000 = Vehicle::where('engine_power' ,'>', '1800')->where('engine_power', '<=','3000')->get();
                $engine_power_greater_3000 = Vehicle::where('engine_power' ,'>', '3000')->get();


                //non-registered vehicles
                $non_registered_vehicles = DB::table('vehicles')
                    ->where('reg_no', 'like', 'APF%')
                    ->get();

                //entitled
                $entitle= Vehicle::where('entitle', 'entitle')->count();
                $not_entitle= Vehicle::where('entitle', 'not_entitle')->count();
                $entitle_transport_policy= Vehicle::where('entitle', 'entitle_above_policy')->count();
            }


            return view('admin.dashboard')->with([
                'total_vehicles' => $total_vehicles,
                'total_departments' => $total_departments,
                'on_road' => $on_road,
                'off_road' => $off_road,
                'cars' => $cars->count(),
                'jeeps'=> $jeeps->count(),
                'bikes'=> $bikes->count(),
                'pickup'=> $pickup->count(),
                'tractor'=> $tractor->count(),
                'bus'=> $bus->count(),
                'mini_bus'=> $mini_bus->count(),
                'less_than_2000'=> $less_than_2000->count(),
                'less_than_2010'=> $less_than_2010->count(),
                'greater_than_2010'=> $greater_than_2010->count(),
                'greater_than_2020' => $greater_than_2020->count(),
                'new_current_year' => $new_current_year->count(),
                'vehicles_condition' => $vehicles_condition,
                'engine_power_less_1300'=>$engine_power_less_1300->count(),
                'engine_power_less_1600'=>$engine_power_less_1600->count(),
                'engine_power_less_1800'=>$engine_power_less_1800->count(),
                'engine_power_less_3000'=>$engine_power_less_3000->count(),
                'engine_power_greater_3000'=>$engine_power_greater_3000->count(),
                'non_registered_vehicles'=>$non_registered_vehicles->count(),
                'dep_name' => $dep_name,
                'department_id' => $department_id,
                'entitle' => $entitle,
                'not_entitle' => $not_entitle,
                'entitle_transport_policy' => $entitle_transport_policy,
            ]);
        }
        elseif ($user->user_type == 'department_admin'){
            $department = Department::where('user_id' , $user->id)->first();
            $vehicles = Vehicle::where('department_id', $department->id)->get();
            $total_vehicles = $vehicles->count();

            return view('department.dashboard')->with([
                'total_vehicles' => $total_vehicles,
                'department' => $department,
                'on_road' => $vehicles->where('status', 'On Road')->count(),
                'off_road' => $vehicles->where('status', 'Off Road')->count(),
                'not_set' => $vehicles->where('status', 'Not Set')->count(),
            ]);
        }

    }

    public function vCode(){
        $vehicles = Vehicle::all();
        foreach ($vehicles as $vehicle){
            $dep = Department::where('id', $vehicle->department_id)->first();
            $short_name = $dep->short_name;
            $vms_code = 'AJKV-'.$short_name.'-'.$vehicle->id;
            $vehicle->vms_code = $vms_code;
            $vehicle->update();

        }

    }
}
