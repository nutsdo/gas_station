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
        <h1 class="title">添加加油站</h1>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{ route('dashboard.home') }}"><i class="fa-home"></i>首页</a>
            </li>
            <li class="active">

                <a href="{{ route('gasStations.index') }}">加油站管理</a>
            </li>
            <li >

                <strong>添加加油站</strong>
            </li>
        </ol>

    </div>
@endsection

@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">添加油站信息</div>
        <div class="panel-body">

            {!! Form::model(null,['route'=>['gasStations.store'],'class'=>'validate form-horizontal','method'=>'POST','id'=>'form']) !!}
            @include('dashboard.gasStations.partials.form',['submitButtonText'=>'保存','is_create'=>true, 'path'=>''])
            {!! Form::close() !!}
        </div>
    </div>

@endsection
@include('upload.single',['type'=>'gasStation'])
@push('styles')

@endpush
@push('scripts')
{!! Html::script('assets/js/distpicker.min.js') !!}
{!! Html::script('http://api.map.baidu.com/api?v=2.0&ak=GjQkCLPRWvstG55SFWtyeFdj9xTmfKvF') !!}

<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("baidu-map", {minZoom:12,maxZoom:20});//设置地图显示级别

    map.enableScrollWheelZoom(); //启用滚轮放大缩小

    var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
    var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, type: BMAP_NAVIGATION_CONTROL_LARGE}); //右上角，仅包含平移和缩放按钮
    /*
         缩放控件type有四种类型:
         BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；
         BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；
         BMAP_NAVIGATION_CONTROL_ZOOM：仅包含缩放按钮
     */


    //添加控件和比例尺
    map.addControl(top_right_navigation);

    var geolocation = new BMap.Geolocation();

    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            map.panTo(r.point);
            //alert('您的位置：'+r.point.lng+','+r.point.lat);
            //坐标
            var point = new BMap.Point(r.point.lng,r.point.lat);
            // 初始化地图,设置中心点坐标和地图级别。
            map.centerAndZoom(point,14);
        }
        else {
            alert('failed'+this.getStatus());
        }
    },{enableHighAccuracy: true})



    $('#search-location').click(function(){
        // 创建地址解析器实例
        var myGeo = new BMap.Geocoder();
        var address = $('#province option:selected').val() + $('#city option:selected').val() + $('#district option:selected').val() + $('input[name=address]').val();

        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint(address, function(point){
            if (point) {
                map.centerAndZoom(point, 15);
                map.addOverlay(new BMap.Marker(point));
                $('input[name=lng]').val(point.lng);
                $('input[name=lat]').val(point.lat);
            }else{
                alert("您选择地址没有解析到结果!");
            }
        }, "石家庄市");
    });
</script>
@endpush

