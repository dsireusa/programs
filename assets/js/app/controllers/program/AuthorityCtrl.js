angular.module('ncsolar').controller('AuthorityCtrl', function($scope, FileUploader, Restangular) {
    $scope.removeAuthority = function(index) {
        $scope.program.authorities.splice(index, 1);
    }

    $scope.addAuthority = function(authority) {
        authority.open = true;
        authority.upload = {};
        $scope.program.authorities.push(authority);
    }

    $scope.getUploadUrl = function() {
        return Restangular.one('programs', $scope.program.id).one('authorities', 'upload').getRestangularUrl();
    }

    angular.forEach($scope.program.authorities, function(authority, index) {
        if (!authority.upload) {
            authority.upload = {};
        }
    });

})