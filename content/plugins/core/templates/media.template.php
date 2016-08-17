<?php

add_action('load_plugin_styles',function (){

    load_style('/content/web/src/css/directives/media.css');

});


?>

<div id="directive-media" class="">
    <div id="directive-media-header">
        <div class="ui   menu">
            <div class="item">
                多媒体
            </div>

            <div class="right menu">
                <div class="item">
                    <i class="ui icon plus" ng-click="openUserEditor()"></i>
                </div>
                <div class="item">
                    <i class="ui icon ellipsis vertical"></i>
                </div>
            </div>
        </div>


        <!-- <div class="handles">
          <div class="ui dropdown icon button handle">
            更多操作
            <i class="dropdown icon"></i>
            <div class="menu">
              <div class="item"><i class="edit icon"></i> 删除所选项</div>
              <div class="item"><i class="delete icon"></i> 移动文件夹</div>
            </div>
          </div>

          <div class="right">
            <button class="ui button handle"><i class="icon unordered list"></i></button>
            <button class="ui button handle"><i class="icon sort content ascending"></i></button>
          </div>
        </div> -->
    </div>
    <div id="directive-media-list">
        <!-- 文件夹 -->
        <div id="directive-media-folders" class="ui cards">
            <div class="card">
                <div class="icon">
                    <i class="icon folder"></i>
                </div>
                <div class="name">
                    古月
                </div>
            </div>
            <div class="card">
                <div class="icon">
                    <i class="icon folder"></i>
                </div>
                <div class="name">
                    新文件夹
                </div>
            </div>
        </div>
        <!-- 文件 -->
        <div class="ui cards">
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/1.jpeg">
                </div>
                <div class="extra">
                    黑木屋
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/2.jpeg">
                </div>
                <div class="extra">
                    豆荚
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/3.jpeg">
                </div>
                <div class="extra">
                    海
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/4.jpeg">
                </div>
                <div class="extra">
                    自行车
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/5.jpeg">
                </div>
                <div class="extra">
                    红椅
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/6.jpeg">
                </div>
                <div class="extra">
                    坠落
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/7.jpeg">
                </div>
                <div class="extra">
                    都市
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/bob.jpeg">
                </div>
                <div class="extra">
                    bob
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/jobs.jpeg">
                </div>
                <div class="extra">
                    乔布斯
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/allen.jpeg">
                </div>
                <div class="extra">
                    艾佛森
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/avatar.jpeg">
                </div>
                <div class="extra">
                    阿凡达
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/lenon.jpeg">
                </div>
                <div class="extra">
                    列侬
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/1.jpeg">
                </div>
                <div class="extra">
                    黑木屋
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/2.jpeg">
                </div>
                <div class="extra">
                    豆荚
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/3.jpeg">
                </div>
                <div class="extra">
                    海
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/4.jpeg">
                </div>
                <div class="extra">
                    自行车
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/5.jpeg">
                </div>
                <div class="extra">
                    红椅
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/6.jpeg">
                </div>
                <div class="extra">
                    坠落
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/7.jpeg">
                </div>
                <div class="extra">
                    都市
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/bob.jpeg">
                </div>
                <div class="extra">
                    bob
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/jobs.jpeg">
                </div>
                <div class="extra">
                    乔布斯
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/allen.jpeg">
                </div>
                <div class="extra">
                    艾佛森
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/avatar.jpeg">
                </div>
                <div class="extra">
                    阿凡达
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/lenon.jpeg">
                </div>
                <div class="extra">
                    列侬
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/1.jpeg">
                </div>
                <div class="extra">
                    黑木屋
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/2.jpeg">
                </div>
                <div class="extra">
                    豆荚
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/3.jpeg">
                </div>
                <div class="extra">
                    海
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/4.jpeg">
                </div>
                <div class="extra">
                    自行车
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/5.jpeg">
                </div>
                <div class="extra">
                    红椅
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/6.jpeg">
                </div>
                <div class="extra">
                    坠落
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/7.jpeg">
                </div>
                <div class="extra">
                    都市
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/bob.jpeg">
                </div>
                <div class="extra">
                    bob
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/jobs.jpeg">
                </div>
                <div class="extra">
                    乔布斯
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/allen.jpeg">
                </div>
                <div class="extra">
                    艾佛森
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/avatar.jpeg">
                </div>
                <div class="extra">
                    阿凡达
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/lenon.jpeg">
                </div>
                <div class="extra">
                    列侬
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/1.jpeg">
                </div>
                <div class="extra">
                    黑木屋
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/2.jpeg">
                </div>
                <div class="extra">
                    豆荚
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/3.jpeg">
                </div>
                <div class="extra">
                    海
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/4.jpeg">
                </div>
                <div class="extra">
                    自行车
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/5.jpeg">
                </div>
                <div class="extra">
                    红椅
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/6.jpeg">
                </div>
                <div class="extra">
                    坠落
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/7.jpeg">
                </div>
                <div class="extra">
                    都市
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/bob.jpeg">
                </div>
                <div class="extra">
                    bob
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/jobs.jpeg">
                </div>
                <div class="extra">
                    乔布斯
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/allen.jpeg">
                </div>
                <div class="extra">
                    艾佛森
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/avatar.jpeg">
                </div>
                <div class="extra">
                    阿凡达
                </div>
            </div>
            <div class="card">
                <div class="image">
                    <img src="/content/web/src/images/photos/lenon.jpeg">
                </div>
                <div class="extra">
                    列侬
                </div>
            </div>
        </div>
    </div>

</div>
