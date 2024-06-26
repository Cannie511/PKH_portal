class Hrm0150Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, NgMap) {
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

        this.m = {
            showList: true,
            selected: null
        }

    }

    $onInit(){
        var self = this;
        this.NgMap.getMap().then(function(map) {
            self.map = map;

            self.search();
          });
    }

    search() {
        let searchService = this.API.service('search', this.API.all('hrm0150'));

        searchService.post({})
            .then((response) => {
                this.$log.info("RESPONSE", response);
                this.m.data = response.plain().data;
                this.$log.info(this.m);
            });
    }

    focusItem(item, index) {
        var latlng = new google.maps.LatLng(item.gps_lat, item.gps_long);
        this.map.setCenter(latlng);

        this.m.selected = item;
        this.$scope.map.showInfoWindow('myInfoWindow', 'market_' + index);
    }

    showInfo(evt, item, self) {
        self.$log.info('showInfo', evt, item);
        self.m.selected = item;
        self.$scope.map.showInfoWindow('myInfoWindow', this);
    }

    toogleList() {
        this.m.showList = !this.m.showList;
    }
}

export const Hrm0150Component = {
    //templateUrl: './views/app/components/hrm0150/hrm0150.component.html',
    templateUrl: '/views/admin.hrm0150',
    controller: Hrm0150Controller,
    controllerAs: 'vm',
    bindings: {}
}
