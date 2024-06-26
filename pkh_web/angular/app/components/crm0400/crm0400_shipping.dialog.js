export class Crm0400ShippingDialogController {
    constructor($scope, ClientService, $uibModalInstance, DialogService, $log, $filter,API, param) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;
        this.API = API
        this.ClientService = ClientService;

        //his.$log.info('dialog param', param);
        this.m = {
            delivery: param.delivery,
            form: {
                item: param.delivery
            }
        }
        this.m.isSubmit== false;
        // this.API = param.API;
        this.$log.info('check dialog submit: ', this.m);
        this.loadInit();
    }

    loadInit(){ 
        let param = {
            delivery_start_date: this.m.delivery.delivery_time,
            delivery_end_date: moment(new Date()).format('YYYY-MM-DD')
        };
        let service = this.API.service('load-init-shipping', this.API.all('crm0400'));
        service.post(param)
            .then((response) => {
                // this.$log.info('info', response);
                this.m.shippingList = response.data.shippingList;
                
            }); 
    }


    finish() {
        if (this.m.isSubmit== true) {
            swal("Processing!")
            return;
        }

        let self = this;
        swal({
            title: "Bạn có chắc chắn sự vận chuyển này",
            text: "Sau khi xác nhận sẽ không thể thay đổi",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Yes',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           self.confirmFinish();
        });   
    }

    confirmFinish(){
        this.m.isSubmit = true;
        let ClientService = this.ClientService;

        let searchService = this.API.service('shipping', this.API.all('crm0400'));
        this.m.form.store_delivery_id = this.m.delivery.store_delivery_id;
       
        let param = angular.copy(this.m.form);
        // this.$log.info('we can send it: ', this.m);
        searchService.post(param)
            .then((response) => {
                if (response.data.oke){
                    ClientService.success('Update task successfully');

             } else {
               ClientService.error('permission deny');
             }
                 this.m.isSubmit = false;
                this.DialogService.close();
            });
    }

    cancel(){
        this.DialogService.close();
    }
}