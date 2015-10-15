angular.module('ncsolar').controller('MapsCtrl', function($scope, Restangular, select2Type, select2Technology, alert) {
    $scope.typeOptions = select2Type.config({},{}, {
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
            $scope.getProgramsByState();
        }
    });
    $scope.$watch('type', function(before, after) {
        if (before !== after) {
            $scope.getProgramsByState();
        }
    });

    //init method to pass params through to controller via ng-init
    $scope.init = function(params) {
        $scope.programsByState = params['programs-by-state'];
        $scope.technology = params['technology'];
        $scope.type = params['type'];
        $scope.setFilterQueryParams();
    }

    $scope.getNumberOfProgramsByState = function () {
        return $scope.programsByState.length;
    }

    $scope.getProgramsByState = function (params) {
        var filters = {limit: 100};
        if($scope.type) {
            filters['type[]'] = $scope.type.id;
        }
        if($scope.technology) {
            filters['technology[]'] = $scope.technology.id;
        }
        Restangular.all('programs/by-state').getList(jQuery.extend(filters,params)).then(angular.bind(this, function (response) {
            //processing on success
            $scope.setFilterQueryParams();
            $scope.programsByState = $.map(response.data, angular.bind(this, function (object) {
                object.url = $scope.getUrlWithFilterParams(object.url);
                return object;
            }));
            /**
             * Here is where you can post-process the resulting data stored in $scope.programsByState before supplying to GeoCharts
             */

            $scope.$emit('mapDataReady');
        }), angular.bind(this, function (result) {
            alert.add('Unable to load Policies/Incentives by State at this time');
        }));
    }
    $scope.setFilterQueryParams = function() {
        var tempQueryString = '&';
        if($scope.type) {
            tempQueryString += 'type='+$scope.type.id+'&';
        }
        if($scope.technology) {
            tempQueryString += 'technology='+$scope.technology.id+'&';
        }
        $scope.queryString = tempQueryString;
    }
    $scope.getUrlWithFilterParams = function(url) {
        return url+$scope.queryString;
    }
});
