angular.module('ncsolar').service('select2Type', ["Restangular", "select2", function(Restangular, select2) {
    var resource = 'types';
    var rObj = Restangular.all(resource);
    return {
        config: function() {
            return select2.generateConfig(rObj.getRestangularUrl(), $.extend({
                data: function(term, page) {
                    var limit = 10;
                    return {
                        active: true,
                        q:term,
                        limit: limit,
                        offset: (page-1) * limit
                    };
                }
            }, arguments[0] || {}), $.extend({
                id: function(result) {
                    return result.id;
                },
                placeholder: 'Select an Incentive Type',
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