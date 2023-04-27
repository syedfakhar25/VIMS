<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use BaconQrCode\Common\Mode;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;
use Milon\Barcode\Facades\DNS2DFacade;
use phpDocumentor\Reflection\Types\Null_;
use function Symfony\Component\String\length;
use function Termwind\ValueObjects\w;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user= Auth::user();
        $departments = array();
        $vehicles = Vehicle::all();
        if($request->department_id==0){
            $request->department_id !=0;
        }
        $vehicles =DB::table('vehicles');
        if($user->user_type == 'admin'){
           // dd($request->reg_no);
            //dd($request->department_id);
           if($request->reg_no == 1 ){
               $vehicles = DB::table('vehicles')->where('vehicles.reg_no', NULL )
               ->orWhere('vehicles.reg_no', '' )
               ->orWhere('vehicles.reg_no', 'like','APF%' );
           }
           elseif (isset($request->department_id)){
                $vehicles = $vehicles->leftJoin('departments', 'vehicles.department_id', '=', 'departments.id')
                    ->select('vehicles.id as id', 'vehicles.reg_no',  'vehicles.chassis_no', 'vehicles.body_type','vehicles.vms_code',
                            'vehicles.status', 'vehicles.engine_power', 'vehicles.model', 'departments.dep_name' , 'vehicles.allotee'
                    )
                    ->Where('departments.id', $request->department_id);
           }
           elseif (isset($request->chassis_no)){
                    $vehicles = $vehicles->where('vehicles.chassis_no', $request->chassis_no);
           }
           elseif (isset($request->status)){
                    $vehicles = $vehicles->where('vehicles.status', $request->status);
           }
           elseif (isset($request->reg_no)){
                    $vehicles = $vehicles->where('vehicles.reg_no', $request->reg_no);
           }
           elseif (isset($request->body_type)){
                    $vehicles = $vehicles->where('vehicles.body_type', $request->body_type);
           }
           elseif (isset($request->model)){
                    $vehicles = $vehicles->where('vehicles.model', $request->model);
           }

            $departments = Department::all();
        }

        elseif ($user->user_type == 'department_admin'){
            $department = Department::where('user_id' , $user->id)->first();
            $vehicles = $vehicles->where('department_id', $department->id);


        }
        return view('vehicle.index')->with([
            'vehicles' => $vehicles->get()/*->paginate(50)->withQueryString()*/,
            'count_vehicle' => $vehicles->count(),
            'departments'=> $departments
        ]);

    }

    public function searchVehicle($status){
       // dd($status);
        $user= Auth::user();
        if($user->user_type == 'admin'){
            if($status!=NULL){
                $vehicles = DB::table('vehicles')
                   // ->leftJoin('departments', 'vehicles.department_id', '=', 'departments.id')
                    ->where('vehicles.status', $status )
                    ->get();
               // dd($vehicles);
            }
            else{
                // $vehicles = Vehicle::with('department')->get();
                $vehicles = DB::table('vehicles')
                    /*->join('departments', 'vehicles.department_id', '=', 'departments.id')*/
                    ->get();
            }

            $departments = Department::all();
            return view('vehicle.index')->with([
                'vehicles' => $vehicles,
                'count_vehicle' => $vehicles->count(),
                'departments'=> $departments
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $user= Auth::user();
        $status_vehicles=DB::table('vehicles')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->where('status', '!=', NULL)
            ->where('status', '!=', 'Loss')
            ->get();
        $user_department = Null;
        if($user->user_type == 'department_admin')
            $user_department = Department::where('user_id', $user->id)->first();
        return view('vehicle.create')->with([
            'departments' => $departments,
            'user_department' =>$user_department,
            'status_vehicles' => $status_vehicles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $department = Department::find($request->department_id);
        $vehicle->reg_no =$request->reg_no ;
        $vehicle->department_id =$request->department_id ;
        $vehicle->dep_name =$department->dep_name;
        $vehicle->allotee =$request->allotee ;
        $vehicle->maker =$request->maker ;
        $vehicle->body_type =$request->body_type ;
        $vehicle->vehicle_type =$request->vehicle_type ;
        $vehicle->model =$request->model;
        $vehicle->engine_power =$request->engine_power ;
        $vehicle->colour =$request->colour ;
        $vehicle->engine_no =$request->engine_no ;
        $vehicle->chassis_no =$request->chassis_no ;
        $vehicle->type =$request->type ;
        $vehicle->allotted_by =$request->allotted_by ;
        $vehicle->purchase_type =$request->purchase_type ;
        $vehicle->meter_reading =$request->meter_reading ;
        $vehicle->fuel_average =$request->fuel_average ;
        $vehicle->prev_reg_no =$request->prev_reg_no ;
        $vehicle->status =$request->status ;

        $vehicle->save();
        return  redirect()->route('vehicle.index')->with([
            'success' => 'Vehicle Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);

        $vehicleInfoForQR = 'Reg No: '.''.$vehicle->reg_no . ', Model: ' . $vehicle->model;

        //dd($qrCode);
        return view('vehicle.show' )->with([
            'vehicle'=>$vehicle,
            'vehicleInfoForQR' => $vehicleInfoForQR,
                ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $departments = Department::all();
        $status_vehicles=DB::table('vehicles')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->where('status', '!=', NULL)
            ->where('status', '!=', 'Loss')
            ->get();
        $user= Auth::user();
        $user_department = Null;
        if($user->user_type == 'department_admin')
            $user_department = Department::where('user_id', $user->id)->first();
        return view('vehicle.edit')->with([
            'vehicle' => $vehicle,
            'departments' => $departments,
            'user_department' =>$user_department,
            'status_vehicles' => $status_vehicles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->reg_no =$request->reg_no ;
        $vehicle->department_id =$request->department_id ;
        $vehicle->allotee =$request->allotee ;
        $vehicle->maker =$request->maker ;
        $vehicle->body_type =$request->body_type ;
        $vehicle->vehicle_type =$request->vehicle_type ;
        $vehicle->model =$request->model;
        $vehicle->engine_power =$request->engine_power ;
        $vehicle->colour =$request->colour ;
        $vehicle->engine_no =$request->engine_no ;
        $vehicle->chassis_no =$request->chassis_no ;
        $vehicle->type =$request->type ;
        $vehicle->allotted_by =$request->allotted_by ;
        $vehicle->purchase_type =$request->purchase_type ;
        $vehicle->meter_reading =$request->meter_reading ;
        $vehicle->fuel_average =$request->fuel_average ;
        $vehicle->prev_reg_no =$request->prev_reg_no ;
        $vehicle->status =$request->status ;

        $vehicle->update();
        return  redirect()->route('vehicle.index')->with([
            'success' => 'Vehicle Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function importVehicle(){
        return view('vehicle.import');
    }
    public function addImportedVehicle(Request $request){
        $request->validate([
            'vehicle_csv1' => 'required|mimes:csv',
        ]);
        if ($request->has('vehicle_csv1')) {
            $path = $request->file('vehicle_csv1')->store('imported_vehicles', 'public');
            $request->merge(['vehicle_csv' => $path]);
        }
        $filename = Storage::path('/public/'.$path);

        /*$fileName = time().'.'.$request->vehicle_csv->extension();
        $request->vehicle_csv->move(public_path('imported_vehicles'), $fileName);*/
        //$filename = public_path('/imported_vehicles/'.$fileName);

        if (!file_exists($filename) || !is_readable($filename)){
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, ',')) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        $updated_vehicles = 0;
        $added_vehciles = 0;
        for($i =1; $i<count($data) ; $i++){
            //dd($data[1]);
            $reg_no= ($data[$i]['REGISTRATION NUMBER']);
            $dep_name= ($data[$i]['DEPARTMENT  NAME']);
            $allotee= ($data[$i]['ALLOTEE']);
            $maker= ($data[$i]['MAKER']);
            $body_type= ($data[$i]['BODY TYPE']);
            $model= ($data[$i]['YEAR OF MODEL']);
            $engine_power= ($data[$i]['ENGINE POWER']);
            $colour= ($data[$i]['COLOUR']);
            $engine_no= ($data[$i]['ENGINE NO']);
            $chassis_no= ($data[$i]['CHASSIS NO']);
            $type= ($data[$i]['ENGINE TYPE']);
            $allotted_by= ($data[$i]['ALLOTED BY']);
            $purchase_type= ($data[$i]['PURCHAISED TYPE']);
            $meter_reading= ($data[$i]['METER READING']);
            $fuel_average= ($data[$i]['Fuel Average']);
            $prev_reg_no= ($data[$i]['PREVIOUS REGISTRATION NO IF ANY']);
            $status= ($data[$i]['STATUS']);

            //get dep id
            if(Department::where('dep_name', $dep_name)->exists()) {
                $dep_id = Department::select('id')->where('dep_name', $dep_name)->first();
                $dep_id= $dep_id->id;
            }
            else{
                $department = new Department();
                $department->dep_name = $dep_name;
                $department->user_id = 5;
                $department->focal_person = '-';
                $department->phone = '0000';
                $department->short_name = NULL;
                $department->save();

                $dep_id = $department->id;
            }

            //check if record exists already
            $check = Vehicle::where('chassis_no' , $chassis_no)->exists();

            if($check == true && !empty($chassis_no)){
                $vehicle = Vehicle::where('chassis_no',$chassis_no)->first();
                $vehicle->allotee = $allotee ;
                $vehicle->body_type = $body_type ;
                $vehicle->model = $model ;
                $vehicle->engine_no = $engine_no ;
                $vehicle->maker = $maker ;
                $vehicle->engine_power = $engine_power ;
                $vehicle->colour = $colour ;
                $vehicle->chassis_no = $chassis_no ;
                $vehicle->type = $type ;
                $vehicle->allotted_by = $allotted_by ;
                $vehicle->purchase_type = $purchase_type ;
                $vehicle->meter_reading = $meter_reading;
                $vehicle->fuel_average = $fuel_average ;
                $vehicle->prev_reg_no = $prev_reg_no ;
                $vehicle->status = $status ;

                $vehicle->update();
                $updated_vehicles ++;
            }
            elseif($check == false){

                $vehicle = new Vehicle();
                $vehicle->reg_no = $reg_no ;
                $vehicle->dep_name = $dep_name ;
                $vehicle->department_id = $dep_id ;
                $vehicle->allotee = $allotee ;
                $vehicle->engine_no = $engine_no ;
                $vehicle->maker = $maker ;
                $vehicle->body_type = $body_type ;
                $vehicle->model = $model ;
                $vehicle->engine_power = $engine_power ;
                $vehicle->colour = $colour ;
                $vehicle->chassis_no = $chassis_no ;
                $vehicle->type = $type ;
                $vehicle->allotted_by = $allotted_by ;
                $vehicle->purchase_type = $purchase_type ;
                $vehicle->meter_reading = $meter_reading;
                $vehicle->fuel_average = $fuel_average ;
                $vehicle->prev_reg_no = $prev_reg_no ;
                $vehicle->status = $status ;
                $vehicle->save();
                if(empty($reg_no)){
                    $vehicle->update([
                        'reg_no' => 'APF-'.$vehicle->id
                    ]);
                }
                $added_vehciles++;
            }

        }
        return  redirect()->route('vehicle.index')->with([
            'success' => $added_vehciles.' vehicles added and '.$updated_vehicles.' vehicles updated successfully',
        ]);
    }

    public function printSticker($id){
        $vehicle = Vehicle::find($id);
        $vehilce_url = route('vehicle-url', $id);
        /*$vehicleInfoForQR = 'Reg No: '.''.$vehicle->reg_no . ', Model: ' . $vehicle->model
                            .' VMS Code: '. $vehicle->vms_code
                            .' Engine No: '. $vehicle->engine_no;*/

        //dd($qrCode);
        return view('vehicle.print-sticker' )->with([
                'vehicle'=>$vehicle,
                'vehicleInfoForQR' => $vehilce_url,
            ]
        );
    }
    public function vehicleUrlInfo($id){
        $vehicle = Vehicle::find($id);
      return view('vehicle.vehicleQRInfo')->with([
          'vehicle'=> $vehicle
      ]);
    }
}
