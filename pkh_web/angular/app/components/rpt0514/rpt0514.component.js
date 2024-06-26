import { ReportDialogController } from '../report/report.dialog';
class Rpt0514Controller {
    constructor($scope, $state, $compile, $log, AclService, API, ClientService, DialogService, $stateParams, RouteService, ChartService, $filter) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;

        this.$log = $log;
        this.AclService = AclService;
        this.$compile = $compile;
        this.ChartService = ChartService;
        this.API = API;
        this.ClientService = ClientService;
        this.DialogService = DialogService;
        this.$filter = $filter;

        this.m = {
            chart:{},
            activeFlag: 1,
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        }
        this.m.tab_name = ['','Overview', 'Sản phẩm', 'Checkin','CS'];

        this.m.store_id = $stateParams.store_id;

        if (this.m.store_id == null || this.m.store_id <= 0) {

            this.ClientService.warning("Vui lòng chọn cửa hàng");
            RouteService.goState("app.crm0300");
            return;
        }
        for (var i=1; i<6; i++) {
            this.m[i] = {
                filter:{
                    year : moment().format('YYYY'),
                    data_type: 1,
                    view_mode: 1,
                    time_mode: "0",
                    tab : i,
                    current_rate: 23500
                },
                data:{
                    total : 0  
                }   
            }
        }
        this.onInit();
    }

    onInit() {
        let previousSearch = sessionStorage.rpt0514;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.loadData(2);
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
        let loadService = this.API.service('load-init', this.API.all('rpt0514'));
        // let param = angular.copy(this.m.filter);
        let param = {};
        param.store_id = this.m.store_id;
        loadService.post(param)
            .then((response) => {
                // this.$log.info(response);
                this.m.init  = response.plain().data;
            });
    }

    doSearch(index, page) {
        let $log = this.$log;
        // Get list product 

        let searchService = this.API.service('search', this.API.all('rpt0514'));
        let param = angular.copy(this.m[index].filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        param.index = index;
        param.page = page;
        param.store_id = this.m.store_id;
        sessionStorage.rpt0514= angular.toJson(param);
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                this.m[index].data  = response.plain().data.data;
                if (index==5){
                    var images  = this.m[index].data.images;

                    this.m[index].data.data.data.forEach(element => { 
                        element.images = this.$filter("filter")(images, {check_in_id: element.id});
                    });

                }
            });
    }

    chooseTab(index) {
        if (index < 1 || index > 10) {
            return;
        }
        // this.$log.info('check : ',this.m);
        this.m.activeFlag = index;
        switch (index){
            case 1: 
                this.loadOverview(index);
            case 2: 
                 this.loadData(index);
                 break;
            case 3: 
                this.doSearch(index,1);
                break;
            case 4: 
                this.doSearch(index,1);
                break;
            case 5: 
                this.doSearch(index,1);
                break;
        }
              
    }

    loadOverview(index){
        let thisClass = this;
        let $log = this.$log;

        let servicePart1Child = this.API.service('load-overview', this.API.all('rpt0514'));
        let year = null;
        let param = angular.copy(this.m[index].filter);
        param.index= index;
        param.store_id = this.m.store_id ;
        if (param.year == null) {
            year= moment();
            param.year = year.format('YYYY');
            this.m[index].filter = param;
        } else {
            param.year = moment(param.year).format('YYYY');
        }
        sessionStorage.rpt0514 = angular.toJson(param);
        
        servicePart1Child.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                thisClass.m[index].data = response.data;
                thisClass.createChartStatisticDelivery(thisClass.m[index].data.deliveryData);
            });
    }

    resetFilter(index) {
        if (index < 1 || index > 10) {
            return;
        }
        this.m[index].filter = {
           year : moment().format('YYYY'),
           data_type: 1,
           time_mode: "0",
           view_mode: 1,
            tab: index
        };
        this.loadData(index);
    }

    loadData(index) {
        let thisClass = this;
        let $log = this.$log;

        let servicePart1Child = this.API.service('load-data', this.API.all('rpt0514'));
        let year = null;
        let param = angular.copy(this.m[index].filter);
        param.index= index;
        param.store_id = this.m.store_id ;
        if (param.year == null) {
            year= moment();
            param.year = year.format('YYYY');
            this.m[index].filter = param;
        } else {
            param.year = moment(param.year).format('YYYY');
        }
        sessionStorage.rpt0514 = angular.toJson(param);
        
        servicePart1Child.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                thisClass.m[index].data = response.data;
            });

    }

    createChartStatisticDelivery(dataInput) {
        var chart = {};

        var series = ['Sales'];
        var colors = ['#BF465C'];
        var labels = [];
        var line1 = [];
       
        angular.forEach(dataInput, function(item) {
            labels.push(item.yearmonth);
            line1.push(item.total);
        });

        var data = [
            line1
        ];

        this.m.chart.chartStatisticDelivery = this.ChartService.get_angular_chart(series, colors, data, labels);
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
        param.index= 2;
        name.push(that.m.tab_name[activeFlag]);
        name.push(item['Name']);
        
        if ( param.index == 3 || param.index == 4){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                   
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        } else if (param.index==2){
            if (param['data_type'] == 1){
                name.push("Số lượng");
            } else {
                name.push("Số tiên USD");
            }
        }
      
        if (param['product_cat_id']){
            for (var i=0;i<this.m.init.catList.length;i++){
                if (this.m.init.catList[i].product_cat_id == param['product_cat_id']){
                    name.push(this.m.init.catList[i].name);
                    break;
                }
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
        if (param['area1']){
            for (var i=0;i<this.m.init.listArea1.length;i++){
                if (this.m.init.listArea1[i].area_id == param['area1']){
                    name.push(this.m.init.listArea1[i].name);
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

    draw_vertical(activeFlag, category){
        let data = this.m[activeFlag].data.data;
        let param = this.m[activeFlag].filter;
        param.index= activeFlag;

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

        if (param['import_type']){
          if (param['import_type'] == 1){
            name.push("Bảo hành");
          } else {
              name.push("Trả lại");
          }
        }

        if ( param.index == 3 || param.index == 4){
            if (param['data_type']){
                for (var i=0;i<this.m.init.listDataType.length;i++){
                   
                    if (this.m.init.listDataType[i].id == param['data_type']){
                        name.push(this.m.init.listDataType[i].name);
                        break;
                    }
                }
            }
        } else if (param.index==2){
            if (param['data_type'] == 1){
                name.push("Số lượng");
            } else {
                name.push("Số tiên USD");
            }
        }

        if (param['handle_id']){
            
            for (var i=0;i<this.m.init.handleList.length;i++){
                $log.info('handle name',this.m.init.handleList[i]);
                if (this.m.init.handleList[i].handle_id == param['handle_id']){
                    name.push(this.m.init.handleList[i].name);
                    break;
                }
            }
        }
      
       if (param['product_cat_id']){
            for (var i=0;i<this.m.init.catList.length;i++){
                // $log.info('name',this.m.init.catList[i]);
                if (this.m.init.catList[i].product_cat_id == param['product_cat_id']){
                    name.push(this.m.init.catList[i].name);
                    break;
                }
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
        if (param['area1']){
            for (var i=0;i<this.m.init.listArea1.length;i++){
                if (this.m.init.listArea1[i].area_id == param['area1']){
                    name.push(this.m.init.listArea1[i].name);
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

        $log.info('name',name);
        
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

    compare(item){
        let compareService = this.API.service('compare', this.API.all('rpt0513'));
        let year = null;
        let that = this;

        let param = angular.copy(that.m[that.m.activeFlag].filter);
        let activeFlag = that.m.activeFlag;
        param.id = item.id;
        param.year = null;
        param.index= 3;
        param.tab= 3;
        param.store_id = this.m.store_id;

        let $log = this.$log;
        let root_title = "";
        let name = [];
        $log.info('param compare',param);

        // name.push(that.m.tab_name[activeFlag]);
        name.push(item['Name']);
        
      
        
        // for (var i=0;i<name.length;i++){
        //     root_title = root_title +' - '+name[i];
        // }
        let title ={
            0:  "So sánh giữa 4 năm " + root_title + item.Name,
            1:  "So sánh luỹ kế giữa 4 năm " + root_title + item.Name,
            2:  "Chuyển động 4 năm " + root_title+ item.Name
        };

        compareService.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                let res = response.data;
                $log.info('res',res);
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

}

export const Rpt0514Component = {
    //templateUrl: './views/app/components/rpt0514/rpt0514.component.html',
                //  '/views/admin.rpt0513.rpt0513'
    templateUrl: '/views/admin.rpt0514.rpt0514',
    controller: Rpt0514Controller,
    controllerAs: 'vm',
    bindings: {}
}