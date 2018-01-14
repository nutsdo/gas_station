<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/13
 * Time: 上午12:59
 */
?>
@extends('layouts.web')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">评论</div>
        <div class="scrollload-container">
            <div class="scrollload-content">
                {{--@include('web.comments.list')--}}
            </div>
        </div>
    </div>

@endsection
@push('styles')
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
{{ Html::style('assets/css/fonts/fontawesome/css/font-awesome.min.css') }}
{{ Html::style('assets/css/xenon-components.css') }}
{{ Html::style('assets/js/star-rating/css/star-rating.css') }}
{{ Html::style('assets/js/star-rating/themes/krajee-svg/theme.css') }}
@endpush
@push('scripts')
{!! Html::script('assets/js/Scrollload.js') !!}
{{ Html::script('assets/js/star-rating/js/star-rating.min.js') }}
{{ Html::script('assets/js/star-rating/themes/krajee-svg/theme.js') }}
{{ Html::script('assets/js/star-rating/js/locales/zh.js') }}
<script>

    let page=1;
    let last_page=2;
    let url='{{ route('station.comments', $gasStationId) }}';
    new Scrollload({
        // container 和 content 两个配置的默认取的scrollload-container和scrollload-content类的dom。只要你按照以上的dom结构写，这两个配置是可以省略的
        container: document.querySelector('.scrollload-container'),
        content: document.querySelector('.scrollload-content'),
        loadMore: function(sl) {
            console.log('page:'+page +'--last_page:'+last_page);
            if (page > last_page) {
                // 没有数据的时候需要调用noMoreData
                sl.noMoreData()
                return
            }

            // 我这里用jquery的不是因为需要jquery，只是jquery的语法看起来比较简单。大家都认识。
            // 如果你不是用jquery，可以看看原生的insertAdjacentHTML方法来替代append
            $.ajax({
                type: 'GET',
                url: url,
                data : {},
                dataType: 'json',
                success: function(data){
                    // contentDom其实就是你的scrollload-content类的dom
                    $(sl.contentDom).append(data.data)

                    page++;
                    last_page=data.comments.last_page;
                    url = data.comments.next_page_url;

                    // 处理完业务逻辑后必须要调用unlock
                    sl.unLock()
                },
                error: function(xhr, type){
                    // 加载出错，需要执行该方法。这样底部DOM会出现出现异常的样式。
                    sl.throwException()
                }
            })
        },
        // 你也可以关闭下拉刷新
        enablePullRefresh: true,
        pullRefresh: function (sl) {
            $.ajax({
                type: 'GET',
                url: '{{ route('station.comments', $gasStationId) }}',
                data : {},
                dataType: 'json',
                success: function(data){
                    $(sl.contentDom).prepend(data)

                    // 处理完业务逻辑后必须要调用refreshComplete
                    sl.refreshComplete()
                }
            })
        }
    })


</script>
@endpush
