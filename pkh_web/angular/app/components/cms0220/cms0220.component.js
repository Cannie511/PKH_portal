class Cms0220Controller {
    constructor($scope, $stateParams, $state, $compile, $log, AclService, API, UtilsService, ClientService, RouteService) {
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

        this.loadData(1);
    }

    $onInit() {
        let self = this;
        let fileControl = angular.element("#file");
        fileControl.on('change', function() {
            var filesSelected = fileControl[0].files;
            if (filesSelected.length > 0) {
                var fileToLoad = filesSelected[0];
                var fileReader = new FileReader();
                fileReader.onload = function(fileLoadedEvent) {
                    var srcData = fileLoadedEvent.target.result; // <--- data: base64 
                    self.$log.info('srcData', srcData);
                    self.$scope.$apply(function() {
                        self.m.form.file = srcData;
                        self.$log.info('self.m.form.file', self.m.form.file);
                    });
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        });
    }

    loadData(page) {
        // let self = this;
        let service = this.API.service('load', this.API.all('cms0220'));
        let param = angular.copy(this.m.form);
        param.page = page;
        this.$log.info('param:', param);
        service.post(param)
            .then((response) => {
                this.m.data = response.plain().data.data;
                this.$log.info("data", this.m.data);
            });
    }

    remove($file_path) {
        let $log = this.$log;
        let thisClass = this;
        let service = this.API.service('remove', this.API.all('cms0220'));
        this.m.form.file_path = $file_path;
        let param = angular.copy(this.m.form);
        this.$log.info('param:', param);
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            service.post(param)
                .then((response) => {
                    $log.info("data", thisClass.m.data);
                    // $state.reload();
                    thisClass.ClientService.success('Xóa hình ảnh tin tức thành công');
                    thisClass.loadData();
                    thisClass.RouteService.goState('app.cms0220')
                });
        })
    }

    upload(isValid) {
        let thisClass = this;
        let $state = this.$state;
        if (isValid) {
            thisClass.$log.info('send');
            let service = this.API.service('upload', this.API.all('cms0220'));
            let param = angular.copy(this.m.form);
            service.post(param)
                .then(function(response) {

                    if (response.data.rtnCd == true) {
                        // thisClass.$log.info('response', response);
                        // $state.reload();
                        thisClass.m.form.file = null;
                        thisClass.ClientService.success('Thêm hình ảnh tin tức thành công');
                        thisClass.loadData();
                        thisClass.RouteService.goState('app.cms0220')
                    } else {
                        // thisClass.m.form.file = null;
                        thisClass.ClientService.error('Tên file bị trùng');
                        thisClass.loadData();
                        thisClass.RouteService.goState('app.cms0220')
                    }
                });
        } else {
            this.formSubmitted = true
        }
    }
}

export const Cms0220Component = {
    //templateUrl: './views/app/components/cms0220/cms0220.component.html',
    templateUrl: '/views/admin.cms0220',
    controller: Cms0220Controller,
    controllerAs: 'vm',
    bindings: {}
}