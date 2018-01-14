<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:25
 */
?>
<div class="form-group">
    {!! Form::label('油号名称', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('serial_name',null,[
            'class'=>'form-control',
            'data-validate'=>'required',
            'data-message-required'=>'请输入油号名称.',
            'placeholder'=>'请输入油号名称'
        ]) !!}
    </div>
    {!! $errors->first('serial_name') !!}
</div>

<div class="form-group">
    {!! Form::label('油号', '油号',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('serial_number',null,[
            'class'=>'form-control',
            'placeholder'=>'请输入油号'
        ]) !!}
    </div>
    {!! $errors->first('serial_number') !!}
</div>

<div class="form-group">
    {!! Form::label('', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::submit($submitButtonText,['class'=>'btn btn-success']) !!}
    {!! Form::reset('重置',['class'=>'btn btn-white']) !!}
    </div>
</div>
