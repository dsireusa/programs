angular.module('ncsolar').controller('EditCtrl', function($scope, $rootScope, Restangular, editService, select2State, select2Contact, $timeout, debounce, alert) {
    editService.init($scope, {
        objectScopeName: 'program',
        entityIdName: 'program',
        updateR: Restangular.one('programs', 'update'),
        tag: 'program',
        postInitFn: function(program, options) {
            $scope.program.setLastUpdated = true;
            angular.forEach(options.program, function(values, key) {
                $scope.program[key] = values;
            });
            angular.forEach(options.scope, function(values, key) {
                $scope[key] = values;
            });
            $scope.technologies = {};
            if (!$scope.program.contacts) {
                $scope.program.contacts = [];
            }
            angular.forEach($scope.selectVisibles.data, function(option, index) {
                if ($scope.program.published == option.value) {
                    $scope.program.isPublished = option;
                }
            });

            $scope.$watch('program.isPublished', function(newOption, oldOption) {
                if (newOption === oldOption) {
                    return;
                }
                $scope.program.published = newOption.value;
            })


        },
        successCallback: function (data) {
            $scope.saving = false;
            $scope.showSaveMessage = true;
            $scope.program.newSubscriptionMemo = '';
            $scope.program.newProgramMemo = '';
            $.extend($scope.program, data.models.program);
            $timeout(function() {
                $scope.showSaveMessage = false;
            }, 5000);
        }
    });

    $scope.toggleSetLastUpdated = function() {
        $scope.program.setLastUpdated = !$scope.program.setLastUpdated;
    }

    $scope.selectVisibles = {
        minimumResultsForSearch: -1,
        data: [
            {id: 1, text: 'Visible To Public', value: true},{id: 2, text: 'Not Visible To Public', value: false}
        ]
    };

    $scope.newProgramContact = function(contact) {
        return {
            program: $scope.program.id,
            contact: contact,
            webVisible: arguments[1] ? true : false
        };
    }
    $scope.addContact = function(contact) {
        $scope.program.contacts.push($scope.newProgramContact(contact, contact.webVisibleDefault));
    }

    /**
     * JS to make the side bar scroll along
     */
    var debounceScroll = debounce(function() {
        $timeout(function() {
            if($(document).scrollTop() > $scope.defaultDimensions['top']) {
                $('.program-controls').addClass('is-fixed');
            }
            else {
                $('.program-controls').removeClass('is-fixed');
            }
        },0);
    }, 10, true);

    $scope.defaultDimensions = [];
    $scope.defaultDimensions['top'] = $('.program-controls').position().top - 30;
    $scope.initProgramControls = function() {
        
        $scope.defaultDimensions['width'] = $('.edit-program').width() - $('.program-form').outerWidth(true)-1;
        $scope.defaultDimensions['left'] = $('.program-form').outerWidth(true) + $('.program-form').position().left;
        
        $('.program-controls').css({
            'width' : $scope.defaultDimensions['width'],
            'left' : $scope.defaultDimensions['left']
        });
    }

    $timeout(function() {
        $scope.initProgramControls();
    },0)

    $(window).resize($scope.initProgramControls)
    $(window).scroll(debounceScroll);
});