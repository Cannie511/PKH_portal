class Hrm0100Controller{
    constructor($scope, $state, API, $log, UtilsService, ClientService, $timeout, uiCalendarConfig, $compile){
        'ngInject';

        this.API = API;
        this.$state = $state;
        this.$log = $log;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.$timeout = $timeout;
        this.uiCalendarConfig = uiCalendarConfig;
        this.$compile = $compile;
        this.$scope = this.$scope;

        let that = this;
        this.uiConfig = {
          calendar:{
            // height: 450,
            // editable: true,
            header:{
              left: 'title',
              center: '',
              right: 'today prev,next'
            },
            // eventClick: $scope.alertOnEventClick,
            // eventDrop: $scope.alertOnDrop,
            // eventResize: $scope.alertOnResize,
            eventRender: function(event, element, view) {
                // element.attr({ 'uib-tooltip': event.title, 'uib-tooltip-append-to-body': true }); 
                element.attr({ 'title': event.title }); 
                // that.$compile(element)(that.$scope);
            },
            // viewRender: that.viewRender
            viewRender: function(view, element) {
                that.$log.debug("View Changed: ", view.visStart, view.visEnd, view.start, view.end);
                that.viewRender(view, element);
            }
          }
        };

        this.events = [];
        
        this.eventSource = {
            // url: "http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic",
            // className: 'gcal-event',           // an option!
            // currentTimezone: 'America/Chicago' // an option!
        };

        this.eventSources = [this.events];
    }

    $onInit(){
    }

    viewRender(view, element) {
        let startDate = view.start.format('YYYY-MM-DD');
        let endDate = view.end.format('YYYY-MM-DD');

        this.search(startDate, endDate);
    }

    search(startDate, endDate) {
        let service = this.API.service('search', this.API.all('hrm0100'));
        let param = {
            'startDate': startDate,
            'endDate': endDate
        };

        this.errors = null;
        service.post(param) 
            .then(
                (response) => {
                    console.log('response.data :', response);
                    
                    this.listAbsent = response.data.listAbsent;
                    this.listHoliday = response.data.listHoliday;
                    this.createCalendarData(this.listAbsent);
                    this.createCalendarHolidayData(this.listHoliday);
                }, 
                (response) => {
                    this.$log.debug('response', response);
                    if( response.status == 422 ) {
                        this.errors = response.data.errors;
                    }
                });
    }

    createCalendarData(list) {
        console.log('createCalendarData', list);
        // Clear event
        this.events.length = 0;
        for(var i = 0 ; i < list.length; i++ ) {
            var temp = list[i];
            var title = "";
            var backgroundColor = "";
            var date = new Date(temp.absent_date);
            var startDate = new Date(temp.absent_date);
            var endDate = new Date(temp.absent_date);

            if( temp.absent_type == 1 ) {
                title = "Nghỉ buổi sáng";
                backgroundColor = "#872D62";
                startDate.setHours(8);
                endDate.setHours(12);
            } else if( temp.absent_type == 2 ) {
                title = "Nghỉ buổi chiều";
                backgroundColor = "#AA6B39";
                startDate.setHours(13);
                endDate.setHours(17);
            } else if( temp.absent_type == 3 ) {
                title = "Nghỉ cả ngày";
                backgroundColor = "#328A2E";
                startDate.setHours(8);
                endDate.setHours(17);
            } 

            title = temp.user_name + ": " + title + ' - ' + temp.reason;

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

    createCalendarHolidayData(list) {
        this.$log.debug('list', list);
        // Clear event
        // this.events.length = 0;
        for(var i = 0 ; i < list.length; i++ ) {
            var temp = list[i];
            var title = "";
            var backgroundColor = "";
            var date = new Date(temp.holiday_date);
            var startDate = new Date(temp.holiday_date);
            var endDate = new Date(temp.holiday_date);

            // if( temp.amount < 1 ) {
            //     title = "Nghỉ buổi sáng";
            //     backgroundColor = "#872D62";
            //     startDate.setHours(8);
            //     endDate.setHours(12);
            // } else if( temp.absent_type == 2 ) {
            //     title = "Nghỉ buổi chiều";
            //     backgroundColor = "#AA6B39";
            //     startDate.setHours(13);
            //     endDate.setHours(17);
            // } else if( temp.absent_type == 3 ) {
            //     title = "Nghỉ cả ngày";
            //     backgroundColor = "#328A2E";
            //     startDate.setHours(8);
            //     endDate.setHours(17);
            // } 

            title = temp.reason;
            backgroundColor = "#cc2d2d";

            var item = {
                'title': title,
                'start': startDate,
                'end': endDate,
                'backgroundColor': backgroundColor,
                'allDay': true,
                // 'stick': true
            };

            this.events.push(item);
        }
        this.$log.debug(this.events);
    }
}

export const Hrm0100Component = {
    // templateUrl: './views/app/components/hrm0100/hrm0100.component.html',
    templateUrl: '/views/admin.hrm0100',
    controller: Hrm0100Controller,
    controllerAs: 'vm',
    bindings: {}
}
