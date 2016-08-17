<?php

add_action('load_styles',function (){

    load_style('/content/web/src/css/app.plugin.css');

});


?>

<div id="pages-app.plugin" class="page container">

    <div class="ui secondary menu">
        <div class="page item title">
            插件
        </div>

        <div class="page options right menu">
            <div class="item">
                <i class="ui icon plus"></i>
            </div>
            <div class="item">
                <i class="ui icon ellipsis vertical"></i>
            </div>
        </div>
    </div>

    <div id="plugins" class="ui items">

    </div>


</div>

</div>

