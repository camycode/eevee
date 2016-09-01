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
var shopPoint = new BMap.Point(121.393514, 31.321578);

map.centerAndZoom(shopPoint, 15);


/**
 * 添加工具栏
 *
 * 缩放控件type有四种类型:
 * BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；
 * BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；
 * BMAP_NAVIGATION_CONTROL_ZOOM：仅包含缩放按钮
 */

// 左上角，添加比例尺
var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});

//左上角，添加默认缩放平移控件
var top_left_navigation = new BMap.NavigationControl();

//添加控件和比例尺
map.addControl(top_left_control);
map.addControl(top_left_navigation);

/**
 * 标注坐标点函数
 *
 * @param x 经度
 * @param y 纬度
 * @param freight 运费
 * @param address  送货地址
 * @param callback 回调函数
 */
function addMarker(x, y, freight, address, distance, callback) {

    freight = freight || null;

    // 定义坐标点
    var point = new BMap.Point(x, y);

    // 计算距离
    distance = distance || map.getDistance(shopPoint, point).toFixed(2);

    // 定义标注点
    var marker = new BMap.Marker(point);

    // 添加标注点到地图中
    map.addOverlay(marker);

    if (freight) {

        // 定义标签
        var label = new BMap.Label(freight + "元，" + distance + '米', {offset: new BMap.Size(20, -10)});

        //配置标签到标注点
        marker.setLabel(label);

        var opts = {
            width: 20,     // 信息窗口宽度
            height: 40,     // 信息窗口高度
            title: '费用：' + freight + '元'  // 信息窗口标题
        };

        var infoWindow = new BMap.InfoWindow("地址：" + address, '<br>距离：' + distance + '<br>运费：' + freight + '元', opts);  // 创建信息窗口对象

        marker.addEventListener("click", function () {
            map.openInfoWindow(infoWindow, point); //开启信息窗口
        });

        if (typeof callback == 'function') {

            callback(x, y, freight, address, distance);
        }
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
 * @param callback 回调函数
 */
function addAddressMarker(address, freight, callback) {

    myGeo.getPoint(address, function (point) {


        if (point) {

            addMarker(point.lng, point.lat, freight, address, null, callback);


        } else {

            alert("您选择地址没有解析到结果!");
        }
    }, "上海市");

}

// 添加初始标记点
var marker = addMarker(121.393514, 31.321578);

// 设置店铺起点标签
var label = new BMap.Label("店铺", {offset: new BMap.Size(20, -10)});

// 配置标签到标注点
marker.setLabel(label);

var $form = $('#input-wrap');
var $focusForm = $('#focus-form');
var $addressInput = $('#address-input');
var $searchResultPanel = $('#search-result-panel');
var $freightInput = $('#freight-input');
var $dateInput = $('#date-input');
var $totalPriceInput = $('#total-price-input');
var $discountInput = $('#discount-input');
var $submit = $('#submit');
var $formClose = $('#form-close');


// 配置地址输入自动表单填充
// var ac = new BMap.Autocomplete({
//     "input": "address-input",
//     "location": map
// });

// 表单提交实践
$submit.click(function () {

    var address = $addressInput.val();
    var freight = $freightInput.val();
    var date = $dateInput.val();
    var price = $.trim($totalPriceInput.val());
    var discount = $.trim($discountInput.val());

    if ($.trim(address) == '') {

        layer.msg('送餐地址不能为空');

        return false;

    }

    if ($.trim(freight) == '') {

        layer.msg('运费不能为空');

        return false;

    }

    if ($.trim(date) == '') {

        layer.msg('日期不能为空');

        return false;

    }

    addAddressMarker(address, freight, function (x, y, freight, address, distance) {

        var win = layer.load(2);

        $.ajax({
            url: "/api/baidu_map_points/order",
            method: 'post',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                'address': address,
                'freight': freight,
                'added_on': date,
                'price': price,
                'discount': discount,
                'lng': x,
                'lat': y,
                'distance': distance

            }),
            headers: {
                "X-App-ID": "backend",
                "X-App-Version": "1.0.0"
            },
            success: function (res) {

                layer.close(win);

                if (res.code == 200) {

                    $addressInput.val('');
                    $freightInput.val('');
                    $totalPriceInput.val('');
                    $discountInput.val('');

                    layer.msg('添加成功');

                } else {

                    alert(res.message);
                }
            },
            error: function () {

                layer.close(win);

                layer.alert('网络错误');
            }
        });

    });

});


// 关闭表单事件
$formClose.click(function () {

    $form.fadeOut(300);
    $focusForm.fadeIn(300);


});


// 打开表单事件

$focusForm.click(function () {

    $focusForm.fadeOut(300);
    $form.fadeIn(300);

});

var orders = JSON.parse($('#orders-json').html());

for (var i = 0; i < orders.length; i++) {

    addMarker(orders[i].lng, orders[i].lat, orders[i].freight, orders[i].address, orders[i].distance);
}










