class DashboardController {
    constructor($scope, $state, API, $log, $stateParams, RouteService, ClientService, AclService, ChartService) {
        'ngInject'

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.ClientService = ClientService;
        this.$scope = $scope;
        this.RouteService = RouteService;
        this.can = AclService.can;
        this.ChartService = ChartService;
        this.$stateParams = $stateParams;

        this.m = {};
        this.m.is_carton = false;
        this.m.activeFlag = 10;
        // this.init();
    }

    $onInit() {
        this.RouteService.goState('app.crm0300');
    }

    // init() {
    //     let previousTab = sessionStorage.dashboard;

    //     this.chartStatisticOrder = null;
    //     this.chartStatisticDelivery = null;

    //     let param = {};

    //     let service = this.API.service('init-data', this.API.all('das0100'));
    //     service.post(param)
    //         .then((response) => {
    //             this.m = response.data;
    //             this.m.activeFlag = 10;
    //             if (!angular.isUndefined(previousTab)) {
    //                 previousTab = angular.fromJson(previousTab);
    //                 this.m.activeFlag = previousTab.tab;
    //             }

    //             angular.forEach(this.m.needToPay, function(item) {
    //                 item.hide = false;
    //             });

    //             angular.forEach(this.m.warehouse, function(item) {
    //                 item.hide = false;
    //             });

    //             // this.createChartStatisticOrder(); 
    //             this.createChartStatisticDelivery();
    //             this.createChartStatisticSpecificSalesman();
    //             this.createChartStatisticDeliveryQuarter();
    //             this.calcWarehousePrice();
    //             this.calcWarehouseVol();
    //         });
    // }

    doSearchReport(){
        let param = angular.copy(this.m.filter);

        let service = this.API.service('search-report', this.API.all('das0100'));
        service.post(param)
            .then((response) => {
                this.m.so1Turnover = response.data.so1Turnover;
                this.m.so2Turnover = response.data.so2Turnover;
                this.m.so3Turnover = response.data.so3Turnover;
                this.m.so4Turnover = response.data.so4Turnover;
                this.m.statisticDelivery = response.data.statisticDelivery;
                this.m.activeFlag = 10;
              
                // this.createChartStatisticOrder(); 
                this.createChartStatisticDelivery();
                this.createChartStatisticSpecificSalesman();
                this.createChartStatisticDeliveryQuarter();
               
            });
    }

    selectPayment(){
        let order_type_pay = this.m.filter.order_type_pay;
        let $log = this.$log;
        $log.info('order_type_payr', order_type_pay);
        angular.forEach(this.m.needToPay, function(item) {
            item.hide = false;
            if (order_type_pay==1){
                if  (item.store_id != 2125 && item.store_id!= 1946 && item.store_id != 1969 ){
                    item.hide = true;
                }
            } else if (order_type_pay==2){
                if  (item.store_id == 2125 ||item.store_id== 1946|| item.store_id == 1969 ){
                    item.hide = true;
                }
            }
        });
    }

    recalculate(){
        let $log = this.$log;
        let supplier = this.m.supplier_id_wh;
        $log.info('supplier', supplier);
        angular.forEach(this.m.warehouse, function(item) {
            item.hide = false;
            if ((supplier!=null) && (item.supplier_id != supplier)){
                item.hide = true;
            }
        });
        this.calcWarehousePrice();
        this.calcWarehouseVol();
    }


    calcWarehousePrice() {
        let sum = 0;
        let sum_list = {};
        let $log = this.$log;
        let that = this;
        angular.forEach(that.m.warehouseList, function(item) {
            sum_list[item.warehouse_id] = 0 ;
        });
        // let sum_1 = 0;
        // let sum_2 = 0;
        // let sum_3 = 0;
        // let sum_4 = 0;
        // let sum_5 = 0;
        if (that.m.warehouse != null) {
            angular.forEach(that.m.warehouse, function(item) {
                //this.m.count.warehouse++;
                if (item.hide != true){
                    if (item.amount > 0) {
                        sum += parseInt(item.selling_price) * parseInt(item.amount);
                    }
                    angular.forEach(that.m.warehouseList, function(item_sub) {
                        if (item[item_sub.warehouse_label] > 0) {
                            sum_list[item_sub.warehouse_id] += parseInt(item.selling_price) * parseInt(item[item_sub.warehouse_label] );
                        }
                    });
                    
                    // if (item.amount_2 > 0) {
                    //     sum_2 += parseInt(item.selling_price) * parseInt(item.amount_2);
                    // }
                    // if (item.amount_3 > 0) {
                    //     sum_3 += parseInt(item.selling_price) * parseInt(item.amount_3);
                    // }
                    // if (item.amount_4 > 0) {
                    //     sum_4 += parseInt(item.selling_price) * parseInt(item.amount_4);
                    // }
                    // if (item.amount_5 > 0) {
                    //     sum_5 += parseInt(item.selling_price) * parseInt(item.amount_5);
                    // }
                }
            });
        }
        $log.info('sum_list', sum_list);
        this.m.sumWarehouse    = sum;
        this.m.sumWarehouse_no = sum_list;
        // this.m.sumWarehouse_2 = sum_2;
        // this.m.sumWarehouse_3 = sum_3;
        // this.m.sumWarehouse_4 = sum_4;
        // this.m.sumWarehouse_5 = sum_5;
    }

    calcWarehouseVol() {
        let sum = 0;
        let sum_list_vol = {};
        let sum_list_cart = {};
        let $log = this.$log;
        let that = this;
        angular.forEach(that.m.warehouseList, function(item) {
            sum_list_vol[item.warehouse_id] = 0 ;
            sum_list_cart[item.warehouse_id] = 0 ;
        });
        // let sum_1 = 0;
        // let sum_2 = 0;
        // let sum_3 = 0;
        // let sum_4 = 0;
        // let sum_5 = 0;
        let sum_cart = 0;
        // let sum_cart_1 = 0;
        // let sum_cart_2 = 0;
        // let sum_cart_3 = 0;
        // let sum_cart_4 = 0;
        // let sum_cart_5 = 0;
        //this.m.count.warehouse = 0;
        if (that.m.warehouse != null) {
            angular.forEach(that.m.warehouse, function(item) {
                //this.m.count.warehouse++;
                if (item.hide != true){
                    if (item.amount > 0) {
                        sum += parseFloat(item.volume) * parseFloat(item.amount)/parseFloat(item.standard_packing);
                        sum_cart +=  parseFloat(item.amount)/parseFloat(item.standard_packing);
                    }
                    
                    angular.forEach(that.m.warehouseList, function(item_sub) {
                        if (item[item_sub.warehouse_label] > 0) {
                            sum_list_vol[item_sub.warehouse_id] +=parseFloat(item.volume)  * parseInt(item[item_sub.warehouse_label] )/parseFloat(item.standard_packing);
                            sum_list_cart[item_sub.warehouse_id] += parseFloat(item[item_sub.warehouse_label] )/parseFloat(item.standard_packing);
                        }
                        
                    });
                    // if (item.amount_2 > 0) {
                    //     sum_2 += parseFloat(item.volume) * parseFloat(item.amount_2)/parseFloat(item.standard_packing);
                    //     sum_cart_2 +=  parseFloat(item.amount_2)/parseFloat(item.standard_packing);
                    // }
                    // if (item.amount_3 > 0) {
                    //     sum_3 += parseFloat(item.volume) * parseFloat(item.amount_3)/parseFloat(item.standard_packing);
                    //     sum_cart_3 +=  parseFloat(item.amount_3)/parseFloat(item.standard_packing);
                    // }
                    // if (item.amount_4 > 0) {
                    //     sum_4 += parseFloat(item.volume) * parseFloat(item.amount_4)/parseFloat(item.standard_packing);
                    //     sum_cart_4 +=  parseFloat(item.amount_4)/parseFloat(item.standard_packing);
                    // }
                    // if (item.amount_5 > 0) {
                    //     sum_5 += parseFloat(item.volume) * parseFloat(item.amount_5)/parseFloat(item.standard_packing);
                    //     sum_cart_5 +=  parseFloat(item.amount_5)/parseFloat(item.standard_packing);
                    // }
                }
            });
        }

        angular.forEach(that.m.warehouseList, function(item) {
            sum_list_vol[item.warehouse_id] =  parseFloat(sum_list_vol[item.warehouse_id]);
            sum_list_cart[item.warehouse_id] = parseFloat( sum_list_cart[item.warehouse_id]);
        });

        that.m.sumWarehouseVol = parseFloat(sum);
        that.m.sumWarehouseVol_no=  sum_list_vol;
        // this.m.sumWarehouseVol_2 = parseFloat(sum_2);
        // this.m.sumWarehouseVol_3 = parseFloat(sum_3);
        // this.m.sumWarehouseVol_4 = parseFloat(sum_4);
        // this.m.sumWarehouseVol_5 = parseFloat(sum_5);
        that.m.sumWarehouseCart = parseFloat(sum_cart);
        that.m.sumWarehouseCart_no =  sum_list_cart;
        // this.m.sumWarehouseCart_2 = parseFloat(sum_cart_2);
        // this.m.sumWarehouseCart_3 = parseFloat(sum_cart_3);
        // this.m.sumWarehouseCart_4 = parseFloat(sum_cart_4);
        // this.m.sumWarehouseCart_5 = parseFloat(sum_cart_5);
    }

    chooseTab(tab) {
        this.m.activeFlag = tab;
        let param1 = {};
        param1.tab = tab;
        sessionStorage.dashboard = angular.toJson(param1);
    }

    createChartStatisticSpecificSalesman(){
        this.chartStatisticSO1 = this.createChartStatisticSalesman(this.m.so1Turnover, 1);
        this.chartStatisticSO2 = this.createChartStatisticSalesman(this.m.so2Turnover, 2);
        this.chartStatisticSO3 = this.createChartStatisticSalesman(this.m.so3Turnover, 3 );
        this.chartStatisticSO4 = this.createChartStatisticSalesman(this.m.so4Turnover, 4);
        this.chartCompareSale  = this.createChartStatisticCompareSalesman();
    }

    createChartStatisticCompareSalesman(){
        var series = ['SM1', 'SM2', 'SM3','SM4'];
        var colors = ['#BF465C', '#46BFBD','#4D5360'];
        var labels = [];
       
        var line1 = [];
        var line2 = [];
        var line3 = [];
        var line4 = [];
           
        angular.forEach(this.m.so1Turnover, function(item) {
            line1.push(item.total);
        });
        line1[0] = 227205000;
        angular.forEach(this.m.so2Turnover, function(item) {
            line2.push(item.total);
        });
        line2[0] = 218082000;
        angular.forEach(this.m.so3Turnover, function(item) {
            line3.push(item.total);
        });
        line3[0]= 75253000;
        line3[1] = line3[1] + 11857500;
        angular.forEach(this.m.so4Turnover, function(item) {
            line4.push(item.total);
        });
        line4[0]= 75253000;
        var line1_q = [];
        var line2_q = [];
        var line3_q = [];
        var line4_q = [];
        var labels_q = ['Q1','Q2', 'Q3', 'Q4']

        var i = 0;
        while (i<12){
            line4_q.push(parseInt(line4[i])+parseInt(line4[i+1])+parseInt(line4[i+2]) );
            line2_q.push(parseInt(line2[i])+parseInt(line2[i+1])+parseInt(line2[i+2]) );
            line3_q.push(parseInt(line3[i])+parseInt(line3[i+1])+parseInt(line3[i+2]) );
            line1_q.push(parseInt(line1[i])+parseInt(line1[i+1])+parseInt(line1[i+2]) );
            i = i + 3;
        }
        var labels = labels_q;
        var data = [
            line1_q,
            line2_q,
            line3_q,
            line4_q,
        ];
        
        return this.ChartService.get_angular_chart(series, colors, data, labels);
    }

    createChartStatisticSalesman(saleData, noSale){
        var series = ['Target', 'Sales','50% case'];
        var colors = ['#BF465C', '#46BFBD','#4D5360'];
        var labels = [];
       
        var line2 = [];
        var line3 = [];
        // var line1_q = [1500000000,1500000000,1500000000,1500000000];
        // var line1_q = [1500000000,1950000000,2025000000,2025000000];
        var line1_q = [1890000000,1890000000,1890000000,1890000000];
        var line2_q = [];
        var line3_q = [];
        var labels_q = ['Q1','Q2', 'Q3', 'Q4']
         
        angular.forEach(saleData, function(item) {
            labels.push(item.yearmonth);
            line2.push(item.total);
            line3.push(item.total_special);
        });

        // if (noSale == 1){
        //     line2[0] = 227205000;
        //     line3[0] = 107156000;
        // } else if (noSale == 2){
        //     line2[0] = 227205000;
        //     line3[0] = 107156000;
        // } else if (noSale == 3){
        //     line2[0] = 218082000;
        //     line3[0] = 106530000;
        // } else {
        //     line2[0]= 75253000;
        //     line2[1] = line2[1] + 11857500;
        //     line3[1] = line2[1] - 11857500;
        // }

        var d = new Date();
        while (line2.length<12){
            line2.push(0);
            line3.push(0);
            labels.push((d.getFullYear()) + '-' + line2.length );
        }
        // line2[0] = line2[0] - 294924000;
        var i = 0;
        while (i<12){
            line2_q.push(parseInt(line2[i])+parseInt(line2[i+1])+parseInt(line2[i+2]) );
            line3_q.push(parseInt(line3[i])+parseInt(line3[i+1])+parseInt(line3[i+2]) );

            i = i + 3;
        }
        var labels = labels_q;
        var data = [
            line1_q,
            line2_q,
            line3_q
        ];

        return this.ChartService.get_angular_chart(series, colors, data, labels);
    }

    createChartStatisticDelivery() {
        var chart = {};

        var series = ['Target', 'Sales'];
        var colors = ['#BF465C', '#46BFBD'];
        var labels = [];
        // var line1 = [1229554000, 1044844000, 2061900000, 2706591000, 2570213000, 2434904000,2466543000, 2229717000, 3008294000, 2536895000, 2830164000, 2880382000];
        var line1 = [
            1500000000, // 1
            1800000000, // 2
            2700000000, // 3
            1950000000, // 4
            2730000000, // 5
            3120000000, // 6
            2025000000, // 7
            2835000000, // 8
            3240000000, // 9
            2025000000, // 10
            2835000000, // 11
            3240000000  // 12
        ];
        var line2 = [];
       
        angular.forEach(this.m.statisticDelivery, function(item) {
            labels.push(item.yearmonth);
            line2.push(item.total_with_discount);
        });

        var d = new Date();
        while (line2.length<12){
            line2.push(0);
            labels.push((d.getFullYear()) + '-' + line2.length );
        }
        // line2[0] = line2[0] - 294924000;

       
        var data = [
            line1,
            line2
        ];

        this.chartStatisticDelivery = this.ChartService.get_angular_chart(series, colors, data, labels);
    }


    createChartStatisticDeliveryQuarter(){
        var chart = {};
        var series = ['Target', 'Sales'];
        var colors = ['#BF465C', '#46BFBD'];
        var labels = [];
        // var line1 = [1229554000, 1044844000, 2061900000, 2706591000, 2570213000, 2434904000,2466543000, 2229717000, 3008294000, 2536895000, 2830164000, 2880382000];
        var line1 = [
            1500000000, // 1
            1800000000, // 2
            2700000000, // 3
            1950000000, // 4
            2730000000, // 5
            3120000000, // 6
            2025000000, // 7
            2835000000, // 8
            3240000000, // 9
            2025000000, // 10
            2835000000, // 11
            3240000000  // 12
        ];
        var line2 = [];
        var line1_q = [];
        var line2_q = [];
        var labels_q = ['Q1','Q2', 'Q3', 'Q4']
         
        angular.forEach(this.m.statisticDelivery, function(item) {
            labels.push(item.yearmonth);
            line2.push(item.total_with_discount);
        });

        var d = new Date();
        while (line2.length<12){
            line2.push(0);
            labels.push((d.getFullYear()) + '-' + line2.length );
        }
        // line2[0] = line2[0] - 294924000;
        var i = 0;
        while (i<12){
            line1_q.push(parseInt(line1[i])+parseInt(line1[i+1])+parseInt(line1[i+2]) );
            line2_q.push(parseInt(line2[i])+parseInt(line2[i+1])+parseInt(line2[i+2]) );
            i = i + 3;
        }
        var labels = labels_q;
        var data = [
            line1_q,
            line2_q
        ];

        this.chartStatisticDeliveryQuarter = this.ChartService.get_angular_chart(series, colors, data, labels);
    }

    createChartStatisticDelivery() {
        var chart = {};

        var series = ['Target', 'Sales'];
        var colors = ['#BF465C', '#46BFBD'];
        var labels = [];
        // var line1 = [1229554000, 1044844000, 2061900000, 2706591000, 2570213000, 2434904000,2466543000, 2229717000, 3008294000, 2536895000, 2830164000, 2880382000];
        var line1 = [
            1500000000, // 1
            1800000000, // 2
            2700000000, // 3
            1950000000, // 4
            2730000000, // 5
            3120000000, // 6
            2025000000, // 7
            2835000000, // 8
            3240000000, // 9
            2025000000, // 10
            2835000000, // 11
            3240000000  // 12
        ];
        var line2 = [];
       
        angular.forEach(this.m.statisticDelivery, function(item) {
            labels.push(item.yearmonth);
            line2.push(item.total_with_discount);
        });

        var d = new Date();
        while (line2.length<12){
            line2.push(0);
            labels.push((d.getFullYear()) + '-' + line2.length );
        }
        // line2[0] = line2[0] - 294924000;

       
        var data = [
            line1,
            line2
        ];

        this.chartStatisticDelivery = this.ChartService.get_angular_chart(series, colors, data, labels);
     
    }

    download() {
        let param = {};

        let service = this.API.service('download', this.API.all('das0100'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }
}

export const DashboardComponent = {
    //templateUrl: './views/app/components/dashboard/dashboard.component.html',
    templateUrl: '/views/admin.dashboard.dashboard',
    controller: DashboardController,
    controllerAs: 'vm',
    bindings: {}
}