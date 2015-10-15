angular.module('ncsolar').controller('UploadCtrl', function($scope, Restangular, FileUploader, alert) {
    $scope.init = function(modelName, url) {
        /**
         * Begin file uploader things
         */
        var url = url ? $scope.$eval(url) : '';
        $scope.uploader = new FileUploader({
            autoUpload: true,
            removeAfterUpload: true,
            queueLimit: 1,
            url: url
        });
        $scope.uploader.onBeforeUploadItem = function(item) {
            $scope.uploading = true;
        }

        $scope.uploader.onCompleteItem = function(item, response, status, headers) {
            $scope.$apply(function() {
                if (!response || !response.models || !response.models.upload) {
                    alert.add('Unable to process upload at this time.');
                    console.log('failed');
                    return;
                }
                $.extend($scope.$eval(modelName), response.models.upload);
            })
        }

        $scope.uploader.onCompleteAll = function() {
            $scope.uploading = false;
        }

    }


});