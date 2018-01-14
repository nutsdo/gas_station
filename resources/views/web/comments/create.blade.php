<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/13
 * Time: 上午1:00
 */
?>
@extends('layouts.web')
@section('content')
    <section class="profile-env">
        {!! Form::model(null,['route'=>['station.comments.store', $gasStationId],'class'=>'profile-post-form','method'=>'POST']) !!}

        <label for="input-5" class="control-label">评价</label>
        <input id="stars" name="stars" class="rating rating-loading" data-language="zh" data-min="0" data-max="5" data-step="1" data-size="xs">

        <textarea name="content" class="form-control input-unstyled input-lg autogrow" placeholder="留下点什么吧?">{{ $comment }}</textarea>
        <ul class="list-unstyled list-inline form-action-buttons">
            <li>
                <i class="fa fa-comment-o"></i>
            </li>
        </ul>
        <button type="submit" class="btn btn-single btn-xs btn-success post-story-button">评论</button>
        {!! Form::close() !!}
    </section>
@endsection
@push('styles')
{{ Html::style('assets/css/fonts/fontawesome/css/font-awesome.min.css') }}
{{ Html::style('assets/css/xenon-components.css') }}
{{ Html::style('assets/js/star-rating/css/star-rating.css') }}
{{ Html::style('assets/js/star-rating/themes/krajee-svg/theme.css') }}
@endpush
@push('scripts')
{{ Html::script('assets/js/star-rating/js/star-rating.min.js') }}
{{ Html::script('assets/js/star-rating/themes/krajee-svg/theme.js') }}
{{ Html::script('assets/js/star-rating/js/locales/zh.js') }}
<script>
    $(document).on('ready', function(){
        $('#stars').rating({
            language: 'zh',
            min: 0,
            max:5,
            step:1,
            size:'xs'
        });
    });
</script>
@endpush