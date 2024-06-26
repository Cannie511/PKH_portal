class Adm0400Controller {
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
            form: {}
        }

    }

    $onInit() {}

    run() {

        if (this.m.form.cmd == null || this.m.form.cmd.length <= 0) {
            self.ClientService.warning("Vui lòng nhập nội dung");
            return;
        }

        let self = this;
        let service = this.API.service('run', this.API.all('adm0400'));
        let param = angular.copy(this.m.form);
        service.post(param)
            .then((response) => {
                this.$log.info(response);
                self.ClientService.success("Đang thực thi, hãy tải lại dữ liệu sau vài phút nữa.");
            });
    }

    clear(name) {
        swal({
            title: `Xác nhận`,
            text: `Bạn có muốn xóa ${name} không?`,
            type: "warning",
            showCancelButton: true,
            // confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, () => {
            this.API.service('clean', this.API.all('adm0400'))
                .post({name: name})
                .then((response) => {
                    this.ClientService.success(`Đã thực hiện xong (${name} - ${response.data.rtnCd})`);
                });
        });
    }
}

export const Adm0400Component = {
    templateUrl: '/views/admin.adm0400',
    controller: Adm0400Controller,
    controllerAs: 'vm',
    bindings: {}
}