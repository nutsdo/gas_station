<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/10
 * Time: 下午11:57
 */
?>

@foreach($stations as $key => $station)
    <div class="station-item">

        <a href="{{ route('station.show',$station->id) }}" class="thumbnail">
            <img src="http://yese.com/uploads/articles/20161023/image-1.jpg" data-src="uploads/articles/20161023/image-1.jpg">
        </a>
        <div class="info">
            <div class="name">{{ $station->name }}</div>
            <div class="city">{{ $station->province.$station->city }}</div>
        </div>
        <div class="location">
            <div class="distance">
                {{ Html::image('assets/images/station/my-icon.png',null,['width'=>15]) }}
                {{ round($station->distance, 2) }}km
            </div>
            <div class="go" data-destination="{{ $station->lat.','.$station->lng }}" data-city="{{ $station->city }}">
                {{ Html::image('assets/images/station/go.png',null,['width'=>20]) }}
                去这里
            </div>
        </div>
    </div>
@endforeach



