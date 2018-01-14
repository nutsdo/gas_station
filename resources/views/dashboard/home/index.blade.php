<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/2
 * Time: 下午11:12
 */
?>
@extends('layouts.dashboard')

@section('page-nav')
    <div class="title-env">
        <h1 class="title">首页</h1>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{ route('dashboard.home') }}"><i class="fa-home"></i>首页</a>
            </li>
        </ol>

    </div>
@endsection

@section('main-content')

    <div class="row">

    </div>

@endsection
@push('scripts')

{!! Html::script('assets/js/xenon-widgets.js') !!}
{!! Html::script('assets/js/devexpress-web-14.1/js/globalize.min.js') !!}
{!! Html::script('assets/js/devexpress-web-14.1/js/dx.chartjs.js') !!}
{!! Html::script('assets/js/toastr/toastr.min.js') !!}

@endpush