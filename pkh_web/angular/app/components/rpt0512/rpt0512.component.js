import { ReportDialogController } from '../report/report.dialog';
class Rpt0512Controller {
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
            download: [0, 0, 0, 0],
            activeFlag: 1,
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        }

        this.m.tab_name = ['', 'Giao hàng', 'Đặt hàng','Thanh toán','','Cửa hàng mới','Bảo hành'];

        for (var i=1; i<7; i++) {
            this.m[i] = {
                filter:{
                    data_type: 1,
                    view_mode: 1,
                    time_mode: "0",
                    year : moment().format('YYYY')
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
        let previousSearch = sessionStorage.rpt0512;
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
        let loadService = this.API.service('load-init', this.API.all('rpt0512'));
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
            data_type: 1,
            view_mode: 1,
            time_mode: "0",
            year : moment().format('YYYY')
        };
        this.loadData(index);
    }

      
    loadData(index) {
        let thisClass = this;
        let $log = this.$log;

        let servicePart1Child = this.API.service('load-data', this.API.all('rpt0512'));
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
        sessionStorage.rpt0512 = angular.toJson(param);

        $log.info('param ', param);
        servicePart1Child.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                $log.info('thisClass.m[index] ', thisClass.m[index]);

                thisClass.m[index].data = response.data;
            });

    }

    draw_vertical(activeFlag, category){
        let data = this.m[activeFlag].data.data;
        let param = this.m[activeFlag].filter;
        let $log = this.$log;
        let key_name = 'Name';
        let root_title = "";

        let name = [];

        if (param["time_mode"]==0){
            name.push(moment(param.year).format('YYYY'));
        }
        name.push(" Top 15 theo ");
        name.push(this.m.tab_name[activeFlag]);
        name.push(category);

        if (param['area_group_id']){
            for (var i=0;i<this.m.init.listAreaGroup.length;i++){
                // $log.info('name',this.m.init.listAreaGroup[i]);
                if (this.m.init.listAreaGroup[i].area_group_id == param['area_group_id']){
                    name.push(this.m.init.listAreaGroup[i].name);
                    break;
                }
            }
        }
    
        $log.info('name',name);
       
        if (activeFlag == 1 || activeFlag ==2){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        }
        if (param['salesman_id']){
            for (var i=0;i<this.m.init.salesmanList.length;i++){
                if (this.m.init.salesmanList[i].id == param['salesman_id']){
                    name.push(this.m.init.salesmanList[i].name);
                    break;
                }
            }
        }
        for (var i=0;i<name.length;i++){
            root_title = root_title +' - '+name[i];
        }
        let title ={
            0:  root_title ,
            1:  root_title
        };
        let data_chart = this.ChartService.get_vertical(data, param,title, category, key_name);

        let modalOption = {
            size: 'dialog-1024',
            controller: ReportDialogController,
            resolve: {
                data: {1: data_chart }
            }
        };

        this.DialogService.open('report_chart', modalOption);
       
    }

    line_chart(item){
        let title = "";
        let that = this;
        let $log = this.$log;
        let param = angular.copy(that.m[that.m.activeFlag].filter);
        let data  = null;
        let root_title =  "";
        let name = [];
        let activeFlag = that.m.activeFlag;
        name.push(that.m.tab_name[activeFlag]);
        name.push(item['Name']);
        
        if (activeFlag == 1 || activeFlag ==2){
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
        if (param['area_group_id']){
            for (var i=0;i<this.m.init.listAreaGroup.length;i++){
                // $log.info('name',this.m.init.listAreaGroup[i]);
                if (this.m.init.listAreaGroup[i].area_group_id == param['area_group_id']){
                    name.push(this.m.init.listAreaGroup[i].name);
                    break;
                }
            }
        }
        if (param['salesman_id']){
            for (var i=0;i<this.m.init.salesmanList.length;i++){
                if (this.m.init.salesmanList[i].id == param['salesman_id']){
                    name.push(this.m.init.salesmanList[i].name);
                    break;
                }
            }
        }
        for (var i=0;i<name.length;i++){
            root_title = root_title +' - '+name[i];
        }
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



    compare(item){  
        let compareService = this.API.service('compare', this.API.all('rpt0512'));
        
        let that = this;
        let param = angular.copy(that.m[that.m.activeFlag].filter);
        let activeFlag = that.m.activeFlag;

        param.index = that.m.activeFlag;
        // id of area : area id
        param.id = item.id;
        // To load 3 year of area id
        param.year = null; 
        let root_title =  "";
        let name = [];

        name.push(that.m.tab_name[activeFlag]);
        name.push(item['Name']);
        if (activeFlag == 1 || activeFlag ==2){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        }
      
        for (var i=0;i<name.length;i++){
            root_title = root_title +' - '+name[i];
        }
        let title ={
            0:  "So sánh giữa 4 năm " + root_title ,
            1:  "So sánh luỹ kế giữa 4 năm " + root_title,
            2:  "Chuyển động 4 năm " + root_title
        };
         // $log.info('param ', param);  
         compareService.post(param)
         .then(function(response) {
             // thisClass.m.downloadPart1[year] = 1;
             let res = response.data;
             
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


    $onInit() {}
}

export const Rpt0512Component = {
    //templateUrl: './views/app/components/rpt0512/rpt0512.component.html',
    templateUrl: '/views/admin.rpt0512.rpt0512',
    controller: Rpt0512Controller,
    controllerAs: 'vm',
    bindings: {}
}