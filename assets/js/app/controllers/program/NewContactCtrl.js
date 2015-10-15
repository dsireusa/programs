angular.module('ncsolar').controller('NewContactCtrl', function($scope, $rootScope, Restangular, editService, select2State) {
    editService.init($scope, {
        objectScopeName: 'contact',
        entityIdName: 'contact',
        updateR: Restangular.one('contacts'),
        tag: 'contact',
        postInitFn: function(contact) {
            $scope.stateOptions = select2State.config({}, {}, {
                getInitSelection: function(value, data, element, callback) {
                    callback(contact.stateObject ? contact.stateObject : null);
                }
            });
            $('.flyout-menu').removeClass('hide-load');
        },
        entityPostDataFn: function(entity) {
            var data = angular.copy(entity);
            data.state = entity.state && entity.state.id ? entity.state.id : null;
            return data;
        },
        successCallback : function(data) {
            $scope.panel().close();
            if (!$scope.contact.id) {
                // only add contact id no id was present, otherwise it was an edit
                //$scope.addContact(data.models.contact);
                $rootScope.$broadcast('ProgramContactCtrl:appendContact', data.models.contact);
            }
            $scope.contact = {};
            $scope.saving = false;
        }
    });
    $scope.$on('NewContactCtrl:setContact', function(event, contact) {
        $scope.contact = contact;
        $rootScope.$broadcast('flyout:contact:open');
    })
});