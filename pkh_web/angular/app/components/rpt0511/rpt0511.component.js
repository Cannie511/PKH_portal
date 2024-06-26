import { ReportDialogController } from '../report/report.dialog';
class Rpt0511Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, DialogService,ChartService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.DialogService = DialogService;
        this.ChartService = ChartService;

        this.m = {
            
            activeFlag: 1,
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        }
        for (var i=1; i<5; i++) {
            this.m[i] = {
                filter:{
                    year : moment().format('YYYY'),
                    data_type: "1"
                },
                data:{
                    total : 0  
                }   
            }
        }
        // this.m.filter.order_date = new Date();
        this.onInit();
    }

    onInit() {
        let previousSearch = sessionStorage.rpt0511;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.loadData(1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var index = previousSearch.index;

        this.m.activeFlag = index;
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);
        this.loadData(this.m.activeFlag);
    }

    loadInit(){
        let loadService = this.API.service('load-init', this.API.all('rpt0511'));
        // let param = angular.copy(this.m.filter);

        loadService.post()
            .then((response) => {
                this.$log.info(response);
                this.m.init  = response.plain().data;
            });
    }

    chooseTab(index) {
        if (index < 1 || index > 9) {
            return;
        }
        // this.$log.info('check : ',this.m);
        this.m.activeFlag = index;
        this.loadData(index)
    }

    resetFilter(index) {
        if (index < 1 || index > 9) {
            return;
        }
        this.m[index].filter = {
           year : moment().format('YYYY'),
           data_type: "1"
        };
        this.loadData(index);
    }

      
    loadData(index) {
        let thisClass = this;
        let $log = this.$log;

        let servicePart1Child = this.API.service('load-data', this.API.all('rpt0511'));
        let year = null;
        let param = angular.copy(this.m[index].filter);
        param.index= index;
        if (param.year == null) {
            year= moment();
            param.year = year.format('YYYY');
            this.m[index].filter = param;
        } else {
            param.year = moment(param.year).format('YYYY');
        }
        sessionStorage.rpt0511 = angular.toJson(param);

        $log.info('param ', param);
        servicePart1Child.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                thisClass.m[index].data = response.data;
                $log.info(thisClass.m);
            });

    }
    
    draw_vertical(activeFlag, category){
        let data = this.m[activeFlag].data.data;
        let param = this.m[activeFlag].filter;
        let $log = this.$log;
        let key_name = 'Name';
        
        let data_chart = this.ChartService.get_vertical(data, param, category, key_name);

        let modalOption = {
            size: 'dialog-1024',
            controller: ReportDialogController,
            resolve: {
                data: {1: data_chart }
            }
        };

        this.DialogService.open('report_chart', modalOption);
       
    }

    compare(item){

        let $log = this.$log;

        let compareService = null;
        let that = this;
        let param = angular.copy(item);
        if (that.m.activeFlag == 1){
            compareService =   that.API.service('compare', that.API.all('rpt0518'));
        } else  if (that.m.activeFlag == 2){
            param.index = 1;
            compareService =   that.API.service('compare', that.API.all('rpt0512'));
        }  if (that.m.activeFlag == 3){ 
            compareService =   that.API.service('compare', that.API.all('rpt0513'));
            param.type = 2;
            param.area_group_id = that.m[that.m.activeFlag].filter.area_group_id;
            param.data_type = that.m[that.m.activeFlag].filter.data_type;
        }
       
        $log.info('test param:',param);

        compareService.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                let res = response.data;
                $log.info('test response:',res);
                let data = that.ChartService.get_compare(res, item);
                let modalOption = {
                    size: 'dialog-1024',
                    controller: ReportDialogController,
                    resolve: {
                        data:data
                    }
                }
                that.DialogService.open('report_chart', modalOption);
            });
    }


}

export const Rpt0511Component = {
    //templateUrl: './views/app/components/rpt0511/rpt0511.component.html',
    templateUrl: '/views/admin.rpt0511.rpt0511',
    controller: Rpt0511Controller,
    controllerAs: 'vm',
    bindings: {}
}