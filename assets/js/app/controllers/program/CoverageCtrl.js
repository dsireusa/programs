angular.module('ncsolar').controller('CoverageCtrl', function($scope, select2Utility, select2City, select2County, select2ZipCode) {

    $scope.init = function() {
        var implementingSector = $scope.program.sectorObj.name;
        var isEntireState = $scope.program.entireState;
        var stateId = $scope.program.state;
        var withStateData = {
            fnData: function(term, page, limit) {
                return {
                    stateId: stateId
                }
            }
        }
        var withStateAndOrderData = {
            fnData: function(term, page, limit) {
                return {
                    stateId: stateId,
                    orderBy: 'name',
                    orderDir: 'ASC'
                }
            }
        }
        if (implementingSector == 'Utility') {
            $scope.hasUtilities = true;
            // filter utilities by program state id
            $scope.utilityOptions = select2Utility.config({},{}, withStateAndOrderData);
        } else if ((implementingSector == 'State' && !isEntireState) || implementingSector == 'Local') {
            $scope.hasCounties = true;
            // filter counties by program state id
            $scope.countyOptions = select2County.config({},{}, withStateAndOrderData);


            $scope.hasCities = true;
            // filter cities by program state id
            $scope.cityOptions = select2City.config({},{}, withStateAndOrderData);
        }
        if ((implementingSector == 'State' && !isEntireState)|| implementingSector == 'Local' || implementingSector == 'Utility') {
            $scope.hasZips = true;
            $scope.zipOptions = select2ZipCode.config({}, {}, withStateData);
        }

    }

})