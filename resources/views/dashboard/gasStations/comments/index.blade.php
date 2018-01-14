<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/4
 * Time: 下午7:58
 */
?>
@extends('layouts.dashboard')

@section('main-content')
        <!-- Basic Setup -->
<div class="panel panel-default">

    <div class="panel-body">
        <div class="panel-heading">
            {{ $station->name }} 的评论
        </div>
        <table id="gas-stations" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>编号</th>
                <th>评分</th>
                <th>内容</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>编号</th>
                <th>评分</th>
                <th>内容</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </tfoot>

            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->stars }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <a href="javascript:;" data-url="{{ route('gasStations.comments.destroy', ['gasStation'=> $station->id, 'comment'=> $comment->id]) }}" class="btn btn-danger btn-sm btn-icon icon-left delete">
                            删除
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $comments->links() }}
    </div>

</div>

@endsection
@push('styles')
{!! Html::style('assets/js/datatables/dataTables.bootstrap.css') !!}
@endpush
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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