export class DialogService {
    constructor($uibModal, $uibModalStack, $log) {
        'ngInject';

        this.$uibModal = $uibModal;
        this.$uibModalStack = $uibModalStack;
        this.$log = $log;
    }

    open(template, options) {
        this.$log.debug('template ', template);
        if (!template) {
            return false;
        }

        if (!options) {
            options = {};
        }

        var defaultOptions = {
            animation: true,
            controllerAs: 'vm',
            templateUrl: '/views/admin.dialogs.' + template,
            size: 300
        };

        options = angular.extend(defaultOptions, options);
        this.$log.debug(options);

        // options.templateUrl = './views/dialogs/' + template + '/' + template + '.dialog.html'
        // options.templateUrl = '/views/admin.dialogs.' + template;

        //return this.$mdDialog.show(options);
        return this.$uibModal.open(options);

        /*
        // var modalInstance = this.$uibModal.open({
        //     animation: true,
        //     templateUrl: '/views/admin.dialogs.store_dialog',
        //     controller: this.modalcontroller,
        //     controllerAs: 'mvm',
        //     size: 300,
        //     // resolve: {
        //     //     items: () => {
        //     //         return items
        //     //     }
        //     // }
        // }) */
    }

    close(params) {
        let hideParam = {
            type: 'hide',
            params: params || null
        };
        // this.$uibModal.close(hideParam);
        // this.$uibModalStack.close(modalInstance, result);
        var top = this.$uibModalStack.getTop();
        if (top) {
            this.$uibModalStack.close(top.key, hideParam);
        }
    }

    cancel(params) {
        let cancelParam = {
            type: 'cancel',
            params: params
        };

        var top = this.$uibModalStack.getTop();
        if (top) {
            this.$uibModalStack.dismiss(top.key, cancelParam);
        }
    }

    // alert(title, content, params) {
    //     let alert = this.$mdDialog.alert(params)
    //         .title(title)
    //         .content(content)
    //         .ariaLabel(content)
    //         .ok('Ok');

    //     this.$mdDialog.show(alert);
    // }

    // confirm(title, content, params) {
    //     let confirm = this.$mdDialog.confirm(params)
    //         .title(title)
    //         .content(content)
    //         .ariaLabel(content)
    //         .ok('Ok')
    //         .cancel('Cancel');

    //     return this.$mdDialog.show(confirm);
    // }

    // prompt(title, content, placeholder, params) {
    //     let prompt = this.$mdDialog.prompt(params)
    //         .title(title)
    //         .textContent(content)
    //         .placeholder(placeholder)
    //         .ariaLabel(placeholder)
    //         .ok('Ok')
    //         .cancel('Cancel');

    //     return this.$mdDialog.show(prompt);
    // }
}