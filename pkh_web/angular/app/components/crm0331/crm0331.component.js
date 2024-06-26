class Crm0331Controller {
    constructor($scope, $state, $stateParams, $compile, $log, AclService, API, UtilsService, RouteService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService;
        this.ClientService = ClientService;
        this.formSubmitted = false;

        this.m = {
            form: {
                storeWorkingId: null,
                storeId: null,
                file: null,
                pathFile: null
            }
        }
        this.m.form.storeWorkingId = $stateParams.store_working_id;
        this.m.form.storeId = $stateParams.store_id;
        $log.info('storeWorkingId:', this.m.form.storeWorkingId);
        $log.info('storeId:', this.m.form.storeId);

        if (this.m.form.storeId == null || this.m.form.storeId <= 0) {
            this.ClientService.warning("Vui lòng chọn cửa hàng");
            RouteService.goState("app.crm0300");
            return;
        }
        this.loadInitData();
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
    }

    loadInitData() {
        let $log = this.$log;
        let b = this;
        if (!(this.m.form.storeWorkingId == null || this.m.form.storeWorkingId <= 0)) {
            let service = b.API.service('load', b.API.all('crm0331'));
            let param = { storeWorkingId: b.m.form.storeWorkingId, storeId: b.m.form.storeId };

            service.post(param)
                .then(function(response) {
                    if( response.data.storeWorking && response.data.storeWorking.length > 0 ) {
                        b.m.form.storeName = response.data.storeWorking[0].store;
                        b.m.form.listSalesman = response.data.storeWorking[0].salesman;
                        b.m.form.notes = response.data.storeWorking[0].notes;
                    }
                    
                    if(response.data.image && response.data.image.length > 0)
                        b.m.form.pathFile = response.data.image[0].img_path;
                });
        } else {
            let service = b.API.service('init', b.API.all('crm0331'));
            let param = { storeId: b.m.form.storeId };
            service.post(param)
                .then(function(response) {
                    b.m.form.storeName = response.data.item.name;
                    b.m.form.listSalesman = response.data.listSalesman;
                });
        }
    }

    save(isValid) {
        let $log = this.$log;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let m = this.m;
        let param = angular.copy(this.m.form);
        // var file = document.querySelector('#files > input[type="file"]').files[0];
        $log.info('param', param);
        if (isValid) {
            $log.info('save');
            let crm0310Service = this.API.service('save', this.API.all('crm0331'));
            crm0310Service.post(param)
                .then(function(response) {
                    if (m.form.storeWorkingId != null) {
                        ClientService.success('Cập nhật thông tin theo dõi cửa hàng thành công');
                    } else {
                        ClientService.success('Thêm mới thông tin theo dõi cửa hàng thành công');
                    }
                    RouteService.goState('app.crm0330')
                });
        } else {
            this.formSubmitted = true
        }
    }
}

export const Crm0331Component = {
    //templateUrl: './views/app/components/crm0331/crm0331.component.html',
    templateUrl: '/views/admin.crm0331',
    controller: Crm0331Controller,
    controllerAs: 'vm',
    bindings: {}
}