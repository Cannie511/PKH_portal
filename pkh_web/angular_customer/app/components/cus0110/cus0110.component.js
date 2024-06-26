class Cus0110Controller{
    constructor($scope, $state, API, $log, $stateParams, RouteService, ClientService){
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.ClientService = ClientService;
        this.RouteService = RouteService;

        this.m = {
            data : null,
            mode : 'EDIT'
        }

    }

    $onInit(){
        this.loadInitData();
    }

    loadInitData() {
        let $log = this.$log;

        let param = {
        };

        let service = this.API.service('load-init', this.API.all('cus0110'));
        service.post(param) 
            .then((response) => {
                this.m.data = response.data;
                $log.debug('response', response);
                $log.debug('this.m', this.m);
            });
    }

    confirm() {
        this.m.mode = 'CONFIRM';
    }

    back() {
        this.m.mode = 'EDIT';
    }

    order() {
        let $log = this.$log;
        let ClientService = this.ClientService;
        
        $log.info('click order', this.m.data);
        //this.RouteService.goState('app.landing');
        
        var param = [];

        angular.forEach(this.m.data, function(cat) {
            angular.forEach(cat.items, function(pro) {
                if( pro.qty > 0 ) {
                    param.push({
                        product_id: pro.product_id,
                        qty: pro.qty
                    });
                }
            });
        });

        $log.info("param", param);

        let service = this.API.service('order', this.API.all('cus0110'));
        service.post(param) 
            .then((response) => {
                if( response.data.rtnCd == 'OK') {
                    ClientService.success('Đã gửi thông tin đơn hàng');
                    this.RouteService.goState('app.landing');
                }
                $log.debug('response', response);
                $log.debug('this.m', this.m);
            });
    }
}

export const Cus0110Component = {
    templateUrl: './views/app/components/cus0110/cus0110.component.html',
    controller: Cus0110Controller,
    controllerAs: 'vm',
    bindings: {}
}
