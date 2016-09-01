<?php

add_action('load_scripts', function () {

    load_script('http://api.map.baidu.com/api?v=2.0&ak=Yxko6ks81kOnDcy2ZD7WG9nvm8jrOO3V');
    load_script('/content/plugins/baidu_map_points/assets/js/map.js');
});

$orders = connection('bmp_mysql')->table('orders')->orderBy('added_on', 'desc')->limit(1500)->get();

?>


<style>

    #input-wrap {
        position: absolute;
        z-index: 100;
        top: 30px;
        right: 45px;
        width: 300px;
        background: #fff;
        border-radius: 5px;
        padding: 20px 30px 0px 30px;
        display: none;
        box-shadow: 1px 1px 20px 1px #909090;
    }

    #input-wrap input {
        color: #333;
    }

    #input-wrap .button {

        width: 100%;
    }

    #input-wrap .close {
        position: absolute;
        right: 7px;
        top: 7px;
        color: #b3b3b3;
    }

    #input-wrap .close:hover {
        color: #616161;
    }

    #focus-form {
        position: absolute;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        background: #f7f7f7;
        border-radius: 40px;
        z-index: 100;
        right: 45px;
        top: 30px;
        color: #00b5ad;
        box-shadow: 1px 1px 7px -1px #333;
    }

    #focus-form i {
        display: block;
        width: 15px;
        margin: 0 auto;
    }

    #focus-form:hover {
        background: #00b5ad;
        color: #fff;
    }


</style>

<div id="focus-form"><i class="icon pencil"></i></div>

<div id="input-wrap" class="ui form">
    <i id="form-close" class="icon close"></i>
    <br>
    <div class="field">
        <input id="address-input" type="text" placeholder="送餐地址 *">
    </div>
    <div class="field one">
        <input id="freight-input" type="text" placeholder="达达运费（元） *">
    </div>
    <div class="field one">
        <input id="date-input" type="text" placeholder="日期 *">
    </div>
    <div class="field one">
        <input id="total-price-input" type="text" placeholder="订单总价（元）">
    </div>
    <div class="field one">
        <input id="discount-input" type="text" placeholder="折扣（元）">
    </div>

    <div class="field">
        <button id="submit" class="ui teal right icon button">
            添加
        </button>
    </div>
    <br>
</div>

<div id="bmp-container" style="height: 100%;"></div>

<script id="orders-json" type="application/json"><?php echo json_encode($orders); ?></script>

