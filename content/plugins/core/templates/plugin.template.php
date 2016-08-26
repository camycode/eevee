<?php

add_action('load_styles', function () {

    load_style('/content/web/src/css/app.plugin.css');

});

$plugins = [];

$dirs = list_dirs(base_path('content/plugins'));

foreach ($dirs as $dir) {

    if (basename($dir) != 'core') {

        $config_file = $dir . DIRECTORY_SEPARATOR . 'plugin.json';

        if (!file_exists($config_file)) {

            continue;
        }

        try {

            $plugin = json_decode(file_get_contents($config_file), true);

            array_push($plugins, $plugin);

        } catch (\Exception $e) {

            throw $e;
            
        }

    }

}


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


        <?php foreach ($plugins as $plugin): ?>

            <h3><?php echo $plugin['name']; ?> <small><?php echo $plugin['version']; ?></small></h3>
            <p><?php echo $plugin['description']; ?></p>

        <?php endforeach; ?>

    </div>


</div>

</div>

