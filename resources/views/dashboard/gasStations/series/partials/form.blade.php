<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:25
 */
?>
<div class="form-group">
    {!! Form::label('series_id', '选择油号',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::select('series_id', $series, null, [ 'class' => 'form-control' ]) !!}
    </div>
    {!! $errors->first('series_id') !!}
</div>

<div class="form-group">
    {!! Form::label('油价', '油价',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <div class="input-group">
            <span class="input-group-addon">¥</span>
            {!! Form::text('price',null,[
                'class'=>'form-control',
                'placeholder'=>'请输入油价'
            ]) !!}
            <span class="input-group-addon">元</span>
        </div>
    </div>
    {!! $errors->first('price') !!}
</div>

<div class="form-group">
    {!! Form::label('', '',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
    {!! Form::submit($submitButtonText,['class'=>'btn btn-success']) !!}
    {!! Form::reset('重置',['class'=>'btn btn-white']) !!}
    </div>
</div>
