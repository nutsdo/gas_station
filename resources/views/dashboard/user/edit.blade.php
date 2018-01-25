<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午9:30
 */
?>
@extends('layouts.dashboard')

@section('page-nav')
    <div class="title-env">
        <h1 class="title">修改密码</h1>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{ route('dashboard.home') }}"><i class="fa-home"></i>首页</a>
            </li>
            <li >
                <strong>修改密码</strong>
            </li>
        </ol>

    </div>
@endsection

@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">修改密码</div>
        <div class="panel-body">

            {!! Form::model(null,['route'=>['user.update'],'class'=>'validate form-horizontal','method'=>'PUT','id'=>'form']) !!}
            @include('dashboard.user.partials.form',['submitButtonText'=>'保存','is_create'=>false])
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('scripts')

<script type="text/javascript">

    $('.submit').on('click', function(){
        let form = $(this).parents().closest('form');

        let password = $('input[name=password]').val();
        let password_confirmation = $('input[name=password_confirmation]').val();
        let message = '';
        if (password==''){
            message = '密码不可为空';
            swal(message,{
                icon: "warning",
                button: "确定",
            });
            return false;
        }
        if (password_confirmation!=password){
            message = '两次密码不一致';
            swal(message,{
                icon: "warning",
                button: "确定",
            });
            return false;
        }

        let url = form.attr('action'),
                data = form.serialize();
        $.ajax({
            url:url,
            type:"POST",
            data:data,
            success:function(data){
                swal("保存成功!", {
                    icon: "success",
                });
                //location.reload;
            },
            dataType:"json"
        });
    });
</script>
@endpush

