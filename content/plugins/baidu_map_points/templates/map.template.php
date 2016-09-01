<?php

add_action('load_scripts',function (){

    load_script('http://api.map.baidu.com/api?v=2.0&ak=Yxko6ks81kOnDcy2ZD7WG9nvm8jrOO3V');
    load_script('/content/plugins/baidu_map_points/assets/js/map.js');
});

?>

<!--<div class="ui action input">-->
<!--    <input type="text" placeholder="输入地址">-->
<!---->
<!--</div>-->
<br>
<div class="ui form">
    <div class="three fields">
        <div class="field">
            <input id="address-input" type="text" placeholder="地址">
        </div>
        <div class="field one">
            <input id="freight-input" type="text" placeholder="费用">
        </div>
        <div class="field">
            <button id="submit" class="ui teal right icon button">
                添加
            </button>
        </div>
    </div>
</div>
<br>
<div id="bmp-container" style="height: 100%;">

</div>

