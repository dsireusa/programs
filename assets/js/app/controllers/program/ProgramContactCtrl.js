angular.module('ncsolar').controller('ProgramContactCtrl', function($scope, $rootScope, select2Contact) {
    $scope.service = select2Contact;

    $scope.removeProgramContact = function(index) {
        $scope.program.contacts.splice(index, 1);
    }

    // ----------------------------- flyouts
    $scope.openNewContactForm = function () {
        $scope.editContactForm({webVisibleDefault: true});
    };

    $scope.editContactForm = function(contact) {
        $rootScope.$broadcast('NewContactCtrl:setContact', contact);
    }
    $scope.contactOptions = select2Contact.config({},{}, {
        fnData: function(term, page, limit) {
            return {select2: true}
        }
    });

    var appendProgramContact = function(contact) {
        $scope.program.contacts.push($scope.newProgramContact(contact, contact.webVisibleDefault));
    }

    $scope.$on('ProgramContactCtrl:appendContact', function(event, contact) {
        appendProgramContact(contact);
    })


    $scope.$watch('contact', function(newContact, oldContact) {
        if (newContact === oldContact || !newContact) {
            return;
        }
        // a contact has been selected
        appendProgramContact(newContact);
        $scope.contact = null;
    });
});