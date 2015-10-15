angular.module('ncsolar').controller('EditCtrl', ["$scope", "Restangular", "editService", "select2State", function($scope, Restangular, editService, select2State) {
    editService.init($scope, {
        objectScopeName: 'contact',
        entityIdName: 'contact',
        updateR: Restangular.one('contacts'),
        tag: 'contact',
        postInitFn: function(contact) {
            $scope.stateOptions = select2State.config({}, {}, {
                getInitSelection: function(value, data, element, callback) {
                    callback(contact.stateObject ? contact.stateObject : null);
                },
                fnData: function(term, page, limit) {
                    return {
                        orderBy: 'name',
                        orderDir: 'ASC'
                    }
                }
            });
        },
        entityPostDataFn: function(entity) {
            var data = angular.copy(entity);
            data.state = entity.state && entity.state.id ? entity.state.id : null;
            return data;
        }
    });
}]);