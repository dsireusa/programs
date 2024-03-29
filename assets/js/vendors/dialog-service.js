/*
 * Based on https://github.com/jwstadler/angular-jquery-dialog-service
 *
 *  This provides us with a basic dialog service, that should work with nested scopes.
 *  This is based on the jquery dialog.
 *
 *  The jwstadler/angular-jquery-dialog-service injects a lot of scope issues, causing
 *  issues such as inability to separate controller logic (ex form alerts) when a dialog
 *  is nested inside a subcontroller.
 *
 */
angular.module('dialogService', []).service('dialogService',
    ['$rootScope', '$q', '$compile', '$templateCache',
        function($rootScope, $q, $compile, $templateCache) {

            _this = this;
            this.dialogs = {};

            this.open = function(id)
            {
                // If the dialog exists, open it
                if(_this.dialogs[id]) {
                    _this.dialogs[id].ref.dialog('open');
                    // Create our promise, cache it to complete later, and return it
                    _this.dialogs[id].deferred = $q.defer();
                    return _this.dialogs[id].deferred.promise;
                }
            }

            this.init = function(id, options, element) {

                // Copy options so the change ot close isn't propogated back.
                // Extend is used instead of copy because window references are
                // often used in the options for positioning and they can't be deep
                // copied.
                var dialogOptions = {};
                if (angular.isDefined(options)) {
                    angular.extend(dialogOptions, options);
                }

                // Initialize our dialog structure
                var dialog = { scope: null, ref: null, deferred: null };

                dialog.ref = element;

                // Hande the case where the user provides a custom close and also
                // the case where the user clicks the X or ESC and doesn't call
                // close or cancel.
                var customCloseFn = dialogOptions.close;
                var cleanupFn = this.cleanup;
                dialogOptions.close = function(event, ui) {
                    if (customCloseFn) {
                        customCloseFn(event, ui);
                    }
                    cleanupFn(id);
                };

                // Initialize the dialog and open it
                dialog.ref.dialog(dialogOptions);

                // Cache the dialog
                _this.dialogs[id] = dialog;

                // Create our promise, cache it to complete later, and return it
                dialog.deferred = $q.defer();
                return dialog.deferred.promise;
            }

            this.close = function(id, result) {
                // Get the dialog and throw exception if not found
                var dialog = _this.getExistingDialog(id);

                // Notify those waiting for the result
                // This occurs first because the close calls the close handler on the
                // dialog whose default action is to cancel.
                dialog.deferred.resolve(result);

                // Close the dialog (must be last)
                dialog.ref.dialog("close");
            };

            this.cancel = function(id) {
                // Get the dialog and throw exception if not found
                var dialog = _this.getExistingDialog(id);

                // Notify those waiting for the result
                // This occurs first because the cancel calls the close handler on the
                // dialog whose default action is to cancel.
                dialog.deferred.reject();

                // Cancel and close the dialog (must be last)
                dialog.ref.dialog("close");
            };

            /* private */
            this.cleanup = function(id) {
                // Get the dialog and throw exception if not found
                var dialog = _this.getExistingDialog(id);

                // This is only called from the close handler of the dialog
                // in case the x or escape are used to cancel the dialog. Don't
                // call this from close, cancel, or externally.
                dialog.deferred.reject();

                // Remove the object from the DOM
                //dialog.ref.remove();

                // Delete the dialog from the cache
                //delete _this.dialogs[id];
            };

            /* private */
            this.getExistingDialog = function(id) {
                // Get the dialog from the cache
                var dialog = _this.dialogs[id];
                // Throw an exception if the dialog is not found
                if (!angular.isDefined(dialog)) {
                    throw "DialogService does not have a reference to dialog id " + id;
                }
                return dialog;
            };

        }
    ]);
