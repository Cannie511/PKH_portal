import { ReportDialogController } from '../report/report.dialog';
class Rpt0510Controller {

    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $filter, DialogService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.$filter = $filter;
        this.DialogService = DialogService;
        this.m = {
            filter: {
                date: new Date()
            },
            data: []
        }
    }

    $onInit() {
        this.search();
    }

    search() {
        let thisClass = this;
        let service = this.API.service('search', this.API.all('rpt0510'));
        let param = angular.copy(this.m.filter);

        if (param.date != null && param.date != "") {
            param.date = this.$filter("date")(param.date, 'yyyy-MM-dd');
        }

        service.post(param)
            .then(function(response) {
                thisClass.$log.info('response', response);
                thisClass.m.data = response.plain().data; // not fixed yet
            });
    }


    getDataHorizontalByStore(item) {
        let smallItem = {};
        let dataProvider = [];
        angular.forEach(item, function(value, key) {
            //$log.info('draw part 3', key);
            if (key != "Time" && key != "Total" && key != "$$hashKey") {
                smallItem = {};
                smallItem.key = key;
                smallItem.value = value;
                dataProvider.push(smallItem);
            }
        });
        return dataProvider;
    }


    getDataVerticalByStore(item, header) {
        let smallItem = {};
        let dataProvider = [];
        angular.forEach(item, function(value, key) {
            smallItem = {};
            smallItem.key = item[key].Time;
            if (item[key][header] == null) {
                smallItem.value = 0;
            } else {
                smallItem.value = item[key][header];
            }

            dataProvider.unshift(smallItem);
        });
        return dataProvider;
    }



    prepareDataToDraw(typeObject, item, header, direction, title, row) {
        let dataProvider = [];
        let $log = this.$log;
        switch (typeObject) {
            case 2:
                if (direction == 0) {
                    dataProvider = this.getDataHorizontalByStore(item);
                    title = title + '_' + item.Time;

                } else {
                    dataProvider = this.getDataVerticalByStore(item, header);
                }
                break;
        }
        let data = {
            title: title,
            dataProvider: dataProvider
        };
        return data;
    }

    selectTitleForPart(part) {
        switch (part) {
            case 1:
                return "DOANH SỐ CÁC CẤP";

        }
        return "";
    }

    // typeObject (product or store : 1 or 2), item (data), header, type( line or bar: 2 or 1), direction (horizontal or vertical: 0 or 1)
    draw(typeObject, item, header, typeChart, direction, part, addition, row) {
        let $log = this.$log;
        let title = this.selectTitleForPart(part) + '_' + addition + '_' + header;
        let data;
        data = this.prepareDataToDraw(typeObject, item, header, direction, title, row);
        //$log.info('test draw rpt0511 a', type);
        let modalOption = {
            size: 'dialog-1024',
            controller: ReportDialogController,
            resolve: {
                data: data,
                type: typeChart
            }
        };

        this.DialogService.open('report_chart', modalOption);
    }
}

export const Rpt0510Component = {
    //templateUrl: './views/app/components/rpt0510/rpt0510.component.html',
    templateUrl: '/views/admin.rpt0510',
    controller: Rpt0510Controller,
    controllerAs: 'vm',
    bindings: {}
}