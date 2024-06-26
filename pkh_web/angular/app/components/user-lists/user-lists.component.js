class UserListsController {
    constructor($scope, $state, $compile, DTOptionsBuilder, DTColumnBuilder, API, $log) {
        'ngInject'
        this.API = API
        this.$state = $state
        this.$log = $log;
        this.DTOptionsBuilder = DTOptionsBuilder;
        this.DTColumnBuilder = DTColumnBuilder;
        this.$compile = $compile;
        this.$scope = $scope;
    }

    $onInit() {
        this.loadData();
    }

    loadData() {
        let Users = this.API.service('users');
        let DTOptionsBuilder = this.DTOptionsBuilder;
        let DTColumnBuilder = this.DTColumnBuilder;

        Users.getList()
            .then((response) => {
                let dataSet = response.plain()
                this.dtOptions = DTOptionsBuilder.newOptions()
                    .withOption('data', dataSet)
                    .withOption('createdRow', createdRow)
                    .withOption('responsive', true)
                    .withBootstrap()

                this.dtColumns = [
                    DTColumnBuilder.newColumn('id').withTitle('ID'),
                    DTColumnBuilder.newColumn('name').withTitle('Name'),
                    DTColumnBuilder.newColumn('email').withTitle('Email'),
                    DTColumnBuilder.newColumn('role_name').withTitle('Role'),
                    DTColumnBuilder.newColumn('branch_name').withTitle('Branch'),
                    // DTColumnBuilder.newColumn('employee').withTitle('Employee'),
                    DTColumnBuilder.newColumn(null).withTitle('Employee').notSortable()
                        .renderWith((data) => {
                            let html = '';
                            if(data.employee == 'TRUE') {
                                html = '<i class="fas fa-check text-success"></i>';
                            } else {
                                html = '<i class="fas fa-times text-warning"></i>';
                            }

                            return html;
                        }),
                    DTColumnBuilder.newColumn(null).withTitle('Actions').notSortable()
                    .renderWith(actionsHtml)
                ]

                this.displayTable = true
            })

        let createdRow = (row) => {
            this.$compile(angular.element(row).contents())(this.$scope)
        }

        let actionsHtml = (data) => {

            let htmlAddEmployee = "";

            if(data.employee == 'FALSE') {
                htmlAddEmployee = `
                    <button class="btn btn-xs btn-primary" ng-click="vm.addEmployee(${data.id})">
                        <i class="fa fa-plus"></i>
                    </button>
                `;
            }

            return `
                <a class="btn btn-xs btn-warning" ui-sref="app.useredit({userId: ${data.id}})">
                    <i class="fa fa-edit"></i>
                </a>
                &nbsp;
                <button class="btn btn-xs btn-danger" ng-click="vm.delete(${data.id})">
                    <i class="fa fa-trash-o"></i>
                </button>
                &nbsp;
                <button class="btn btn-xs btn-warning" ng-click="vm.resetPass(${data.id})">
                    <i class="fa fa-key"></i>
                </button>
                &nbsp;
                ${htmlAddEmployee}
            `
        }
    }

    delete(userId) {
        let API = this.API
        let $state = this.$state

        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            API.one('users').one('user', userId).remove()
                .then(() => {
                    swal({
                        title: 'Deleted!',
                        text: 'User Permission has been deleted.',
                        type: 'success',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function() {
                        $state.reload()
                    })
                })
        })
    }

    resetPass(userId) {
        let API = this.API

        swal({
            title: 'Are you sure?',
            text: 'Reset password for this user!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, reset it!',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let searchService = API.service('reset-pass', API.all('users'));
            let param = {
                    id: userId
                }
                //param.pageSize = $scope.m.paginationInfo.pageSize;

            searchService.post(param)
                .then((response) => {
                    swal({
                        title: 'Reset!',
                        text: 'User Password has been reset.',
                        type: 'success',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function() {
                        //$state.reload()
                    })
                });
        })
    }

    addEmployee(userId) {
        let API = this.API;
        let self = this;

        swal({
            title: 'Are you sure?',
            text: 'Create employee for this user!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#204d74',
            confirmButtonText: 'Yes, create it!',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let searchService = API.service('create-employee', API.all('users'));
            let param = {
                    id: userId
                }
                //param.pageSize = $scope.m.paginationInfo.pageSize;

            searchService.post(param)
                .then((response) => {
                    swal({
                        title: 'Create!',
                        text: 'Employee has been created.',
                        type: 'success',
                        confirmButtonText: 'OK',
                        closeOnConfirm: true
                    }, function() {
                        self.$state.reload()
                        // this.loadData();
                    })
                });
        })
    }

    
}

export const UserListsComponent = {
    templateUrl: './views/app/components/user-lists/user-lists.component.html',
    controller: UserListsController,
    controllerAs: 'vm',
    bindings: {}
}