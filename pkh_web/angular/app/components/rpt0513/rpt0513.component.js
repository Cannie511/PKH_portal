import { ReportDialogController } from '../report/report.dialog';
class Rpt0513Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, DialogService, ClientService,ChartService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.DialogService = DialogService;
        this.ClientService = ClientService;
        this.ChartService = ChartService;

        this.m = {
            download: [0, 0, 0, 0],
            activeFlag: 1,
            datetimepicker_options: {
                viewMode: 'years',
                format: 'YYYY'
            }
        }
        this.m.tab_name = ['','Overview', 'Nhập hàng', 'Giao hàng','Warranty','Hàng nợ','Profit'];

        for (var i=1; i<9; i++) {
            this.m[i] = {
                filter:{
                    year : moment().format('YYYY'),
                    data_type: 1,
                    view_mode: 1,
                    time_mode: "0",
                    tab : i,
                    current_rate: 23500,
                    supplier_id: ""
                },
                data:{
                    total : 0  
                }   
            }
        }
      
        // this.m.filter.order_date = new Date();
        this.onInit();
    }

    condition_direction(orderDirection, a_first, a_second){
        if (orderDirection == 'asc'){
            if (a_first > a_second){
                return true;
            } else {
                return false;
            }
        } else {
            if (a_first < a_second){
                return true;
            } else {
                return false;
            }
        }
    }

    sort_direction(orderBy,orderDirection){
        // this.$log.info('info 1');
        var temp = {};
        for (var i=0;i<this.m[7].data.length-1;i++){
            for (var j=i+1;j<this.m[7].data.length;j++){
                if (this.condition_direction(orderDirection, this.m[7].data[i][orderBy], this.m[7].data[j][orderBy])){
                    temp = this.m[7].data[i];
                    this.m[7].data[i] = this.m[7].data[j];
                    this.m[7].data[j] = temp;
                }
            }   
        }
    }

    sort(orderBy, activeFlag) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m[activeFlag].filter.orderBy, this.m[activeFlag].filter.orderDirection);
        this.m[activeFlag].filter.orderBy = orderOption.orderBy;
        this.m[activeFlag].filter.orderDirection = orderOption.orderDirection;
        // this.$log.info('info 2');
        this.sort_direction(orderBy,orderOption.orderDirection);
    }

    onInit() {
        let previousSearch = sessionStorage.rpt0513;
        this.loadInit();
        if (angular.isUndefined(previousSearch)) {
            this.loadData(3);
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
        let loadService = this.API.service('load-init', this.API.all('rpt0513'));
        // let param = angular.copy(this.m.filter);

        loadService.post()
            .then((response) => {
                this.$log.info(response);
                this.m.init  = response.plain().data;
            });
    }

    chooseTab(index) {
        if (index < 1 || index > 10) {
            return;
        }
        // this.$log.info('check : ',this.m);
        this.m.activeFlag = index;
        this.loadData(index);
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

        let servicePart1Child = this.API.service('load-data', this.API.all('rpt0513'));
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
        sessionStorage.rpt0513 = angular.toJson(param);
        $log.info('this.m[index].filter', this.m[index].filter);
        $log.info('param 1', param);
        servicePart1Child.post(param)
            .then(function(response) {
                // thisClass.m.downloadPart1[year] = 1;
                thisClass.m[index].data = response.data;
                // $log.info('data', thisClass.m[index].data);
                if (index == 7){
                    $log.info('param 1');
                    thisClass.makePriceList();
                }
            });

    }

    makePriceList(){
        let $log = this.$log;
        let current_rate = this.m[7].filter.current_rate;
        let discount= [44,47,50,53,56,59,62,67 ];
        angular.forEach(this.m[7].data, function(value) {
            value["cost"] = value.purchase_price/(1-10/100-0.35/100-0.3/100)*current_rate;
            for (let i = 0; i < discount.length; i++) {
                // $log.info('param 1', discount[i]);
                value["v"+discount[i].toString()] = value.selling_price*(1-discount[i]/100)- value["cost"];   
                value["p"+discount[i].toString()] = value["v"+discount[i].toString()]/value["cost"] *100;   
            }
        });
        $log.info('data ', this.m[7].data);
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
        param.index= activeFlag;
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
        param.index= activeFlag;

        let $log = this.$log;
        let root_title = "";
        let name = [];
        $log.info('param compare',param);

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
                name.push("Số lượng (cái)");
            } else {
                name.push("Số tiên USD");
            }
        }

        if (param['area_group_id']){
            for (var i=0;i<this.m.init.listAreaGroup.length;i++){
                $log.info('name',this.m.init.listAreaGroup[i]);
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
        let title ={
            0:  "So sánh giữa 4 năm " + root_title ,
            1:  "So sánh luỹ kế giữa 4 năm " + root_title,
            2:  "Chuyển động 4 năm " + root_title
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


    download(data) {
        let param = {
            data: data
        }
        let service = this.API.service('download', this.API.all('rpt0513'));
        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    $onInit() {}
}

export const Rpt0513Component = {
    //templateUrl: './views/app/components/rpt0513/rpt0513.component.html',
    templateUrl: '/views/admin.rpt0513.rpt0513',
    controller: Rpt0513Controller,
    controllerAs: 'vm',
    bindings: {}
}