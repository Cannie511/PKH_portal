class Hrm0152Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, NgMap, ClientService, $filter) {
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
        this.$filter = $filter;

        this.m = {
            showList: true,
            selected: null,
            direction: [],
            // startPoint: null,
            // endPoint: null,
            filter: {
                dateFrom: moment(new Date()).add(-24 * 30, "hours"),
                dateTo: moment(new Date()).add(24, "hours")
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
        let beService = this.API.service('init', this.API.all('hrm0152'));
        beService.post()
            .then((res) => {
                this.$log.info('res', res);
                this.m.init = res.plain().data;
            });
    }

    search() {
        this.doSearch(1);
    }

    distance(lat1, lon1, lat2, lon2, unit){
        if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
        }
        else {
            var radlat1 = Math.PI * lat1/180;
            var radlat2 = Math.PI * lat2/180;
            var theta = lon1-lon2;
            var radtheta = Math.PI * theta/180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180/Math.PI;
            dist = dist * 60 * 1.1515;
            if (unit=="K") { dist = dist * 1.609344 }
            if (unit=="N") { dist = dist * 0.8684 }
            return dist;
        }
    }

    doSearch(page) {
        let searchService = this.API.service('search', this.API.all('hrm0152'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        
        // if( param.user_id == null || param.user_id == "") {
        //     this.ClientService.error("Vui lòng chọn nhân viên");
        //     return;
        // }

        if (param.dateFrom == null && angular.isUndefined(param.dateFrom)) {
            param.dateFrom = moment(new Date());
        }

        if (param.dateTo == null && angular.isUndefined(param.dateTo)) {
            param.dateTo = moment(new Date());
        }

        param.dateFrom = param.dateFrom.format('YYYY-MM-DD HH:mm:00');
        param.dateTo = param.dateTo.format('YYYY-MM-DD HH:mm:59');

        this.$log.info('param', param);

        searchService.post(param)
            .then((response) => {
                this.$log.info("RESPONSE", response);

                var checkins  = response.plain().data.checkins;
                var images  = response.plain().data.images;

                var direction = [];
                checkins.data.forEach(element => {
                    direction.push({
                        lat: element.gps_lat,
                        lng: element.gps_long
                    });
                    element.images = this.$filter("filter")(images, {check_in_id: element.id});
                    element.dist  = this.distance(element.gps_lat, element.gps_long, element.store_gps_lat, element.store_gps_long,"K");
                });

                this.m.data = checkins;
                this.m.images = images;

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

    showStoreInfo(evt, item, self) {
        self.$log.info('showStoreInfo', evt, item);
        self.m.selected = item;
        self.map.showInfoWindow('myInfoWindowStore', this);
    }

    focusItem(item, index) {
        var latlng = new google.maps.LatLng(item.gps_lat, item.gps_long);
        this.map.setCenter(latlng);

        this.m.selected = item;
        this.map.showInfoWindow('myInfoWindow', 'market_' + index);
        this.map.showInfoWindow('myInfoWindowStore', 'store_market');
    }
}

export const Hrm0152Component = {
    //templateUrl: './views/app/components/hrm0152/hrm0152.component.html',
    templateUrl: '/views/admin.hrm0152',
    controller: Hrm0152Controller,
    controllerAs: 'vm',
    bindings: {}
}
