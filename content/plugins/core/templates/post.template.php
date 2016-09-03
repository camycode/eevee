<?php

add_action('load_styles', function () {

    load_style('/content/web/src/css/app.post.css');

});

add_action('load_components', function () {

    load_component('post.editor');

});

add_action('load_scripts', function () {

    load_plugin_script('/core/web/components/post.js');

});


?>

<div id="app-post" class="page container">

    <div class="ui secondary menu">
        <div class="page item title">
            文章
        </div>

        <div class="page options right menu">
            <div class="item">
                <i class="ui icon plus" id="openPostEditorBtn"></i>
            </div>
            <div class="item">
                <i class="ui icon ellipsis vertical"></i>
            </div>
        </div>
    </div>

    <div id="container"></div>

    <div class="page handles">
        <div class="ui dropdown icon button more">
            更多操作
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item"><i class="edit icon"></i> Edit Post</div>
                <div class="item"><i class="delete icon"></i> Remove Post</div>
                <div class="item"><i class="hide icon"></i> Hide Post</div>
            </div>
        </div>

        <div class="right">
            <div class="item handle paginations">
                <span class="posts-count">第1-20篇，共92篇</span>
            </div>
            <div class="ui buttons paging">
                <button class="ui button last"><i class="icon chevron left"></i></button>
                <button class="ui button next"><i class="icon chevron right"></i></button>
            </div>
        </div>
    </div>
    <div id="posts" class="ui items">
        <div class="item">
            <div class="attaches">
                <a class="post-status">正常</a>
                <a><i class="icon comment"></i>28</a>
                <a><i class="icon ellipsis vertical"></i></a>
            </div>
            <div class="image ui tiny">
                <img src="/content/web/src/images/photos/6.jpeg">
                <div class="post-handles">

                </div>
            </div>
            <div class="content">
                <a class="header"> bob，一个关于爱与死的童话...</a>
                <div class="meta">
                    <a>古月</a><span>2016-01-06 15:09</span>
                    <div class="right">

                    </div>
                </div>
                <div class="description">
                    <p>在14岁时和自己的导师身兼经纪人B. Rich相遇后，B.o.B在2002年为Slip-n-Slide公司的录音艺术家CITTI发行了“I'm the Cookie
                        Man”一曲。B.o.B在此时发现自己真的很爱音乐...</p>
                </div>
                <div class="extra">
                    <i class="icon block layout"></i><a href="javascript:;">商品/图书</a><a href="javascript:;">冬季/热销</a>

            <span class="post-tags">

              <i class="icon tag"></i> <a>新闻</a>,<a>商品</a>
            </span>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="image ui tiny">
                <img src="/content/web/src/images/photos/2.jpeg">
            </div>
            <div class="content">
                <a class="header">2014年全国农运会传统武术大赛于11月2至7日在重庆举行</a>
                <div class="meta">
                    <div class="floated right">
                        <a>古月</a>
                        <span>2016-01-06 15:09</span>
                    </div>
                </div>
                <div class="description">
                    <p>在14岁时和自己的导师身兼经纪人B. Rich相遇后，B.o.B在2002年为Slip-n-Slide公司的录音艺术家CITTI发行了“I'm the Cookie
                        Man”一曲。B.o.B在此时发现自己真的很爱音乐...</p>

                </div>
                <div class="extra">
          <span class="post-tags">
            <i class="icon tag"></i> <a>新闻</a>,<a>商品</a>
          </span>
                </div>
            </div>
        </div>
    </div>

    <div class="page handles">
        <div class="ui dropdown icon button more">
            更多操作
            <i class="dropdown icon"></i>
            <div class="menu">
                <div class="item"><i class="edit icon"></i> Edit Post</div>
                <div class="item"><i class="delete icon"></i> Remove Post</div>
                <div class="item"><i class="hide icon"></i> Hide Post</div>
            </div>
        </div>

        <div class="right">
            <div class="item paginations">
                <span class="posts-count">第1-20篇，共92篇</span>
            </div>
            <div class="ui buttons handle paging">
                <button class="ui button last"><i class="icon chevron left"></i></button>
                <button class="ui button next"><i class="icon chevron right"></i></button>
            </div>
        </div>
    </div>
    <br>
</div>


