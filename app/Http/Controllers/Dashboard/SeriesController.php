<?php

namespace App\Http\Controllers\Dashboard;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SeriesCreateRequest;
use App\Http\Requests\SeriesUpdateRequest;
use App\Repositories\SeriesRepository;
use App\Validators\SeriesValidator;


class SeriesController extends BaseController
{

    /**
     * @var SeriesRepository
     */
    protected $repository;

    /**
     * @var SeriesValidator
     */
    protected $validator;

    public function __construct(SeriesRepository $repository, SeriesValidator $validator)
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
        $series = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $series,
            ]);
        }

        return view('dashboard.series.index', compact('series'));
    }

    public function create()
    {
        return view('dashboard.series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SeriesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SeriesCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $series = $this->repository->create($request->except('_token'));

            $response = [
                'message' => 'Series created.',
                'data'    => $series->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $series = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $series,
            ]);
        }

        return view('dashboard.series.show', compact('series'));
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

        $series = $this->repository->find($id);

        return view('dashboard.series.edit', compact('series'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SeriesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(SeriesUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $series = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Series updated.',
                'data'    => $series->toArray(),
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
                'message' => 'Series deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Series deleted.');
    }
}
