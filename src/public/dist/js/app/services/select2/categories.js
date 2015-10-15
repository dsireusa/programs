angular.module('ncsolar').service('select2Category', ["Restangular", "select2", function(Restangular, select2) {
    var resource = 'categories';
    var rObj = Restangular.all(resource);
    var loadingInit = false;
    return {
        config: function() {
            return select2.generateConfig(rObj.getRestangularUrl(), $.extend({

            }, arguments[0] || {}), $.extend({
                id: function(result) {
                    return result.id;
                },
                placeholder: 'Select a Category',
                formatResult: function(result, ev, context, defaultFn) {
                    return result.name;
                },
                formatSelection: function(result) {
                    return result.name;
                },
                minimumResultsForSearch: -1
            }, arguments[1] || {}), $.extend({}, {
                resource: resource
            }, arguments[2] || {}));
        }
    }
}]);