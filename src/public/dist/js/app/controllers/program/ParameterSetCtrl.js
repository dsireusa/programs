angular.module('ncsolar').controller('ParameterSetCtrl', ["$scope", function($scope) {
    $scope.init = function(unitsMap) {
        $scope.unitsMap = unitsMap;
    }

    var format = function(object, container, query) {
        return object.name;
    };
    $scope.selectedTechnologyOptions = {
        data: $scope.program.technologies,
        id: function(object) {
            return object.id
        },
        placeholder: 'Select a technology',
        formatResult: format,
        formatSelection: format

    };
    $scope.selectedSectorOptions = {
        data: $scope.program.sectors,
        id: function(object) {
            return object.id
        },
        placeholder: 'Select a sector',
        formatResult: format,
        formatSelection: format
    };

    $scope.addParameterSet = function() {
        $scope.program.parameterSets.push({
            technologies: [],
            sectors: [],
            parameters: []
        })
    }

    $scope.removeParameter = function(parameterSet, index)
    {
        parameterSet.parameters.splice(index, 1);
    }

    $scope.addParameter = function(parameterSet)
    {
        if (!parameterSet.parameters) {
            parameterSet.parameters = [];
        }
        var parameter = {
            source: 'System',
            qualifier: '',
            unit: ''
        };
        parameterSet.parameters.push(parameter);
    }

    $scope.removeParameterSet = function(parameterSet, index) {
        $scope.program.parameterSets.splice(index, 1);
    }
}]).controller('ParameterCtrl', ["$scope", function($scope) {
    $scope.units = [];

    var getUnits = function(source, qualifier) {
        if ($scope.unitsMap[source]) {
            if ($scope.unitsMap[source][qualifier]) {
                return $scope.unitsMap[source][qualifier];
            } else if ($scope.unitsMap[source]['default']) {
                return $scope.unitsMap[source]['default'];
            }
        }
        return $scope.units;
    }

    $scope.$watch('parameter.source', function(newVal, oldVal) {
        if ($scope.source === newVal) {
            return;
        }
        $scope.source = newVal;
        $scope.units = getUnits(newVal, $scope.parameter.qualifier);
    });
    $scope.$watch('parameter.qualifier', function(newVal, oldVal) {
        if ($scope.qualifier === newVal) {
            return;
        }
        $scope.qualifier = newVal;
        $scope.units = getUnits($scope.parameter.source, newVal);
    });
}]);