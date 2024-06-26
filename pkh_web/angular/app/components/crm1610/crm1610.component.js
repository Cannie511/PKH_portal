class Crm1610Controller {
    constructor($scope, $state, $compile, DTOptionsBuilder, DTColumnBuilder, $log, ClientService, AclService, API, UtilsService, RouteService, $stateParams) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.RouteService = RouteService;
        this.ClientService = ClientService;
        this.m = {
            delivery: {

            },
            init: {},
            deliveryDetail: [],
            form: {},
            dateOptions: {
                viewMode: 'days',
                format: 'YYYY-MM-dd'
            }
        }


        this.m.canEdit = true;
        this.m.check_status = [1, 1, 1, 1, 1, 1, 1, 1, 1];
        this.m.supplier_delivery_id = $stateParams.supplier_delivery_id;
        this.m.supplier_order_id = $stateParams.supplier_order_id;

        this.m.test = [0, 0, 0, 0]; // using to check valid input forms in thanh toan 1
        this.m.testForm = [0, 0, 0, 0, 0, 0, 0]; // using to check valid input forms about information of delivery 

        // this.$log.info('ahihi form init', this.m.testForm);
        if (this.m.supplier_delivery_id == null) {
            this.m.form.supplier_delivery_id = 0;
        }

        if (this.m.supplier_order_id == null || this.m.supplier_order_id <= 0) {
            //$log.info(this.m);
            this.ClientService.warning("Vui lòng chọn packing list invoice");
            RouteService.goState("app.crm1600");
            return;
        }

        this.loadInitData();

    }

    choose(index) {
        let $log = this.$log
        this.m.check_status[index] = -1 * this.m.check_status[index];
        //$log.info('check_status', this.m);
    }



    makeNotificationConfirm(index) {
        let str = "Lưu ngày ";
        if (index == 1) str = str + "thanh toán lần 1 ";
        if (index == 2) str = str + "sản xuất xong ";
        if (index == 3) str = str + "bắt đầu vận chuyển từ Malaysia ";
        if (index == 4) str = str + "hàng đến cảng ";
        if (index == 5) str = str + "nhập kho ";
        if (index == 5) str = str + "thanh toán lần 2 ";
        str = str + "thành công";
        return str;
    }

    checkValidForm1() {

        let oke = true;
        let msg = "";
        if (this.m.form.contract_no == null || this.m.form.contract_no == "") {
            this.m.test[0] = 1;
            msg = "Chưa nhập mã hợp đồng ";
            oke = false;
        } else {
            this.m.test[0] = 0
        }
        if (this.m.form.payment_1_percent == null || this.m.form.payment_1_percent == "") {
            this.m.test[1] = 1;
            oke = false;
            msg = msg + "Chưa nhập % thanh toán lần 1 ";
        } else {
            this.m.test[1] = 0
        }
        if (this.m.form.payment_2_duration == null || this.m.form.payment_2_duration == "") {
            this.m.test[2] = 1;
            oke = false;
            msg = msg + "Chưa nhập thời hạn thanh toán lần 2 ";
        } else {
            this.m.test[2] = 0
        }
        if (!oke) {
            this.ClientService.error(msg);
        }
        return oke;
    }

    checkValidForm2() {

        let oke = true;
        if (this.m.form.payment_desc == null || this.m.form.payment_desc == "") {
            this.m.test[3] = 1;
            oke = false;
        } else {
            this.m.test[3] = 0
        }

        return oke;
    }

    checkValidForm3() {
        let $log = this.$log
            //$log.info('check form ', this.m.form);
        let oke = true;
        if (this.m.form.rate == null || this.m.form.rate == "") {
            this.m.testForm[0] = 1;
            oke = false;
        } else {
            this.m.testForm[0] = 0
        }

        if (this.m.form.vat_tax == null) {
            this.m.testForm[2] = 1;
            oke = false;
        } else {
            if (this.m.form.vat_tax > 100 || this.m.form.vat_tax < 0) {
                this.m.testForm[2] = 1;
                oke = false;
            } else {
                this.m.testForm[2] = 0
            }
        }
        if (this.m.form.frieght_cost == null || this.m.form.frieght_cost < 0) {
            this.m.testForm[3] = 1;
            oke = false;
            //$log.info('check frieght  ', this.m.form.frieght_cost);
        } else {
            this.m.testForm[3] = 0
        }
        if (this.m.form.landed_cost == null || this.m.form.landed_cost < 0) {
            this.m.testForm[4] = 1;
            oke = false;
        } else {
            this.m.testForm[4] = 0
        }
        if (this.m.form.insurance_cost == null || this.m.form.insurance_cost < 0) {
            this.m.testForm[5] = 1;
            oke = false;
            // $log.info('check insurance_cost  ', this.m.form.insurance_cost);
        } else {
            this.m.testForm[5] = 0
        }
        if (this.m.form.pi_no == null || this.m.form.pi_no == "") {
            this.m.testForm[6] = 1;
            oke = false;
        } else {
            this.m.testForm[6] = 0
        }

        return oke;
    }

    checkValidForm2() {

        let oke = true;
        if (this.m.form.payment_desc == null || this.m.form.payment_desc == "") {
            this.m.test[3] = 1;
            oke = false;
        } else {
            this.m.test[3] = 0
        }

        return oke;
    }


    checkValidForm5() {

        let oke = true;
        let msg = "";
        if (this.m.form.warehouse_id == null || this.m.form.warehouse_id == "") {
            msg = "Vui lòng chọn kho để nhập.";
            oke = false;
        } 
        
        if (!oke) {
            this.ClientService.error(msg);
        }
        return oke;
    }

    confirm(index) {
        let $log = this.$log
        
            //$log.info('ahihi', param);

        if (index == 1 && !this.checkValidForm1()) {
            return;
        }

        if (index == 5 && !this.checkValidForm5()) {
            return;
        }

        var detail = [];
        let that = this;
        swal({
            title: "Bạn có muốn xác nhận",
            text: "Sau khi bấm nút xác nhận sẽ không chỉnh sửa được nữa. Lưu ý sau khi chọn kho nhập và đồng ý bạn sẽ không thể điều chỉnh được nữa.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            let param = {
                index: index,
                form: that.m.form
            }
            let confirmService = that.API.service('confirm', that.API.all('crm1610'));
            confirmService.post(param)
                .then((response) => {
                    that.init_confirm = response.data;
    
                    //$log.info('response confirm: ', this.init_confirm);
                    that.m.form.delivery_sts = parseInt(that.init_confirm.instance.delivery_sts);
                    that.m.form.delivery_date = that.init_confirm.instance.delivery_date;
                    that.m.form.finish_cont_date = that.init_confirm.instance.finish_cont_date;
                    that.m.form.deliver_cont_date = that.init_confirm.instance.deliver_cont_date;
                    that.m.form.arrive_port_date = that.init_confirm.instance.arrive_port_date;
                    that.m.form.comming_pkh_date = that.init_confirm.instance.comming_pkh_date;
                    that.m.form.payment_1_date = that.init_confirm.instance.payment_1_date;
                    that.m.form.payment_2_date = that.init_confirm.instance.payment_2_date;
                    that.ClientService.success(that.makeNotificationConfirm(that.m.form.delivery_sts));
                });
          
        });

        
    }

    checkExpectedDate(index) {
        let ok = true;
        switch (index) {
            case 2:
                if (this.m.form.finish_cont_expected_date == "") {
                    ok = false;
                }
                break;
            case 3:
                if (this.m.form.deliver_cont_expected_date == "") {
                    ok = false;
                }
                break;
            case 4:
                if (this.m.form.arrive_port_expected_date == "") {
                    ok = false;
                }
                break;
            case 5:
                if (this.m.form.comming_pkh_expected_date == "") {
                    ok = false;
                }
                break;
            case 6:
                if (this.m.form.payment_2_expected_date == "") {
                    ok = false;
                }
                break;
        }
        return ok;
    }

    clickSaveDate(index) {
        let $log = this.$log
        let param = {
                index: index,
                form: this.m.form
            }
            //$log.info('ahihi', param);
            //$log.info('ahihi chua vao');
        if (!this.checkExpectedDate(index)) {
            return;
        }
        //$log.info('ahihi vao oy date');
        let confirmService = this.API.service('expected-date', this.API.all('crm1610'));
        confirmService.post(param)
            .then((response) => {

            });
    }

    initForm() {
        this.m.form.rate = 0;
        this.m.form.vat_tax = 10;
        this.m.form.frieght_cost = 0;
        this.m.form.landed_cost = 0;
        this.m.form.insurance_cost = 0;
        this.m.form.pi_no = "";
        this.m.form.notes = "";
    }

    nomarlizeForm(init) {
        this.m.form.rate = init.rate;
        this.m.form.vat_tax = parseInt(init.vat_tax);
        this.m.form.frieght_cost = parseInt(init.frieght_cost);
        this.m.form.landed_cost = parseInt(init.landed_cost);
        this.m.form.insurance_cost = parseInt(init.insurance_cost);
        this.m.form.payment_1_date = this.makeDateForExpectedDate(init.payment_1_date);
        this.m.form.finish_cont_date = this.makeDateForExpectedDate(init.finish_cont_date);
        this.m.form.delivery_sts = parseInt(init.delivery_sts);
        this.m.form.deliver_cont_date = this.makeDateForExpectedDate(init.deliver_cont_date);
        this.m.form.arrive_port_date = this.makeDateForExpectedDate(init.arrive_port_date);
        this.m.form.comming_pkh_date = this.makeDateForExpectedDate(init.comming_pkh_date);
        this.m.form.payment_2_date = this.makeDateForExpectedDate(init.payment_2_date);
        this.m.form.finish_cont_expected_date = this.makeDateForExpectedDate(init.finish_cont_expected_date);

        this.m.form.deliver_cont_expected_date = this.makeDateForExpectedDate(init.deliver_cont_expected_date);
        this.m.form.arrive_port_expected_date = this.makeDateForExpectedDate(init.arrive_port_expected_date);
        this.m.form.comming_pkh_expected_date = this.makeDateForExpectedDate(init.comming_pkh_expected_date);
        this.m.form.payment_2_expected_date = this.makeDateForExpectedDate(init.payment_2_expected_date);

    }

    makeDateForExpectedDate(date) {
        if (date != null) {
            return new Date(date);
        }
        return "";
    }

    loadInitData() {
        this.m.delivery.supplier_id = 1;
        this.m.delivery.notes = null;
        let $log = this.$log;
        let param = {
                supplier_delivery_id: this.m.supplier_delivery_id,
                supplier_order_id: this.m.supplier_order_id
            }
            //$log.info('ahihi', param);
        this.initForm();
        let initService = this.API.service('load-init', this.API.all('crm1610'));
        initService.post(param)
            .then((response) => {
                this.m.init = response.data;
                this.m.deliveryDetail = this.m.init.deliveryDetail;
                this.m.warehouseList = this.m.init.warehouseList;


                this.m.form.supplier_id = this.m.init.supplier[0].supplier_id;
                //$log.info('init form ', this.m.init);

                if (this.m.supplier_delivery_id != null) {
                    this.m.form = this.m.init.delivery[0];
                    this.nomarlizeForm(this.m.init.delivery[0]);

                    //$log.info('check init ', this.m.form);
                    this.m.form.payment_desc = "";
                    this.m.form.payment = parseFloat(this.m.form.total) + parseFloat(this.m.form.frieght_cost);
                }
                this.calcDeliveryTotal();
            });
    }

    searchProduct() {
        let $log = this.$log;
        // Get list product 
        let searchService = this.API.service('search-product', this.API.all('crm1610'));
        let param = angular.copy(this.m.filter);

        var thisClass = this;
        searchService.post(param)
            .then((response) => {
                var list = response.plain().data.list;
                if (thisClass.m.deliveryDetail != null && thisClass.m.deliveryDetail.length > 0) {
                    angular.forEach(list, function(value, key) {
                        var hide = false;
                        for (var i = 0; i < thisClass.m.deliveryDetail.length; i++) {
                            if (thisClass.m.deliveryDetail[i].product_id == value.product_id) {
                                hide = true;
                                break;
                            }
                        }
                        value.hide = hide;
                    });
                }

                this.m.productList = list;
            });
    }

    addProduct(product) {
        if (this.m.deliveryDetail == null) {
            this.m.deliveryDetail = [];
        }

        var newProduct = {
            product_id: product.product_id,
            product_code: product.product_code,
            name: product.product_cat_name,
            stock_code: product.stock_code,
            product_name: product.name_origin,
            standard_packing: product.standard_packing,
            product_cat_id: product.product_cat_id,
            unit_price: product.selling_price,
            length: product.length,
            width: product.width,
            height: product.height,
            packaging: product.packaging,
            amount: 0,
            store_delivery_id: 0,
            version_no: 0
                //cần thêm giá vốn
                // cần thêm thể tích thùng

        };

        this.m.deliveryDetail.push(newProduct);
        product.hide = true;
        this.calcDeliveryTotal();
    }

    calcDeliveryTotal() {
        if (this.m.deliveryDetail == null)
            return;
        var total = 0;
        var totalVAT = 0;
        var totalVolume = 0;
        angular.forEach(this.m.deliveryDetail, function(value) {
            total += parseFloat(value.unit_price) * parseFloat(value.amount);
            totalVAT += parseFloat(value.unit_price) * parseFloat(value.amount) * ((parseFloat(value.duty_tax) + 100) / 100);
            totalVolume += parseFloat(Math.ceil(value.amount / value.standard_packing) * parseFloat(value.length) * parseFloat(value.width) * parseFloat(value.height) / 1000000000);
        });
        totalVAT = totalVAT * parseInt(this.m.form.rate);
        this.m.delivery.total_duty = totalVAT;
        //this.$log.info('rate ', this.m.form.rate);
        //this.$log.info('form ', this.m.form);
        this.m.delivery.totalVAT = (totalVAT * 10 / 100);
        this.m.delivery.importCost = this.m.delivery.totalVAT + this.m.form.frieght_cost + this.m.form.landed_cost + this.m.form.insurance_cost;
        this.m.delivery.von = this.m.delivery.importCost + totalVAT;
        this.m.delivery.total = total;
        this.m.delivery.totalVolume = totalVolume;
    }

    roundUp(number) {
        return Math.ceil(number);
    }

    removeProduct(product) {
        var index = this.m.deliveryDetail.indexOf(product);
        if (index >= 0) {
            this.m.deliveryDetail.splice(index, 1);
            this.calcDeliveryTotal();
            for (var i = 0; i < this.m.productList.length; i++) {
                if (this.m.productList[i].product_id == product.product_id) {
                    this.m.productList[i].hide = false;
                }
            }
        }
        this.calcDeliveryTotal();
    }

    clickPrintCheck() {
        var param = {
            supplier_delivery_id: this.m.supplier_delivery_id,
            payment_desc: this.m.form.payment_desc
        };
        let $log = this.$log;
        if (!this.checkValidForm2() || !this.checkValidForm1()) {
            return;
        }
        let service = this.API.service('print-check', this.API.all('crm1610'));
        service.post(param)
            .then((res) => {
                if (res.data.rtnCd == true) {

                    window.open(res.data.url);
                } else {
                    this.ClientService.error('Không tải được tập tin.');
                }
            });
    }

    clickSave() {
        var deliveryDetail = [];
        let oke = true;
        angular.forEach(this.m.deliveryDetail, function(value, key) {
            if (value.duty_tax > 100 || value.duty_tax < 0) {
                oke = false;
            }
            deliveryDetail.push({
                product_id: value.product_id,
                amount: value.amount,
                price: value.unit_price,
                duty_tax: value.duty_tax
            });
        });
        // this.$log.info('ahihi form ', this.m.testForm);
        if (!oke) {
            this.ClientService.error("duty tax không hợp lệ");
            return;
        }
        if (!this.checkValidForm3()) {
            return;
        }

        //this.$log.info('order', this.m.order);
        var param = {
            mode: 'SAVE',
            supplier_id: this.m.form.supplier_id,
            supplier_order_id: this.m.supplier_order_id,
            notes: this.m.form.notes,
            pi_no: this.m.form.pi_no,
            deliveryDetail: deliveryDetail,
            supplier_delivery_id: this.m.supplier_delivery_id,
            total: this.m.delivery.total,
            totalVolume: this.m.delivery.totalVolume,
            totalDuty: this.m.delivery.total_duty,
            rate: this.m.form.rate,
            duty_tax: this.m.form.duty_tax,
            vat_tax: this.m.form.vat_tax,
            frieght_cost: this.m.form.frieght_cost,
            landed_cost: this.m.form.landed_cost,
            insurance_cost: this.m.form.insurance_cost
        };
        // this.$log.info('param', param);
        let service = this.API.service('save', this.API.all('crm1610'));
        service.post(param)
            .then((response) => {
                //this.$log.info('response.data', response.data);
                this.ClientService.success("Lưu thành công");
                this.RouteService.goState("app.crm1600");

            });
    }

    downloadForWarehouse() {
        let param = {
            supplier_delivery_id: this.m.supplier_delivery_id
        };

        let service = this.API.service('download-warehouse', this.API.all('crm1610'));

        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    downloadForAdmin() {
        let param = {
            supplier_delivery_id: this.m.supplier_delivery_id
        };

        let service = this.API.service('download-admin', this.API.all('crm1610'));

        service.post(param)
            .then((response) => {
                //this.$log.info(response.data);
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

    saveActualDate() {
        let $log = this.$log
        let param = {
            supplier_delivery_id: this.m.form.supplier_delivery_id,
            payment_1_date: this.m.form.payment_1_date,
            finish_cont_date: this.m.form.finish_cont_date,
            deliver_cont_date: this.m.form.deliver_cont_date,
            arrive_port_date: this.m.form.arrive_port_date,
            comming_pkh_date: this.m.form.comming_pkh_date,
            payment_2_date: this.m.form.payment_2_date
        }

        let confirmService = this.API.service('actual-date', this.API.all('crm1610'));
        confirmService.post(param)
            .then((response) => {
                this.ClientService.success("Save successfully");
            });
    }

    $onInit() {}
}

export const Crm1610Component = {
    //templateUrl: './views/app/components/crm1610/crm1610.component.html',
    templateUrl: '/views/admin.crm1610',
    controller: Crm1610Controller,
    controllerAs: 'vm',
    bindings: {}
}