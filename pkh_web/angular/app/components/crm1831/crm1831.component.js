class Crm1831Controller {
    constructor($scope, $state, $log, API, UtilsService, ClientService, $stateParams, RouteService, AclService) {
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
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                // viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }
        this.m.cost_id = $stateParams.cost_id;
        this.m.isSaving = false;
    }

    $onInit() {
        this.m.form.cost_date = moment();
        //this.$log.info('ahihi', this.m);
        this.loadInit();
    }

    nomarlizeData(data) {
        if (!data) {
            return;
        }
        this.m.form.department_id = data.department_id;
        this.m.form.cost_cat_id = data.cost_cat_id;
        this.m.form.cost_date = new Date(data.cost_date);
        this.m.form.confirm_time = new Date(data.confirm_time);
        this.m.form.cancel_time = new Date(data.cancel_time);
        this.m.form.created_at = new Date(data.created_at);

        this.m.form.amount = parseInt(data.amount);
        this.m.form.contra_account = data.contra_account;
        this.m.form.voucher = data.voucher;
        this.m.form.description   = data.description;
        this.m.form.cost_sts      = data.cost_sts;
        this.m.form.request_notes = data.request_notes;
        this.m.form.confirm_notes = data.confirm_notes;
        this.m.form.cancel_notes  = data.cancel_notes;

        this.m.form.confirm_by = data.confirm_by;
        this.m.form.created_by = data.created_by
    }

    loadInit() {
        let param = {
            cost_id: this.m.cost_id
        };
        let service = this.API.service('load-init', this.API.all('crm1831'));
        service.post(param)
            .then((response) => {
                this.m.init.departments = response.data.departments;
                this.m.init.costcats = response.data.costcats;
                this.nomarlizeData(response.data.form);
                this.$log.info('m init: ',this.m);
            });
    }

    checkCondition(form) {
        let ClientService = this.ClientService;
        if (!form.voucher || form.voucher == "") {
            ClientService.error("Chưa nhập số chứng từ");
            return false;
        }
        if (!form.cost_date || form.cost_date == "") {
            ClientService.error("Chưa nhập ngày hoặc ngày không đúng định dạng");
            return false;
        }
        if (!form.description || form.description == "") {
            ClientService.error("Chưa nhập diễn giải");
            return false;
        }
        if (!form.contra_account || form.contra_account == "") {
            ClientService.error("Chưa nhập tài khoản đối ứng");
            return false;
        }
        if (!form.cost_cat_id || form.cost_cat_id == "") {
            ClientService.error("Chưa chọn loại chi phí");
            return false;
        }
        if (!form.department_id || form.department_id == "") {
            ClientService.error("Chưa chọn phòng ban");
            return false;
        }
        if (!form.amount || form.amount == "") {
            ClientService.error("Chưa nhập phát sinh nợ");
            return false;
        }
        if (!form.request_notes || form.request_notes == "") {
            ClientService.error("Chưa nhập request_notes");
            return false;
        }
        return true;
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
        if (!that.checkCondition(that.m.form)) {
            return;
        }

        let param = angular.copy(that.m.form);
        param.cost_id = that.m.cost_id;
        param.cost_date =  moment(param.cost_date).format('YYYY-MM-DD');
        that.$log.info('param: ',param);
        swal({
            title: "Bạn có muốn lưu thông tin chi phí này",
            text: "Thông tin không thể sửa sau khi lưu",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('save', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let id = response.data;
                    ClientService.success(id);
                    that.m.cost_id = id;
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                    
                });
        });


    }

    sendRequest(){
        let that = this;
        let param = angular.copy(that.m.form);
        param.cost_id = this.m.cost_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn đề xuất duyệt chi phí này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('send-request', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }

    accpet(){
        let that = this;
        let param = angular.copy(that.m.form);
        param.cost_id = this.m.cost_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn duyệt xuất duyệt chi phí này",
            text: "Thông tin sau khi duyệt sẽ được bộ phận kế toán chi trả ",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('accept', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }

    deny(){
        let that = this;
        let param = angular.copy(that.m.form);
        param.cost_id = this.m.cost_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn không duyệt xuất duyệt chi phí này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('accept', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }

    accountantConfirm(){
        let that = this;
        let param = angular.copy(that.m.form);
        param.cost_id = this.m.cost_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn xác nhận chi trả",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('acc-confirm', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }

    clickRequestCancel(){
        let that = this;
        let param = angular.copy(that.m.form);
        param.cost_id = this.m.cost_id;
        let ClientService = that.ClientService;
        swal({
            title: "Bạn có muốn huỷ đề xuất thanh toán này",
            text: "Thông tin không thể sửa sau khi đề xuất",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let saveService = that.API.service('cancel', that.API.all('crm1831'));
            saveService.post(param)
                .then(function(response) {
                    let msg = response.data;
                    ClientService.success(msg);
                    // RouteService.goState('app.crm1830');
                    that.loadInit();
                });
        });
    }
}

export const Crm1831Component = {
    //templateUrl: './views/app/components/crm1831/crm1831.component.html',
    templateUrl: '/views/admin.crm1831',
    controller: Crm1831Controller,
    controllerAs: 'vm',
    bindings: {}
}