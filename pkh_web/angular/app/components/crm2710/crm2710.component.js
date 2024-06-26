class Crm2710Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.can = AclService.can;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$stateParams = $stateParams;

        this.m = {
            init: {},
            form: {
                size: 150,
                amount: 100
            },
            products: [],
            dateOptions: {
                format: 'YYYY-MM-DD'
            }
        }

    }

    $onInit(){
        this.loadInitData();
    }

    loadInitData() {
        let param = {
            store_id: this.m.store_id,
            store_order_id: this.m.store_order_id
        };

        let self = this;
        let service = this.API.service('load-init', this.API.all('crm2710'));
        service.post()
            .then((response) => {
                self.m.init = response.plain().data;
            })
    }

    addProduct(item) {
        let index = this.m.products.findIndex((ele) => ele.product_id == item.product_id);
        if (index < 0) {
            this.m.products.push(item);
        }
        item.hide = true;
    }

    removeProduct(item) {
        let index = this.m.products.findIndex((ele) => ele.product_id == item.product_id);
        if (index >= 0) {
            this.m.products.splice(index, 1);
        }

        index = this.m.init.productList.findIndex((ele) => ele.product_id == item.product_id);
        if( index > 0) {
            this.m.init.productList[index].hide = false;
        }
    }

    download() {

        if (this.m.products.length == 0) {
            this.ClientService.warning("Bạn chưa chọn sản phẩm");
            return;
        }

        if (this.m.form.size <= 0) {
            this.ClientService.warning("Nhập sai kích thước");
            return;
        }

        if (this.m.form.amount <= 0) {
            this.ClientService.warning("Nhập sai số lượng");
            return;
        }

        // let param = angular.copy(this.m.form);

        let listCode = this.m.products.map(ele => ele.product_code.substr(0,6));

        let paramForPost = {};
        paramForPost.size = this.m.form.size;
        paramForPost.amount = this.m.form.amount;
        paramForPost.listCode = listCode.join(',', paramForPost);


        let env = getEnv();
        this.ClientService.postUrl(env.URL_WWW + "/print-qr", paramForPost);
    }

}

export const Crm2710Component = {
    //templateUrl: './views/app/components/crm2710/crm2710.component.html',
    templateUrl: '/views/admin.crm2710',
    controller: Crm2710Controller,
    controllerAs: 'vm',
    bindings: {}
}
