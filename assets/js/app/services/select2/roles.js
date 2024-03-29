angular.module('ncsolar').service('select2Role', function(Restangular, select2) {
    var resource = 'roles';
    var roles = Restangular.all(resource);
    var loadingInit = false;
    return {
        config: function() {
            var ajax = $.extend({
                dataType: 'json',
                results: function(result, page) {
                    return {results: result.data, more: (result.meta.offset + result.meta.limit < result.meta.total)}
                }
            }, arguments[0] || {});
            var topLevel = $.extend({
                id: function(result) {
                    return result.roleId;
                },
                placeholder: 'Select A Role',
                formatResult: function(result, ev, context, defaultFn) {
                    return result.displayName;
                },
                formatSelection: function(result) {
                    return result.displayName;
                }
            }, arguments[1] || {});
            var options = $.extend({
                resource: resource
                //getInitDataFromElement: function(element, value) {
                //    return value;
                //}
            }, arguments[2] || {});
            return select2.generateConfig(roles.getRestangularUrl(), ajax, topLevel, options);
        }
    }
});
