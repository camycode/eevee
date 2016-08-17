<?php

add_action('load_plugin_styles',function (){

    load_style('/content/web/src/css/app.term.css');

});


?>

<div id="app-term" class="page container">

    <div class="ui secondary menu">
        <div class="page title item ">
            分类栏目
        </div>

        <div class="page otions right menu">
            <div class="item">
                <i class="ui icon ellipsis vertical"></i>
            </div>
        </div>
    </div>

    <div class="ui grid">
        <!-- 分类树 -->
        <div class="nine wide column">
            <div class="handles">
                <div class="ui button handle">
                    排序
                </div>
            </div>
            <!-- 排序列表 -->
            <div class="dd" id="terms-list">
                <ol class="dd-list">
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">图书</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">水果</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">游戏</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="13">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">春节大促销</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">图书</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">水果</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">游戏</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="13">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">春节大促销</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">图书</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">水果</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">游戏</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="13">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">春节大促销</div>
                    </li>          <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">图书</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">水果</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="14">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">游戏</div>
                    </li>
                    <li class="dd-item dd3-item" data-id="13">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">春节大促销</div>
                    </li>
                </ol>
            </div>
        </div>
        <!-- 表单 -->
        <div id="terms-form" class="six wide column">
            <form class="ui form">
                <div class="field required">
                    <label>名称</label>
                    <input type="text" name="first-name">
                </div>
                <div class="field required">
                    <label>标识符</label>
                    <input type="text" name="last-name">
                </div>
                <div class="field required">
                    <label>父节点</label>
                    <input type="text" name="last-name">
                </div>
                <div class="field">
                    <label>关键词</label>
                    <input type="text" name="last-name">

                </div>
                <div class="field">
                    <label>描述</label>
                    <textarea name="" id="" rows="2"></textarea>
                </div>
                <button class="ui button blue" type="submit">添加</button>
            </form>
        </div>
    </div>
    <br>
</div>
