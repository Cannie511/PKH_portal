class Crm2600Controller{
    constructor($rootScope, $scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService) {
        'ngInject'

        this.$rootScope = $rootScope;
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.$stateParams = $stateParams;
        this.ClientService = ClientService;
        this.can = AclService.can;

        this.m = {
            // store_id: parseInt($stateParams.store_id)
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            },
            review: {
                review_expired_date: moment().endOf("year")
            }
        }
    }

    $onInit(){

        if (this.$stateParams.store_id == null || this.$stateParams.store_id == undefined) {
            RouteService.goState('app.crm0300');
            return;
        }

        this.m.store_id = parseInt(this.$stateParams.store_id);
        if (! (this.m.store_id > 0)) {
            RouteService.goState('app.crm0300');
            return;
        }

        this.loadStore(this.m.store_id);
        this.reloadComment();
    }

    loadStore(store_id) {
        let service = this.API.service('load', this.API.all('crm2600'));
        let param = { store_id: this.m.store_id };
        let that = this;
        service.post(param)
            .then(function(response) {
                that.m.store = response.data.store;
                that.m.signatures = response.data.signatures;
            });
    }

    /**
     * 
     * @param {Integer} type commitType (0: comment, 1: approve, 2: deny)
     */
    commitReview(type) {
        let service = this.API.service('review', this.API.all('crm2600'));
        let param = { 
            store_id: this.m.store_id,
            type: type,
            content: this.m.review.comment,
            review_expired_date: this.m.review.review_expired_date
        };
        
        if (angular.isUndefined(param.review_expired_date) || param.review_expired_date == null || param.review_expired_date == '') {
            param.review_expired_date = moment().endOf("year").format('YYYY-MM-DD');
        } else {
            param.review_expired_date = param.review_expired_date.format('YYYY-MM-DD');
        }

        service.post(param)
            .then((response) => {
                let data = response.data;
                if( data.rtnCd == false) {
                    this.ClientService.error(data.rtnMsg);
                } else {
                    this.m.review.comment = null;
                    this.ClientService.success("Cập nhật thành công");
                    this.loadStore(this.m.store_id);
                    this.$rootScope.$broadcast('crm2601-reload');
                    this.reloadComment();
                }
            });
    }

    reloadComment() {
        // let service = this.API.all('comments');
        // console.log('service 1:>> ', service);
        // let param = { 
        //     store_id: this.m.store_id,
        //     group: "mst_store_verify"
        // };
        // console.log('param :>> ', param);
        // service.customGET("", param)
        //     .then((response) => {
        //         console.log('response :>> ', response);
        //         this.m.reviewComments = response.data;
        //     });
        this.doSearchComment(1);
    }

    doSearchComment(page) {
        let service = this.API.all('comments');
        let param = { 
            id1: this.m.store_id,
            group: "mst_store_verify",
            page: page,
            page_size: 10
        };
        service.customGET("", param)
            .then((response) => {
                console.log('response :>> ', response);
                this.m.reviewComments = response.data;
            });
    }

}

export const Crm2600Component = {
    //templateUrl: './views/app/components/crm2600/crm2600.component.html',
    templateUrl: '/views/admin.crm2600',
    controller: Crm2600Controller,
    controllerAs: 'vm',
    bindings: {}
}
