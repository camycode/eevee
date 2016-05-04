define([
        'role',
        'user',
        'typing',
        'css!../../css/app.user'
    ],
    function () {

        return ['$scope', 'typing', 'user', function ($scope, typing, user) {


            $scope.users = [];

            user.setUserEditor($scope);

            user.setUserDetail($scope);

            var sort = {
                username: null,
                email: null,
                role: null,
                status: null,
                updated_at: null
            };

            var sortField = 'updated_at';

            var sortRule = 'asc';

            var limit = 5;

            var offset = 0;

            var paging = 'next';

            $scope.offset_start = offset;

            $scope.offset_end = offset + limit;


            user.getUsers({
                    count: true
                })
                .success(function (response) {
                    $scope.user_total = response.data;
                })
                .error(function () {

                });


            var getUsers = function (params) {

                user.getUsers(params)
                    .success(function (response) {

                        if (response.code == 200) {

                            $scope.users = response.data;

                            if (paging == 'next') {

                                $scope.offset_start = offset;

                                offset += response.data.length;

                                $scope.offset_end = offset;

                            }else{

                                $scope.offset_end = offset;

                                offset -= response.data.length;

                                $scope.offset_start = offset;

                            }



                        } else {
                            typing.warning(response.message);
                        }

                    })
                    .error(function () {

                        typing.error('网络错误');

                    });

            };

            $scope.sort = $.extend({}, sort);

            getUsers({
                order: 'created_at:desc',
                limit: limit
            });

            $scope.sortBy = function (field) {

                if (sortField == field) {
                    sortRule = sortRule == 'asc' ? 'desc' : 'asc';
                }

                $scope.sort = $.extend({}, sort);

                sortField = field;

                $scope.sort[field] = sortRule == 'asc' ? 'sort ascending' : 'sort descending';

                getUsers({
                    order: field + ':' + sortRule,
                    limit: limit
                });

            };

            $scope.nextPage = function () {
                getUsers({
                    order: sortField + ':' + sortRule,
                    limit: limit,
                    offset: offset + limit
                });
            };

            $scope.lastPage = function () {
                getUsers({
                    order: sortField + ':' + sortRule,
                    limit: limit,
                    offset: offset - limit
                });
            };

            $scope.openUserEditor = function () {
                $scope.$emit('app.user.editor.show');
            };


            $scope.openUserDetailView = function (user_id) {
                $scope.$emit('app.user.detail.show', user_id);
            };

            $scope.$on('app.user.posted', function (e, data) {
                $scope.users.unshift(data);
            });


        }];

    });
