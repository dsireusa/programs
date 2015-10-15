angular.module('ncsolar').controller('NewsCtrl', function($scope, Restangular, alert) {

    //init method to pass params through to controller via ng-init
    $scope.init = function(params) {
        $scope.programUpdates = params['programUpdates'];
        $scope.subscribeToAllProgramsUrl = params['subscribeToAllProgramsUrl'];
    }

});
