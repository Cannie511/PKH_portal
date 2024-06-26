import { Hrm0300DialogController } from './Hrm0300.dialog';
import { Hrm0300SubmitDialogController } from './Hrm0300_submit.dialog';
import { Hrm0300ScoreDialogController } from './Hrm0300_score.dialog';
class Hrm0300Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService,DialogService){
        'ngInject';

        
        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.m = {
            activeFlag: 1,
           
            list: null,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
            mapOption: {
            },
            button: {
                doing: false,
                finish: false,
                scoring: false,
                remind: false
            }
        }

        for (var i=1; i<6; i++) {
            this.m[i] = {
                filter:{
                  
                },
                data:{
                }   
            }
        }
       
    }

    $onInit() {
        this.init();
    }

    loadInitData() {
        let service = this.API.service('load-init', this.API.all('hrm0300'));
        service.post()
            .then((response) => {
                this.m.init = response.data; //initiate list of users
            });
    }

    init(){
        this.loadInitData();
        let previousSearch = sessionStorage.hrm0300;
        // this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.doSearch(1,1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        var index = previousSearch.index;
        this.m.activeFlag = index;

        delete previousSearch['page'];
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);
        this.doSearch(index, page);
    }

    resetFilter(index) {
        if (index < 1 || index > 5) {
            return;
        }
        this.m[index].filter = {
      
        };
        this.doSearch(index, 1);
    }


    chooseTab(index) {
        if (index < 1 || index > 5) {
            return;
        }
        this.m.activeFlag = index;
        this.doSearch(index,1)
    }

    doSearch(index,page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('hrm0300'));
        let param = angular.copy(this.m[index].filter);
        param.down = 0;
        param.page = page;
        param.index = index;
    
        sessionStorage.hrm0300 = angular.toJson(param);

        searchService.post(param)
            .then((response) => {
                
                this.m[index].data = response.plain().data.data;
                // this.$log.info(this.m);
                
            });
    }

    updateSts(item){
        if (this.m.button.doing == true) {
            swal("Processing!")
            return;
        }

        this.m.button.doing = true;

        let searchService = this.API.service('update', this.API.all('hrm0300'));
        let param = angular.copy(this.m[1].filter);
        let ClientService = this.ClientService; 
        param.task_sts = item.task_sts +1;
        param.task_id = item.task_id;
        param.user_id = item.user_id;
        param.task_creator_mail = item.task_creator_mail;
        searchService.post(param)
            .then((response) => {
              if (response.data.oke){
                     ClientService.success('Update task successfully');

              } else {
                ClientService.error('permission deny');
              }
              this.m.button.doing = false;
              this.init();  
        });
    }

    get_detail(item) {
        let modalOption;
        let DialogClose;
        let that = this;
       
        let param = {
            task: item
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Hrm0300DialogController,
            resolve: {
                param: param
            }
        };
        DialogClose = this.DialogService.open('hrm0300_detail_dialog', modalOption);
        DialogClose.result.then(function(data) {
            
        });
    }

    submit(item) {
       
        let modalOption;
        let DialogClose;
        let that = this;
        
        let param = {
            task: item
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Hrm0300SubmitDialogController,
            resolve: {
                param: param
            }
        };
       
        DialogClose = this.DialogService.open('hrm0300_submit_dialog', modalOption);
        DialogClose.result.then(function(data) {
            that.init();  
        });
        
    }

    score(item) {
      
        let modalOption;
        let DialogClose;
        let that = this;
       
        let param = {
            task: item
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Hrm0300ScoreDialogController,
            resolve: {
                param: param
            }
        };
        DialogClose = this.DialogService.open('hrm0300_score_dialog', modalOption);
        DialogClose.result.then(function(data) {
            that.init();  
        });
    }

    download(activeFlag){
        let param = angular.copy(this.m[activeFlag].filter);
        let service = this.API.service('download', this.API.all('hrm0300'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }


}

export const Hrm0300Component = {
    templateUrl: './views/admin.hrm0300.hrm0300',
    controller: Hrm0300Controller,
    controllerAs: 'vm',
    bindings: {}
}
