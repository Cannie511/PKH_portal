export class Hrm0300SubmitDialogController {
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
            task: param.task,
            form: {
                
            }
        }
        this.m.isSubmit== false;
        // this.API = param.API;
        this.$log.info('check dialog submit: ', this.m);
    }


    finish() {
        if (this.m.isSubmit== true) {
            swal("Processing!")
            return;
        }

        let self = this;
        swal({
            title: "Do you want to finish a task?",
            text: "After confirming your manager will be notified your finished task",
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

        let searchService = this.API.service('update', this.API.all('hrm0300'));
        this.m.form.task_sts = this.m.task.task_sts +1;
        this.m.form.task_id = this.m.task.task_id;
        let param = angular.copy(this.m.form);
        param.user_id = this.m.task.user_id;
        param.task_creator_mail = this.m.task.task_creator_mail;

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