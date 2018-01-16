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
            {{ Html::image($station->cover) }}
        </a>
        <div class="info">
            <a href="{{ route('station.show',$station->id) }}">
                <div class="name">{{ $station->name }}</div>
            </a>
            <div class="city">{{ $station->province.$station->city }}</div>
        </div>
        <div class="location">
            <div class="distance">
                {{ Html::image('assets/images/station/my-icon.png',null,['width'=>15]) }}
                {{ round($station->distance, 2) }}km
            </div>
            <div class="go" data-destination="{{ $station->lat.','.$station->lng }}" data-city="{{ $station->city }}">
                {{ Html::image('assets/images/station/goto.png',null,['width'=>20]) }}
                去这里
            </div>
        </div>
    </div>
@endforeach



