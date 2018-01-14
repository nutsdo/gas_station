<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午7:58
 */
?>
@extends('layouts.dashboard')

@section('page-nav')
    <div class="title-env">
        <h1 class="title">油站管理</h1>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{ route('dashboard.home') }}"><i class="fa-home"></i>首页</a>
            </li>
            <li class="active">
                <strong>加油站管理</strong>
            </li>
        </ol>

    </div>
@endsection

@section('main-content')
        <!-- Basic Setup -->
<div class="panel panel-default">
    <a href="{{ route('gasStations.create') }}" class="btn btn-success btn-sm btn-icon">
        <i class="fa-plus-square"></i>
        <span>新增</span>
    </a>
    <div class="panel-body">

        <table id="gas-stations" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>加油站</th>
                <th>地址</th>
                <th>坐标</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>ID</th>
                <th>加油站</th>
                <th>地址</th>
                <th>坐标</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </tfoot>

            <tbody>
            @foreach($gasStations as $gasStation)
                <tr>
                    <td>{{ $gasStation->id }}</td>
                    <td>{{ $gasStation->name }}</td>
                    <td>{{ $gasStation->address }}</td>
                    <td>({{ $gasStation->lng }},{{ $gasStation->lat }})</td>
                    <td>{{ $gasStation->created_at }}</td>
                    <td>
                        <a href="{{ route('gasStations.edit', ['gasStation'=> $gasStation->id]) }}" class="btn btn-secondary btn-sm btn-icon icon-left">
                            编辑
                        </a>
                        <a href="{{ route('gasStations.series.index', ['gasStation'=> $gasStation->id]) }}" class="btn btn-blue btn-sm btn-icon icon-left">
                            油号管理
                        </a>
                        <a href="{{ route('gasStations.comments.index', ['gasStation'=> $gasStation->id]) }}" class="btn btn-blue btn-sm btn-icon icon-left">
                            评论
                        </a>
                        <a href="javascript:;" data-url="{{ route('gasStations.destroy', ['gasStation'=> $gasStation->id]) }}" class="btn btn-danger btn-sm btn-icon icon-left delete">
                            删除
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $gasStations->links() }}
    </div>

</div>

@endsection
@push('styles')
{!! Html::style('assets/js/datatables/dataTables.bootstrap.css') !!}
@endpush
@push('scripts')
<script>
    $('.delete').on('click',function(){
        var $this = $(this);
        var url = $this.data('url');
        swal({
            title: "您确定要删除这条记录吗?",
            text: "一旦删除将不可恢复!",
            icon: "warning",
            buttons: {
                cancel : "取消",
                confirm: "确定"
            },
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url:url,
                    type:"POST",
                    data:{"_method":"DELETE"},
                    success:function(data){
                        if (data.deleted){
                            swal("删除成功!", {
                                icon: "success",
                            });
                            $this.parents().closest('tr').remove();
                        }else {
                            swal("删除失败!", {
                                icon: "error",
                            });
                        }
                    },
                    dataType:"json"
                });

            } else {
                swal("已取消!");
            }
        });
    });
</script>
@endpush