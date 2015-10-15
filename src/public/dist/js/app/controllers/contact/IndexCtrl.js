angular.module('ncsolar').controller('IndexCtrl', ["$scope", "Restangular", "listService", function($scope, Restangular, listService) {
    $scope.init = function(editUrl) {
        listService.attachTo($scope, Restangular.all('contacts'), {
            columns: [
                {
                    property: 'lastName',
                    label: 'Name',
                    render: function(data, type, full) {
                        return (full.firstName ? full.firstName : '') + ' ' + (full.lastName ? full.lastName : '');
                    }
                },{
                    property: 'lastName',
                    label: 'State',
                    render: function(data, type, full) {
                        return full.stateObject.name ? full.stateObject.name : '--';
                    },
                    notsortable: true
                }, {
                    property: 'organizationName',
                    label: 'Organization Name'
                }, {
                    property: 'webVisibleDefault',
                    label: 'Website Visible',
                    notsortable: true,
                    render: function(data, type, full) {
                        return data ? 'Visible' : 'Not Visible';
                    }
                },
            ],
            fnClick: function (tr, data) {
                window.location.href = editUrl + '/' + data.id
            }
        })
    }

}]);
