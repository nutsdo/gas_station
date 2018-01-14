<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/7
 * Time: 上午12:56
 */
?>
@extends('layouts.web')
@section('navigate')
    <div class="container">
        <ul class="nav navbar-nav station-nav navbar-static-top">
            <li><a href="{{ route('index') }}" @if($type=='map')class="active" @endif>地图</a></li>
            <li><a href="{{ route('index',['type'=>'list']) }}" @if($type=='list')class="active" @endif>列表</a></li>
        </ul>
    </div>
@endsection
@section('content')
    @if($type == 'map')
        @include('web.gasStation.map')
    @else
        <ul class="nav nav-pills">

            <li role="presentation" class="disabled @if($order=='distance') active @endif"><a href="{{ route('index',['type'=>'list', 'order'=>'distance']) }}">距离</a></li>
            <li role="presentation" class="disabled @if($order=='comments') active @endif"><a href="{{ route('index',['type'=>'list', 'order'=>'comments']) }}">评论</a></li>
            <li role="presentation" class="disabled @if($order=='price') active @endif"><a href="{{ route('index',['type'=>'list', 'order'=>'price']) }}">价格</a></li>

        </ul>
        @include('web.gasStation.list')
    @endif
@endsection
