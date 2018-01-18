<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/11
 * Time: 下午10:54
 */
?>
@extends('layouts.web')
@section('content')
    <div class="station-info">
        <div class="thumbnail">
            {{ Html::image($station->cover) }}
            <div class="caption clearfix">
                <div class="detail">
                    <h4>{{ $station->name }}</h4>
                    <ul>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                    </ul>
                </div>
                <div class="go">
                    {{ Html::image('assets/images/station/goto.png',null,['width'=>40]) }}
                    <a href="javascript:;" class="go-there"
                       data-destination="{{ $station->lat.','.$station->lng }}" data-city="{{ $station->city }}"
                    >去这里</a>
                </div>
            </div>
            <p>联系电话:{{ $station->telephone?$station->telephone:$station->phone }}</p>
            <p>
                {{ Html::image('assets/images/station/my-icon.png',null,['width'=>20]) }}
                {{ $station->province.$station->city.$station->distance.$station->address }}
            </p>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">油价详情</div>
        <div class="series swiper-container">
            <ul class="swiper-wrapper">
                <li class="swiper-slide">
                    <span>油号</span>
                    <span>价格</span>
                </li>
                @foreach($station->series as $sery)
                <li class="swiper-slide">
                    <span>{{ $sery->serial_name }}</span>
                    <span>{{ $sery->pivot->price }}/升</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading panel_say">
            <a href="{{ route('station.comments.create',$station->id) }}">评论 <i class="fa fa-pencil-square-o"></i></a>
            <div class="panel-options pull-right">
                <a href="{{ route('station.comments', $station->id) }}">
                    查看更多 <i class="fa fa-angle-double-right"></i>
                </a>
            </div>
        </div>
        <div class="panel-body comments">
            <span class="label label-default default-comment">服务态度好</span>
            <span class="label label-primary default-comment">服务态度不好</span>
            <span class="label label-success default-comment">油品不好</span>
            <span class="label label-info default-comment">非常好</span>
            <span class="label label-warning default-comment">值得再来</span>
            <span class="label label-danger default-comment">打发票快</span>
            <span class="label label-default default-comment">油品好</span>
            <span class="label label-primary default-comment">油品价格实惠</span>
            <span class="label label-success default-comment">差评</span>
            <span class="label label-info default-comment">好评</span>
            <span class="label label-warning default-comment">排队车少</span>
        </div>

    </div>
    @foreach($station->comments as $comment)
    <div class="media">
        <div class="media-left">
            <a href="javascript:;">
                {{ Html::image('assets/images/user-2.png', null, ['class'=>'media-object avatar']) }}
            </a>
        </div>
        <div class="media-body">
            <h5 class="media-heading">
                匿名用户
                <span class="pull-right">{{ $comment->created_at }}</span>
                <p class="filled-stars" style="width: 100%;">
                    @for($i=1;$i<=$comment->stars;$i++)
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                    @endfor
                </p>
            </h5>
            {{ $comment->content }}
        </div>
    </div>
    @endforeach
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
{{ Html::style('assets/css/fonts/fontawesome/css/font-awesome.min.css') }}
@endpush

@push('scripts')
{!! Html::script('http://api.map.baidu.com/api?v=2.0&ak=GjQkCLPRWvstG55SFWtyeFdj9xTmfKvF') !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script language="javascript">
    var mySwiper = new Swiper('.swiper-container',{
        width: 80,
        freeMode : true,
    })
    $('.default-comment').on('click', function(e){
        location.href = "{{ route('station.comments.create',$station->id) }}" + "?comment=" + $(e.target).text();
    })
</script>
<script type="text/javascript">

    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){

            var latCurrent = r.point.lat;
            var lngCurrent = r.point.lng;
            console.log('我的位置：'+ latCurrent + ',' + lngCurrent);

            $("body").on('click', '.go', function(e){
                var $this = $(e.target);

                console.log(latCurrent)
                console.log(lngCurrent)
                var destination = $this.data('destination');
                var city = $this.data('city');
                //alert($this.attr('width'));
                location.href="http://api.map.baidu.com/direction?origin="+latCurrent+","+lngCurrent+"&destination="+destination+"&mode=driving&region="+city+"&output=html";
            });


        } else {
            alert('failed'+this.getStatus());
        }
    },{enableHighAccuracy: true});


</script>
@endpush
