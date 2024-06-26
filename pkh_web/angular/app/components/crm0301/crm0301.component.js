class Crm0301Controller{
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
        this.search();
    }

    search() {
        this.doSearch();
    }

    doSearch() {
        let searchService = this.API.service('search', this.API.all('crm0301'));
        let param = angular.copy(this.m.filter);
        let self = this;

        searchService.post(param)
            .then((response) => {
                this.$log.info("RESPONSE", response);
                this.m.data = response.plain().data.data;

                var listMarker = [];
                this.m.data.forEach(element => {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(element.gps_lat, element.gps_long),
                        title: element.name
                    });
                    listMarker.push(marker);

                    google.maps.event.addListener(marker, 'click', function () {

                        self.m.selected = element;
                        self.map.showInfoWindow('myInfoWindow', this);
                    });
                });

                var mcOptions = { imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m' };
                this.m.markerClusterer = new MarkerClusterer(this.map, listMarker, mcOptions);
            });
    }

    toogleList() {
        this.m.showList = !this.m.showList;
    }

    showInfo(evt, item, self) {
        self.$log.info('showInfo', evt, item);
        self.m.selected = item;
        self.map.showInfoWindow('myInfoWindow', this);
    }
}

export const Crm0301Component = {
    //templateUrl: './views/app/components/crm0301/crm0301.component.html',
    templateUrl: '/views/admin.crm0301',
    controller: Crm0301Controller,
    controllerAs: 'vm',
    bindings: {}
}
