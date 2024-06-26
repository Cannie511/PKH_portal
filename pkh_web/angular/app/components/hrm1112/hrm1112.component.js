class Hrm1112Controller{
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
        
        // this.loadInitData();

        this.m.init.id = id > 0 ? id : 0;
        if (this.m.init.id > 0 ) {
            this.load(this.m.init.id);
        } else {
            this.m.form = {
                id : this.m.init.id
            };
        }
        console.log('test', this.m);
    }

    /**
     * Load init data
     */
    // loadInitData() {
    //     let service = this.API.service('init-data', this.API.all('hrm1112'));
    //     service.post({})
    //         .then((response) => {
    //             let id = this.m.init.id;
    //             this.m.init = response.data;
    //             this.m.init.id = id;
    //         });
    // }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(id) {
        let service = this.API.service('load', this.API.all('hrm1112'));
        let param = { id: id };
        service.post(param)
            .then((response) => {
                let element = response.data.data;

                // convert int
                let intFields = [
                    "advance", "basic_salary", "bonus", "com_tax_bhtn", 
                    "com_tax_bhtn_percent", "com_tax_bhxh", "com_tax_bhxh_percent", "com_tax_bhyt",
                    "com_tax_bhyt_percent", "count_dependent_person", "gross_salary", "min_salary_area",
                    "minus_amount", "net_salary", "real_salary", "tax_bhtn", "tax_bhtn_percent", 
                    "tax_bhxh", "tax_bhxh_percent", "tax_bhyt", "tax_bhyt_percent", "tax_pit", "tax_pit_edit",
                    "overtime_salary"
                ];
                intFields.forEach((item) => {
                    if (element[item] != null ) {
                        element[item] = parseFloat(element[item] || 0);
                    } else {
                        element[item] = 0;
                    }
                });

                element.total_income = parseInt(element.real_salary) + parseInt(element.overtime_salary) + parseInt(element.bonus);
                // element.com_total = parseInt(element.net_salary) 
                //         + parseInt(element.tax_bhxh) 
                //         + parseInt(element.tax_bhyt) 
                //         + parseInt(element.tax_bhtn)
                //         + parseInt(element.tax_pit)
                //         + parseInt(element.com_tax_bhxh) 
                //         + parseInt(element.com_tax_bhyt) 
                //         + parseInt(element.com_tax_bhtn);
                element.com_total = parseInt(element.real_salary) 
                        + parseInt(element.com_tax_bhxh) 
                        + parseInt(element.com_tax_bhyt) 
                        + parseInt(element.com_tax_bhtn);

                let year = parseInt(element.from_date.substr(0,4));
                console.log('year :>> ', year);
                let basicPIT = 9000000;
                if (year >= 2021) {
                    basicPIT = 11000000;
                }

                // element.total_dependent_amount = 9000000 + 4400000 * parseInt(element.count_dependent_person);
                element.total_dependent_amount = basicPIT + 4400000 * parseInt(element.count_dependent_person);
                element.total_in_tax = Math.max(element.com_total - element.total_dependent_amount, 0);
                this.m.form = element;
                console.log('this.m.form :>> ', this.m.form);
            });

    }

    validate(model, form) {
        //if( model.start_date == null || model.start_date == undefined ) {
        //    this.ClientService.warning("Vui lòng nhập Ngày bắt đầu");
        //    return false;
        //}

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

            // convert int
            let intFields = [
                "total_days", "total_hours", "gross_salary", "basic_salary", "count_dependent_person",
                "tax_pit_edit", "overtime_salary", "bonus", "minus_amount", "advance"
            ];
            intFields.forEach((item) => {
                if (param[item] != null ) {
                    param[item] = parseFloat(param[item] || 0);
                }
            });

            let service = this.API.service('save', this.API.all('hrm1112'));
            service.post(param)
                .then((response) => {
                    let result = response.data.data;
                    if( result.rtnCd == true ) {
                        this.ClientService.success(result.msg);
                        this.m.form.id = result.id;
                        this.m.init.id = result.id;
                        // this.RouteService.goState('app.hrm0810', {id: this.m.id});
                        this.$state.reload();
                    } else {
                        this.ClientService.error(result.msg);
                    }
                }, (response) => {
                    this.m.errors = response.data.errors;
                });
        }
    }

    delete() {
        if( this.m.init.id > 0) {
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this hrm1112',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                html: false
            }, () => {
                let API = this.API
                let searchService = API.service('delete', API.all('hrm1112'));
                let param = {
                        id: this.m.init.id
                    }

                searchService.post(param)
                    .then((response) => {
                        swal({
                            title: 'Reset!',
                            text: 'hrm1112 has been deleted.',
                            type: 'success',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, () => {
                            //$state.reload()
                            this.RouteService.goState('app.hrm1112');
                        })
                    });
            })   
        }
    }
}

export const Hrm1112Component = {
    //templateUrl: './views/app/components/hrm1112/hrm1112.component.html',
    templateUrl: '/views/admin.hrm1112',
    controller: Hrm1112Controller,
    controllerAs: 'vm',
    bindings: {}
}
