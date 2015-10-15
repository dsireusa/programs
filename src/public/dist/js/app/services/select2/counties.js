angular.module('ncsolar').service('select2County', ["Restangular", "select2", function(Restangular, select2) {
    var resource = 'counties';
    var rObj = Restangular.all(resource);
    var loadingInit = false;
    var nameCallbacks = [function(entity) {
        return entity.name;
    }];
    var getName = function(entity) {
        var name = ''
        angular.forEach(nameCallbacks, function(callback,index) {
            if (!name.length) {
                name = (callback(entity)+"").trim();
            }
        });
        return name;
    }
    return {
        config: function() {
            return select2.generateConfig(rObj.getRestangularUrl(), $.extend({

            }, arguments[0] || {}), $.extend({
                id: function(result) {
                    return result.id;
                },
                placeholder: 'Find County',
                formatResult: function(result, ev, context, defaultFn) {
                    return getName(result);
                },
                formatSelection: function(result) {
                    return getName(result);
                }
            }, arguments[1] || {}), $.extend({}, {
                resource: resource
            }, arguments[2] || {}));
        }
    }
}]);