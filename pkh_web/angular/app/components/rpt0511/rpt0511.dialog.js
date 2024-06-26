export class Rpt0511DialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, item) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;

        this.m = {
            msg: 'this is my model  2. StoreDialogController 11 22 33',
            item: item,
            amChartOptions: {
                "type": "serial",
                "theme": "light",
                "titles": [{
                    "text": "Cửa hàng mới",
                    "size": 15
                }],
                "dataProvider": [],
                "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0
                }],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "quantity"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "name",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }
            }
        }

        this.loadChart();
    }

    loadChart() {
        //this.m.showChart = true;
        let copy = angular.copy(this.m.amChartOptions);
        let $log = this.$log;
        let smallItem = {}
        let dataProvider = [];
        $log.info('draw part 3', this.m.item);
        //this.m.chart.notePart3 = "Cửa hàng tháng mới " + item.Time;
        angular.forEach(this.m.item, function(value, key) {
            //$log.info('draw part 3', key);
            if (key != "Time" && key != "Total" && key != "$$hashKey") {
                smallItem = {};
                smallItem.name = key;
                smallItem.quantity = value;
                dataProvider.push(smallItem);
            }
        });
        copy.dataProvider = dataProvider;
        this.m.amChartOptions = null;
        this.m.amChartOptions = copy;
        //$log.info('draw part 3', this.m);
        this.$scope.$broadcast('amCharts.updateData', dataProvider, 'myFirstChart');
    }

    cancel() {
        this.DialogService.close();
    }
}