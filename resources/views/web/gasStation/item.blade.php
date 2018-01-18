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
        <a href="{{ route('station.show',$station->id) }}" class="pull-left">
            {{ Html::image($station->cover,null,["class"=>"media-object"]) }}
        </a>
        <div class="media-body">
            <h5 class="media-heading">
                <a href="{{ route('station.show',$station->id) }}" class="media_name" >{{ $station->name }}</a>
                <div class="media_right">
                    {{ Html::image('assets/images/station/my-icon.png',null,['width'=>15]) }}
                    <span>{{ round($station->distance, 2) }}km</span>
                </div>
                <div class="clear"></div>
            </h5>
            <span>
                联系电话:{{ $station->telephone?$station->telephone:$station->phone }}
            </span>
            <p>
                {{ $station->province.$station->city }}
            </p>
        </div>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group left_go" role="group">
                <a href="tel:{{ $station->telephone?$station->telephone:$station->phone }}" type="button" class="btn btn-default">电话</a>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default go"
                        data-destination="{{ $station->lat.','.$station->lng }}" data-city="{{ $station->city }}"
                >
                    到这去
                </button>
            </div>
        </div>
    </div>

@endforeach



