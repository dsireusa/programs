angular.module('ncsolar').controller('SectorCtrl', ["$scope", function($scope) {
    var scanSector = function(sectors) {
        angular.forEach(sectors, function(sector, index) {
            if (!sector.parentId) {
                sector.template = 'sector-top';
            } else if (!sector.selectable) {
                sector.template = 'sector-middle';
            } else {
                sector.template = 'sector-leaf';
            }
            if (sector.children && sector.children.length) {
                sector.children = scanSector(sector.children);
            }
            // activate all selected
            angular.forEach($scope.program.sectors, function(s, i) {
                if (s.id == sector.id) {
                    sector.active = true;
                }
            })
        });
        return sectors;
    }
    var recursiveActivate = function(item) {
        if (!item) {
            return;
        }
        if (item.selectable) {
            item.active = true;
        } else if (item.children) {
            angular.forEach(item.children, function(child, i) {
                recursiveActivate(child);
            })
        }

    }
    $scope.selectAll = function(parent) {
        recursiveActivate(parent);
    }

    $scope.addCustomSector = function(name, parent) {
        if (name.trim().length < 1) {
            return;
        }
        if (!parent.children) {
            parent.children = [];
        }
        var newSector = {
            name: name,
            selectable: true,
            template: 'sector-leaf',
            active: true,
            countChildren: 0,
            parentId: parent.id
        };
        parent.children.push(newSector);
        $scope.program.sectors.push(newSector);
    }

    $scope.sectors = scanSector($scope.sectorMap);
}]).controller('SingleSectorCtrl', ["$scope", function($scope) {
    var findById = function(needle, haystack) {
        var index = -1;
        angular.forEach(haystack, function(item, i) {
            if (item.id == needle.id) {
                index = i;
            }
        });
        return index;
    }
    var makeSectorFromMap = function(sectorMapItem) {
        return {
            id: sectorMapItem.id,
            name: sectorMapItem.name,
            parentId: sectorMapItem.parentId,
            selectable: sectorMapItem.selectable,
            countChildren: sectorMapItem.countChildren
        }
    }
    $scope.$watch('sector.active', function(nowActive, wasActive) {
        if (nowActive == wasActive) {
            return;
        }
        if (nowActive) {
            // add
            if (findById($scope.sector, $scope.program.sectors) < 0) {
                $scope.program.sectors.push(makeSectorFromMap($scope.sector));
            }

        } else {
            // remove
            var i = findById($scope.sector, $scope.program.sectors);
            if (i >= 0) {
                $scope.program.sectors.splice(i, 1);
            }
        }
    })
}]);