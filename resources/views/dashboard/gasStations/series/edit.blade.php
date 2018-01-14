<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:30
 */
?>
@extends('layouts.dashboard')
@section('page-nav')
    <div class="title-env">
        <h1 class="title">编辑油价信息</h1>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{ route('dashboard.home') }}"><i class="fa-home"></i>首页</a>
            </li>
            <li class="active">
                <a href="{{ route('series.index') }}">油号管理</a>
            </li>
            <li>
                <strong>编辑油价信息</strong>
            </li>
        </ol>

    </div>
@endsection
@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">编辑油价信息</div>
        <div class="panel-body">

            {!! Form::model($gasStationSeries,['route'=>['gasStations.series.update', $gasStationId, $gasStationSeries->series_id],'class'=>'validate form-horizontal','method'=>'PUT','id'=>'form']) !!}
            @include('dashboard.gasStations.series.partials.form',['submitButtonText'=>'保存','is_create'=>true])
            {!! Form::close() !!}
        </div>
    </div>

@endsection
@push('styles')

@endpush
@push('scripts')

@endpush

