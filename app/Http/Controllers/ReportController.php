<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->user_type == 'admin'){
            $vehicles  = DB::table('vehicles');

            $body_type_status = $vehicles->selectRaw('count(*) as total, status, body_type')
                 ->groupBy('status', 'body_type')
                ->whereIn('status', ['NonRegistered', 'Accidental', 'Auctioned', 'Bad Condition', 'Repairable'])
                ->whereIn('body_type', ['CAR', 'JEEP', 'BIKE', 'PICK UP', 'BUS', 'Van', 'Hiace'])
                ->get();

            $bts=array();
            //$bts
            foreach ($body_type_status as $row){
                if(empty($row->status) && empty($row->body_type)){
                    $bts['not_set']['not_set'] = $row->total;
                }
                elseif(empty($row->body_type)){
                    $bts[$row->status]['not_set'] = $row->total;
                }
                elseif (empty($row->status)){
                    $bts['not_set'][$row->body_type] = $row->total;
                }
                else{
                    $bts[$row->body_type][$row->status] = $row->total;
                }

            }
            //dd($bts);

            return view('reports.index')->with([
                'body_type_status' => $bts
            ]);
        }
        else{
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}

