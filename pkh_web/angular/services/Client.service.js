export class ClientService {
    constructor(toaster, $window) {
        'ngInject';

        this.toaster = toaster;
        this.$window = $window;
        this.getTitle = function(alert, defaultTitle) {
            var result = defaultTitle
            if (alert !== null && !angular.isUndefined(alert)) {
                if (alert.title !== null && !angular.isUndefined(alert.title)) {
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

        if (alerts === null || !angular.isUndefined(alerts)) {
            return
        }

        if (Array.isArray(alerts)) {
            let len = alerts.length
            for (var i = 0; i < len; i++) {
                showOne(alerts[i])
            }
        } else {
            showOne(alerts)
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
        if (alerts === null || !angular.isUndefined(alerts)) {
            return
        }

        let type = alert.type
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

    downloadFile(action, params) {
        var path = getContextPath() + action;
        var form = document.createElement("form");
        form._submit_function_ = form.submit;

        form.setAttribute("method", "POST");
        form.setAttribute("action", path);
        form.setAttribute("name", "form");

        for (var key in params) {
            if (params.hasOwnProperty(key)) {
                if (params[key] != undefined && params[key] != null) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);
                    form.appendChild(hiddenField);
                }
            }
        }

        document.body.appendChild(form);
        form._submit_function_();
    }

    postUrl(winURL, params) {
        var winName='MyWindow';
        // var winURL='search.action';
        var windowoption='resizable=yes,height=600,width=800,location=0,menubar=0,scrollbars=1';
        // var params = { 'param1' : '1','param2' :'2'};         
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", winURL);
        form.setAttribute("target",winName);  
        for (var i in params) {
            if (params.hasOwnProperty(i)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = i;
            input.value = params[i];
            form.appendChild(input);
            }
        }              
        document.body.appendChild(form);                       
        window.open('', winName,windowoption);
        form.target = winName;
        form.submit();                 
        document.body.removeChild(form);       
    }

    downloadFileOneTime(file) {
        this.$window.open('/download/one/' + file);
    }
}