class Crm0110Controller {
    constructor($scope, $state, $compile, API, $log, AclService, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.can = AclService.can;
        this.ClientService = ClientService;
        this.RouteService = RouteService;

        this.m = {
            form: {},
            init: {}
        }

        if ($stateParams.product_id > 0) {
            this.m.form.product_id = $stateParams.product_id;
        } else {
            this.m.form.product_id = 0;
        }
    }

    $onInit() {
        let self = this;
        let fileControl = angular.element("#file");
        fileControl.on('change', function() {
            var filesSelected = fileControl[0].files;
            if (filesSelected.length > 0) {
                var fileToLoad = filesSelected[0];
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoadedEvent) {
                    var srcData = fileLoadedEvent.target.result; // <--- data: base64 
                    self.$scope.$apply(function() {
                        self.m.form.file = srcData;
                        self.$log.info('self.m.form.file', self.m.form.file);
                    });
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        });

        this.loadInitData();
    }

    loadInitData() {

        let thisClass = this;
        if (this.m.form.product_id > 0) {
            let service = this.API.service('load', this.API.all('crm0110'));
            let param = { product_id: this.m.form.product_id };
            service.post(param)
                .then(function(response) {
                    thisClass.$log.info('response', response);
                    thisClass.setInitValue(response.data.init);
                    thisClass.m.form = response.data.product;
                }, function(response) {
                    //ClientService.error('Đã có lỗi xãy ra');
                    // let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                    // RouteService.goState('app.supplierlist', { alerts: alert })
                });
        } else {
            let service = this.API.service('init', this.API.all('crm0110'));
            let param = {};
            service.post(param)
                .then(function(response) {
                    thisClass.$log.info('response', response);
                    thisClass.setInitValue(response.data.init);
                }, function(response) {
                    //ClientService.error('Đã có lỗi xãy ra');
                    // let alert = { type: 'error', 'title': 'Error!', msg: response.data.message }
                    // RouteService.goState('app.supplierlist', { alerts: alert })
                });
        }
    }

    setInitValue(initObj) {
        this.m.init = initObj;
        this.m.init.listWarranty = [0, 1, 2, 3, 4, 5, 6];
        if (angular.isUndefined(this.m.form.warranty_year) || this.m.form.warranty_year == null) {
            this.m.form.warranty_year = 1;
        }

        let sYear = (new Date().getFullYear() + "");
        this.m.form.thisYear = sYear.substr(sYear.length - 1);

        if (this.m.init.listSupplier != null && this.m.init.listSupplier.length > 0) {
            this.m.form.supplier_id = this.m.init.listSupplier[0].supplier_id;

            angular.forEach(this.m.init.listSupplier, function(item) {
                item.display = "(" + item.supplier_code + ") " + item.name;
            });
        }

        if (this.m.init.listCat1 != null && this.m.init.listCat1.length > 0) {
            // this.m.form.product_cat1_id = this.m.init.listProductCat1[0].product_cat1_id;

            angular.forEach(this.m.init.listCat1, function(item) {
                item.display = item.name;
            });
        }

        if (this.m.init.listCat2 != null && this.m.init.listCat2.length > 0) {
            // this.m.form.product_cat2_id = this.m.init.listProductCat2[0].product_cat2_id;

            angular.forEach(this.m.init.listCat2, function(item) {
                item.display = item.name;
            });
        }
    }

    save(isValid) {
        this.$log.info(isValid);
        this.$log.info("this.form", this.m.form);
        if (!isValid) {
            return;
        }
        this.m.errors = null;

        let thisClass = this;
        let action = 'create';
        if (this.m.form.product_id > 0) {
            action = 'update';
        }

        let service = this.API.service(action, this.API.all('crm0110'));

        let param = angular.copy(this.m.form);

        service.post(param)
            .then((response) => {
                thisClass.$log.info('ok response', response.plain().data);
                this.m.data = response.plain().data;
                let result = response.plain().data;
                if (result.rtnCd) {
                    thisClass.ClientService.success(result.msg);
                    thisClass.RouteService.goState('app.crm0100');
                }
            }, (response) => {
                thisClass.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });
    }
}

export const Crm0110Component = {
    // templateUrl: './views/app/components/crm0110/crm0110.component.html',
    templateUrl: '/views/admin.crm0110',
    controller: Crm0110Controller,
    controllerAs: 'vm',
    bindings: {}
}