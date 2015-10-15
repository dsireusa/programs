angular.module('ncsolar').controller('TablesCtrl', function($scope, Restangular, select2Category, select2Technology, $timeout, alert) {
    $scope.numStateColumns = 2;
    $scope.$on('match', function(event, mq) {
        if (mq === '$mq_larger' && $scope.numStateColumns != 3) {
            $timeout(function() {
                $scope.numStateColumns = 3;
                $scope.setProgramsByStateContainers();
            });
        }
    });
    $scope.$on('unmatch', function(event, mq) {
        if (mq === '$mq_larger' && $scope.numStateColumns != 2) {
            $timeout(function() {
                $scope.numStateColumns = 2;
                $scope.setProgramsByStateContainers();
            });
        }
    });

    $scope.setStateHeaderArray = function () {
        $scope.stateHeaderArray = new Array($scope.numStateColumns);
    }
    $scope.categoryOptions = select2Category.config({},{}, {
        fnData: function () {
            return {orderBy: 'name', orderDir: 'ASC'};
        }
    });
    $scope.technologyOptions = select2Technology.config({},{}, {
        fnData: function () {
            return {orderBy: 'name', orderDir: 'ASC'};
        }
    });

    $scope.$watch('technology', function(before, after) {
        if(before !== after) {
            $scope.getProgramsByTypeAndState();
        }
    });
    $scope.$watch('category', function(before, after) {
        if (before !== after) {
            $scope.getProgramsByTypeAndState();
        }
    });

    $scope.getProgramsByType = function() {
        return $scope.programsByType;
    }

    $scope.getProgramsByState = function() {
        return $scope.programsByState;
    }

    //init method to pass params through to controller via ng-init
    $scope.init = function(params) {
        $scope.setStateHeaderArray();
        $scope.programsByType = params['programs-by-type'];
        $scope.programsByState = params['programs-by-state'];
        $scope.setProgramsByStateContainers();
        $scope.technology = params['technology'];
        $scope.category = params['category'];
        $scope.setFilterQueryParams();
    }

    $scope.getProgramsByTypeAndState = function (params) {
        var filters = {limit: 100};
        if($scope.category) {
            filters['category[]'] = $scope.category.id;
        }
        if($scope.technology) {
            filters['technology[]'] = $scope.technology.id;
        }
        Restangular.all('programs/by-type-and-state').getList(jQuery.extend(filters,params)).then(angular.bind(this, function (response) {
            //processing on success
            $scope.programsByType = response[0];
            $scope.programsByState = response[1];
            $scope.setProgramsByStateContainers();
            $scope.setFilterQueryParams();
        }), angular.bind(this, function (result) {
            alert.add('Unable to load Policies/Incentives by Type/State at this time');
        }));
    }

    $scope.programsByStateContainers = [];
    //take the list of program totals by state and break them into x smaller arrays to be displayed in separate unordered lists depending on window size
    $scope.setProgramsByStateContainers = function () {
        var tempProgramsByState = [];
        var columnSize = Math.ceil($scope.programsByState.length/$scope.numStateColumns);
        for(var i = 0; i< $scope.numStateColumns; i++) {
            tempProgramsByState[i] = $scope.programsByState.slice(i*columnSize, (i+1)*columnSize);
        }
        $scope.programsByStateContainers = tempProgramsByState;
        $scope.setStateHeaderArray();
    }
    $scope.setFilterQueryParams = function() {
        var tempQueryString = '&';
        if($scope.category) {
            tempQueryString += 'category='+$scope.category.id+'&';
        }
        if($scope.technology) {
            tempQueryString += 'technology='+$scope.technology.id+'&';
        }
        $scope.queryString = tempQueryString;
    }
    $scope.getUrlWithFilterParams = function(url) {
        return url+$scope.queryString;
    }

    $scope.getByHeader = function () {
        if ($scope.category && $scope.category.id == 1) {
            return 'Incentives';
        } else if ($scope.category && $scope.category.id == 2) {
            return 'Policies';
        }
        return 'Policies & Incentives';
    }
    $scope.getByTypeHeader = function () {
        return $scope.getByHeader()+' by Type';
    }
    $scope.getByStateHeader = function () {
        return $scope.getByHeader()+' by State';
    }
});
