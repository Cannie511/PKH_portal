export class ClientService {
    constructor(toaster) {
        'ngInject';

        this.toaster = toaster
        this.getTitle = function(alert, defaultTitle) {
            var result = defaultTitle
            if (alert !== null && angular.isDefined(alert)) {
                if (alert.title !== null && angular.isDefined(alert.title)) {
                    result = alert.title
                }
            }

            return result;
        }
    }

    /**
     * Show alert
     * @param  {Object, List} alerts List alert or one
     * @return {None} 
     */
    show(alerts) {

        if (alerts === null || angular.isUndefined(alerts) ) {
            return;
        }

        if (angular.isArray(alerts)) {
            let len = alerts.length
            for (var i = 0; i < len; i++) {
                this.showOne(alerts[i])
            }
        } else {
            this.showOne(alerts)
        }
    }

    /**
     * Show alert
     * Format: alert = { type: 'success', 'title': 'Success!', msg: 'Your message here' }
     * Type: success, info, warning
     * @param  {Object} alerts List alert or one
     * @return {None} 
     */
    showOne(alert) {
        if (alert === null || angular.isUndefined(alert) ) {
            return
        }

        let type = alert.type;
        let body = "";
        if (type === 'success') {
            let title = this.getTitle(alert, 'Success!')
            this.toaster.pop(type, title, body, 5000, 'trustedHtml');
        } else if (type === 'info') {
            let title = this.getTitle(alert, 'Infomation!')
            this.toaster.pop(type, title, body, 5000, 'trustedHtml');
        } else if (type === 'warning') {
            let title = this.getTitle(alert, 'Warning!')
            this.toaster.pop(type, title, body, 5000, 'trustedHtml');
        } else if (type === 'error') {
            let title = this.getTitle(alert, 'Error!')
            this.toaster.pop(type, title, body, 60000, 'trustedHtml');
        }
    }

    success(body) {
        this.toaster.pop('success', "Success", body, 5000, 'trustedHtml');
    }

    error(body) {
        this.toaster.pop('error', "Error", body, 60000, 'trustedHtml');
    }

    warning(body) {
        this.toaster.pop('warning', "Warning", body, 5000, 'trustedHtml');
    }
}
