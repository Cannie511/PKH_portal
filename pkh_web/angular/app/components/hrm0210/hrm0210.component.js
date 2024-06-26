class Hrm0210Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService, $stateParams, RouteService, $timeout){
        'ngInject';

        this.$scope = this.$scope;
        this.$state = $state;
        this.API = API;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.$timeout = $timeout;

        this.started = false;

        this.m = {
            //time: 5 * 60 * 60
            time: 60
        };
        this.m.id = $stateParams.id;

        if( this.m.id == null || this.m.id <= 0 ) {
            // this.ClientService.warning("Vui lòng chọn cửa hàng");
            this.RouteService.goState("app.hrm0200");
        }

        // this.showClock();
        this.load();
    }

    $onInit(){
    }

    $onDetroy(){
    }

    start() {
        // this.started = true;
        // let that = this;
        // this.timer = this.$timeout(function(){
        //     that.tick();
        // }, 1000);
        let searchService = this.API.service('start', this.API.all('hrm0210'));
        let param = {
            id: this.m.id
        };

        searchService.post(param) 
            .then((response) => {
                if ( response.data.rtnCd == -1) {
                    this.ClientService.error("Không thể làm bài");
                    // this.RouteService.goState("app.hrm0200");
                } else {
                    this.started = true;
                    let that = this;
                    this.timer = this.$timeout(function(){
                        that.tick();
                    }, 1000);
                }
            });
    }

    tick() {
        this.m.time = this.m.time - 1;
        this.showClock();
    }

    showClock() {
        if( this.m.time >= 0) {
            // this.m.time = this.m.time - 1;

            var hour = Math.floor(this.m.time / 3600);
            var min = Math.floor((this.m.time - (hour * 3600)) / 60);
            var sec = this.m.time - hour * 60 * 60 - min * 60;

            var clockString = "";
            if( hour < 10 ) {
                clockString += "0" + hour;
            } else {
                clockString += hour + "";
            }
            clockString = clockString + ":";
            if( min < 10 ) {
                clockString += "0" + min;
            } else {
                clockString += min + "";
            }
            clockString = clockString + ":";
            if( sec < 10 ) {
                clockString += "0" + sec;
            } else {
                clockString += sec + "";
            }
            this.m.clockString = clockString;

            let that = this;
            this.timer = this.$timeout(function(){
                that.tick();
            }, 1000);
        } else {
            this.finish();
        }
    }

    clearTimer() {
        if (this.timer != null ) {
            this.$timeout.cancel( this.timer );
            this.timer = null;
        }
    }

    finish() {
        this.clearTimer();
        this.upload();
    }

    load() {
        let searchService = this.API.service('load', this.API.all('hrm0210'));
        let param = {
            id: this.m.id
        };

        searchService.post(param) 
            .then((response) => {
                this.$log.debug('response', response);
                if ( response.data.rtnCd == -1) {
                    this.ClientService.warning("Không tìm thấy bài kiểm tra");
                    this.RouteService.goState("app.hrm0200");
                }

                this.m.min = response.data.time;
                this.m.time = response.data.time * 60; 
                this.m.data = response.data;
            });
    }

    upload() {
        this.$log.debug('upload here');

        let searchService = this.API.service('save', this.API.all('hrm0210'));
        let param = angular.copy(this.m.data);
        param.id = this.m.id;

        searchService.post(param) 
            .then((response) => {
                // this.$log.info(response);
                // var data = response.plain().data;
                // var list = data.data;
                // angular.forEach(list, function(value){
                //     list.check = false;
                // });
                // // this.m.list = list;
                // this.m.data = data;
                // swal("Thành công!", "Bài kiểm tra của bạn đã được gửi!", "success")
                let that = this;
                if( response.data.rtnCd == -1 ) {
                    swal({
                      title: "Thất bại",
                      text: "Bạn chưa hoàn thành bài kiểm tra",
                      type: "error",
                      timer: 3000,
                      showConfirmButton: true
                    }, function() {
                    });
                } else {
                    swal({
                      title: "Thành công!",
                      text: "Bạn đã hoàn thành bài kiểm tra",
                      timer: 3000,
                      showConfirmButton: true
                    }, function() {
                        that.RouteService.goState("app.hrm0200");
                    });
                }
                
                
            });
    }
}

export const Hrm0210Component = {
    // templateUrl: './views/app/components/hrm0210/hrm0210.component.html',
    templateUrl: '/views/admin.hrm0210',
    controller: Hrm0210Controller,
    controllerAs: 'vm',
    bindings: {}
}
