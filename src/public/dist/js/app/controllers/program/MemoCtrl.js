angular.module('ncsolar').controller('MemoCtrl', ["$scope", "Restangular", "alert", function($scope, Restangular, alert) {

    var loadFn = function() {
        if ($scope.loading) {
            return;
        }
        $scope.loading = true;
        Restangular.one('programs', $scope.program.id).one('memos', $scope.memoType).get({
            offset: $scope.page,
            limit: $scope.limit
        }).then(function(result) {
            $scope.loading = false;
            Array.prototype.push.apply($scope.memos, result.data);
            $scope.meta = result.meta;
        }, function() {
            $scope.loading = false;
            alert.add('Unable to load memos at this time.');
        });

    }

    $scope.page = 0;
    $scope.limit = 10;

    $scope.meta = {};

    $scope.memos = [];

    $scope.init = function(memoType) {
        $scope.memoType = memoType;
    }
    $scope.displayMemos = false;
    $scope.toggleDisplayMemos = function() {
        $scope.displayMemos = !$scope.displayMemos;
    }

    $scope.loadMore = function() {
        $scope.page = $scope.memos.length;
        loadFn();
    }

    $scope.$watch('displayMemos', function(newVal, oldVal) {
        if (newVal && !$scope.memos.length) {
            loadFn();
        }
    });

    $scope.openEditMemo = function(memo, editing) {
        memo.editing = editing;
    }

    $scope.openDeleteMemo = function(memo, index) {
        memo.deleting = true;
        Restangular.one('programs', $scope.program.id).one('memos', $scope.memoType).one(''+memo.id).remove().then(function(result) {
            memo.deleting = false;
            $scope.memos.splice(index, 1);
            $scope.meta.total--;
        }, function () {
            memo.deleteError = 'Unable to delete memo at this time';
        });
    }

    $scope.updateMemo = function(memo) {
        // post data
        memo.updating = true;
        Restangular.one('programs', $scope.program.id).one('memos', $scope.memoType).post(memo.id, memo).then(function(result) {
            memo.updating = false;
            memo.editing = false;
            // update memo
            $.extend(memo, result.models.memo);
        }, function() {
            memo.updating = false;
            alert.add('Unable to load memos at this time.');
        });
    }
}]);