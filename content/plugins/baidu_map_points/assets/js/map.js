/**
 * 百度地图定位插件
 *
 * @type {Highcharts.Map}
 */

// var map = new BMap.Map("bmp-container");          // 创建地图实例
// var point = new BMap.Point(116.404, 39.915);  // 创建点坐标
//
// map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别
//
// map.addControl(new BMap.OverviewMapControl());
//
// var map = new BMap.Map("bmp-container");
// map.centerAndZoom(new BMap.Point(121.393514, 31.321578), 15);
// map.addControl(new BMap.NavigationControl());
// map.addControl(new BMap.ScaleControl());
// map.addControl(new BMap.OverviewMapControl());
// map.addControl(new BMap.MapTypeControl());
// map.setCurrentCity("上海"); // 仅当设置城市信息时，MapTypeControl的切换功能才能可用

// 百度地图API功能
// var map = new BMap.Map("bmp-container");
// var point = new BMap.Point(121.393514,39.897445);
// map.centerAndZoom(point,12);
// // 创建地址解析器实例
// var myGeo = new BMap.Geocoder();
// // 将地址解析结果显示在地图上,并调整地图视野
// myGeo.getPoint("上海市聚丰园路5弄12号", function(point){
//     console.log(point);
//     if (point) {
//         map.centerAndZoom(point, 16);
//         map.addOverlay(new BMap.Marker(point));
//
//         var marker = new BMap.Marker(point);  // 创建标注
//         map.addOverlay(marker);              // 将标注添加到地图中
//
//         var label = new BMap.Label("5元",{offset:new BMap.Size(20,-10)});
//         marker.setLabel(label);
//
//     }else{
//         alert("您选择地址没有解析到结果!");
//     }
// }, "上海市");

//
// lat
//     :
//     31.321578
// lng
//     :
//     121.393514

// 定义地图对象
var map = new BMap.Map("bmp-container");

// 设置初始定位
var point = new BMap.Point(121.393514, 31.321578);
map.centerAndZoom(point, 15);

/**
 * 标注坐标点函数
 *
 * @param x 经度
 * @param y 纬度
 * @param freight 运费
 */
function addMarker(x, y, freight) {

    freight = freight || null;

    // 定义坐标点
    var point = new BMap.Point(x, y);

    // 定义标注点
    var marker = new BMap.Marker(point);

    // 添加标注点到地图中
    map.addOverlay(marker);

    if (freight) {

        // 定义标签
        var label = new BMap.Label(freight + "元", {offset: new BMap.Size(20, -10)});

        //配置标签到标注点
        marker.setLabel(label);
    }

    return marker;
}

// 创建地址解析器实例
var myGeo = new BMap.Geocoder();

/**
 * 标注地址函数
 *
 * @param address 地址
 * @param freight 运费
 */
function addAddressMarker(address, freight) {

    myGeo.getPoint(address, function (point) {


        if (point) {

            var marker = addMarker(point.lng, point.lat, freight);

            var opts = {
                width: 20,     // 信息窗口宽度
                height: 40,     // 信息窗口高度
                title: '费用：' + freight + '元'  // 信息窗口标题
            };

            var infoWindow = new BMap.InfoWindow("地址：" + address, opts);  // 创建信息窗口对象

            marker.addEventListener("click", function () {
                map.openInfoWindow(infoWindow, point); //开启信息窗口
            });

        } else {

            alert("您选择地址没有解析到结果!");
        }
    }, "上海市");

}

// 添加初始标记点
var marker = addMarker(121.393514, 31.321578);

// 设置店铺起点标签
var label = new BMap.Label("店铺", {offset: new BMap.Size(20, -10)});

//配置标签到标注点
marker.setLabel(label);


var $addressInput = $('#address-input');
var $freightInput = $('#freight-input');
var $submit = $('#submit');

$submit.click(function () {

    var address = $addressInput.val();

    if ($.trim(address) != '') {

        addAddressMarker(address, $freightInput.val());

    } else {

        layer.open({
            type: 1,
            content: '地址不能为空'
        });

    }

});

// addAddressMarker('上海市聚丰园路5弄18号', 2);
// addAddressMarker('上海市聚丰园路12弄', 3);






