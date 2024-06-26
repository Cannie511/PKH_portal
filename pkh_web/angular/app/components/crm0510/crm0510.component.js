class Crm0510Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService){
        'ngInject';
        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            param: {},
            form: {},
            dateOptions: {

                // formatYear: 'yy',
                startingDay: 1
            }
            ,
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
        // this.$log.info($stateParams);

        this.m.param.store_id = $stateParams.store_id;
        this.m.param.cs_id = $stateParams.cs_id;
        if (this.m.param.store_id == null || this.m.param.store_id <= 0) {
            this.ClientService.warning("Vui lòng chọn cửa hàng");
            RouteService.goState("app.crm0300");
            return;
        }
        //
    }

    loadInitData() {
        let param = {
            store_id: this.m.param.store_id,
            cs_id: this.m.param.cs_id
        };
        let log = this.$log;

        let service = this.API.service('load-init', this.API.all('crm0510'));
        service.post(param)
            .then((response) => {
                if (this.m.param.cs_id!=null){
                    this.m.form  = response.data.inforCs; 
                }
                this.m.store = response.data.store;
            });
    }

    $onInit(){
        this.loadInitData();
    }

    condition_to_save(param){
        let ClientService = this.ClientService;

        let current_time = moment(new Date()).format('YYYY-MM-DD');

        if (current_time >  moment(param.deadline).format('YYYY-MM-DD') ){
            ClientService.error('Deadline không hợp lệ');
            return false;
        } 

        if ((param.cus_review.length)<20){
            ClientService.error('Độ dài customer feedback phải lớn hơn 20');
            return false;
        }

        return true;
    }

    clickSave(){
        var self = this;

        swal({
            title: "Bạn có muốn lưu",
            text: "Sau khi bấm lưu sẽ không thể thay đổi, vui lòng kiểm tra kĩ thông tin.",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           self.save();
        });
    }

    save() {
        var self = this;
        if (self.m.isSaved == true) {
            swal("Đang xử lý!")
            return;
        }
        let RouteService = self.RouteService;
        let ClientService = self.ClientService;
        let saveService = self.API.service('save', self.API.all('crm0510'));
        let param = angular.copy(self.m.form);
        

        // Check fields are valid or not to further proceed
        if (!this.condition_to_save(param)){
            return;
        }
        self.m.isSaved = true;

        if (self.m.param.cs_id == null) {
            param.cs_id = null;
        } else {
            param.cs_id = self.m.param.cs_id;
        }

        param.deadline = moment(param.deadline).format('YYYY-MM-DD 23:55:00');
        param.store_id = self.m.store.store_id ;
        param.pic_id = self.m.store.salesman_id ;
        param.status = 0;

        saveService.post(param)
            .then(function(response) {
                self.m.isSaved = false;

                if (param.cs_id == null) {
                    ClientService.success('Thêm mới thành công');

                } else {
                    ClientService.success('Cập nhật thành công');

                }

                RouteService.goState('app.crm0500');
            });

    }
}

export const Crm0510Component = {
    templateUrl: '/views/admin.crm0510',
    controller: Crm0510Controller,
    controllerAs: 'vm',
    bindings: {}
}
