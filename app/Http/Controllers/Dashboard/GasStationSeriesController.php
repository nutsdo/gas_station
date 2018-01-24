<?php

namespace App\Http\Controllers\Dashboard;

use App\Entities\GasStation;
use App\Entities\GasStationSeries;
use App\Entities\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GasStationSeriesController extends BaseController
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $gasStationId)
    {
        $station = GasStation::with('series')->find($gasStationId);

        return view('dashboard.gasStations.series.index', compact('station'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $gasStationId)
    {
        //
        $series = Series::all();
        $series = $this->makeOptions($series);
        return view('dashboard.gasStations.series.create', compact('gasStationId','series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $gasStationId)
    {
        //
        try {

            $series_id  = $request->input('series_id');
            $price      = $request->input('price');
            $gasStation = GasStation::find($gasStationId);
            $has_series = $gasStation->series()->where('series_id', $series_id)->count();
            if(!$has_series){
                $gasStation->series()->attach($series_id, ['price' => $price]);

                $response = [
                    'message' => 'GasStation created.',
                    'data'    => $gasStation->toArray(),
                ];


            }else{
                $response = [
                    'message' => '已存在.',
                    'data'    => $gasStation->toArray(),
                ];
            }
            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return redirect()->route('gasStations.index', ['gasStationId'=>$gasStationId])->with('message', $response['message']);

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }
            return redirect()->route('gasStations.index', ['gasStationId'=>$gasStationId])->withErrors($e->getMessage())->withInput();
        }
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
    public function edit($gasStationId, $id)
    {
        $series = Series::all();
        $series = $this->makeOptions($series);
        $gasStationSeries = GasStationSeries::where('gas_station_id', $gasStationId)->where('series_id', $id)->first();

        return view('dashboard.gasStations.series.edit', compact('gasStationId', 'series', 'gasStationSeries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gasStationId, $id)
    {
        //
        try {
            $price      = $request->input('price');
            $gasStationSeries = GasStationSeries::where('gas_station_id', $gasStationId)
                                          ->where('series_id', $id)->first();
            if($gasStationSeries){

                GasStationSeries::where('gas_station_id', $gasStationId)
                    ->where('series_id', $id)->update(['price'=> $price]);

                $response = [
                    'message' => '油号价格已保存.',
                    'data'    => $gasStationSeries->toArray(),
                ];

            }else{
                $response = [
                    'message' => '油号不存在.',
                    'data'    => $gasStationSeries->toArray(),
                ];
            }
            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return redirect()->route('gasStations.index', ['gasStationId'=>$gasStationId])->with('message', $response['message']);
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }
            return redirect()->route('gasStations.index', ['gasStationId'=>$gasStationId])->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gasStationId, $id)
    {
        $deleted = GasStationSeries::where('gas_station_id', $gasStationId)
            ->where('series_id', $id)->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => '删除成功.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', '删除成功.');
    }

    public function makeOptions($array)
    {
        $result = [];
        foreach($array as $item){
            $result[$item->id] = $item->serial_name;
        }
        return $result;
    }
}
