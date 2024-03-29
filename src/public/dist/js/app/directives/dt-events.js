/**
 * Created by brendans on 12/4/14.
 */
//Used to pass datatables events through for use in angular
angular.module('ncsolar')
    .directive('dtEvents', function () {
        return {
            restrict: 'A',
            link: function ($scope, element, attrs) {
                $(element).on('length.dt', function ( e, settings, len ) {
                    $scope.$emit('event:dataTableLengthChanged', {
                        element: element,
                        length: len,
                        table: $(element).DataTable()
                    });
                } );
            }
        }
    });
