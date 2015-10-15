angular.module('ncsolar').controller('AlertCtrl',function ($scope,alert) {

    $scope.init = function(messages) {
        alert.add(messages);
    }

    $scope._alert = alert;
});
