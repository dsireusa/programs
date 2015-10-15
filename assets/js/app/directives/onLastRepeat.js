angular.module('ncsolar').directive('onLastRepeat', function() {
    return {
        link: function($scope, $element, $attrs) {
            if ($scope.$last) {
                $scope.$emit('onLastRepeat'+$attrs.onLastRepeat);
            }
        }
    };
});