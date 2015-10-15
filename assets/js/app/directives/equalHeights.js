
angular.module('ncsolar').directive('equalHeights', function($timeout) {

    return {
        compile: function compile($element, $attrs, transclude) {
            return {
                pre: function preLink($scope, $element, $attrs, controller) { },
                post: function postLink($scope, $element, $attrs, controller) {

                    $scope.runEqualHeights = function() {
                        var currentTallest = 0,
                        currentRowStart = 0,
                        rowDivs = [],
                        $el,
                        topPosition = 0;
                        var myEl = $element.find('li');

                        $.each(myEl, function(index, val) {
                            // for summary tables
                            if($attrs.equalHeights === 'table') {
                                $el = $(val).find('.type');
                                $($el).height('auto');
                                topPostion = $el.position().top;

                                if (currentRowStart != topPostion) {
                                    for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                                        rowDivs[currentDiv].height(currentTallest);
                                    }
                                    rowDivs.length = 0; // empty the array
                                    currentRowStart = topPostion;
                                    currentTallest = $el.height();
                                    rowDivs.push($el);
                                } else {
                                    rowDivs.push($el);
                                    currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                                }
                                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                                    rowDivs[currentDiv].height(currentTallest);
                                }
                            }
                            // For detail pages
                            else {
                                $el = $(val).find('div');
                                $el.css('height','auto');

                                if($($el[0]).height() > $($el[1]).height()) {
                                    $($el[1]).height($($el[0]).height());
                                }
                                else {
                                    $($el[0]).height($($el[1]).height());
                                }
                            }
                        });
                    };

                    var doit;
                    $(window).on('resize', function() {
                        clearTimeout(doit);
                        doit = setTimeout(function() {
                            $scope.runEqualHeights();
                        }, 200);
                    });
                    $scope.$on('onLastRepeat'+$attrs.equalHeights, function() {
                        $timeout(function() {
                            $scope.runEqualHeights();
                        }, 0);
                    });
                }
            };
        }
    };
});