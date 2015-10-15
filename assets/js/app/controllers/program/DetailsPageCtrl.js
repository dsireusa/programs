angular.module('ncsolar').controller('DetailsPageCtrl', function($scope, $rootScope, Restangular,$timeout) {
    $scope.init = function (params) {
        $scope.memoType = 'subscription';
        $scope.displayMemos = true;
        $scope.displayParameters = false;
        $scope.objectScopeName = 'program';
        $scope.entityIdName = 'program';
        $scope.program = params['program'];
        $scope.contacts = params['contacts'];
        $scope.details = params['details'];
        $scope.authorities = params['authorities'];
        $scope.renewableTechnologyNames = params['technologiesByEnergyCategory'][1] ? $scope.getPropertiesForObjectArray(params['technologiesByEnergyCategory'][1]) : '';
        $scope.efficiencyTechnologyNames = params['technologiesByEnergyCategory'][2] ? $scope.getPropertiesForObjectArray(params['technologiesByEnergyCategory'][2]) : '';
        $scope.sectorNames = $scope.getPropertiesForObjectArray(params['sectors']);
        $scope.utilityNames = $scope.getPropertiesForObjectArray(params['utilities']);
        $scope.countyNames = $scope.getPropertiesForObjectArray(params['counties']);
        $scope.cityNames = $scope.getPropertiesForObjectArray(params['cities']);
        $scope.zipcodeNames = $scope.getPropertiesForObjectArray(params['zipCodes'], 'zipcode');
        $scope.msgWrapperText = 'Last Updated ' + params['programLastUpdated'];
        $scope.subscribeToProgramUrl = params['subscribeToProgramUrl'];
        $scope.programFields = [
            {
                label: 'Implementing Sector',
                getValue: function() { return $scope.program.sectorObj.name }
            },
            {
                label: 'Category',
                getValue: function() { return $scope.program.categoryObj.name }
            },
            {
                label: 'State',
                getValue: function() { return $scope.program.stateObj.name }
            },
            {
                label: 'Incentive Type',
                getValue: function() { return $scope.program.typeObj.name }
            },
            {
                label: 'Web Site',
                type: 'link',
                getValue: function() { return $scope.program.websiteUrl }
            },
            {
                label: 'Administrator',
                getValue: function() { return $scope.program.admin }
            },
            {
                label: 'Funding Source',
                getValue: function() { return $scope.program.fundingSource }
            },
            {
                label: 'Budget',
                getValue: function() { return $scope.program.budget}
            },
            {
                label: 'Start Date',
                getValue: function() { return $scope.program.startDateDisplay }
            },
            {
                label: 'Expiration Date',
                getValue: function() { return $scope.program.endDateDisplay}

            },
            {
                label: 'Utilities',
                getValue: function() { return $scope.utilityNames }
            },
            {
                label: 'Counties',
                getValue: function() { return $scope.countyNames }
            },
            {
                label: 'Cities',
                getValue: function() { return $scope.cityNames }
            },
            {
                label: 'Zip Codes',
                getValue: function() { return $scope.zipcodeNames }
            },
            {
                label: 'Eligible Renewable/Other Technologies',
                getValue: function() {
                    return $scope.renewableTechnologyNames + ($scope.program.additionalTechnologies ? ' '+ $scope.program.additionalTechnologies : '');
                }
            },
            {
                label: 'Eligible Efficiency Technologies',
                getValue: function() {
                    return $scope.efficiencyTechnologyNames;
                }
            },
            {
                label: 'Applicable Sectors',
                getValue: function() { return $scope.sectorNames}
            },
        ];
        $.each($scope.details, function(key, detail) {
            $scope.programFields.push({
                label: detail.label,
                getValue: function() {return detail.value}
            });
        });
        $scope.parameterSets = $.map(params['parameterSets'], function(parameterSetObj) {
            var parameterset = [[
                {
                    label: 'Technologies',
                    getValue: function () {
                        return $scope.getPropertiesForObjectArray(parameterSetObj.technologies);
                    }
                },
                {
                    label: 'Sectors',
                    getValue: function () {
                        return $scope.getPropertiesForObjectArray(parameterSetObj.sectors);
                    }
                },
                {
                    label: 'Parameters',
                    getValue: function () {
                        return $.map(parameterSetObj.parameters, function (parameter) {
                            return $scope.getParameterValue(parameter);
                        }).join(', ');
                    }
                },
            ]]
            return parameterset;
        });
    }

    $scope.getParameterValue = function (parameterObj) {
        if (parameterObj.source == 'System') {
            value = 'The system size';
        } else {
            value = 'The incentive';
        }
        if (parameterObj.qualifier == 'min') {
            value += ' has a minimum of ';
        } else if(parameterObj.qualifier == 'max') {
            value += ' has a maximum of ';
        } else {
            value += ' is ';
        }
        if(parameterObj.units == '$') {
            value += parameterObj.units;
        }
        value += parameterObj.amount;
        if(parameterObj.units != '$') {
            value += ' '+parameterObj.units;
        }
        return value;
    }

    $scope.getPropertiesForObjectArray = function (collection, property) {
        if(!property) {
            property = 'name';
        }
        return $.map(collection, function (object) {
                return object[property];
            }
        ).join(', ');
    }
    
    //is the current user an admin?
    $scope.isLoggedIn = function() {
        // rename to 'logged in'
        return $scope.role != 'guest';
    }

    $scope.fakeLastRepeat = function(repeatAttr) {
        $scope.$emit('onLastRepeat'+repeatAttr);
    }

    $scope.toggleDisplayParameters = function(repeatAttr) {
        $scope.displayParameters = !$scope.displayParameters;
        $rootScope.$broadcast('onLastRepeat'+repeatAttr);
    }
});