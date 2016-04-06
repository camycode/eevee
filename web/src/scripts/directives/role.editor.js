define(['app','jquery'], function(app) {

  app.directive('role.editor', function($http, $compile) {

    return {
      restrict: 'A',
      replace: true,
      scope: {},
      templateUrl: 'views/editors/role.editor.html',
      controller: ['$scope', function($scope) {

        $scope.title = "编辑用户";

        $scope.closePostEditor = function() {

          $("#role-editor").addClass('animated slideOutRight');

        };

      }]
    };

  });

});
