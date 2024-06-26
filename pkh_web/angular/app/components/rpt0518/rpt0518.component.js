import { ReportDialogController } from '../report/report.dialog';
// import { ChartController } from '../report/chart';


class Rpt0518Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, DialogService, ClientService,ChartService){
        'ngInject';
        
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.ChartService = ChartService;
        // 
        this.m = {
            activeFlag: 1,  
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        };
        this.m.tab_name = ['','Overview', 'Giao hàng','Đặt hàng','Thanh toán','Hàng nợ','Waranty','Profit'];
        this.m.chart_name = ['Bar chart','Line chart','Pie chart'];
        for (var i=1; i<10; i++) {
            this.m[i] = {
                filter:{
                    data_type: 1,
                    time_mode: "0",
                    year : moment().format('YYYY'),
                },
                data:{
                    total : 0
                }
            }
        }
    }

    chooseTab(index) {
        if (index < 1 || index > 10) {
            return;
        }
        this.m.activeFlag = index;
        this.loadData(index)
    }

    $onInit(){
        let previousSearch = sessionStorage.rpt0518;
        // this.loadInit();
        this.loadInitData();
        if (angular.isUndefined(previousSearch)) {
            this.loadData(1);
            return;
        }

        previousSearch = angular.fromJson(previousSearch);
        var index = previousSearch.index;

        this.m.activeFlag = index;
        delete previousSearch['index'];
        this.m[index].filter = angular.copy(previousSearch);

        this.loadData(index);
    }

    loadInitData() {
        let self = this;
        let service = this.API.service('init', this.API.all('rpt0518'));
        let param = {};
        service.post(param)
            .then(function(response) {
                self.m.init = response.plain().data;
            });
    }

    resetFilter(index) {
        if (index < 1 || index > 10) {
            return;
        }
        this.m[index].filter = {
            data_type:1,
            time_mode: "0",
            year : moment().format('YYYY'),
        };
        this.loadData(index);
    }


    loadData(index) {
        // Get list product 
        let searchService = this.API.service('search', this.API.all('rpt0518'));
        let param = angular.copy(this.m[index].filter);
        param.index = index;
        param.down = 0;
        if (param.year == null) {
            year= moment();
            param.year = year.format('YYYY');
            this.m[index].filter = param;
        } else {
            param.year = moment(param.year).format('YYYY');
        }
        sessionStorage.rpt0518 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                this.$log.info(this.m);
                this.m[index].data = response.plain().data;
            });
    }

    title_for_bar(activeFlag, param, category){
       
        
        let root_title = moment(param.year).format('YYYY')+' '+this.m.tab_name[activeFlag]+' '+category;
        // $log.info('check param vertical: ',param);
        let name = [];
        if (param.index == 2 || param.index == 3){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                   
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        }
        

        if (param['areaGroup']){
            for (var i=0;i<this.m.init.listAreaGroup.length;i++){
                // $log.info('name',this.m.init.listAreaGroup[i]);
                if (this.m.init.listAreaGroup[i].area_group_id == param['areaGroup']){
                    name.push(this.m.init.listAreaGroup[i].name);
                    break;
                }
            }
        }
        if (param['area1']){
            for (var i=0;i<this.m.init.listArea1.length;i++){
                if (this.m.init.listArea1[i].area_id == param['area1']){
                    name.push(this.m.init.listArea1[i].name);
                    break;
                }
            }
        }

        if (param['salesman_id']){
            // $log.info('check sale: ',this.m.init.salesmanList);
            for (var i=0;i<this.m.init.salesmanList.length;i++){
                if (this.m.init.salesmanList[i].id == param['salesman_id']){
                    name.push(this.m.init.salesmanList[i].name);
                    break;
                }
            }
        }

        if (param['import_type']){
            if (param['import_type'] == 1){
              name.push("Bảo hành");
            } else {
                name.push("Trả lại");
            }
          }

        for (var i=0;i<name.length;i++){
            root_title = root_title +' - '+name[i];
        }
        return root_title;
    }

    title_for_line(activeFlag, param, category){
        let root_title = this.m.tab_name[activeFlag]+ ' ' + category;
        let name = [];
        if (param.index == 2 || param.index == 3){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                   
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        }

        if (param['import_type']){
            if (param['import_type'] == 1){
              name.push("Bảo hành");
            } else {
                name.push("Trả lại");
            }
          }
        for (var i=0;i<name.length;i++){
            root_title = root_title +' - '+name[i];
        }

        return root_title;
    }


    line_chart(item){
        let title = "";
        let that = this;
        let $log = this.$log;
        let param = angular.copy(that.m[that.m.activeFlag].filter);
        let data  = null;
        let category = item["Name"];
        let activeFlag = that.m.activeFlag;
        param.index = activeFlag;
        let root_title = this.title_for_bar(activeFlag, param, category);
     
        if (param.time_mode == 0){
            data = that.ChartService.get_line_by_month(item, param, root_title);
        } else {
            data = that.ChartService.get_line_by_year(item, root_title);
        }
        $log.info('data line',data);
        let modalOption = {
            size: 'dialog-1024',
            controller: ReportDialogController,
            resolve: {
                data:{1: data }
            }
        }
        that.DialogService.open('report_chart', modalOption);
    }


    draw_vertical(activeFlag, category){
        let data = this.m[activeFlag].data.data;
        let param = this.m[activeFlag].filter;
        param.index = activeFlag;
        let $log = this.$log;

        let key_name = 'Name';
      
        let root_title = this.title_for_bar(activeFlag, param, category);
     
        let title = 
        {
            0:  root_title ,
            1:  root_title
        };
        let data_chart = this.ChartService.get_vertical(data, param, title, category, key_name);

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
        let compareService = this.API.service('compare', this.API.all('rpt0518'));
        let year = null;
        let param = angular.copy(this.m[this.m.activeFlag].filter);
        let activeFlag = this.m.activeFlag;
        param.index =this.m.activeFlag;
        param.id = item.id;
        param.year = null;
        let $log = this.$log;
        let that = this;
        let root_title = this.title_for_line(activeFlag, param, item["Name"]);

        let title ={
            0:  "So sánh giữa 4 năm " + root_title ,
            1:  "So sánh luỹ kế giữa 4 năm " + root_title,
            2:  "Chuyển động 4 năm " + root_title
        };

        $log.info('param ', param);
        compareService.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                let res = response.data;
                $log.info('res ', res);
                let data = that.ChartService.get_compare(res, param, title);
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

    download(index) {
        let param = angular.copy(this.m[index].filter);
        let service = this.API.service('download', this.API.all('rpt0518'));
        param.down = 1;
        param.index =  index;
        service.post(param)
            .then((response) => {
                // this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const Rpt0518Component = {
    templateUrl: '/views/admin.rpt0518.rpt0518',
    controller: Rpt0518Controller,
    controllerAs: 'vm',
    bindings: {}
}
