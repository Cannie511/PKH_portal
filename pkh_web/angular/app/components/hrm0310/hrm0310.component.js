class Hrm0310Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService){
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.m = {
            filter: {},
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            }
        }

        this.m.task_id = $stateParams.task_id;
        this.m.isSaved = false;
        this.$log.info("state param",$stateParams.task_id );
        this.$log.info("task id",this.m.task_id );
    }

    
    $onInit(){
        this.loadInitData();
    }

    save() {
        if (this.m.isSaved == true) {
            swal("Processing!")
            return;
        }
        let ClientService = this.ClientService;
        let param = angular.copy(this.m.filter);
        if (this.m.task_id == null) {
            param.task_id = null;
        } else {
            param.task_id = this.m.task_id;
        }
        if (!param.task_name){
            ClientService.error('Please enter task name');
            return ;
        } 
        if (!param.user_id){
            ClientService.error('Please choose person to assign');
            return ;
        }
        if (!param.task_content){
            ClientService.error('Please enter task content');
            return ;
        }

        let self = this;
        swal({
            title: "Do you want to create a task?",
            text: "After confirm your task will be created",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Yes',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           self.confirmSave();
        });
    }

    confirmSave(){

        if (this.m.isSaved == true) {
            swal("Processing!")
            return;
        }

        this.m.isSaved = true;

        let $log = this.$log;
        //$log.info('aihihihihi', this.m.filter);
        let alerts = this.alerts;
        let RouteService = this.RouteService;
        let ClientService = this.ClientService;
        let saveService = this.API.service('save', this.API.all('hrm0310'));
        let param = angular.copy(this.m.filter);

        saveService.post(param)
            .then((response) => {

                if (param.payment_id == null) {
                    ClientService.success('Add new task successfully');

                } else {
                    ClientService.success('Update task successfully');

                }
                RouteService.goState('app.hrm0300');
                this.m.isSaved = false;

                
            });
    }

    loadInitData() {
        let param = {
        
            task_id: this.m.task_id
        };

        let service = this.API.service('load-init', this.API.all('hrm0310'));
        service.post(param)
            .then((response) => {
                this.m.init = response.data; //initiate list of bank account
                
                if (this.m.task_id != null){

                    this.m.filter.deadline = new Date(this.m.init.task[0].deadline);
                    this.m.filter.task_group_id = this.m.init.task[0].task_group_id;
                    this.m.filter.user_id = this.m.init.task[0].user_id;
                    this.m.filter.task_name = this.m.init.task[0].task_name;
                    this.m.filter.task_content = this.m.init.task[0].task_content;
                }
            });
    }

}

export const Hrm0310Component = {
    templateUrl: './views/admin.hrm0310',
    controller: Hrm0310Controller,
    controllerAs: 'vm',
    bindings: {}
}
