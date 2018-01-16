<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/7
 * Time: 上午12:56
 */
?>
@extends('layouts.web')
@section('title','加油邯郸')
@section('navigate')
    <div class="container">
        <ul class="nav navbar-nav station-nav navbar-static-top">
            <li @if($type=='map')class="active" @endif><a href="{{ route('index') }}">地图</a></li>
            <li  @if($type=='list')class="active" @endif><a href="{{ route('index',['type'=>'list']) }}">列表</a></li>
        </ul>
    </div>
@endsection
@section('content')
    @if($type == 'map')
        @include('web.gasStation.map')
    @else

        <p class="station-order">
            <label class="cbr-inline">
                距离
                <input type="radio" name="type" data-url="{{ route('index',['type'=>'list', 'order'=>'distance']) }}" class="cbr cbr-turquoise" @if($order=='distance') checked @endif>
            </label>
            <label class="cbr-inline">
                评论
                <input type="radio" name="type" data-url="{{ route('index',['type'=>'list', 'order'=>'comments']) }}" class="cbr cbr-turquoise" @if($order=='comments') checked @endif>
            </label>
            <label class="cbr-inline">
                价格
                <input type="radio" name="type" data-url="{{ route('index',['type'=>'list', 'order'=>'price']) }}" class="cbr cbr-turquoise" @if($order=='price') checked @endif>
            </label>
        </p>

        @include('web.gasStation.list')
    @endif
@endsection
