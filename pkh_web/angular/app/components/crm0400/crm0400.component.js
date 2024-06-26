import { Crm0400ShippingDialogController } from './Crm0400_shipping.dialog';
class Crm0400Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, DialogService, $stateParams, NgMap, AclService) {
        'ngInject'
        this.$scope = $scope;
        this.API = API;
        this.AclService = AclService;
        this.can = AclService.can;

        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.DialogService = DialogService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;
        this.NgMap = NgMap;
        this.map = null;

        this.m = {
            activeFlag: 2,
            filter: {},
            list: null,
            is_store: true,
            is_chanh: false,
            dateOptions: {
                // formatYear: 'yy',
                startingDay: 1
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
            mapOption: {
            },
            optionsFrom: {
                format: 'YYYY-MM-DD HH:mm'
            },
            optionsTo: {
                format: 'YYYY-MM-DD HH:mm'
            }
           
        }
        this.init();
    }

    $onInit() {
       
    }

    init() {
       
        // this.$log.info('is map',self.map);

        this.title = ["Mới", "Đóng gói", "Xác nhận", "Xuất kho", "Vận chuyển", "Khách nhận", "Hoàn tất", "Huỷ"];
        this.code =  {0:2,
            6:3,
            7:4,
            1:5,
            8:6,
            9:7,
            4:8,
            5:9};
        for (var i=2; i<12; i++) {
            this.m[i] = {
                filter:{
                    orderBy: 'updated_at'
                    , orderDirection :'desc'
                },
                data:{
                    total : 0
                }
                , title : this.title[i-2]
            }
        }

        this.loadInit();
        this.$log.info('is map',this.m);
        if( this.$stateParams.store_id != null) {
            for (var i=2; i<12; i++) {
                this.m[i].filter.store_id = this.$stateParams.store_id;
            }
            this.doSearch(2,1);
        } else {
            let previousSearch = sessionStorage.crm0400;
            if (angular.isUndefined(previousSearch)) {
                this.doSearch(2,1);
                return;
            }

            previousSearch = angular.fromJson(previousSearch);
            var page = previousSearch.page;
            var index = previousSearch.index;

            this.m.activeFlag = index;
            delete previousSearch['page'];
            delete previousSearch['index'];
            this.m[index].filter = angular.copy(previousSearch);
            if (index <11){
                this.doSearch(index,page);
            } else {
                this.doMap();
            }
        }
    }

    loadInit() {
        let that  = this;
        let service = this.API.service('load-promotion', this.API.all('crm0400'));
        service.post()
            .then((response) => {
                let promotionList = response.data.promotionList;
                let salesmanList = response.data.salesmanList;
                let statusList = response.data.statusList;
                let branchList = response.data.branchList;
                let reportStatus = response.data.reportStatus;
                let warehouseList = response.data.warehouseList;

                if (promotionList != null) {
                    this.m.listPromotion = promotionList;
                }
                if (salesmanList != null) {
                    this.m.listSalesman = salesmanList;
                }
                if (statusList != null) {
                    this.m.statusList = statusList;
                }
                if (branchList != null) {
                    this.m.branchList = branchList;
                }

                if (warehouseList != null) {
                    this.m.warehouseList = warehouseList;
                }
                this.m.supplierList= response.data.supplierList;
                if (reportStatus != null) {
                    this.m.reportStatus = reportStatus;
                    angular.forEach(this.m.reportStatus, function(value) {
                        // total += parseFloat(value.unit_price) * parseFloat(value.amountExport);
                        let num= parseInt(value["delivery_sts"], 10);
                        let count =  value["count"];
                        let id = that.code[num];
                        that.m[id].data.total = count;
                    });
                }
            });
    }

    search() {
        this.doSearch(2,1);
    }

    resetFilter(index) {
        if (index < 1 || index > 12) {
            return;
        }
        this.m[index].filter = {
            orderBy:  'updated_at',
            orderDirection: 'desc'
        };
        this.doSearch(index, 1);
    }

    chooseTab(index) {
        if (index < 1 || index > 12) {
            return;
        }
        this.m.activeFlag = index;
        if (index<11){
            this.doSearch(index,1);
        } else {
            this.doMap();
        }
    }

    sort(index, orderBy) {
        let orderOption = this.UtilsService.getOrderBy(orderBy, this.m[index].filter.orderBy, this.m[index].filter.orderDirection);
        this.m[index].filter.orderBy = orderOption.orderBy;
        this.m[index].filter.orderDirection = orderOption.orderDirection;

        this.doSearch(index,1);
    }

    toogleList() {
        this.m.showList = !this.m.showList;
    }

    showInfo(evt, item, self) {
        self.$log.info('showInfo', evt, item);
        self.m.selected = item;
        self.map.showInfoWindow('myInfoWindow', this);
    }

    loadMap(){
        let self = this;
        var iconBase =
        'http://maps.google.com/mapfiles/kml/';

        var icons = {
        host: {
            icon: iconBase + 'shapes/ranger_station.png'
        }, 
        store: {
            icon: iconBase + 'paddle/red-square.png'
        },
        chanh: {
            icon: iconBase + 'paddle/blu-blank.png'
        }
        };

        var listMarker = [];
        // this.$log.info('is store',this.m.is_store);
        // this.$log.info('self.map',self.map);

        if (this.m.markerClusterer){
            this.m.markerClusterer.clearMarkers();
        }
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(10.737462,106.711953),
            title: "PKH",
            icon:icons["host"].icon
        });
        listMarker.push(marker);
        

        this.m[11].data1.forEach(element => {
            if (this.m.is_store ){
                if (element.gps_lat!= null &  element.gps_long!= null){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(element.gps_lat, element.gps_long),
                        title: element.name ,
                        icon:icons["store"].icon
                    });
                    
                    listMarker.push(marker);
    
                    google.maps.event.addListener(marker, 'click', function () {
    
                      self.m.selected = element;
                      self.map.showInfoWindow('myInfoWindow', this);
                  });
                }
                
              }  else 
              if (this.m.is_chanh){
                var gps_lat = element.gps_lat_c;
                var gps_long = element.gps_long_c;
                var icon = icons["chanh"].icon;
                var title = "chành " +element.name;

                if ((gps_lat == null | gps_long == null) | (gps_lat == 0 & gps_long == 0)){
                    gps_lat = element.gps_lat;
                    gps_long = element.gps_long;
                    title = element.name;
                    icon = icons["store"].icon
                }
                if (gps_lat != null & gps_long != null){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(gps_lat,gps_long),
                        title:  title,
                        icon: icon
                    });
                    // this.$log.info('titel',title );
    
                    listMarker.push(marker);
    
                  google.maps.event.addListener(marker, 'click', function () {
    
                      self.m.selected = element;
                      self.map.showInfoWindow('myInfoWindow', this);
                  });
                  }
                }
          });
          this.$log.info('markers',listMarker);
          var mcOptions = { imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m' };
         
          this.m.markerClusterer = new MarkerClusterer(self.map, listMarker, mcOptions);
        //   this.m.markerClusterer.setMap(null);
    }

    doMap(){
        var self = this;
        this.$log.info('doMap');

        this.NgMap.getMap().then(function(map) {
            self.map = map;
            self.$log.info('is map inside');
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
            self.doSearchMap();
          });
    }

    doSearchMap(){
        this.$log.info('doSearchMap');
        let searchService = this.API.service('map', this.API.all('crm0400'));
        let param = angular.copy(this.m[11].filter);
       
        param.index = 11;
        sessionStorage.crm0400 = angular.toJson(param);
        searchService.post(param)
            .then((response) => {
                // this.$log.info("RESPONSE", response.plain().data.data_1.data);
                this.m[11].data1 = response.plain().data.data_1.data;
                this.m[11].data2 = response.plain().data.data_2.data;
                this.m[11].data3 = response.plain().data.data_3.data;

                this.loadMap();
            });
    }

    doSearch(index, page) {
        let $log = this.$log;
        // Get list product 
        let searchService = this.API.service('search', this.API.all('crm0400'));
        let param = angular.copy(this.m[index].filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        param.index = index;
        param.page = page;
        sessionStorage.crm0400 = angular.toJson(param);
        //param.pageSize = $scope.m.paginationInfo.pageSize;

        searchService.post(param)
            .then((response) => {
                var data = response.plain().data;
                var list = data.list;
                angular.forEach(list, function(value) {
                    list.check = false;
                });
                this.m[index].data = data;
            });
    }

    clickPrintCheck() {
        var selectedIds = [];
        angular.forEach(this.m.list, function(value) {
            if (value.check === true) {
                selectedIds.push(value.store_delivery_id);
            }
        });

        if (selectedIds.length == 0) {
            this.ClientService.warning("Vui lòng chọn phiếu xuất.");
            return;
        }

        var param = {
            ids: selectedIds,
        };

        // this.$log.debug('download');
        // this.ClientService.downloadFile('api/crm0210/print-check', param);
        let service = this.API.service('print-check', this.API.all('crm0210'));
        service.post(param)
            .then((res) => {
                if (res.data.rtnCd == true) {
                    this.ClientService.success(res.data.url);
                    window.open(res.data.url);
                } else {
                    this.ClientService.error('Không tải được tập tin.');
                }
            });
    }

    download() {
        let param = angular.copy(this.m.filter);
        let service = this.API.service('download', this.API.all('crm0400'));
        param.down = 1;
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    Shipping(item){

        let modalOption;
        let DialogClose;
        let that = this;
       
        let param = {
            delivery: item
        };
        // that.$log.info('sale user', param);
        modalOption = {
            size: 'dialog-768',
            controller: Crm0400ShippingDialogController,
            resolve: {
                param: param
            }
        };
        DialogClose = this.DialogService.open('crm0400_shipping', modalOption);
        DialogClose.result.then(function(data) {
            that.init();  
        });
    }

    Receive(item){
        let self = this;
        swal({
            title: "Bạn có chắc chắn khách đã nhận hàng",
            text: "Sau khi xác nhận sẽ không thể thay đổi",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Yes',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
           self.confirmReceive(item);
        });   

    }

    confirmReceive(item){
        let ClientService = this.ClientService;

        let searchService = this.API.service('receive', this.API.all('crm0400'));
       
        let param = angular.copy(item);
        // this.$log.info('we can send it: ', this.m);
        searchService.post(param)
            .then((response) => {
                if (response.data.oke){
                    ClientService.success('Update successfully');

             } else {
                ClientService.error(response.data.message);
            }
             this.init();  
            });
    }

    downloadList(index) {
        let param = angular.copy(this.m[index].filter);
        if (param.from_date) {
            param.from_date = moment(param.from_date).format('YYYY-MM-DD');
        }
        if (param.to_date) {
            param.to_date = moment(param.to_date).format('YYYY-MM-DD');
        }
        param.index = index;
        param.down = 1;

        let service = this.API.service('download-list', this.API.all('crm0400'));
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

}

export const Crm0400Component = {
    // templateUrl: './views/app/components/crm0400/crm0400.component.html',
    templateUrl: '/views/admin.crm0400.crm0400',
    controller: Crm0400Controller,
    controllerAs: 'vm',
    bindings: {}
}