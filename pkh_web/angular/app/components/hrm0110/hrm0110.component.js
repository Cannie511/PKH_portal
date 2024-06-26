class Hrm0110Controller {
    constructor($scope, $state, API, $log, UtilsService, ClientService, $timeout, uiCalendarConfig) {
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$timeout = $timeout;
        this.uiCalendarConfig = uiCalendarConfig;

        this.m = {
            init: {},
            form: {
                dayOffType: '1',
                leave_type: "1"
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
                    // viewDate: 'YYYY-MM'
            }
        };

        this.uiConfig = {
            calendar: {
                // height: 450,
                // editable: true,
                header: {
                    left: 'title',
                    center: '',
                    right: 'today prev,next'
                }
                // eventClick: $scope.alertOnEventClick,
                // eventDrop: $scope.alertOnDrop,
                // eventResize: $scope.alertOnResize,
                // eventRender: $scope.eventRender
            }
        };

        this.events = [];

        this.eventSource = {
            // url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
            // className: 'gcal-event',           // an option!
            // currentTimezone: 'America/Chicago' // an option!
        };

        this.eventSources = [this.events];

        this.activeTab = 1;
        this.list = [];

        
    }

    $onInit() {
        this.loadInit();
        this.loadList();
    }

    loadInit() {

        this.API.service('init', this.API.all('hrm0110'))
            .post({})
            .then((response) => {
                console.log('init', response.data);
                this.m.init = response.data;
            });
    }

    validate(param) {
        if( param.leave_type == 1) {
            if ( !(param.leave_allocation_id > 0) ) {
                this.errors = {
                    "leave_allocation_id": ["Vui lòng chọn Ngày phép"]
                }
                console.log("errors", this.errors);
                return false;
            }
        }
        return true;
    }

    save() {
        let service = this.API.service('save', this.API.all('hrm0110'));
        let param = angular.copy(this.m.form);

        if (param.dayOffDate != null && param.dayOffDate != "") {
            param.dayOffDate = param.dayOffDate.format('YYYY-MM-DD');
        }

        if (this.validate(param) == false) {
            return false;
        }

        this.errors = null;
        service.post(param)
            .then(
                (response) => {
                    let returnData = response.data;
                    console.log('returnData', returnData);
                    if( returnData.rtnCd == 0) {
                        this.clear();
                        this.loadList();
                        this.ClientService.success("Đăng ký thành công");
                    } else {
                        this.ClientService.error(returnData.msg);
                    }
                },
                (response) => {
                    this.$log.debug('response', response);
                    if (response.status == 422) {
                        this.errors = response.data.errors;
                    }
                });
    }

    clear() {
        this.m.form = {
            dayOffType: '1'
        };
    }

    openTab(tabIndex) {
        this.activeTab = tabIndex;
    }

    loadList() {
        let service = this.API.service('list', this.API.all('hrm0110'));
        let param = {};

        this.errors = null;
        service.post(param)
            .then(
                (response) => {
                    this.list = response.data;
                    this.createCalendarData(this.list);
                },
                (response) => {
                    this.$log.debug('response', response);
                    if (response.status == 422) {
                        this.errors = response.data.errors;
                    }
                });
    }

    createCalendarData(list) {
        // Clear event
        this.events.length = 0;
        for (var i = 0; i < list.length; i++) {
            var temp = list[i];
            var title = "";
            var backgroundColor = "";
            // var date = new Date(temp.absent_date);
            var startDate = new Date(temp.absent_date);
            var endDate = new Date(temp.absent_date);

            if (temp.absent_type == 1) {
                title = "Nghỉ buổi sáng";
                backgroundColor = "#872D62";
                startDate.setHours(8);
                endDate.setHours(12);
            } else if (temp.absent_type == 2) {
                title = "Nghỉ buổi chiều";
                backgroundColor = "#AA6B39";
                startDate.setHours(13);
                endDate.setHours(17);
            } else if (temp.absent_type == 3) {
                title = "Nghỉ cả ngày";
                backgroundColor = "#328A2E";
                startDate.setHours(8);
                endDate.setHours(17);
            }

            title = title + ' - ' + temp.reason;

            var item = {
                'title': title,
                'start': startDate,
                'end': endDate,
                'backgroundColor': backgroundColor,
                'allDay': false,
                'stick': true
            };

            this.events.push(item);
        }
        this.$log.debug(this.events);
    }

    // renderCalendar() {
    //    this.$timeout(function(){
    //         angular.element('#calendar').fullCalendar('render');
    //         angular.element('#calendar').fullCalendar('rerenderEvents');
    //     }, 0);
    // }
}

export const Hrm0110Component = {
    //templateUrl: './views/app/components/hrm0110/hrm0110.component.html',
    templateUrl: '/views/admin.hrm0110',
    controller: Hrm0110Controller,
    controllerAs: 'vm',
    bindings: {}
}