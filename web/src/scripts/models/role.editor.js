define(['app', '../directives/role.editor', 'jquery'], function (app) {

    app.factory('RoleEditor', function ($compile) {
        return {
            init: function ($scope) {
                $('#eevee-view').append($compile($('<div role.editor></div>'))($scope));
            },
            open: function () {
                $("#directive-role-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();

            }
        }
    });
});
