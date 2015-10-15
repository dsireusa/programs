angular.module('ncsolar').directive('flyoutMenu', function() {
    return {
        restrict: 'A',
        scope: true,
        controller: function($scope, $element, $attrs, $transclude) {
            var PANEL_ID = 0;
            $scope.flyoutData = {
                current: 0,
                panels: {}, // panel id: panel object
                levels: {} // level id: array of panel ids
            }
            $scope.$watch('flyoutData.current', function(newCurrentLevel, oldCurrentLevel) {
                //console.log('current level changed!', arguments);
                if (newCurrentLevel < 1) {
                    $element.removeClass('active');
                    $element.removeAttr('data-level-active')
                } else {
                    $element.addClass('active');
                    $element.attr('data-level-active', newCurrentLevel)
                    angular.element('body').addClass('no-scroll');
                }
            })
            var closePanel = function(container, level) {
                var levelNumber = parseInt(level);
                if($scope.flyoutData.current > levelNumber) {
                    angular.forEach($scope.flyoutData.levels, function(panelIds, lvl) {
                        if (lvl > levelNumber) {
                            angular.forEach(panelIds, function(panelId, i) {
                                $scope.flyoutData.panels[panelId].active = false;
                            })
                        }
                    });
                    $scope.flyoutData.current = levelNumber;
                } else {
                    var panelIds = $scope.flyoutData.levels && $scope.flyoutData.levels[levelNumber] ? $scope.flyoutData.levels[levelNumber] : [];
                    angular.forEach(panelIds, function(panelId, i) {
                        $scope.flyoutData.panels[panelId].active = false;
                    });
                    $scope.flyoutData.current = levelNumber - 1;
                }
            }

            var namespace = 'flyout:'+$attrs.flyoutMenu;
            $scope.$on(namespace+':open', function(event) {
                if ($scope.flyoutData.levels[1]) {
                    angular.forEach($scope.flyoutData.levels[1], function(panelId, i) {
                        $scope.flyoutData.panels[panelId].active = true;
                    });
                }
                $scope.flyoutData.current = 1;
            });
            $scope.addPanel = function(domElement, level, options) {
                //console.log('adding panel fn', arguments);
                if (!$scope.flyoutData.levels[level]) {
                    $scope.flyoutData.levels[level] = [];
                }
                var panelId = PANEL_ID++;
                var panel = {
                    active: false,
                    $element: domElement,
                    id: panelId,
                    level: level
                };
                panel.close = function() {
                    return closePanel($element, level);
                }
                if (options.flyoutTag) {
                    panel.tag = options.flyoutTag;
                }

                $scope.flyoutData.panels[panelId] = panel;
                $scope.flyoutData.levels[level].push(panelId);
                angular.element(domElement).attr('data-level', level);
                if (level == 1) {
                    angular.element(domElement).on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function (e) {
                        // check if this was the last panel open
                        var lastOpen = true;
                        angular.forEach($scope.flyoutData.levels[1], function(panelId, i) {
                            if (lastOpen && $scope.flyoutData.panels[panelId].active) {
                                lastOpen = false;
                            }
                        });
                        if (lastOpen) {
                            $('body').removeClass('no-scroll');
                        }
                    });
                }
                return panel;
            }
            $scope.$on(namespace+':addPanel', function(event, domElement, level, attrs) {
                //console.log('add panel ON', arguments);
                $scope.addPanel(domElement, level, attrs);
            })
            $scope.$on(namespace+':close', function() {
                //console.log('ON close', arguments);
            });
            var domElement = $element[0];
            $element.on('click', function($event) {
                //console.log('on click', arguments);
                if ($event.target == domElement) {
                    //console.log('closing all panels');
                    // close all panels
                    $scope.$apply(function() {
                        closePanel($element, 0);
                    });
                }
            });

            $scope.next = function() {
                //console.log('starting', $scope.flyoutData);
                var panelTag = arguments[0] || null;
                var current = $scope.flyoutData.current;
                var nextLevel = null;
                angular.forEach($scope.flyoutData.levels, function(panelIds, level) {
                    if (level > current && (nextLevel === null || level < nextLevel)) {
                        nextLevel = level;
                        //console.log(nextLevel, 'is a candidate');
                    }
                });
                //console.log('chosen: ', nextLevel);
                if (nextLevel === null) {
                    // nothing left to open
                    //console.log('nothing left to open');
                    return;
                }
                var opened  = false;
                angular.forEach($scope.flyoutData.levels[nextLevel], function(panelId, i) {
                    //console.log('panel id, index', panelId, i);
                    if (!panelTag || $scope.flyoutData.panels[panelId].tag == panelTag) {
                        $scope.flyoutData.panels[panelId].active = true;
                        opened = true;
                    }
                });
                if (opened) {
                    $scope.flyoutData.current = nextLevel;
                }
                //console.log('done', $scope.flyoutData);
            }

            $scope.$on(namespace+':next', function(event) {
                //console.log('ON next', arguments);
                var panelTag = arguments[1] || null;
                $scope.$apply(function() {
                    $scope.next(panelTag)
                })
            })

            $scope.getPanel = function(panelId) {
                //console.log('getPanel', arguments);
                return $scope.flyoutData.panels[panelId];
            }
        }
    }
}).directive('flyoutPanel', function() {
    return {
        require: '^flyoutMenu',
        restrict: 'A',
        scope: true,
        link: function($scope, $element, $attrs) {
            var panel = $scope.addPanel($element, $attrs.flyoutPanel, $attrs);
            $scope.panel = function() {
                return panel;
            }

        }
    };
});