class Hrm0810Controller{
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
            init: {},
            form: {
                // changed_date: moment(new Date())
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }
        // THIS IS DEFAULT TEMPLATE
    }

    $onInit(){
        let id = this.$stateParams.id;
        
        this.loadInitData();

        this.m.init.id = id > 0 ? id : 0;
        if (this.m.init.id > 0 ) {
            this.load(this.m.init.id);
        } else {
            this.m.form = {
                id : this.m.init.id,
                expired_date: moment().endOf('year')
            };
        }
    }

    /**
     * Load init data
     */
    loadInitData() {
        let service = this.API.service('init-data', this.API.all('hrm0810'));
        service.post({})
            .then((response) => {
                let listEmployee = response.data.listEmployee;
                // listEmployee.forEach(item => {
                //     item.display = "[" + item.employee_code + "] " + item.fullname;
                // });
                // this.m.init = response.data;
                this.m.init.listEmployee = listEmployee;
            });
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(id) {
        let service = this.API.service('load', this.API.all('hrm0810'));
        let param = { id: id };
        service.post(param)
            .then((response) => {
                let data = response.data.data;
                if (data.num_days) {
                    data.num_days = parseInt(data.num_days);
                } else {
                    data.num_days = 0;
                }
                this.m.form = data;
            });
    }

    validate(model, form) {
        //if( model.start_date == null || model.start_date == undefined ) {
        //    this.ClientService.warning("Vui lòng nhập Ngày bắt đầu");
        //    return false;
        //}

        return true;
    }

    save(isValid, form) {
        if(this.validate(this.m.form, form)) {
            let param = angular.copy(this.m.form);

            // convert moment to date 'YYYY-MM-DD'
            let dateFields = ["expired_date"];
            dateFields.forEach((item) => {
                if (param[item] != null ) {
                    param[item] = param[item].format('YYYY-MM-DD');
                }
            });

            let service = this.API.service('save', this.API.all('hrm0810'));
            service.post(param)
                .then((response) => {
                    let result = response.data.data;
                    if( result.rtnCd == true ) {
                        this.ClientService.success(result.msg);
                        this.m.form.id = result.id;
                        this.m.init.id = result.id;
                        // this.RouteService.goState('app.hrm0810', {id: this.m.id});
                    } else {
                        this.ClientService.error(result.msg);
                    }
                }, (response) => {
                    this.m.errors = response.data.errors;
                });
        }
    }

    // delete() {
    //     if( this.m.contract_id > 0) {
    //         swal({
    //             title: 'Are you sure?',
    //             text: 'Do you want to delete this contract',
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#DD6B55',
    //             confirmButtonText: 'Yes, delete it!',
    //             closeOnConfirm: false,
    //             showLoaderOnConfirm: true,
    //             html: false
    //         }, () => {
    //             let API = this.API
    //             let searchService = API.service('delete', API.all('hrm0716'));
    //             let param = {
    //                     id: this.m.contract_id
    //                 }

    //             searchService.post(param)
    //                 .then((response) => {
    //                     swal({
    //                         title: 'Reset!',
    //                         text: 'Contract has been reset.',
    //                         type: 'success',
    //                         confirmButtonText: 'OK',
    //                         closeOnConfirm: true
    //                     }, () => {
    //                         //$state.reload()
    //                         this.RouteService.goState('app.hrm0715', {id: this.m.employee_id});
    //                     })
    //                 });
    //         })   
    //     }
    // }
}

export const Hrm0810Component = {
    //templateUrl: './views/app/components/hrm0810/hrm0810.component.html',
    templateUrl: '/views/admin.hrm0810',
    controller: Hrm0810Controller,
    controllerAs: 'vm',
    bindings: {}
}
