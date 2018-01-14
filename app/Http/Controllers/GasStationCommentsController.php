<?php

namespace App\Http\Controllers;

use App\Entities\Comments;
use App\Entities\GasStation;
use App\Repositories\GasStationRepository;
use Illuminate\Http\Request;

class GasStationCommentsController extends Controller
{
    //
    protected $repository;

    public function __construct(GasStationRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(Request $request, $gasStationId)
    {
        $comments = Comments::where('gas_station_id', $gasStationId)->paginate(20);

        if (request()->wantsJson()) {

            $comments_render = view('web.comments.list')->with('comments',$comments)->render();

            return response()->json([
                'data' => $comments_render,
                'comments' => $comments,
            ]);
        }

        return view('web.comments.index', compact('comments', 'gasStationId'));
    }

    public function create(Request $request, $gasStationId)
    {
        $comment = $request->input('comment');
        return view('web.comments.create', compact('comment', 'gasStationId'));
    }

    public function store(Request $request, $gasStationId)
    {
        $inputs = $request->only(['stars', 'content']);

        $gasStation = GasStation::find($gasStationId);

        $comment = $gasStation->comments()->create($inputs);

        $response = [
            'message' => '评论成功.',
            'data'    => $comment,
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->back()->with('message', $response['message']);
    }
}
