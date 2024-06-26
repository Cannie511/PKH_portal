import { ReportDialogController } from '../report/report.dialog';
class Rpt0516Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, DialogService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.DialogService = DialogService;
        this.UtilsService = UtilsService;

        this.m = {
            init: {},
            filter: {},
            data: [],
            res: {}
        }

    }

    $onInit() {
        this.loadInitData();
    }

    loadInitData() {
        let self = this;
        let service = this.API.service('init', this.API.all('rpt0516'));
        let param = {};
        service.post(param)
            .then(function(response) {
                self.setInitData(response.data);
            });
    }

    setInitData(data) {
        this.m.init = data;
        if (this.m.init.listYear != null && this.m.init.listYear.length > 0) {
            this.m.filter.year = this.m.init.listYear[0].year;
        } else {
            this.m.filter.year = (new Date()).getFullYear();
        }
    }

    choose(tab) {
        this.m.activeFlag = tab;
    }

    loadDataForCategories() {
        let param = angular.copy(this.m.filter);
        let serviceCate = this.API.service('load-cate', this.API.all('rpt0516'));
        this.m.res[1] = {};
        serviceCate.post(param)
            .then((response) => {
                this.m.res[1] = response.data;
                //this.$log.info('result from cate', this.m);
            });
    }

    loadDataForDepartments() {
        let param = angular.copy(this.m.filter);
        let serviceDepartment = this.API.service('load-department', this.API.all('rpt0516'));
        this.m.res[2] = {};
        serviceDepartment.post(param)
            .then((response) => {
                this.m.res[2] = response.data;
            });
    }

    search() {
        if (!this.m.activeFlag) {
            return;
        }
        let activeFlag = this.m.activeFlag;
        this.$log.info('check tab ', this.m)
        switch (activeFlag) {
            case 1:
                this.loadDataForCategories();
                break;
            case 2:
                this.loadDataForDepartments();
                break;
        }
    }

    getDataHorizontalByProduct(item, row) {
        let $log = this.$log;
        let smallItem = {};
        let dataProvider = [];
        //$log.info('draw part 3', row);
        angular.forEach(row, function(value, key) {
            if (key != 0 && key != 13) {
                smallItem = {};
                smallItem.key = value;
                if (item[key] == null) {
                    smallItem.value = 0;
                } else {
                    smallItem.value = item[key];
                }
                dataProvider.push(smallItem);
            }
        });
        return dataProvider
    }

    getDataVerticalByProduct(item, header) {
        let smallItem = {};
        let dataProvider = [];
        angular.forEach(item, function(value, key) {
            if (key > 0) {
                smallItem = {};
                smallItem.key = item[key][0];
                smallItem.value = item[key][header];
                dataProvider.push(smallItem);
            }
        });
        this.$log.info('check vertical ', dataProvider);
        return dataProvider;
    }


    prepareDataToDraw(typeObject, item, header, direction, title, row) {
        let dataProvider = [];
        let $log = this.$log;
        switch (typeObject) {
            // product
            case 1:
                if (direction == 0) {
                    dataProvider = this.getDataHorizontalByProduct(item, row);
                    title = title + '_' + item[0];
                } else {
                    dataProvider = this.getDataVerticalByProduct(item, header);
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
                return "CHI PHÍ THEO LOẠI SẢN PHẨM";
            case 2:
                return "CHI PHÍ THEO PHÒNG BAN";
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

export const Rpt0516Component = {
    //templateUrl: './views/app/components/rpt0516/rpt0516.component.html',
    templateUrl: '/views/admin.rpt0516',
    controller: Rpt0516Controller,
    controllerAs: 'vm',
    bindings: {}
}