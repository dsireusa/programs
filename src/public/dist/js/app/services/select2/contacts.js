angular.module('ncsolar').service('select2Contact', ["Restangular", "select2", function(Restangular, select2) {
    var resource = 'contacts';
    var contacts = Restangular.all(resource);
    var loadingInit = false;
    var nameCallbacks = [function(contact) {
        return (contact.firstName ? contact.firstName : '') + ' ' + (contact.lastName ? contact.lastName : '');
    }, function(contact) {
        return contact.organizationName ? contact.organizationName : '';
    }, function(contact) {
        return contact.email ? contact.email : '';
    }];
    var getName = function(contact) {
        var name = ''
        angular.forEach(nameCallbacks, function(callback,index) {
            if (!name.length) {
                name = (callback(contact)+"").trim();
            }
        });
        return name;
    }
    return {
        getName: getName,
        config: function() {
            return select2.generateConfig(contacts.getRestangularUrl(), $.extend({

            }, arguments[0] || {}), $.extend({
                id: function(result) {
                    return result.id;
                },
                placeholder: 'Find Contact',
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