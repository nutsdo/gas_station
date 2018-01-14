<?php

namespace App\Http\Controllers;

use App\Entities\GasStation;
use App\Repositories\GasStationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GasStationController extends Controller
{
    //

    protected $repository;

    public function __construct(GasStationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        //
        $type = $request->get('type','map');

        $order = $request->get('order', 'distance');

        $lng = $request->input('lng');
        $lat = $request->input('lat');
        $stations = [];
        if($lng!=0 && $lat!=0){
            $query = GasStation::select([
                '*',
                DB::raw('(
                    6371 * acos (
                      cos ( radians('.$lat.') )
                      * cos( radians( lat ) )
                      * cos( radians( lng ) - radians('.$lng.') )
                      + sin ( radians('.$lat.') )
                      * sin( radians( lat ) )
                    )
                  ) AS distance'),
                DB::raw('(
                    SELECT
                        COUNT(id)
                    FROM
                        comments
                    WHERE
                        gas_stations.id = comments.gas_station_id
                ) AS comments'),
                DB::raw('(
                    SELECT
                        (AVG(price))
                    FROM
                        gas_station_series gss
                    WHERE
                        gss.gas_station_id = gas_stations.id
                )  AS price')
            ]);
            if($type=='map'){
                $stations = $query->orderBy($order,'ASC')->get();
            }elseif($type=='list'){
                if($order == 'price'){
                    $sort = 'ASC';
                    $query->orderBy($order,$sort);
                }elseif($order == 'comments'){
                    $sort = 'DESC';
                    $query->orderBy($order,$sort);
                }
                $stations = $query->orderBy('distance','ASC')->paginate(10);
            }
        }

        if (request()->wantsJson()) {

            if($type=='map'){

                return response()->json([
                    'data'  => $stations
                ]);
            }elseif($type=='list'){

                $stations_render = view('web.gasStation.item')->with('stations',$stations)->render();

                return response()->json([
                    'data' => $stations_render,
                    'stations' => $stations,
                ]);
            }

        }

        return view('web.index',compact('type', 'order', 'stations'));
    }

    public function show(Request $request, $id)
    {
        $station = GasStation::with('series')->find($id);
        //dd($station);
        return view('web.gasStation.show', compact('station'));
    }

    public function comments(Request $request)
    {

    }

    public function doComment(Request $request)
    {

    }
}
