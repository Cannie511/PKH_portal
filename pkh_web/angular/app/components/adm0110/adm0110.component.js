class Adm0110Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;

        this.m = {
            form: {}
        }
    }

    $onInit() {}

    save(isValid) {
        let thisClass = this;

        if (isValid) {
            let service = this.API.service('adm0110');
            let param = angular.copy(this.m.form);

            service.post(param)
                .then(function(response) {
                    thisClass.$log.info('response', response);
                    thisClass.ClientService.success('Thêm mới người dùng thành công');
                    thisClass.RouteService.goState('app.userlist')
                });
        } else {
            this.formSubmitted = true
        }
    }

}

export const Adm0110Component = {
    //templateUrl: './views/app/components/adm0110/adm0110.component.html',
    templateUrl: '/views/admin.adm0110',
    controller: Adm0110Controller,
    controllerAs: 'vm',
    bindings: {}
}