export function RoutesConfig($stateProvider, $urlRouterProvider) {
    'ngInject'

    var getView = (viewName) => {
        return `./views/app/pages/${viewName}/${viewName}.page.html`
    }

    var getViewServer = (viewName) => {
        return `/views/admin.${viewName}`
    }

    var getLayout = (layout) => {
        return `./views/app/pages/layout/${layout}.page.html`
    }

    var getStateDefinition = (name, options) => {
        var template = `<${name}></${name}>`;
        var defOption = {
            url: '/' + name,
            data: {
                auth: true
            },
            views: {
                'main@app': {
                    template: template
                }
            }
        };
        if (angular.isDefined(options) && options != null) {
            angular.merge(defOption, options);
        }

        return defOption;
    }

    $urlRouterProvider.otherwise('/');

    $stateProvider
        .state("app", {
            abstract: true,
            views: {
                layout: {
                    templateUrl: getLayout("layout"),
                },
                "header@app": {
                    templateUrl: getViewServer("header"),
                },
                "footer@app": {
                    templateUrl: getViewServer("footer"),
                },
                main: {},
            },
            data: {
                bodyClass: "hold-transition skin-blue sidebar-mini",
            },
        })
        .state("app.landing", {
            url: "/",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    templateUrl: getView("landing"),
                },
            },
        })
        .state("app.profile", {
            url: "/profile",
            data: {
                auth: true,
                roles: ["Admin"],
            },
            views: {
                "main@app": {
                    template: "<user-profile></user-profile>",
                },
            },
            params: {
                alerts: null,
            },
        })
        .state("app.userlist", {
            url: "/user-lists",
            data: {
                auth: true,
                // roles: ['manager']
                permissions: {
                    only: ["admin.adm0100"],
                    redirectTo: "login",
                },
            },
            views: {
                "main@app": {
                    template: "<user-lists></user-lists>",
                },
            },
        })
        .state("app.useredit", {
            url: "/user-edit/:userId",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-edit></user-edit>",
                },
            },
            params: {
                alerts: null,
                userId: null,
            },
        })
        .state("app.userroles", {
            url: "/user-roles",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-roles></user-roles>",
                },
            },
        })
        .state("app.userpermissions", {
            url: "/user-permissions",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-permissions></user-permissions>",
                },
            },
        })
        .state("app.userpermissionsadd", {
            url: "/user-permissions-add",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-permissions-add></user-permissions-add>",
                },
            },
            params: {
                alerts: null,
            },
        })
        .state("app.userpermissionsedit", {
            url: "/user-permissions-edit/:permissionId",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-permissions-edit></user-permissions-edit>",
                },
            },
            params: {
                alerts: null,
                permissionId: null,
            },
        })
        .state("app.userrolesadd", {
            url: "/user-roles-add",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-roles-add></user-roles-add>",
                },
            },
            params: {
                alerts: null,
            },
        })
        .state("app.userrolesedit", {
            url: "/user-roles-edit/:roleId",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<user-roles-edit></user-roles-edit>",
                },
            },
            params: {
                alerts: null,
                roleId: null,
            },
        })
        .state("login", {
            url: "/login",
            views: {
                layout: {
                    templateUrl: getView("login"),
                },
                "header@app": {},
                "footer@app": {},
            },
            data: {
                bodyClass: "hold-transition login-page",
            },
            params: {
                registerSuccess: null,
                successMsg: null,
            },
        })
        .state("loginloader", {
            url: "/login-loader",
            views: {
                layout: {
                    templateUrl: getView("login-loader"),
                },
                "header@app": {},
                "footer@app": {},
            },
            data: {
                bodyClass: "hold-transition login-page",
            },
        })
        .state("register", {
            url: "/register",
            views: {
                layout: {
                    templateUrl: getView("register"),
                },
                "header@app": {},
                "footer@app": {},
            },
            data: {
                bodyClass: "hold-transition register-page",
            },
        })
        .state("userverification", {
            url: "/userverification/:status",
            views: {
                layout: {
                    templateUrl: getView("user-verification"),
                },
            },
            data: {
                bodyClass: "hold-transition login-page",
            },
            params: {
                status: null,
            },
        })
        .state("forgot_password", {
            url: "/forgot-password",
            views: {
                layout: {
                    templateUrl: getView("forgot-password"),
                },
                "header@app": {},
                "footer@app": {},
            },
            data: {
                bodyClass: "hold-transition login-page",
            },
        })
        .state("reset_password", {
            url: "/reset-password/:email/:token",
            views: {
                layout: {
                    templateUrl: getView("reset-password"),
                },
                "header@app": {},
                "footer@app": {},
            },
            data: {
                bodyClass: "hold-transition login-page",
            },
        })
        .state("app.logout", {
            url: "/logout",
            views: {
                "main@app": {
                    controller: function (
                        $rootScope,
                        $scope,
                        $auth,
                        $state,
                        AclService,
                        API
                    ) {
                        // let service = API.service('logout', API.all('auth'));
                        let service = API.all("logout");
                        service.post().then(() => {});

                        $auth.logout().then(function () {
                            delete $rootScope.me;
                            AclService.flushRoles();
                            AclService.setAbilities({});
                            $state.go("login");
                        });
                    },
                },
            },
        })
        /**
         * CRM: Customer relationship management
         */
        // Supplier
        .state("app.supplierlist", {
            url: "/supplier-lists",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<supplier-lists></supplier-lists>",
                },
            },
        })
        .state("app.supplieradd", {
            url: "/supplier-add",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<supplier-add></supplier-add>",
                },
            },
        })
        .state("app.supplieredit", {
            url: "/supplier-edit/:id",
            data: {
                auth: true,
            },
            views: {
                "main@app": {
                    template: "<supplier-edit></supplier-edit>",
                },
            },
        })
        .state("app.adm0110", getStateDefinition("adm0110"))
        .state("app.crm0130", getStateDefinition("crm0130"))
        .state("app.crm0140", getStateDefinition("crm0140"))
        .state("app.crm0141", getStateDefinition("crm0141"))
        .state("app.crm1300", getStateDefinition("crm1300"))
        .state("app.crm1500", getStateDefinition("crm1500"))
        .state("app.crm1600", getStateDefinition("crm1600"))
        .state("app.crm1700", getStateDefinition("crm1700"))
        .state("app.crm1640", getStateDefinition("crm1640"))
        //Loai chi phi
        .state("app.crm1810", getStateDefinition("crm1810"))
        .state(
            "app.crm1811",
            getStateDefinition("crm1811", {
                params: { alerts: null, cost_cat_id: null },
            })
        )
        // Phong ban cong ty
        .state("app.crm1820", getStateDefinition("crm1820"))
        .state(
            "app.crm1821",
            getStateDefinition("crm1821", {
                params: { alerts: null, department_id: null },
            })
        )
        // chi phi
        .state("app.crm1830", getStateDefinition("crm1830"))
        .state(
            "app.crm1831",
            getStateDefinition("crm1831", {
                params: { alerts: null, cost_id: null },
            })
        )
        .state(
            "app.crm1832",
            getStateDefinition("crm1831", {
                url: "/crm1831/{cost_id:int}",
                params: { alerts: null, cost_id: null },
            })
        )
        //Manage web order : Quản lý thông tin user order online
        .state("app.crm1900", getStateDefinition("crm1900"))
        //Manage web order : Quản lý thông tin  order online
        .state("app.crm1920", getStateDefinition("crm1920"))
        //Manage web order : Quản lý thông tin  order online chi tiết
        .state(
            "app.crm1921",
            getStateDefinition("crm1921", {
                params: { alerts: null, web_order_id: null },
            })
        )
        .state(
            "app.crm1922",
            getStateDefinition("crm1921", {
                url: "/crm1921/{web_order_id:int}",
                params: { alerts: null, web_order_id: null },
            })
        )
        //Nhập hàng
        .state(
            "app.crm1630",
            getStateDefinition("crm1630", {
                params: {
                    alerts: null,
                    import_type: null,
                    supplier_delivery_id: null,
                    store_id: null,
                    import_wh_id: null,
                    type: null,
                },
            })
        )
        .state(
            "app.crm1631",
            getStateDefinition("crm1630", {
                url: "/crm1630/{type:int}/{import_wh_id:int}",
                params: { alerts: null, type: null, import_wh_id: null },
            })
        )
        //Thêm packing
        .state(
            "app.crm1610",
            getStateDefinition("crm1610", {
                url: "/crm1610/{supplier_delivery_id:int}/{supplier_order_id:int}",
                params: {
                    alerts: null,
                    supplier_delivery_id: null,
                    supplier_order_id: null,
                },
            })
        )
        .state(
            "app.crm1710",
            getStateDefinition("crm1710", {
                params: { alerts: null, promotion_id: null },
            })
        )
        .state("app.crm1620", getStateDefinition("crm1620"))
        .state("app.crm1650", getStateDefinition("crm1650"))
        // Hỗ trợ hóa đơn
        .state(
            "app.crm0740",
            getStateDefinition("crm0740", {
                params: { store_order_id: null, store_delivery_id: null },
            })
        )
        //Thêm packing
        .state(
            "app.crm1510",
            getStateDefinition("crm1510", {
                params: { alerts: null, packing_id: null },
            })
        )
        //Thêm đặt hàng nhà máy
        .state(
            "app.crm1310",
            getStateDefinition("crm1310", {
                params: { alerts: null, supplier_id: null },
            })
        )
        .state(
            "app.crm1311",
            getStateDefinition("crm1310", {
                url: "/crm1310/{supplier_order_id:int}/{supplier_id:int}",
                params: {
                    alerts: null,
                    supplier_order_id: null,
                    supplier_id: null,
                },
            })
        )
        //Thêm người giao hàng
        .state(
            "app.crm1010",
            getStateDefinition("crm1010", {
                params: { alerts: null, store_id: null, delivery_id: null },
            })
        )
        // Thêm người giao hàng
        .state(
            "app.crm1110",
            getStateDefinition("crm1110", {
                params: { alerts: null, delivery_vendor_id: null },
            })
        )
        .state(
            "app.crm2521",
            getStateDefinition("crm2521", {
                params: { alerts: null, supplier_id: null },
            })
        )
        // Tạo thanh toán
        .state(
            "app.crm0710",
            getStateDefinition("crm0710", {
                params: { alerts: null, store_id: null, payment_id: null },
            })
        )
        .state(
            "app.crm0711",
            getStateDefinition("crm0710", {
                url: "/crm0710/{cpayment_id:int}/{store_id:int}",
                params: { alerts: null, store_id: null, payment_id: null },
            })
        )
        // Theo dõi công nợ
        .state("app.crm0720", getStateDefinition("crm0720"))
        // Thêm tài khoản ngân hàng
        .state(
            "app.crm1210",
            getStateDefinition("crm1210", {
                params: { alerts: null, store_id: null, bank_account_id: null },
            })
        )
        // Danh sách đơn đặt hàng
        .state("app.crm0200", getStateDefinition("crm0200"))

        .state(
            "app.crm0200_params",
            getStateDefinition("crm0200", {
                url: "/crm0201",
                params: { alerts: null, store_id: null },
            })
        )
        // Tạo đơn đặt hàng
        .state(
            "app.crm0210",
            getStateDefinition("crm0210", {
                params: { alerts: null, store_id: null },
            })
        )
        .state(
            "app.crm0211",
            getStateDefinition("crm0210", {
                url: "/crm0210/{store_id:int}/{store_order_id:int}",
                params: { alerts: null, store_id: null, store_order_id: null },
            })
        )
        // Đơn hàng giao thiếu
        .state("app.crm0220", getStateDefinition("crm0220"))
        // Sản phẩm cửa hàng đã mua
        .state(
            "app.crm0230",
            getStateDefinition("crm0230", {
                params: { alerts: null, store_id: null },
            })
        )
        // Sản phẩm cửa hàng chưa mua
        .state(
            "app.crm0231",
            getStateDefinition("crm0231", {
                params: { alerts: null, store_id: null },
            })
        )
        // Danh sách xử lý đơn hàng
        .state("app.crm0240", getStateDefinition("crm0240"))
        // Danh sách ngày công nợ
        .state("app.crm0250", getStateDefinition("crm0250"))
        // Danh sach cua hang
        .state("app.crm0300", getStateDefinition("crm0300"))
        // Ban do cua hang
        .state("app.crm0301", getStateDefinition("crm0301"))
        // Tao cua hang
        .state(
            "app.crm0310",
            getStateDefinition("crm0310", {
                params: { alerts: null, store_id: null },
            })
        )
        // Tao cua hang
        .state("app.crm0320", getStateDefinition("crm0320"))
        // Theo doi doanh so cua hang
        .state("app.crm0321", getStateDefinition("crm0321"))
        // Phân công cửa hàng
        .state("app.crm0340", getStateDefinition("crm0340"))
        // Danh sach chanh xe
        .state("app.crm0350", getStateDefinition("crm0350"))
        .state(
            "app.crm0351",
            getStateDefinition("crm0351", { params: { chanh_id: null } })
        )
        .state(
            "app.crm0352",
            getStateDefinition("crm0351", { url: "/crm0351/{chanh_id:int}" })
        )
        //Customer service
        .state("app.crm0500", getStateDefinition("crm0500"))
        //Customer service Create
        .state(
            "app.crm0510",
            getStateDefinition("crm0510", {
                params: { alerts: null, store_id: null },
            })
        )
        .state(
            "app.crm0511",
            getStateDefinition("crm0510", { url: "/crm0511/{cs_id:int}" })
        )
        // Tao man hinh danh sach tai khoan ngan hang
        .state("app.crm1200", getStateDefinition("crm1200"))
        // Ghi chú cửa hàng
        .state(
            "app.crm0330",
            getStateDefinition("crm0330", { params: { store_id: null } })
        )
        .state(
            "app.crm0331",
            getStateDefinition("crm0331", {
                params: { store_order_id: null, store_delivery_id: null },
            })
        )
        .state(
            "app.crm0332",
            getStateDefinition("crm0331", {
                url: "/crm0331/{store_id:int}/{store_working_id:int}",
            })
        )
        // Danh sach phieu xuat
        .state("app.crm0400", getStateDefinition("crm0400"))
        .state(
            "app.crm0400_params",
            getStateDefinition("crm0400", {
                url: "/crm0401",
                params: { alerts: null, store_id: null },
            })
        )
        // Tao phieu xuat hang
        .state(
            "app.crm0410",
            getStateDefinition("crm0410", {
                params: { store_order_id: null, store_delivery_id: null },
            })
        )
        .state(
            "app.crm0411",
            getStateDefinition("crm0410", {
                url: "/crm0410/{store_order_id:int}/{store_delivery_id:int}",
            })
        )
        .state("app.crm0100", getStateDefinition("crm0100"))
        // .state('app.crm0110', getStateDefinition('crm0110', { params: { product_id: 0 } }))
        .state(
            "app.crm0110",
            getStateDefinition("crm0110", { url: "/crm0110/{product_id:int}" })
        )
        //Loai san pham
        .state("app.crm0120", getStateDefinition("crm0120"))
        //chi tiet loai san pham
        // .state('app.crm0121', getStateDefinition('crm0121', { params: { product_cat_id: 0 } }))
        .state(
            "app.crm0121",
            getStateDefinition("crm0121", {
                url: "/crm0121/{product_cat1_id:int}",
            })
        )
        .state("app.crm0800", getStateDefinition("crm0800"))
        .state("app.crm0810", getStateDefinition("crm0810"))
        .state(
            "app.crm0811",
            getStateDefinition("crm0810", {
                url: "/crm0810/{checkWarehouseId:int}",
            })
        )
        .state("app.crm0900", getStateDefinition("crm0900"))
        .state("app.crm0910", getStateDefinition("crm0910"))
        .state("app.crm0912", getStateDefinition("crm0912"))
        .state(
            "app.crm0913",
            getStateDefinition("crm0913", {
                params: { checkingDate: null, check_warehouse_id: null },
            })
        )
        .state(
            "app.crm0913_2",
            getStateDefinition("crm0913", {
                url: "/crm0913/{check_warehouse_id:int}",
            })
        )
        // Thời gian tiêu thụ công
        .state("app.crm0914", getStateDefinition("crm0914"))
        // Thời gian tiêu thụ sản phẩm
        .state(
            "app.crm0915",
            getStateDefinition("crm0915", { params: { pi_no: null } })
        )

        .state("app.crm0920", getStateDefinition("crm0920"))
        .state("app.crm1000", getStateDefinition("crm1000"))
        // Danh sach nguoi giao hang
        .state("app.crm1100", getStateDefinition("crm1100"))
        .state("app.crm2520", getStateDefinition("crm2520"))
        .state("app.crm0700", getStateDefinition("crm0700"))
        .state("app.crm0750", getStateDefinition("crm0750"))
        // Tạo thanh toán
        .state(
            "app.crm0751",
            getStateDefinition("crm0751", {
                params: {
                    alerts: null,
                    store_order_id: null,
                    payment_id: null,
                },
            })
        )
        .state(
            "app.crm0752",
            getStateDefinition("crm0751", {
                url: "/crm0751/{store_order_id:int}/{payment_id:int}",
                params: {
                    alerts: null,
                    store_order_id: null,
                    payment_id: null,
                },
            })
        )
        // Danh sach chi nhanh
        .state("app.crm2000", getStateDefinition("crm2000"))
        .state(
            "app.crm2010",
            getStateDefinition("crm2010", {
                params: { alerts: null, branch_id: null },
            })
        )
        .state(
            "app.crm2011",
            getStateDefinition("crm2010", { url: "/crm2010/{branch_id:int}" })
        )
        //Danh sách tỉnh
        .state("app.crm2100", getStateDefinition("crm2100"))
        .state("app.crm2110", getStateDefinition("crm2110"), {
            params: { area_id: null },
        })
        .state(
            "app.crm2111",
            getStateDefinition("crm2110", { url: "/crm2110/{area_id:int}" })
        )
        //Danh sách khu vực
        .state("app.crm2200", getStateDefinition("crm2200"))
        // Danh sách xuất kho chi nhánh nội bộ
        .state("app.crm2300", getStateDefinition("crm2300"))
        // Xuất kho chi nhánh nội bộ
        .state(
            "app.crm2310",
            getStateDefinition("crm2310", { params: { alerts: null } })
        )
        .state(
            "app.crm2311",
            getStateDefinition("crm2310", {
                url: "/crm2310/{warehouse_exim_id:int}",
                params: { alerts: null, warehouse_exim_id: null },
            })
        )

        // Nhập kho chi nhánh nội bộ
        .state("app.crm2320", getStateDefinition("crm2320"))
        // Danh sách nhập kho chi nhánh nội bộ
        .state("app.crm2330", getStateDefinition("crm2330"))
        // Danh sách thời gian đặt hàng gần nhất của cửa hàng
        .state("app.crm2400", getStateDefinition("crm2400"))
        // Danh sách vật phẩm
        .state("app.crm2500", getStateDefinition("crm2500"))
        // Tạo vật phẩm
        .state("app.crm2510", getStateDefinition("crm2510"))
        .state(
            "app.crm2511",
            getStateDefinition("crm2510", {
                url: "/crm2510/{product_market_id:int}",
            })
        )
        // Danh sách Nhập/Xuất vật phẩm
        .state("app.crm2530", getStateDefinition("crm2530"))
        // Nhập/Xuất vật phẩm
        .state(
            "app.crm2540",
            getStateDefinition("crm2540", {
                url: "/crm2540/{product_market_his_id:int}",
            })
        )
        .state(
            "app.crm2541",
            getStateDefinition("crm2540", {
                params: { warehouse_change_type: null },
            })
        )
        // Tồn kho vật phẩm
        .state("app.crm2550", getStateDefinition("crm2550"))
        // Chi tiết cửa hàng
        .state(
            "app.crm2600",
            getStateDefinition("crm2600", {
                url: "/crm2600/{store_id:int}",
                params: { alerts: null, store_id: null },
            })
        )
        .state(
            "app.crm2610",
            getStateDefinition("crm2610", {
                url: "/crm2610/{store_id:int}",
                params: { alerts: null, store_id: null },
            })
        )
        .state("app.crm2700", getStateDefinition("crm2700"))
        .state("app.crm2710", getStateDefinition("crm2710"))
        // Danh sách KPI của hàng
        .state("app.crm2800", getStateDefinition("crm2800"))
        // Danh sách KPI 1 của hàng
        .state(
            "app.crm2810",
            getStateDefinition("crm2810", {
                url: "/crm2810/{store_id:int}",
                params: { alerts: null, store_id: null },
            })
        )
        // Chi tiết KPI của hàng 1 tháng
        .state(
            "app.crm2820",
            getStateDefinition("crm2820", {
                url: "/crm2820/{kpi_id:int}/{month:int}",
            })
        )
        // Danh sách kho
        .state("app.crm2900", getStateDefinition("crm2900"))
        // Tao kho
        .state(
            "app.crm2910",
            getStateDefinition("crm2910", {
                params: { alerts: null, warehouse_id: null },
            })
        )
        .state(
            "app.crm2911",
            getStateDefinition("crm2910", {
                url: "/crm2910/{warehouse_id:int}",
                params: { alerts: null, warehouse_id: null },
            })
        )
        //Đánh giá đại lý
        .state("app.crm3000", getStateDefinition("crm3000"))
        .state("app.crm4000", getStateDefinition("crm4000"))
        .state("app.crm3010", getStateDefinition("crm3010"))
        //lịch sử điểm
        .state(
            "app.crm3020",
            getStateDefinition("crm3020", {
                params: { alerts: null, warehouse_id: null },
            })
        )
        .state(
            "app.crm3021",
            getStateDefinition("crm3020", {
                url: "/crm3020/{store_id:int}",
                params: { alerts: null, store_id: null },
            })
        )
        /**
         * HRM: Human resouce management
         */
        // Lịch công ty
        .state("app.hrm0100", getStateDefinition("hrm0100"))
        // Đơn xin nghỉ phép
        .state("app.hrm0110", getStateDefinition("hrm0110"))
        // Duyệt đơn
        .state("app.hrm0120", getStateDefinition("hrm0120"))
        // Thống kê phép năm
        .state("app.hrm0130", getStateDefinition("hrm0130"))
        // Truy cập hệ thống
        .state("app.hrm0140", getStateDefinition("hrm0140"))
        // Thời gian làm việc theo tháng
        .state("app.hrm0141", getStateDefinition("hrm0141"))
        // VỊ trí mới nhất
        .state("app.hrm0150", getStateDefinition("hrm0150"))
        // LỊch sử vị trí
        .state("app.hrm0151", getStateDefinition("hrm0151"))
        // Checkin
        .state("app.hrm0152", getStateDefinition("hrm0152"))
        // Checkin/Checkout Web
        .state("app.hrm0153", getStateDefinition("hrm0153"))
        // Checkin/Checkout Web List
        .state("app.hrm0154", getStateDefinition("hrm0154"))
        // Danh sách bài kiểm tra
        .state("app.hrm0200", getStateDefinition("hrm0200"))
        // Kiểm tra
        .state(
            "app.hrm0210",
            getStateDefinition("hrm0210", { params: { id: 0 } })
        )

        // Danh sách
        .state("app.hrm0300", getStateDefinition("hrm0300"))
        .state(
            "app.hrm0310",
            getStateDefinition("hrm0310", { params: { task_id: null } })
        )
        // HRM0400	Bảng lương
        .state("app.hrm0400", getStateDefinition("hrm0400"))
        .state("app.hrm0410", getStateDefinition("hrm0410"))
        // HRM0500	KPI
        .state("app.hrm0500", getStateDefinition("hrm0500"))
        .state("app.hrm0510", getStateDefinition("hrm0510"))
        // HRM0600	Bảng chấm công
        .state("app.hrm0600", getStateDefinition("hrm0600"))
        // HRM0700	Danh sách nhân viên
        .state("app.hrm0700", getStateDefinition("hrm0700"))
        // HRM0710  Thông tin nhân viên
        .state(
            "app.hrm0710",
            getStateDefinition("hrm0710", { url: "/hrm0710/{id:int}" })
        )
        .state(
            "app.hrm0714",
            getStateDefinition("hrm0710", {
                url: "/hrm0710/{id:int}",
                params: { screenMode: "EDIT" },
            })
        )
        // HRM0715  Danh sách hợp đồng
        .state(
            "app.hrm0715",
            getStateDefinition("hrm0715", { url: "/hrm0715/{id:int}" })
        )
        // HRM0716  Add/Edit hợp đồng
        .state(
            "app.hrm0716",
            getStateDefinition("hrm0716", {
                url: "/hrm0716/{employee_id:int}/{contract_id:int}",
            })
        )
        // HRM0800 Leave allocation list
        .state("app.hrm0800", getStateDefinition("hrm0800"))
        // .state('app.hrm0810', getStateDefinition('hrm0810'))
        .state(
            "app.hrm0810",
            getStateDefinition("hrm0810", {
                url: "/hrm0810/{id:int}",
                params: { id: 0 },
            })
        )
        // HRM0900 Ngày lễ
        .state("app.hrm0900", getStateDefinition("hrm0900"))
        // HRM0910 Add/Remove holiday
        .state(
            "app.hrm0910",
            getStateDefinition("hrm0910", {
                url: "/hrm0910/{id:int}",
                params: { id: 0 },
            })
        )
        // HRM1000 Internal news
        .state("app.hrm1000", getStateDefinition("hrm1000"))
        // HRM1010 Add/Remove Internal news
        .state(
            "app.hrm1010",
            getStateDefinition("hrm1010", {
                url: "/hrm1010/{id:int}",
                params: { id: 0 },
            })
        )
        // hrm1020 Internal news (public)
        .state("app.hrm1020", getStateDefinition("hrm1020"))
        // hrm1021 View Internal news (public)
        .state(
            "app.hrm1021",
            getStateDefinition("hrm1021", { url: "/hrm1021/{id:int}" })
        )
        // HRM1100	Danh sách bảng lương
        .state("app.hrm1100", getStateDefinition("hrm1100"))
        // HRM1110	Chi tiết bảng lương
        .state(
            "app.hrm1110",
            getStateDefinition("hrm1110", {
                url: "/hrm1110/{id:int}",
                params: { id: 0 },
            })
        )
        // HRM1111	Chi tiết bảng lương
        .state(
            "app.hrm1111",
            getStateDefinition("hrm1111", {
                url: "/hrm1111/{id:int}",
                params: { id: 0 },
            })
        )
        // HRM1112	Chi tiết bảng lương nhân viên
        .state(
            "app.hrm1112",
            getStateDefinition("hrm1112", { url: "/hrm1112/{id:int}" })
        )
        // HRM1120	Danh sách bảng lương cho nhân viên
        .state("app.hrm1120", getStateDefinition("hrm1120"))
        // HRM1130	Chi tiết bản lương cho nhân viên
        .state(
            "app.hrm1130",
            getStateDefinition("hrm1130", { url: "/hrm1021/{id:int}" })
        )
        // TEST
        .state("app.tmp9999", getStateDefinition("tmp9999"))

        /**
         * Admin
         */
        .state("app.adm0400", getStateDefinition("adm0400"))
        .state("app.adm0500", getStateDefinition("adm0500"))

        /**
         * Report
         */
        // Báo cáo doanh số NVBH
        .state("app.rpt0100", getStateDefinition("rpt0100"))
        // Báo cáo doanh số
        .state("app.rpt0200", getStateDefinition("rpt0200"))
        // Doanh số từng cấp (Daily Report)
        .state(
            "app.rpt0510",
            getStateDefinition("rpt0510", { url: "/rpt0510/{day}" })
        )
        // Doanh số sale (Daily Report)
        .state(
            "app.rpt0511",
            getStateDefinition("rpt0511", { url: "/rpt0511/{day}" })
        )
        // Doanh số khu vực (Daily Report)
        .state(
            "app.rpt0512",
            getStateDefinition("rpt0512", { url: "/rpt0512/{day}" })
        )
        // Quản lý sản phẩm (Daily Report)
        .state(
            "app.rpt0513",
            getStateDefinition("rpt0513", { url: "/rpt0513/{day}" })
        )
        // Số ngày tồn kho
        .state(
            "app.rpt0514",
            getStateDefinition("rpt0514", { url: "/rpt0514/{store_id:int}" })
        )
        .state("app.rpt0515", getStateDefinition("rpt0515"))
        .state("app.rpt0516", getStateDefinition("rpt0516"))
        .state("app.rpt0517", getStateDefinition("rpt0517"))
        // Báo cáo cửa hàng
        .state("app.rpt0518", getStateDefinition("rpt0518"))
        // Báo cáo cửa hàng
        .state("app.rpt0519", getStateDefinition("rpt0519"))
        /**
         * CMS: Content mamagement system
         */
        .state("app.cms0100", getStateDefinition("cms0100"))
        .state("app.cms0200", getStateDefinition("cms0200"))
        .state(
            "app.cms0210",
            getStateDefinition("cms0210", { params: { id: 0 } })
        )
        .state(
            "app.cms0211",
            getStateDefinition("cms0210", { url: "/cms0210/{id:int}" })
        )
        .state("app.cms0220", getStateDefinition("cms0220"))
        .state("app.cms0300", getStateDefinition("cms0300"))
        .state("app.cms0400", getStateDefinition("cms0400"))
        /**
         * Orther
         */
        .state("app.mobile", getStateDefinition("mobile"));
}