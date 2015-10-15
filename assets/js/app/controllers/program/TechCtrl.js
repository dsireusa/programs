angular.module('ncsolar').controller('TechCtrl', function($scope, select2Technology) {
    var technologies = [];
    var energyCategoryId = $scope.energyCategory.id;
    angular.forEach($scope.program.technologies, function(technology, index) {
        if (technology.energyCategoryId == energyCategoryId) {
            technologies.push(technology);
        }
    });
    $scope.technologies = technologies;

    var findSingleMissing = function(completeArray, incompleteArray) {
        var missing = null;
        angular.forEach(completeArray, function(item1, i) {
            var found = false;
            angular.forEach(incompleteArray, function(item2, j) {
                if (item1.id == item2.id) {
                    found = true;
                }
            });
            // this item is not present in the incomplete array
            if (!found) {
                missing = item1;
            }
        });
        return missing;
    }

    var findIndexOf = function(technology, technologies) {
        var index = -1;
        angular.forEach(technologies, function(tech, i) {
            if (tech.id == technology.id) {
                index = i;
            }
        });
        return index;
    }

    $scope.$watch('technologies', function(newTech, oldTech, s) {
        if (newTech == oldTech) {
            return;
        }
        if (newTech.length > oldTech.length) {
            // added
            var tech = findSingleMissing(newTech, oldTech);
            if (findIndexOf(tech, $scope.program.technologies) < 0) {
                $scope.program.technologies.push(tech);
            }
        } else {
            // removed
            var tech = findSingleMissing(oldTech, newTech);
            var index = findIndexOf(tech, $scope.program.technologies);
            if (index >= 0) {
                // remove it
                $scope.program.technologies.splice(index, 1);
            }
        }

    }, true);

    $scope.technologyOptions = select2Technology.config({}, {}, {
        fnData: function(term, page, limit) {
            return {
                energyCategoryId: $scope.energyCategory.id,
                orderBy: 'name',
                orderDir: 'ASC'
            }
        }
    });
})