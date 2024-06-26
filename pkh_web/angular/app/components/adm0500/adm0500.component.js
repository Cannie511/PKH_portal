class Adm0500Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;

        this.m = {
            currentTab : "",
            forms: {
                PRINT_DELIVERY: {},
                DELIVERY: {}
            },
            tabs: [
                { id: "PRINT_DELIVERY", name: "In phiếu xuất", icon: "fa fa-print" },
                { id: "DELIVERY", name: "Xuất hàng", icon: "fa fa-truck-loading"},
                { id: "ESMS", name: "ESMS", icon: "fa fa-comment"},
                { id: "OA", name: "OA", icon: "fas fa-bullhorn"}
            ]
        }

    }

    $onInit(){
        this.setTab(this.m.tabs[0]);
    }

    setTab(tab) {
        this.m.currentTab = tab.id;
        this.load(tab.id);
    }

    load(formId) {
        let service = this.API.service('load', this.API.all('adm0500'));
        let param = {
            formId: formId
        };
        service.post(param)
            .then((response) => {
                this.$log.info(response.data);
                this.m.forms[formId] = response.data.data;
            });
    }

    save(formId) {
        let formData = angular.copy(this.m.forms[formId]);

        let service = this.API.service('save', this.API.all('adm0500'));
        let param = {
            formId: formId,
            data: formData
        };
        service.post(param)
            .then((response) => {
                this.$log.info(response);
                this.ClientService.success("Đã lưu dữ liệu.");
            });
    }
}

export const Adm0500Component = {
    //templateUrl: './views/app/components/adm0500/adm0500.component.html',
    templateUrl: '/views/admin.adm0500',
    controller: Adm0500Controller,
    controllerAs: 'vm',
    bindings: {}
}
