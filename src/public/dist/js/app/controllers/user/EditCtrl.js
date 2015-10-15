angular.module('ncsolar').controller('EditCtrl', ["$scope", "Restangular", "editService", "alert", "formAlert", "select2Role", function($scope, Restangular, editService, alert, formAlert, select2Role) {

    editService.init($scope, {
        objectScopeName: 'user',
        entityIdName: 'user',
        updateR: Restangular.one('users'),
        tag: 'user',
        postInitFn: function(user) {
            $scope.roleOptions = select2Role.config({}, {}, {
                getInitSelection: function(value, data, element, callback) {
                    callback(user.roleObject ? user.roleObject : {roleId: 'user',displayName: 'User'});
                }
            });
        },
        entityPostDataFn: function(entity) {
            var data = angular.copy(entity);
            data.role = entity.role && entity.role.roleId ? entity.role.roleId : null;
            return data;
        }
    });

    $scope.resetPassword = function(user) {
        $scope.saving = true;
        Restangular.one('users', user.id).post('reset-password').then(function() {
            $scope.saving = false;
            alert.add('The user has been sent a password reset email.', {type: 'success'})
        }, function() {
            $scope.saving = false;
            alert.add('Unable to reset user password at this time.');
        })
    }

}]);
