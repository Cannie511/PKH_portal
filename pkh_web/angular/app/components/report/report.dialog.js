export class ReportDialogController {
    constructor($scope, $uibModalInstance, DialogService, $log, $filter, data) {
        'ngInject';

        this.$scope = $scope;
        this.$log = $log;
        this.DialogService = DialogService;
        this.$uibModalInstance = $uibModalInstance;

        this.m = {
            msg: 'this is my model  2. StoreDialogController 11 22 33',
        }
        this.m.id_charts = [];
        data = data[1];
        this. $log.info('init chart',data);

        let num = data.length;
        for (var i=0;i<num;i++){
            this.m.id_charts.push("Chart"+i);
        }
        this. $log.info('init chart');

        this.loadChart(data);
    }

    amChartOptionForBar(title) {
        let amChartOption = {
            "type": "serial",
            "theme": "black",
            "titles": [{
                "text": title,
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
                "valueField": "value"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "key",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20,
                "labelRotation": 45
            },
            "export": {
                "enabled": true
            }
        };
        return amChartOption;
    }

    amChartOptionForLine(title) {
        let amChartOption = {
            "type": "serial",
            "theme": "black",
            "marginRight": 80,
            "autoMarginOffset": 20,
            "titles": [{
                "text": title,
                "size": 15
            }],
            "dataProvider": [],
            "valueAxes": [{
                "axisAlpha": 0,
                "guides": [{
                    "fillAlpha": 0.1,
                    "fillColor": "#ffffff",
                    "lineAlpha": 0,
                    "toValue": 16,
                    "value": 10
                }],
                "position": "left",
                "tickLength": 0
            }],
            "graphs": [{
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>",
                "bullet": "round",
                "dashLength": 3,
                "colorField": "color",
                "valueField": "value"
            }],
            "chartScrollbar": {
                "scrollbarHeight": 2,
                "offset": -1,
                "backgroundAlpha": 0.1,
                "backgroundColor": "#888888",
                "selectedBackgroundColor": "#67b7dc",
                "selectedBackgroundAlpha": 1
            },
            "chartCursor": {
                "fullWidth": true,
                "valueLineEabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "cursorAlpha": 0
            },
            "categoryField": "key",
            "categoryAxis": {
                "parseDates": false,
                "axisAlpha": 0,
                "gridAlpha": 0.1,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true
            }
        };
        return amChartOption;
    }

    amChartMultiLines(title,graph){
        let amChartOption = {
            "type": "serial",
            "theme": "light",
            "dataProvider": [],
            "titles": [{
                "text": title,
                "size": 15
            }],
            "valueAxes": [{
              "gridColor": "#FFFFFF",
              "gridAlpha": 0.2,
              "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": graph ,
            "chartCursor": {
              "categoryBalloonEnabled": false,
              "cursorAlpha": 0,
              "zoomable": false
            },
            "categoryField": "category",
            "categoryAxis": {
              "gridPosition": "start",
              "gridAlpha": 0
            },
            "legend": {}
        };
        return amChartOption;
    }

    amChartOptionForPie(title) {
        let amChartOption = {
            "type": "pie",
            "theme": "light",
            "titles": [{
                "text": title,
                "size": 15
            }],
            "dataProvider": [],
            "valueField": "value",
            "titleField": "key",
            "balloon": {
                "fixedPosition": true
            },
            "export": {
                "enabled": true
            }
        };
        return amChartOption;
    }

    chooseAmChartOptions(type, title, graph) {
        switch (type) {
            case 1:
                return this.amChartOptionForBar(title);
            case 2:
                // return this.amChartOptionForLine(title);
                return this.amChartMultiLines(title, graph);
            case 3:
                return this.amChartOptionForPie(title);
            case 4:
                return this.amChartOptionForLine(title);
        }
        return null;
    }


    /* type
     * 1: bar
     * 2: Line
     * 3: Pie
     */
    loadChart(data) {
        let $log = this.$log;
        //$log.info('load chart', this.m.dataProvider);

        let copy = [];
    
        // let copy_2 = angular.copy(this.chooseAmChartOptions(3, title, graph));
        for (var i=0;i<data.length;i++){  
            let item = angular.copy(this.chooseAmChartOptions(data[i].type, data[i].title, data[i].graph))
            item.dataProvider = data[i].dataProvider;
            copy.push(item);
        }
        
        this.m.amChartOptions = copy;
        $log.info('load chart', this.m);
        
        for (var i=0;i<data.length;i++){
            // $log.info('loop', this.m.id_charts[i]);
            this.$scope.$broadcast('amCharts.updateData', data[i].dataProvider, this.m.id_charts[i]);
        }
        // this.$scope.$broadcast('amCharts.updateData', data[0].dataProvider, this.m.id_charts[0]);
        // this.$scope.$broadcast('amCharts.updateData', data[1].dataProvider, this.m.id_charts[1]);
        // this.$scope.$broadcast('amCharts.updateData', data[2].dataProvider, this.m.id_charts[2]);

        // this.$scope.$broadcast('amCharts.updateData', this.m.dataProvider, 'mySecondChart');

    }

    cancel() {
        this.DialogService.close();
    }
}