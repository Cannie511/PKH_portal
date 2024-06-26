export class Crm0500FinishDialogController {
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
            cs: param.cs,
            form: {
                
            }
        }
        this.m.edit = param.edit;
        this.m.isSubmit== false;
    }


    finish() {
        let ClientService = this.ClientService;

        if ((this.m.form.com_resolve.length)<15){
            ClientService.error('Độ dài customer feedback phải lớn hơn 15 kí tự');
            return ;
        }
        if (this.m.isSubmit== true) {
            swal("Processing!")
            return;
        }

        let self = this;
        swal({
            title: "Do you want to finish a task?",
            text: "After confirming, information can not be changed",
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

        let searchService = this.API.service('update', this.API.all('crm0510'));
        this.m.form.status = 1;
        let param = angular.copy(this.m.form);

       
        param.cs_id = this.m.cs.cs_id;
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