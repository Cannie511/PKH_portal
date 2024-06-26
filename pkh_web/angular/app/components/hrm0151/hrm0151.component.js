class Hrm0151Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, NgMap, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.NgMap = NgMap;
        this.map = null;
        this.ClientService = ClientService;

        this.m = {
            showList: true,
            selected: null,
            direction: [],
            // startPoint: null,
            // endPoint: null,
            filter: {
                dateFrom: moment(new Date()).add(-24 * 30, "hours"),
                dateTo: moment(new Date()).add(2, "hours")
            },
            optionsFrom: {
                format: 'YYYY-MM-DD HH:mm'
            },
            optionsTo: {
                format: 'YYYY-MM-DD HH:mm'
            },
            mapOption: {
            }
        }
    }

    $onInit(){
        var self = this;
        this.NgMap.getMap().then(function(map) {
            self.map = map;

            self.mapOption = {
                icons: [{
                    icon: { path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW },
                    offset: '100%'
                }],
                markerOption: {
                    icon: {
                        path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                        scale: 10
                    }
                }
            };

            self.init();

          });
    }

    init() {
        let beService = this.API.service('init', this.API.all('hrm0151'));
        beService.post()
            .then((res) => {
                this.$log.info('res', res);
                this.m.init = res.plain().data;
            });
    }

    search() {
        this.doSearch(1);
    }

    doSearch(page) {
        let searchService = this.API.service('search', this.API.all('hrm0151'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        
        if( param.user_id == null || param.user_id == "") {
            this.ClientService.error("Vui lòng chọn nhân viên");
            return;
        }

        if (param.dateFrom == null && angular.isUndefined(param.dateFrom)) {
            param.dateFrom = moment(new Date());
        }

        if (param.dateTo == null && angular.isUndefined(param.dateTo)) {
            param.dateTo = moment(new Date());
        }

        param.dateFrom = param.dateFrom.format('YYYY-MM-DD HH:mm:00');
        param.dateTo = param.dateTo.format('YYYY-MM-DD HH:mm:59');

        searchService.post(param)
            .then((response) => {
                this.$log.info("RESPONSE", response);

                this.m.data = response.plain().data.data;
                var direction = [];
                this.m.data.data.forEach(element => {
                    direction.push({
                        lat: element.gps_lat,
                        lng: element.gps_long
                    });
                });

                this.m.direction = direction;

                this.$log.info(this.m);
            });
    }

    toogleList() {
        this.m.showList = !this.m.showList;
    }

    update(dateFrom, dateTo) {
        this.m.optionsFrom.maxDate = dateTo;
        this.m.optionsTo.minDate = dateFrom;
    }

    showInfo(evt, item, self) {
        self.$log.info('showInfo', evt, item);
        self.m.selected = item;
        self.map.showInfoWindow('myInfoWindow', this);
    }

    focusItem(item, index) {
        var latlng = new google.maps.LatLng(item.gps_lat, item.gps_long);
        this.map.setCenter(latlng);

        this.m.selected = item;
        this.map.showInfoWindow('myInfoWindow', 'market_' + index);
    }
}

export const Hrm0151Component = {
    //templateUrl: './views/app/components/hrm0151/hrm0151.component.html',
    templateUrl: '/views/admin.hrm0151',
    controller: Hrm0151Controller,
    controllerAs: 'vm',
    bindings: {}
}
