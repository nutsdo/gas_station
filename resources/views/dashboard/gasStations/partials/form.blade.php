<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:25
 */
?>
<div class="form-group">
    {!! Form::label('油站类型', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('type', ['1'=>'加油站', '2'=>'加气站'], null, [ 'class' => 'form-control' ]) !!}
    </div>
    {!! $errors->first('category_id') !!}
</div>

<div class="form-group">
    {!! Form::label('油站名称', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('name',null,[
            'class'=>'form-control',
            'data-validate'=>'required',
            'data-message-required'=>'请输入油站名称.',
            'placeholder'=>'请输入油站名称'
        ]) !!}
    </div>
    {!! $errors->first('name') !!}
</div>
<div class="form-group">
    {!! Form::label('cover', '油站图片',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-9">
        {!! Form::text('cover',null,[
            'class'=>'form-control',
            'placeholder'=>'油站图片'
        ]) !!}
    </div>
    <a href="javascript:;" data-input="cover" class="btn btn-primary btn-single btn-sm file-upload">上传</a>

    {!! $errors->first('cover') !!}
</div>

<div class="form-group @if($is_create) hide @endif" id="preview_pic">
    <div class="col-sm-10 col-sm-offset-2">

    {!! Html::image($path,null,['id'=>'pic_path','width'=>'80']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('手机号码', '手机号码',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone',null,[
            'class'=>'form-control',
            'placeholder'=>'请输入手机号码'
        ]) !!}
    </div>
    {!! $errors->first('phone') !!}
</div>
<div class="form-group">
    {!! Form::label('座机号码', '座机号码',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('telephone',null,[
            'class'=>'form-control',
            'placeholder'=>'请输入座机号码'
        ]) !!}
    </div>
    {!! $errors->first('telephone') !!}
</div>

<div class="form-group">
    {!! Form::label('is_banned', '状态',['class'=>'control-label col-sm-2']) !!}
    <div class="checkbox">
        <div class="col-sm-1">
            {!! Form::radio('is_banned', '1', true) !!}禁用
        </div>
        <div class="col-sm-1">
            {!! Form::radio('is_banned', '0', true) !!}正常
        </div>
    </div>
    {!! $errors->first('is_banned') !!}
</div>
<div class="form-group">
    {!! Form::label('详细地址', '详细地址',['class'=>'control-label col-sm-2']) !!}
    <div id="distpicker" class="col-sm-10 form-inline" data-toggle="distpicker">
        @if($is_create)
            {!! Form::select('province', [], null, [ 'class' => 'form-control', 'id'=>'province', 'data-province'=>'---- 选择省 ----' ]) !!}
            {!! Form::select('city', [], null, [ 'class' => 'form-control', 'id'=>'city', 'data-city'=>'---- 选择市 ----' ]) !!}
            {!! Form::select('district', [], null, [ 'class' => 'form-control', 'id'=>'district', 'data-district'=>'---- 选择区 ----' ]) !!}
        @else
            {!! Form::select('province', [], null, [ 'class' => 'form-control', 'id'=>'province', 'data-province'=>$gasStation->province ]) !!}
            {!! Form::select('city', [], null, [ 'class' => 'form-control', 'id'=>'city', 'data-city'=>$gasStation->city ]) !!}
            {!! Form::select('district', [], null, [ 'class' => 'form-control', 'id'=>'district', 'data-district'=>$gasStation->district ]) !!}

        @endif
        {!! Form::text('address',null,[
            'class'=>'form-control',
            'placeholder'=>'请输入详细地址'
        ]) !!}
        <a href="javascript:;" id="search-location" class="btn btn-primary btn-single btn-sm">搜索位置</a>
    </div>
    {!! $errors->first('phone') !!}
</div>

<div class="form-group">
    <div id="baidu-map" class="col-sm-10 col-sm-offset-2" style="height: 500px;">

    </div>
</div>
{!! Form::hidden('lng') !!}
{!! Form::hidden('lat') !!}
<div class="form-group">
    {!! Form::label('', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::submit($submitButtonText,['class'=>'btn btn-success']) !!}
    {!! Form::reset('重置',['class'=>'btn btn-white']) !!}
    </div>
</div>
