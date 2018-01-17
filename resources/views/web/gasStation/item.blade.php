<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/10
 * Time: 下午11:57
 */
?>

@foreach($stations as $key => $station)

    <div class="media">
        <a href="#" class="pull-left">
            {{ Html::image($station->cover,null,["class"=>"media-object"]) }}
        </a>
        <div class="media-body">
            <h5 class="media-heading">
                {{ $station->name }}
                <a href="{{ route('station.show',$station->id) }}" class="pull-right dx-font-m">
                    {{ Html::image('assets/images/station/my-icon.png',null,['width'=>15]) }}
                    {{ round($station->distance, 2) }}km
                </a>
            </h5>
            <p>
                联系电话:{{ $station->telephone?$station->telephone:$station->phone }}
            </p>
            <p>
                {{ $station->province.$station->city }}
                <span class="go pull-right" data-destination="{{ $station->lat.','.$station->lng }}" data-city="{{ $station->city }}">
                    {{ Html::image('assets/images/station/goto.png',null,['width'=>20]) }}
                    去这里
                </span>
            </p>
        </div>
    </div>

@endforeach



