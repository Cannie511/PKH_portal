import { Crm0500FinishDialogController } from './crm0500_finish.dialog';

class Crm0500Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService,DialogService){
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.m = {
            filter: {},
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        };
        //
    }



    loadInit(){
        this.title = ["Pending", "Done"];

        for (var i=1; i<13; i++) {
            this.m[i] = {
                filter:{
                    orderBy: 'updated_at'
                    , orderDirection :'desc'
                },
                data:{
                    total : 0
                }
                , title : this.title[i-1]
            }
        }
        this.init();

        let previousSearch = sessionStorage.crm0500;
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
        this.doSearch(index,page);

    }

    init(){
        let loadService = this.API.service('load-init', this.API.all('crm0500'));
        // let param = angular.copy(this.m.filter);

        loadService.post()
            .then((response) => {
                // this.$log.info(response);
                this.m.init  = response.plain().data;
            });
    }

    $onInit(){
        this.loadInit();
    }

    search() {
        this.doSearch(1,1);
    }

   resetFilter(index) {
       
        this.m[index].filter = {
            orderBy:  'updated_at',
            orderDirection: 'desc'
        };
        this.doSearch(index, 1);
    }

    chooseTab(index) {
       
        this.m.activeFlag = index;
        this.doSearch(index,1)
    }

    doSearch(index, page) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0500'));
        let param = angular.copy(this.m[index].filter);
        param.page = page;
        param.index = index;

        sessionStorage.crm0500 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                
                this.m[index].data = response.plain().data.data;
               
            });
    }

    finish(item, is_edit) {
       
        let modalOption;
        let DialogClose;
        let that = this;
       
        let param = {
            cs: item,
            edit: is_edit
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Crm0500FinishDialogController,
            resolve: {
                param: param
            }
        };
       
        DialogClose = this.DialogService.open('crm0500_finish_dialog', modalOption);
        DialogClose.result.then(function(data) {
            that.search();  
        });
        
    }
}

export const Crm0500Component = {
    templateUrl: '/views/admin.crm0500.crm0500',
    controller: Crm0500Controller,
    controllerAs: 'vm',
    bindings: {}
}
