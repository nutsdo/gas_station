<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:25
 */
?>
<div class="form-group">
    {!! Form::label('密码', '密码',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <div class="input-group">
            {!! Form::text('password',null,[
                'class'=>'form-control',
                'placeholder'=>'请输入密码'
            ]) !!}
        </div>
    </div>
    {!! $errors->first('password') !!}
</div>

<div class="form-group">
    {!! Form::label('确认密码', '确认密码',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <div class="input-group">
            {!! Form::text('password_confirmation',null,[
                'class'=>'form-control',
                'placeholder'=>'请输入确认密码'
            ]) !!}
        </div>
    </div>
    {!! $errors->first('password_confirmation') !!}
</div>
<div class="form-group">
    {!! Form::label('', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::button($submitButtonText,['class'=>'btn btn-success submit']) !!}
    {!! Form::reset('重置',['class'=>'btn btn-white']) !!}
    </div>
</div>
