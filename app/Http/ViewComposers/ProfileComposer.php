<?php

/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/3
 * Time: 下午11:50
 */
namespace App\Http\ViewComposers;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $user;

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        //dd($this->user);
        $view->with('user', $this->user);
    }
}