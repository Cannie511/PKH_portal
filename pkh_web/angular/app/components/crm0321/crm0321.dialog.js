export class Crm0321DialogController {
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
                "dataDateFormat": "YYYY-MM",
                "precision": 2,
                "valueAxes": [{
                    "id": "v1",
                    "title": "Số tiền",
                    "position": "left",
                    "autoGridCount": false,
                    "labelFunction": function(value) {
                        return "VND" + $filter('currency')(Math.round(value / 1000000), '', 0) + "M";
                    }
                }, {
                    "id": "v2",
                    "title": "Cấp",
                    "gridAlpha": 0,
                    "position": "right",
                    "autoGridCount": false,
                    "reversed": true
                }],
                "numberFormatter": {
                    "precision": -1,
                    "decimalSeparator": ",",
                    "thousandsSeparator": ""
                },
                "graphs": [{
                    "id": "g3",
                    "valueAxis": "v1",
                    // "lineColor": "#88A236",
                    // "fillColors": "#88A236",
                    "fillAlphas": 0.5,
                    "type": "smoothedLine",
                    "title": "Đặt hàng",
                    "valueField": "order_total",
                    "clustered": false,
                    "columnWidth": 5,
                    "legendValueText": "VND[[value]]",
                    // "balloonText": "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>",
                    "balloonFunction": function(graphDataItem, graph) {
                        var value = "<b>" + graph.title + "</b>: " + $filter('currency')(graphDataItem.values.value, '', 0);
                        return value;
                    }
                }, {
                    "id": "g4",
                    "valueAxis": "v1",
                    // "lineColor": "#4E9231",
                    // "fillColors": "#4E9231",
                    "fillAlphas": 0.5,
                    "type": "smoothedLine",
                    "title": "Đặt hàng (Sau CK)",
                    "valueField": "order_total_with_discount",
                    "clustered": false,
                    "columnWidth": 4,
                    "legendValueText": "$[[value]]M",
                    // "balloonText": "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>"
                    "balloonFunction": function(graphDataItem, graph) {
                        var value = "<b>" + graph.title + "</b>: " + $filter('currency')(graphDataItem.values.value, '', 0);
                        return value;
                    }
                }, {
                    "id": "g5",
                    "valueAxis": "v1",
                    // "lineColor": "#9F3548",
                    // "fillColors": "#9F3548",
                    "fillAlphas": 0.5,
                    "type": "column",
                    "title": "Giao hàng",
                    "valueField": "delivery_total",
                    "clustered": false,
                    "columnWidth": 3,
                    "legendValueText": "$[[value]]M",
                    // "balloonText": "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>"
                    "balloonFunction": function(graphDataItem, graph) {
                        var value = "<b>" + graph.title + "</b>: " + $filter('currency')(graphDataItem.values.value, '', 0);
                        return value;
                    }
                }, {
                    "id": "g6",
                    "valueAxis": "v1",
                    // "lineColor": "#7D2A68",
                    // "fillColors": "#7D2A68",
                    "fillAlphas": 0.5,
                    "type": "column",
                    "title": "Giao hàng (Sau CK)",
                    "valueField": "delivery_total_with_discount",
                    "clustered": false,
                    "columnWidth": 2,
                    "legendValueText": "",
                    // "balloonText": "[[title]]<br /><b style='font-size: 130%'>$[[value]]M</b>"
                    "balloonFunction": function(graphDataItem, graph) {
                        var value = "<b>" + graph.title + "</b>: " + $filter('currency')(graphDataItem.values.value, '', 0);
                        return value;
                    }
                }, {
                    "id": "g7",
                    "valueAxis": "v2",
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "reversed": true,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "lineColor": "#FF7400",
                    "type": "smoothedLine",
                    "dashLength": 5,
                    "title": "Cấp",
                    "useLineColorForBulletBorder": true,
                    "valueField": "store_rank",
                    "legendValueText": "[[value]]",
                    // "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>",
                    "balloonFunction": function(graphDataItem, graph) {
                        var value = "<b>" + graph.title + "</b>: " + (graphDataItem.values.value);
                        return value;
                    }
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 30,
                    "scrollbarHeight": 50,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "valueLineAlpha": 0.2
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "legend": {
                    "useGraphSettings": true,
                    "position": "top"
                },
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "export": {
                    "enabled": true
                }
            }
        }

        this.loadChart();
    }

    loadChart() {
        // this.m.showChart = true;
        let copy = angular.copy(this.m.amChartOptions);
        copy.dataProvider = this.m.item.items;
        this.m.amChartOptions = null;
        this.m.amChartOptions = copy;

        this.$scope.$broadcast('amCharts.updateData', this.m.item.items, 'myFirstChart');
    }

    cancel() {
        this.DialogService.close();
    }
}