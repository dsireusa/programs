angular.module('ncsolar').controller('IndexCtrl', function($scope, Restangular, listService) {
    $scope.init = function(editUrl) {
        listService.attachTo($scope, Restangular.one('users'), {
            columns: [
                {
                    property: 'username',
                    label: 'Username'
                }, {
                    property: 'lastName',
                    label: 'Name',
                    render: function(data, type, full) {
                        return full.lastName + ', ' + full.firstName;
                    }
                }, {
                    property: 'role',
                    label: 'Role',
                    notsortable: true
                }
            ],
            fnClick: function (tr, data) {
                window.location.href = editUrl + '/' + data.id
            }
        })
    };
});
