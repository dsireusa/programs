angular.module('ncsolar').directive('fzyUploader', ["$scope", "Restangular", "FileUploader", function($scope, Restangular, FileUploader) {
    return {
        link: function($scope, $element, $attrs) {
            $scope.init = function(modelName) {
                /**
                 * Begin file uploader things
                 */
                $scope.uploader = new FileUploader({
                    autoUpload: true,
                    removeAfterUpload: true,
                    queueLimit: 1,
                    url: $scope.getUploadUrl()
                });
                var model = $scope.$eval(modelName);
                //console.log('authority init', modelName);
                //var modelParts = modelName.split('.');
                //var model = $scope;
                //for (var i in modelParts) {
                //    model = model[modelParts[i]];
                //}
                console.log('model', model);
                $scope.uploader.onBeforeUploadItem = function(item) {
                    $scope.uploading = true;
                }

                $scope.uploader.onCompleteItem = function(item, response, status, headers) {
                    console.log('on complete item', arguments);

                }

                $scope.uploader.onCompleteAll = function() {
                    $scope.uploading = false;
                }

            }
        }
    };
}]);