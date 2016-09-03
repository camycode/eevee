<?php

add_action('load_styles',function (){

    load_style('/content/web/src/css/app.role.css');

});


?>
<div id="app-role" class="page container">

    <div class="ui secondary menu">
        <div class="page item title">
            角色
        </div>

        <div class="page options right menu">
            <div class="item">
                <i class="ui icon plus" ng-click="openRoleEditor()"></i>
            </div>
            <div class="item">
                <i class="ui icon ellipsis vertical"></i>
            </div>
        </div>
    </div>

    <div class="ui grid">
        <div class="sixteen wide column">
            <table class="ui striped table selectable">
                <thead>
                <tr>
                    <th class="col-name" ng-click="sortBy('name')">角色名 <i class="icon {{ sort.name || 'sort' }}"></i></th>
                    <th class="col-permission-amount" ng-click="sortBy('permission_amount')">权限数<i class="icon {{ sort.permission_amount || 'sort' }}"></i></th>
                    <th class="col-status" ng-click="sortBy('status')">状态 <i class="icon {{ sort.status || 'sort' }}"></i></th>
                    <th class="col-updated_at" ng-click="sortBy('updated_at')">更新时间 <i class="icon {{ sort.updated_at || 'sort' }}"></i></th>
                    <th class="col-description">描述</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="role in roles" role-id="{{ role.id }}" ng-click="openRoleDetailView(role.id )">
                    <td class="col-name">{{ role.name }}</td>
                    <td class="col-permission-amount">{{ role.permission_amount }}</td>
                    <td class="col-status">{{ role.status }}</td>
                    <td class="col-updated_at">{{ role.updated_at }}</td>
                    <td class="col-description">{{ role.description || '-' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>
