angular.module('ncsolar').controller('NewCtrl', ["$scope", "Restangular", "editService", "select2State", "select2Type", "alert", function($scope, Restangular, editService, select2State, select2Type, alert) {
    $scope.stateOptions = select2State.config({},{}, {
        fnData: function () {
            return {orderBy: 'name', orderDir: 'ASC'};
        }
    });
    $scope.typeOptions = select2Type.config({}, {}, {
        fnData: function(term, page, limit) {
            return {
                categoryId: $scope.settings.category && $scope.settings.category.id ? $scope.settings.category.id : null,
                orderBy: 'name',
                orderDir: 'ASC'
            };
        }
    });
    $scope.settings = {
        entireState: true
    };
    $scope.getEntireState = function () {
        return $scope.settings.entireState;
    }
    $scope.toggleEntireState = function () {
        $scope.settings.entireState = !$scope.settings.entireState;
    }

    editService.init($scope, {
        objectScopeName: 'program',
        entityIdName: 'programId',
        updateR: Restangular.one('programs', 'create'),
        tag: 'program',
        postInitFn: function(program, sectors, categories) {
            $scope.sectors = sectors;
            $scope.categories = categories;
        }
    });

    $scope.clearSettingKeys = function(keys) {
        angular.forEach(keys, function(key, index) {
            delete $scope.settings[key];
            if (key == 'entireState') {
                $scope.settings[key] = true;
            }
        });
    }
}]);