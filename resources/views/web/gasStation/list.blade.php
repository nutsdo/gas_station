<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/10
 * Time: 下午10:33
 */
?>
<div class="list-group" id="stations">
    <div class="scrollload-container">
        <div class="scrollload-content">
            @include('web.gasStation.item')
        </div>

    </div>
    <div id="last" class="clearfix"></div>
</div>
@push('scripts')
{!! Html::script('http://api.map.baidu.com/api?v=2.0&ak=GjQkCLPRWvstG55SFWtyeFdj9xTmfKvF') !!}
{!! Html::script('assets/js/Scrollload.js') !!}
{!! Html::script('js/custom.js') !!}

<script type="text/javascript">

    let latCurrent;
    let lngCurrent;
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){

            var latCurrent = r.point.lat;
            var lngCurrent = r.point.lng;
            console.log('我的位置：'+ latCurrent + ',' + lngCurrent);

            $("body").on('click', '.go', function(e){
                var $this = $(e.target);

                console.log(latCurrent)
                console.log(lngCurrent)
                var destination = $this.data('destination');
                var city = $this.data('city');
                //alert($this.attr('width'));
                location.href="http://api.map.baidu.com/direction?origin="+latCurrent+","+lngCurrent+"&destination="+destination+"&mode=driving&region="+city+"&output=html";
            });

            let page=1;
            let last_page=1;
            let url='{{ route('index',['type'=>$type]) }}';
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
                        data : {lng:lngCurrent,lat:latCurrent},
                        dataType: 'json',
                        success: function(data){
                            // contentDom其实就是你的scrollload-content类的dom
                            $(sl.contentDom).append(data.data)

                            page++;
                            last_page=data.stations.last_page;
                            url = data.stations.next_page_url;

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
                        url: '{{ route('index',['type'=>$type]) }}',
                        data : {lng:lngCurrent,lat:latCurrent},
                        dataType: 'json',
                        success: function(data){
                            $(sl.contentDom).prepend(data)

                            // 处理完业务逻辑后必须要调用refreshComplete
                            sl.refreshComplete()
                        }
                    })
                }
            })

        } else {
            alert('failed'+this.getStatus());
        }
    },{enableHighAccuracy: true});


</script>
@endpush