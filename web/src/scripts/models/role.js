define([
    'app',
    'jquery',
    'ajax',
    'role.editor'
], function (app, $) {

    app.factory('role', ['$compile', 'ajax', function ($compile, ajax) {

        return {


            /**
             * 配置角色编辑器
             *
             * @param $scope
             */
            setRoleEditor: function ($scope) {
                $('#eevee-view').append($compile($('<div role.editor></div>'))($scope));
            },

            /**
             * 打开角色编辑器
             */
            openRoleEditor: function () {
                $("#directive-role-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
            },
            /**
             * 添加角色
             *
             * @param data object
             *
             * @return $http
             */
            postRole: function (data) {
                return ajax.post('/api/role', data);
            },
            /**
             * 编辑角色
             *
             * @param  role_id  string
             * @param  data     object
             *
             * @return $http
             */
            putRole: function (role_id, data) {
                return ajax.put('/api/role?role_id=' + role_id, data);
            },
            /**
             * 获取角色组
             *
             * @return $http
             */
            getRoles: function (params) {
                return ajax.get('/api/roles',params);
            },
            /**
             * 获取角色权限组
             *
             * @return $http
             */
            getRolePermissions: function (role_id) {
                return ajax.get('/api/role/permissions?role_id=' + role_id + '&archive=true');
            }

        };

    }]);

});
