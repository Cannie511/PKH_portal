class Cms0100Controller {
    constructor($scope, $state, $log, $filter, $translate, API, UtilsService, ClientService) {
        'ngInject';

        this.$state = $state;
        this.$log = $log;
        this.$filter = $filter;
        this.$translate = $translate;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.m = {
            init: {},
            form: {},
            activeFlag: 1
        };
    }

    $onInit() {
        this.load();
        this.loadListTopProduct();
        this.loadListNewProduct();
    }

    load() {
        let service = this.API.service('init-data', this.API.all('cms0100'));
        service.post()
            .then((response) => {
                // this.m.form = response.plain().data;
                let data = response.plain().data;
                data.listProduct.forEach(element => {
                    element.displayName = element.product_code + " - " + element.name;
                });
                this.m.init.listProduct = data.listProduct;
                delete(data.listProduct);
                this.m.form = data;
                this.m.form.cms_zalo_notify = '{"MessageBuilder" : "list" \
                ,"test_id" : "" \
                , "actions" : [ \
                { \
                "type" : "buildActionOpenURL" \
                 ,"header" : "DÒNG SẢN PHẨM CAO CẤP ROMA CÓ MẶT TẠI VIỆT NAM"  \
                , "body" : "Thiết kế kiểu dáng sang trọng, mới lạ, độc đáo, tiện lợi với thân vòi vuông một góc 90°; tay vặn xoay 360°, 5 cánh không bị trơn tuột khi sử dụng và dễ dàng lắp đặt, tháo gỡ" \
                , "link" : "https://www.phankhangco.com/tin-tuc/dong-san-pham-cao-cap-roma-sap-co-mat-tai-viet-nam_1" \
                , "image" : "https://www.phankhangco.com/images/92/92_20200827114352_11.jpeg" \
                } ,\
                { \
                "type" : "buildActionQueryShow" \
                 ,"header" : "DÒNG CAO CẤP ROMA TIẾP TỤC CÓ MẶT TRÊN TẠP CHÍ NỘI THẤT"  \
                , "body" : "" \
                , "link" : "https://www.phankhangco.com/tin-tuc/dong-cao-cap-roma-tiep-tuc-co-mat-tren-tap-chi-noi-that" \
                , "image" : "https://www.phankhangco.com/images/87/87_20200803134013_53.jpeg"  \
                } , \
                 { \
                "type" :"buildActionOpenPhone" \
                 ,"header" : "Liên hệ"  \
                , "body" :"" \
                , "link" : "0915846849" \
                , "image" : "https://www.phankhangco.com/frontend/theme2/images/slider/slide3.jpg"  \
                } \
                ]}';
            });
    }

    save() {
        let service = this.API.service('save', this.API.all('cms0100'));
        var param = {
            'cms_home_marquee': this.m.form.cms_home_marquee,
            'cms_home_marquee_2': this.m.form.cms_home_marquee_2
        };
        service.post(param)
            .then((response) => {
                // this.m.form = response.plain().data;
                this.ClientService.success(this.$translate.instant('MSG_I000003'));
            });
    }

    broadcast() {
        var self = this; 
       

        if (self.m.isSaved == true) {
            swal("Đang xử lý!")
            return;
        }

        // this.$log.info('check print packing');
        swal({
            title: "Bạn có muốn thông báo tới tất cả followers qua ZALO?",
            text: "Sau khi bấm tài khoản zalo của khách hàng sẽ nhận được thông báo",
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                message: self.m.form.cms_zalo_notify
            };
            self.m.isSaved = true;
            let service = self.API.service('notify-all-zalo', self.API.all('cms0100'));
            service.post(param)
                .then((res) => {
                    // self.ClientService.warning(res.data.errorMsg);
                    // self.init();
                    self.m.isSaved = false;
                });
        });
    }

    addProduct() {
        if( angular.isUndefined(this.m.form.listProduct)) {
            this.m.form.listProduct = [];
        }
        if( angular.isUndefined(this.m.form.listIds)) {
            this.m.form.listIds = [];
        }
        // let listId = this.m.form.listProduct.map((product) => product.product_id);
        let listId = this.m.form.listIds;
        listId.push(this.m.form.selectProduct.product_id);
        let set = new Set(listId);
        listId = Array.from(set);

        let topProduct = listId.join(',');
        let param = {
            'cms_home_top_product': topProduct
        };
        this.API.service('save-products', this.API.all('cms0100'))
            .post(param)
            .then((response) => {
                this.ClientService.success(response.data.msg);
                this.m.form.selectProduct = null;
                this.loadListTopProduct();
            });
    }

    addProductNew() {
        if( angular.isUndefined(this.m.form.listProductNew)) {
            this.m.form.listProductNew = [];
        }
        if( angular.isUndefined(this.m.form.listIdsNew)) {
            this.m.form.listIdsNew = [];
        }
        // let listId = this.m.form.listProduct.map((product) => product.product_id);
        let listId = this.m.form.listIdsNew;
        listId.push(this.m.form.selectProductNew.product_id);
        let set = new Set(listId);
        listId = Array.from(set);

        let topProduct = listId.join(',');
        let param = {
            'cms_home_new_product': topProduct
        };
        this.API.service('save-products', this.API.all('cms0100'))
            .post(param)
            .then((response) => {
                this.ClientService.success(response.data.msg);
                this.m.form.selectProductNew = null;
                this.loadListNewProduct();
            });
    }

    removeProduct(product) {

        swal({
            title: 'Are you sure?',
            text: `Do you want to remote this product (${product.product_code})`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, remove it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            let listId = this.m.form.listProduct.map((product) => product.product_id).filter(x => x != product.product_id);
            let topProduct = listId.join(',');
            
            let param = {
                'cms_home_top_product': topProduct
            };
            this.API.service('save-products', this.API.all('cms0100'))
                .post(param)
                .then((response) => {
                    // this.ClientService.success('Đã thêm sản phẩm thành công');
                    this.ClientService.success('Đã cập nhật thành công');
                    this.loadListTopProduct();
                });
        })
    }

    removeProductNew(product) {

        swal({
            title: 'Are you sure?',
            text: `Do you want to remote this product (${product.product_code})`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, remove it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            let listId = this.m.form.listProductNew.map((product) => product.product_id).filter(x => x != product.product_id);
            let topProduct = listId.join(',');
            
            let param = {
                'cms_home_new_product': topProduct
            };
            this.API.service('save-products', this.API.all('cms0100'))
                .post(param)
                .then((response) => {
                    // this.ClientService.success('Đã thêm sản phẩm thành công');
                    this.ClientService.success('Đã cập nhật thành công');
                    this.loadListTopProduct();
                });
        })
    }

    loadListTopProduct() {
        this.API.service('load-products', this.API.all('cms0100'))
            .post({type: "BEST_SALE"})
            .then((response) => {
                let data = response.data;
                this.m.form.listProduct = data.listProduct;
                this.m.form.listIds = data.listProduct.map(x => x.product_id);
                this.m.init.listProductFilter = this.reduceListAllProduct(this.m.form.listIds);
            });
    }

    loadListNewProduct() {
        this.API.service('load-products', this.API.all('cms0100'))
            .post({type: "NEW"})
            .then((response) => {
                let data = response.data;
                this.m.form.listProductNew = data.listProduct;
                this.m.form.listIdsNew = data.listProduct.map(x => x.product_id);
                this.m.init.listProductFilterNew = this.reduceListAllProduct(this.m.form.listIdsNew);
            });
    }

    reduceListAllProduct(listIds) {
        let products = [];
        if( angular.isUndefined(listIds)) {
            listIds = [];
        }
        this.m.init.listProduct.forEach(product => {
            if( listIds.indexOf(product.product_id) < 0 ) {
                products.push(product);
            }
        });
        
        return products;
    }

    chooseTab(tab) {
        this.m.activeFlag = tab;
    }
}

export const Cms0100Component = {
    // templateUrl: './views/app/components/cms0100/cms0100.component.html',
    templateUrl: '/views/admin.cms0100',
    controller: Cms0100Controller,
    controllerAs: 'vm',
    bindings: {}
}