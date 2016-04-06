define(['app', 'nestable'], function(app) {

  return ['$scope', '$state', function($scope, $state) {

    $scope.title = "分类目录";

    // 配置拖动排序
    $('#terms-list').nestable({});

    $scope.editTerm = function() {
      return false;
    }

  }];

});
