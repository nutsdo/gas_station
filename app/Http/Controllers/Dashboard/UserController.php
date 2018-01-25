<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    public $user;
    //
    public function __construct()
    {
        parent::__construct();

    }

    public function edit(Request $request)
    {

        return view('dashboard.user.edit');
    }

    public function update(Request $request)
    {
        try {

            $inputs = $request->only('password');
            $inputs['password'] = bcrypt($inputs['password']);


            $user = User::where('id' ,1)->update($inputs);

            $response = [
                'message' => '已更新.',
                'data'    => $user,
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);

        } catch (\Exception $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessage()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
