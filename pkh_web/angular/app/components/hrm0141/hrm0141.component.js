class Hrm0141Controller{
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
            // mode: "ONE",
            init: {},
            filter: {
                month: moment(new Date().toISOString())
            },
            data: {},
            datetimepicker_options: {
                viewMode: 'months',
                format: 'YYYY-MM'
            }
        }

    }

    $onInit(){
        this.init();
    }

    init() {
        let beService = this.API.service('init', this.API.all('hrm0141'));
        beService.post()
            .then((res) => {
                this.m.init = res.plain().data;

                let previousSearch = sessionStorage.hrm0141;
                if(previousSearch != null && previousSearch != undefined) {
                    previousSearch = angular.fromJson(previousSearch);
                    if (previousSearch.month != null && previousSearch.month != undefined && previousSearch.month.length > 0) {
                        this.m.filter.month = moment(previousSearch.month + "-01");
                    }
                    this.m.filter.user_id = previousSearch.user_id || null;
                }
                this.search();
            });
    }

    search() {
        
        let param = angular.copy(this.m.filter);
        
        if( param.month == null || param.month == "") {
            this.ClientService.error("Vui lòng nhập thời gian");
            return;
        }

        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        let searchService;
        sessionStorage.hrm0141 = angular.toJson(param);
        if( param.user_id == null || param.user_id == "") {
            searchService = this.API.service('search-all', this.API.all('hrm0141'));

            searchService.post(param)
                .then((response) => {
                    this.m.mode = "MULTI";
                    let data = response.data.data;
                    this.m.data = data;
                });
        } else {
            searchService = this.API.service('search', this.API.all('hrm0141'));
            searchService.post(param)
                .then((response) => {
                    this.m.mode = "ONE";
                    this.m.list = this.editDisplayList(response.plain().data);
                    this.m.summary = this.summarize(this.m.list);
                });
        }
    }

    clickExecute() {

        let service = this.API.service('execute', this.API.all('hrm0141'));
        let param = angular.copy(this.m.filter);
        if( param.month == null || param.month == "") {
            this.ClientService.error("Vui lòng nhập thời gian");
            return;
        }
        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        this.ClientService.success("Đang thực thi, hãy tải lại dữ liệu sau vài phút nữa.");
        service.post(param)
            .then((response) => {
                this.$log.info(response);
                this.ClientService.success("Đang thực thi xong.");
            });
    }

    editDisplayList(list) {
        var n = new Date(list.data[0].date).getDay();
        list.data.forEach(element => {
            element.day = n;
            n = ++n % 7;
        });
        return list;
    }

    summarize(calendar) {
        let summary = {
            totalDays: 0,
            totalWorkingDays: 0,
            totalWorkingHours: 0,
            totalWorkingHoursString: "00:00",
            todayAbsent: 0,
            todayAbsentNo: 0,
            todayHoliday: 0,
            totalStandardHours: 0
        };

        calendar.data.forEach(element => {
            if( element.workday > 0 ) {
                if (element.is_holiday == 1) {
                    summary.todayHoliday += 1;
                } else {
                    summary.totalDays += element.workday;
                    if( element.working_hours > 0 ) {
                        summary.totalWorkingHours += element.working_hours;
                    }

                    if(element.workday > 0 && element.first_time != null || element.first_time !== undefined ) {
                        summary.totalWorkingDays += element.workday;
                    }

                    if ( (element.first_time == null || element.first_time === undefined || element.first_time == "") 
                        && element.absent_type != 1 && element.absent_type !=2 && element.absent_type !=3 ) {
                        summary.todayAbsentNo += 1;
                    }

                    if (element.absent_type == 3) {
                        summary.todayAbsent += 1;
                    } else if (element.absent_type == 2 || element.absent_type == 1) {
                        summary.todayAbsent += 0.5;
                    }
                }
            }
        });

        if (summary.totalWorkingHours > 0 ) {
            let hour = Math.floor(summary.totalWorkingHours / 60, 0);
            let min = summary.totalWorkingHours - hour * 60;
            summary.totalWorkingHoursString = hour + " hours " + ("00" + min).slice(-2) + " min";
        }

        summary.totalStandardHours = summary.totalDays * 8;

        return summary;
    }

    selectEmployee(employee) {
        this.m.filter.user_id = employee.id;
        this.search();
    }

    download() {
        let param = angular.copy(this.m.filter);
    
        if( param.month == null || param.month == "") {
            this.ClientService.error("Vui lòng nhập thời gian");
            return;
        }

        if (param.month != null && param.month != "") {
            param.month = param.month.format('YYYY-MM');
        }

        this.API.service('download', this.API.all('hrm0141'))
            .post(param)
            .then((response) => {
                this.ClientService.downloadFileOneTime(response.data.file);
            });
    }

}

export const Hrm0141Component = {
    //templateUrl: './views/app/components/hrm0141/hrm0141.component.html',
    templateUrl: '/views/admin.hrm0141',
    controller: Hrm0141Controller,
    controllerAs: 'vm',
    bindings: {}
}
