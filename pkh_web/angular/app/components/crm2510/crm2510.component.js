class Crm2510Controller{
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

        if ($stateParams.product_market_id > 0) {
            this.m.form.product_market_id = $stateParams.product_market_id;
        } else {
            this.m.form.product_market_id = 0;
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
                    self.$log.info('srcData', srcData);
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
        if (this.m.form.product_market_id > 0) {
            let service = this.API.service('load', this.API.all('crm2510'));
            let param = {
                product_market_id: this.m.form.product_market_id
            };
            service.post(param)
                .then((response) => {
                    this.m.form = response.plain().data.product;
                    this.m.form.type = this.m.form.type.toString();
                }, (response) => {
                    this.$log.info('ng response', response);
                    this.m.errors = response.data.errors;
                });
        }
    }

    save(isValid) {
        if (!isValid) {
            return;
        }
        this.m.errors = null;

        let thisClass = this;
        let action = 'create';
        if (this.m.form.product_market_id > 0) {
            action = 'update';
        }

        let service = this.API.service(action, this.API.all('crm2510'));

        let param = angular.copy(this.m.form);

        service.post(param)
            .then((response) => {
                thisClass.$log.info('ok response', response.plain().data);
                this.m.data = response.plain().data;
                let result = response.plain().data;
                if (result.rtnCd) {
                    thisClass.ClientService.success(result.msg);
                    thisClass.RouteService.goState('app.crm2500');
                }
            }, (response) => {
                thisClass.$log.info('ng response', response);
                this.m.errors = response.data.errors;
            });
    }
}

export const Crm2510Component = {
    //templateUrl: './views/app/components/crm2510/crm2510.component.html',
    templateUrl: '/views/admin.crm2510',
    controller: Crm2510Controller,
    controllerAs: 'vm',
    bindings: {}
}
