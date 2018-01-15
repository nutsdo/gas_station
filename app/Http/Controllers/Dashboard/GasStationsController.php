<?php

namespace App\Http\Controllers\Dashboard;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GasStationCreateRequest;
use App\Http\Requests\GasStationUpdateRequest;
use App\Repositories\GasStationRepository;
use App\Validators\GasStationValidator;


class GasStationsController extends BaseController
{

    /**
     * @var GasStationRepository
     */
    protected $repository;

    /**
     * @var GasStationValidator
     */
    protected $validator;

    public function __construct(GasStationRepository $repository, GasStationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $gasStations = $this->repository->with('series')->paginate(20);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $gasStations,
            ]);
        }
//        dd($gasStations);
        return view('dashboard.gasStations.index', compact('gasStations'));
    }

    public function create()
    {
        return view('dashboard.gasStations.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  GasStationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GasStationCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $gasStation = $this->repository->create($request->except('_token'));

            $response = [
                'message' => 'GasStation created.',
                'data'    => $gasStation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('gasStations.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasStation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $gasStation,
            ]);
        }

        return view('dashboard.gasStations.show', compact('gasStation'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $gasStation = $this->repository->find($id);

        return view('dashboard.gasStations.edit', compact('gasStation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GasStationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GasStationUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $gasStation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'GasStation updated.',
                'data'    => $gasStation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'GasStation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'GasStation deleted.');
    }

}
