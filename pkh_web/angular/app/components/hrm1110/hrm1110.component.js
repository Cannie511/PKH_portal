class Hrm1110Controller{
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
                salary_month: moment(new Date()).startOf('month').startOf('day'),
                // from_date: moment(new Date()).startOf('month').startOf('day'),
                // to_date: moment(new Date()).endOf('month').startOf('day')
            },
            dateOptions: {
                format: 'YYYY-MM-DD'
            },
            dateMonthOptions: {
                format: 'YYYY-MM'
            }
        }
        // THIS IS DEFAULT TEMPLATE
        // console.log('this.m :', this.m);
        
    }

    $onInit(){
        let id = this.$stateParams.id;
        
        this.loadInitData();

        this.m.init.id = id > 0 ? id : 0;
        if (this.m.init.id > 0 ) {
            this.load(this.m.init.id);
        } else {
            this.m.form.id = this.m.init.id;
        }
    }

    /**
     * Load init data
     */
    loadInitData() {
        let service = this.API.service('init-data', this.API.all('hrm1110'));
        service.post({})
            .then((response) => {
                let id = this.m.init.id;
                this.m.init = response.data;
                this.m.init.id = id;
            });
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(id) {
        let service = this.API.service('load', this.API.all('hrm1110'));
        let param = { id: id };
        service.post(param)
            .then((response) => {
                this.m.form = response.data.data;
            });

    }

    validate(model, form) {
        if( model.salary_month == null || model.salary_month == undefined ) {
           this.ClientService.warning("Vui lòng nhập tháng");
           return false;
        }

        return true;
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */

    save(isValid, form) {
        if(this.validate(this.m.form, form)) {
            let param = angular.copy(this.m.form);

            // convert moment to date 'YYYY-MM-DD'
            // let dateFields = ["dob", "start_date", "end_date", "probation_start_date", "probation_end_date", "card_id_issue_on"];
            // dateFields.forEach((item) => {
            //     if (param[item] != null ) {
            //         param[item] = param[item].format('YYYY-MM-DD');
            //     }
            // });
            param.salary_month = param.salary_month.format('YYYY-MM-01');

            let service = this.API.service('save', this.API.all('hrm1110'));
            service.post(param)
                .then((response) => {
                    let result = response.data;
                    console.log('response.data :', response.data);
                    
                    if( result.rtnCd == true ) {
                        this.ClientService.success(result.msg);
                        this.RouteService.goState('app.hrm1111', {id: result.id});
                    } else {
                        this.ClientService.error(result.msg);
                    }
                }, (response) => {
                    this.m.errors = response.data.errors;
                });
        }
    }

    // delete() {
    //     if( this.m.init.id > 0) {
    //         swal({
    //             title: 'Are you sure?',
    //             text: 'Do you want to delete this hrm1110',
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#DD6B55',
    //             confirmButtonText: 'Yes, delete it!',
    //             closeOnConfirm: false,
    //             showLoaderOnConfirm: true,
    //             html: false
    //         }, () => {
    //             let API = this.API
    //             let searchService = API.service('delete', API.all('hrm1110'));
    //             let param = {
    //                     id: this.m.init.id
    //                 }

    //             searchService.post(param)
    //                 .then((response) => {
    //                     swal({
    //                         title: 'Reset!',
    //                         text: 'hrm1110 has been deleted.',
    //                         type: 'success',
    //                         confirmButtonText: 'OK',
    //                         closeOnConfirm: true
    //                     }, () => {
    //                         //$state.reload()
    //                         this.RouteService.goState('app.hrm1110');
    //                     })
    //                 });
    //         })   
    //     }
    // }
}

export const Hrm1110Component = {
    //templateUrl: './views/app/components/hrm1110/hrm1110.component.html',
    templateUrl: '/views/admin.hrm1110',
    controller: Hrm1110Controller,
    controllerAs: 'vm',
    bindings: {}
}
