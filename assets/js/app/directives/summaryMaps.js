
angular.module('ncsolar').directive('summaryMaps', function($timeout) {

    return {
        compile: function compile($element, $attrs, transclude) {
            return {
                pre: function preLink($scope, $element, $attrs, controller) { },
                post: function postLink($scope, $element, $attrs, controller) {

                    $scope.initMap = function() {                        
                        google.setOnLoadCallback($scope.drawRegionsMap($scope.programsByState));
                    };

                    $scope.drawRegionsMap = function(dataObject) {
                        var dataArray = [],
                            ivalue = [],
                            $mobileList = $('<ul class="mobile-list-all"></ul>');
                            $mobileList.append('<li><span>State/Territory</span> <span>Total</span></li>').append('<li class="tablet-header"><span>State/Territory</span> <span>Total</span></li>');
                        dataArray.push(['State','Title', 'Policies & Incentives',  {role: 'tooltip', p:{html:true}}]);
                        dataArray.push(['US-unknown', '', 0, '<div class="tooltip"><h3>North Carolina</h3> Policies & Incentives: <strong>300</strong></div>']);

                        $.each(dataObject, function(index, state) {
                            dataArray.push( ['US-'+state['state'].abbreviation , '', state.total, '<div class="tooltip"><h3>'+state['state'].name+'</h3> Policies & Incentives: <strong>'+state.total+'</strong></div>']);
                            ivalue['US-'+state['state'].abbreviation] = state.url;
                            // $mobileList.append('<li><a href="'+state.url+'"><span class="location">'+state['state'].abbreviation+' - '+state['state'].name+'</span> <span class="count">'+state.total+'</span></a></li>');
                        });
                        // $('.mobile-list').html($mobileList);

                        var data = google.visualization.arrayToDataTable(dataArray);
                        
                        var chartWidth = $('#chart_div').width();
                        

                        var geochart = new google.visualization.GeoChart(
                            document.getElementById('chart_div'));

                        var options = {
                            region: 'US',
                            resolution: 'provinces',
                            width: chartWidth,
                            enableRegionInteractivity: true,
                            keepAspectRatio: true,
                            displayMode: 'regions',
                            tooltip: {
                                isHtml: true,
                                textStyle: {color: '#ff0000'},
                                trigger:'focus'
                            },
                            colorAxis: {
                                colors: ['#71b5c4', '#427e93']
                            }, // orange to blue 
                            backgroundColor: { fill: '#f2f2f2' },

                            datalessRegionColor: '#cccccc'
                        };


                        google.visualization.events.addListener(geochart, 'select', function() {
                            var selection = geochart.getSelection();
                            if (selection.length == 1) {
                                var selectedRow = selection[0].row;
                                var selectedRegion = data.getValue(selectedRow, 0);
                                if(ivalue[selectedRegion] !== '') { document.location = ivalue[selectedRegion]; }
                            }
                        });
                        geochart.draw(data, options);

                        var resizeTimer; // Set resizeTimer to empty so it resets on page load

                        function resizeFunction() {
                            // Stuff that should happen on resize
                            chartWidth = $('#chart_div').width();
                            options.width = chartWidth;
                            geochart = new google.visualization.GeoChart(document.getElementById('chart_div'));
                            geochart.draw(data, options);
                        }

                        // On resize, run the function and reset the timeout
                        // 250 is the delay in milliseconds. Change as you see fit.
                        $(window).resize(function() {
                            clearTimeout(resizeTimer);
                            resizeTimer = setTimeout(resizeFunction, 250);
                        });
                        google.visualization.events.addListener(geochart, 'ready', function () {
                            // $('.export-map').attr('href', geochart.getImageURI());
                            $('.export-map-container img').attr('src', geochart.getImageURI());
                        });
                        $('.export-map').on('click', function(){
                            $('.export-map-container').addClass('active');
                            $('body').addClass('no-scroll');
                        });
                        $('.close-trigger').on('click', function(e){
                            
                            if($(e.target).hasClass('close-trigger')) {
                                $('.export-map-container').removeClass('active');
                                $('body').removeClass('no-scroll');
                            }
                           
                        });

                    };

                    $scope.redrawMap = function() {

                    };

                    $timeout(function() {
                        $scope.initMap();
                    }, 0);

                    $scope.$on('mapDataReady', function(){
                        $scope.initMap();
                    });
                    // var doit;
                    // $(window).on('resize', function() {
                    //     clearTimeout(doit);
                    //     doit = setTimeout($scope.runEqualHeights(), 200);
                    // });
                    // $scope.$on('onLastRepeat'+$attrs.equalHeights, function() {
                    //     $timeout(function() {
                    //         $scope.runEqualHeights();
                    //     }, 0);
                    // });
                }
            };
        }
    };
});