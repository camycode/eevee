<?php

add_action('load_styles', function () {

    load_style('/content/web/src/css/app.user.css');

});

add_action('load_scripts', function () {

    load_script('/content/plugins/core/web/pages/user/user.controller.js');
    load_script('/content/plugins/core/web/services/ajax.js');
    load_script('/content/plugins/core/web/models/user.js');

});


?>

<div id="app-user" class="page container" ng-app="user" ng-controller="userController">

    <div class="ui secondary menu">
        <div class="page item title">
            用户
        </div>

        <div class="page options right menu">

            <div class="item">
                <i class="ui icon plus" ng-click="openUserEditor()"></i>
            </div>
            <div class="item">
                <i class="ui icon search"></i>
            </div>
            <div class="item">
                <i class="ui icon ellipsis vertical"></i>
            </div>
        </div>
    </div>
    <div class="page handles">
        <div class="ui dropdown icon button handle more">
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
                <span>第{{ offsetStart }}-{{ offsetEnd }}位用户，共{{ userTotal }}位</span>
            </div>
            <div class="ui buttons handle paging">
                <button class="ui button last" ng-click="lastPage()"><i class="icon chevron left"></i></button>
                <button class="ui button next" ng-click="nextPage()"><i class="icon chevron right"></i></button>
            </div>
        </div>
    </div>
    <table class="ui celled striped table selectable" cellspacing="1" cellpadding="0">
        <thead>
        <tr>
            <th class="col-check">
                <input type="checkbox" value="">
            </th>
            <th class="col-avatar">头像</th>
            <th class="col-username" ng-click="sortBy('username')">用户名 <i class="icon {{ sort.username || 'sort' }}">
            </th>
            <th class="col-email" ng-click="sortBy('email')">邮箱 <i class="icon {{ sort.email || 'sort' }}"></th>
            <th class="col-role" ng-click="sortBy('role')">角色 <i class="icon {{ sort.role || 'sort' }}"</th>
            <th class="col-status" ng-click="sortBy('status')">状态 <i class="icon {{ sort.status || 'sort' }}"</th>
            <th class="col-date" ng-click="sortBy('updated_at')">日期 <i class="icon {{ sort.updated_at || 'sort' }}"</th>
        </tr>
        </thead>

        <tfoot ng-show="users.length > 10">
        <tr>
            <th>
                <input type="checkbox" value="">
            </th>
            <th>头像</th>
            <th>用户名</th>
            <th>邮箱</th>
            <th>角色</th>
            <th>状态</th>
            <th>日期</th>
        </tr>
        </tfoot>
        
        <tbody>
        <tr ng-repeat="user in users" ng-click="openUserDetailView(user.id)">
            <td class="col-check">
                <input type="checkbox">
            </td>
            <td class="col-avatar">
                <img ng-src="{{ user.avatar }}" class="avatar" alt="">
            </td>
            <td class="col-username" ng-bind="user.username"></td>
            <td class="col-email" ng-bind="user.email"></td>
            <td class="col-role">{{ user.role }}</td>
            <td class="col-status">{{ user.status }}</td>
            <td class="col-date">{{ user.created_at }}</td>
        </tr>
        </tbody>

    </table>

    <if ng-if="users.length > 10">
        <div class="page handles">
            <div class="ui dropdown icon button handle more">
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
                    <span id="">第{{ offsetStart }}-{{ offsetEnd }}位用户，共{{ userTotal }}位</span>
                </div>
                <div class="ui buttons handle paging">
                    <button class="ui button last" ng-click="lastPage()"><i class="icon chevron left"></i></button>
                    <button class="ui button next" ng-click="nextPage()"><i class="icon chevron right"></i></button>
                </div>
            </div>
        </div>
    </if>
    <br>
</div>
