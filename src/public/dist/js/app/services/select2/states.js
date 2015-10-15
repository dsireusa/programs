angular.module('ncsolar').service('select2State', ["Restangular", "select2", function(Restangular, select2) {
    var resource = 'states';
    var states = Restangular.all(resource);
    var loadingInit = false;
    return {
        config: function() {
            return select2.generateConfig(states.getRestangularUrl(), $.extend({

            }, arguments[0] || {}), $.extend({
                id: function(result) {
                    return result.id;
                },
                placeholder: 'Select a State',
                formatResult: function(result, ev, context, defaultFn) {
                    return result.name;
                },
                formatSelection: function(result) {
                    return result.name;
                }
            }, arguments[1] || {}), $.extend({}, {
                resource: resource
            }, arguments[2] || {}));
        }
    }
}]);