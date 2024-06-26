class Crm2910Controller{
    constructor($scope, $state, $log, API, UtilsService, ClientService, $stateParams, RouteService, AclService){
        'ngInject'
        this.$state = $state;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.can = AclService.can;
        this.m = {
            form: {},
            init: {},
        }
        this.m.warehouse_id = $stateParams.warehouse_id;
        this.m.isSaving = false;
    }

    $onInit() {
     
        //this.$log.info('ahihi', this.m);
        this.loadInit();
    }
    loadInit() {
        let param = {
            warehouse_id: this.m.warehouse_id
        };
        let service = this.API.service('load-init', this.API.all('crm2910'));
        service.post(param)
            .then((response) => {
                this.$log.info('m init: ',this.m);
                this.m.form = response.data.form;
                
            });
    }
    save() {
        //let $log = this.$log;
        let that = this;
        let alerts = that.alerts;
        let RouteService = that.RouteService;
        let ClientService = that.ClientService;
        if (that.m.isSaving == true) {
            swal("Đang xử lý!")
            return;
        }
        that.m.isSaving = true;
       

        let param = angular.copy(that.m.form);
        param.warehouse_id = that.m.warehouse_id;
        that.$log.info('param: 1',param);
        swal({
            title: "Bạn có muốn lưu thông tin kho này",
            text: "Thông tin không thể sửa sau khi lưu",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('save', that.API.all('crm2910'));
            saveService.post(param)
                .then(function(response) {
                    let id = response.data;
                    // ClientService.success(id);
                    that.m.warehouse_id = id;
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                    
                });
                
        });


    }


}

export const Crm2910Component = {
    templateUrl: '/views/admin.crm2910',
    controller: Crm2910Controller,
    controllerAs: 'vm',
    bindings: {}
}
