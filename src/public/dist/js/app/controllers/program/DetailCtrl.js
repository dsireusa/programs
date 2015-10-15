angular.module('ncsolar').controller('DetailCtrl', ["$scope", "$timeout", function($scope, $timeout) {
    var details = [];
    angular.forEach($scope.detailTemplates, function(template, index) {
        // look up a detail with this id
        var programDetail = null;
        angular.forEach($scope.details, function(detail, index) {
            if (programDetail === null && detail.templateId == template.id) {
                programDetail = detail;
            }
        });
        if (programDetail === null) {
            programDetail = {
                id: null,
                label: template.label,
                value: '',
                displayOrder: template.displayOrder,
                templateId: template.id
            }
        }
        details.push(programDetail);
    });

    $scope.program.details = details;
}])