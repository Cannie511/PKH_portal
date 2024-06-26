class Hrm1111Controller{
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
            // this.m.form = {
            //     id : this.m.init.id
            // };
            this.ClientService.error('Không tin tìm thấy dữ liệu');
            this.RouteService.goState('app.hrm1100');
        }
    }

    /**
     * Load init data
     */
    loadInitData() {
        let service = this.API.service('init-data', this.API.all('hrm1111'));
        service.post({})
            .then((response) => {
                let id = this.m.init.id;
                this.m.init = response.data;
                this.m.init.id = id;

                this.filterListEmployee();
            });
    }

    /**
     * Load entity
     * @param {int} id Entity id
     */
    load(id) {
        let service = this.API.service('load', this.API.all('hrm1111'));
        let param = { id: id };
        service.post(param)
            .then((response) => {

                if (response.data.salaryInfo == undefined 
                    || response.data.salaryInfo == null) {
                    this.ClientService.error('Không tin tìm thấy dữ liệu');
                    this.RouteService.goState('app.hrm1100');
                    return;
                }
                let form = response.data;
                let summary = {
                    gross_salary: 0,
                    basic_salary: 0,
                    real_salary: 0,
                    overtime_salary: 0,
                    bonus: 0,
                    total_income: 0,
                    tax_bhxh: 0,
                    tax_bhyt: 0,
                    tax_bhtn: 0,
                    tax_pit: 0,
                    minus_amount: 0,
                    advance: 0,
                    net_salary: 0,
                    com_tax_bhxh: 0,
                    com_tax_bhyt: 0,
                    com_tax_bhtn: 0,
                    com_total: 0,
                };
                form.listEmployee.forEach(element => {
                    element.total_income = parseInt(element.real_salary) + parseInt(element.overtime_salary) + parseInt(element.bonus);
                    element.com_total = parseInt(element.net_salary) 
                        + parseInt(element.tax_bhxh) 
                        + parseInt(element.tax_bhyt) 
                        + parseInt(element.tax_bhtn)
                        + parseInt(element.tax_pit)
                        + parseInt(element.com_tax_bhxh) 
                        + parseInt(element.com_tax_bhyt) 
                        + parseInt(element.com_tax_bhtn);
                    // summary
                    summary.gross_salary += parseInt(element.gross_salary);
                    summary.basic_salary += parseInt(element.basic_salary);
                    summary.real_salary += parseInt(element.real_salary);
                    summary.overtime_salary += parseInt(element.overtime_salary);
                    summary.bonus += parseInt(element.bonus);
                    summary.total_income += parseInt(element.total_income);
                    summary.tax_bhxh += parseInt(element.tax_bhxh);
                    summary.tax_bhyt += parseInt(element.tax_bhyt);
                    summary.tax_bhtn += parseInt(element.tax_bhtn);
                    summary.tax_pit += parseInt(element.tax_pit);
                    summary.minus_amount += parseInt(element.minus_amount);
                    summary.advance += parseInt(element.advance);
                    summary.net_salary += parseInt(element.net_salary);
                    summary.com_tax_bhxh += parseInt(element.com_tax_bhxh);
                    summary.com_tax_bhyt += parseInt(element.com_tax_bhyt);
                    summary.com_tax_bhtn += parseInt(element.com_tax_bhtn);
                    summary.com_total += parseInt(element.com_total);
                });
                this.m.form = form;
                this.m.form.summary = summary;

                this.filterListEmployee();
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
            let param = angular.copy(this.m.form.salaryInfo);
            param.id = this.m.init.id;

            // convert moment to date 'YYYY-MM-DD'
            // let dateFields = ["dob", "start_date", "end_date", "probation_start_date", "probation_end_date", "card_id_issue_on"];
            // dateFields.forEach((item) => {
            //     if (param[item] != null ) {
            //         param[item] = param[item].format('YYYY-MM-DD');
            //     }
            // });

            let service = this.API.service('save', this.API.all('hrm1111'));
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

    delete(item) {
        swal({
            title: 'Are you sure?',
            text: `Do you want to remove this ${item.fullname}`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, remove it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            let API = this.API
            let searchService = API.service('remove', API.all('hrm1111'));
            let param = {
                id: item.id,
                salary_id: this.m.init.id
            };

            searchService.post(param)
                .then((response) => {

                    let data = response.data;
                    console.log('data :', data);
                    
                    if (data.rtnCd == true) {
                        swal({
                            title: 'Remove!',
                            text: `${item.fullname} has been deleted.`,
                            type: 'success',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, () => {
                            //
                            // this.RouteService.goState('app.hrm1111');
                            // this.load(this.m.init.id);
                        })
                        this.$state.reload();
                    } else {
                        this.ClientService.error(data.rtnCd.msg);
                    }
                });
        })   
    }

    onAddEmployee() {
        console.log('add employee', this.m.form);

        if ( !(this.m.form.newEmployee > 0) ) {
            this.ClientService.warning("Vui lòng chọn nhân viên");
            return;
        }

        let item = this.m.form.newEmployee;
        swal({
            title: 'Are you sure?',
            text: `Do you want to add this employee`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, add it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            let API = this.API
            let searchService = API.service('add', API.all('hrm1111'));
            let param = {
                employee_id: item,
                salary_id: this.m.init.id
            };

            searchService.post(param)
                .then((response) => {

                    let data = response.data;
                    console.log('data :', data);
                    
                    if (data.rtnCd == true) {
                        swal({
                            title: 'Added!',
                            text: `Employee has been added.`,
                            type: 'success',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true
                        }, () => {
                            //
                            // this.RouteService.goState('app.hrm1111');
                            // this.load(this.m.init.id);
                        })
                        this.$state.reload();
                    } else {
                        this.ClientService.error(data.rtnCd.msg);
                    }
                });
        })   
    }

    clickApprove() {
        // this.updateStatus('approve', 2, "");
        swal({
            title: 'Are you sure?',
            text: 'Do you want to approve this?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, approve it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            this.updateStatus('approve', 2, this.m.form.salaryInfo.notes);
        });
    }

    clickDeny() {
        // this.updateStatus('approve', 0, "");
        swal({
            title: 'Are you sure?',
            text: 'Do you want to deny this?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, deny it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            this.updateStatus('approve', 0, this.m.form.salaryInfo.notes);
        });
    }

    clickSend() {
        // this.updateStatus('send', 1, "");
        swal({
            title: 'Are you sure?',
            text: 'Do you want to send this?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, send it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            this.updateStatus('send', 1, this.m.form.salaryInfo.notes);
        });
    }

    updateStatus(action, status, notes) {
        let service = this.API.service(action, this.API.all('hrm1111'));
        let param = {
            id: this.m.init.id,
            status: status,
            notes: notes
        };
        service.post(param)
            .then((response) => {
                let result = response.data.data;
                if( result.rtnCd == true ) {
                    this.ClientService.success(result.msg);
                    // this.RouteService.goState('app.hrm1111', {id: this.m.init.id});
                    this.$state.reload();
                } else {
                    this.ClientService.error(result.msg);
                }
            }, (response) => {
                this.m.errors = response.data.errors;
            });
    }

    filterListEmployee() {
        let listEmployeeDropDown = this.m.init.listEmployee || [];
        let listEmpolyeeTable = this.m.form.listEmployee || [];
        let listEmployee2 = [];
        let listId = [];

        listEmpolyeeTable.forEach(item => {
            listId.push(item.employee_id);
        });

        listEmployeeDropDown.forEach(item => {
            if (listId.indexOf(item.employee_id) < 0) {
                listEmployee2.push(item);
            }
        });

        this.m.init.listEmployee2 = listEmployee2;
    }

    download() {
        let param = {
            id: this.m.init.id
        };
    
        this.API.service('download', this.API.all('hrm1111'))
            .post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    sendAll() {
        let param = {
            id: this.m.init.id
        };
    
        this.API.service('send-all', this.API.all('hrm1111'))
            .post(param)
            .then((response) => {
                // this.ClientService.downloadFileOneTime(response.data.file);
                console.log('response.data', response.data);
                //this.ClientService.success(response.data.msg);
                this.ClientService.success("Đã gửi");
            });
    }
}

export const Hrm1111Component = {
    //templateUrl: './views/app/components/hrm1111/hrm1111.component.html',
    templateUrl: '/views/admin.hrm1111',
    controller: Hrm1111Controller,
    controllerAs: 'vm',
    bindings: {}
}
