<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 2018/1/10
 * Time: 下午10:31
 */
?>
<div id="map" class="baidu-map"></div>
<div id="location"></div>

@push('scripts')
{!! Html::script('http://api.map.baidu.com/api?v=2.0&ak=GjQkCLPRWvstG55SFWtyeFdj9xTmfKvF') !!}

<script type="text/javascript">

    var map = new BMap.Map("map");

    var myCity = new BMap.LocalCity();  //当前城市
    myCity.get(function(r){
        $('title').text(r.name);
        map.setCenter(r.name);
    })

    map.enableScrollWheelZoom();

        let myIcon = new BMap.Icon("{{ url('/assets/images/station/my-location.png') }}",new BMap.Size(20,20),{
            //anchor: new BMap.Size(15,30),
            imageSize: new BMap.Size(20,20)
        });
        let gsIcon = new BMap.Icon("{{ url('/assets/images/station/gs-station.png') }}",new BMap.Size(40,40),{
            anchor: new BMap.Size(19,25),
            imageSize: new BMap.Size(40,40)
        });

    //    var opts = {
    //        width : 250,     // 信息窗口宽度
    //        height: 80,     // 信息窗口高度
    //        title : "信息窗口" , // 信息窗口标题
    //        enableMessage:true//设置允许信息窗发送短息
    //    };
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            var mk = new BMap.Marker(r.point,{icon:myIcon});
            map.addOverlay(mk);
            map.panTo(r.point);//地图中心点移到当前位置
            map.centerAndZoom(r.point,13);
            var latCurrent = r.point.lat;
            var lngCurrent = r.point.lng;
//            console.log('我的位置：'+ latCurrent + ',' + lngCurrent);

            //添加标注
            $.ajax({
                url : '{{ route('index') }}',
                type : 'GET',
                data : {lng:lngCurrent,lat:latCurrent},
                success: function(data){

                    $.each(data.data,function(k,v){

                        var marker = new BMap.Marker(new BMap.Point(v.lng, v.lat), {icon:gsIcon});  // 创建标注
                        var click = 'goThere(this)';
                        var sContent =
                                "<h5 style='margin:0 0 5px 0;padding:0.2em 0' onclick='goInfo(this)' data-id="+ v.id +">"+ v.name +"</h5>" +
                                "<div style='float:right;margin:4px' data-lng='"+ lngCurrent + "' data-lat='"+ latCurrent + "' data-city='"+ v.city + "' data-destination='"+ v.lat+","+ v.lng + "' onclick='"+ click +"'><img class='go-station' src='/assets/images/station/goto.png' width='20' title='"+ v.name +"'/>" +
                                "<span style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>去这里</span></div>" +
                                "<p style='margin:0;line-height:1.5;font-size:13px;width: 80%'>"+ v.province + v.city + v.district + v.address +"</p>" +
                                "</div>";
                        map.addOverlay(marker);               // 将标注添加到地图中
                        addClickHandler(sContent,marker);
                    })
                },
                dataType:'json'
            });

        }
        else {
            alert('failed'+this.getStatus());
        }
    },{enableHighAccuracy: true});

    function addClickHandler(content,marker){
        marker.addEventListener("click",function(e){
            openInfo(content,e)
        });
    }
    function openInfo(content,e){
        var p = e.target;
        var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
        var infoWindow = new BMap.InfoWindow(content);  // 创建信息窗口对象
        map.openInfoWindow(infoWindow,point); //开启信息窗口

    }
    function goThere(ele)
    {
        var $this = $(ele);
        var latCurrent = $this.data('lat');
        var lngCurrent = $this.data('lng');
        var destination = $this.data('destination');
        var city = $this.data('city');
        //alert($this.attr('width'));
        location.href="http://api.map.baidu.com/direction?origin="+latCurrent+","+lngCurrent+"&destination="+destination+"&mode=driving&region="+city+"&output=html";
    }
    function goInfo(ele)
    {
        var $this = $(ele);
        var id = $this.data('id');
        //alert($this.attr('width'));
        location.href="/gasStation/"+ id +"/show";
    }

</script>
@endpush


