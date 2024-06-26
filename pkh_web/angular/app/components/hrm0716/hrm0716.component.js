class Hrm0716Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;
        this.RouteService = RouteService;

        this.m = {
            employee_id: this.$stateParams.employee_id,
            contract_id: this.$stateParams.contract_id,
            init: {},
            form: {
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        if (this.m.contract_id > 0) {
            this.loadContract(this.m.contract_id);
        } else {
            // this.m.form.contract_no = "PKH-" + moment().format('YYYYMM') + '-';
            this.m.form.start_date = moment(new Date());
            this.m.form.end_date = moment(new Date()).add(1,'year');
        }
        if (this.m.employee_id > 0) {
            this.loadEmployee(this.m.employee_id);
        }
    }

    validate(model, form) {
        if( model.contract_no == null || model.contract_no == "") {
            this.ClientService.warning("Vui lòng nhập Mã hợp đồng");
            return false;
        }
        if( model.start_date == null || model.start_date == undefined ) {
            this.ClientService.warning("Vui lòng nhập Ngày bắt đầu");
            return false;
        }
        if( model.end_date == null || model.end_date == undefined ) {
            this.ClientService.warning("Vui lòng nhập Ngày kết thúc");
            return false;
        }
        if( model.contract_type == null || model.contract_type == undefined ) {
            this.ClientService.warning("Vui lòng nhập Loại");
            return false;
        }

        return true;
    }

    save(isValid, form) {
        if(this.validate(this.m.form, form)) {
            let param = angular.copy(this.m.form);
            param.start_date = this.UtilsService.momentToStringDate(param.start_date);
            param.end_date = this.UtilsService.momentToStringDate(param.end_date);
            param.id = parseInt(this.m.contract_id);
            param.employee_id = parseInt(this.m.employee_id);

            let service = this.API.service('save', this.API.all('hrm0716'));
            service.post(param)
                .then((response) => {
                    let result = response.data.data;
                    if( result.rtnCd == true ) {
                        this.ClientService.success(result.msg);
                        this.RouteService.goState('app.hrm0715', {id: this.m.employee_id});
                    } else {
                        this.ClientService.error(result.msg);
                    }
                }, (response) => {
                    this.m.errors = response.data.errors;
                });
        }
    }

    loadContract(id) {
        let param = { id: id };
        this.API.service('load-contract', this.API.all('hrm0716'))
            .post(param)
            .then((response) => {
                let data = response.data.data;
                data.salary = parseInt(data.salary);
                data.basic_salary = parseInt(data.basic_salary);
                this.m.form = response.data.data;
            });
    }

    loadEmployee(id) {
        let param = { id: id };
        this.API.service('load', this.API.all('hrm0711'))
            .post(param)
            .then((response) => {
                this.m.employee = response.data.data;
                if(this.m.contract_id == 0) {
                    let codePrefix = this.m.employee.employee_code.length > 6 ? this.m.employee.employee_code.substr(0,6) : "PH00000";
                    this.m.form.contract_no = codePrefix + "/" + moment().format('DDMMYYYY');
                }
            });
    }

    delete() {
        if( this.m.contract_id > 0) {
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this contract',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                html: false
            }, () => {
                let API = this.API
                let searchService = API.service('delete', API.all('hrm0716'));
                let param = {
                        id: this.m.contract_id
                    }

                searchService.post(param)
                    .then((response) => {
                        swal({
                            title: 'Reset!',
                            text: 'Contract has been reset.',
                            type: 'success',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, () => {
                            //$state.reload()
                            this.RouteService.goState('app.hrm0715', {id: this.m.employee_id});
                        })
                    });
            })   
        }
    }
}

export const Hrm0716Component = {
    //templateUrl: './views/app/components/hrm0716/hrm0716.component.html',
    templateUrl: '/views/admin.hrm0716',
    controller: Hrm0716Controller,
    controllerAs: 'vm',
    bindings: {}
}
