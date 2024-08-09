class Crm4001Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService) {
        'ngInject';
        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.currentDate = new Date();
        this.currentYear = this.currentDate.getFullYear();
        this.currentMonth = this.currentDate.getMonth() + 1;
        this.currentQuarter = Math.floor((this.currentMonth - 1) / 3) + 1;
        this.m = {
            filter: {
                storeName: '',
                year: this.currentYear,
                quarter: this.currentQuarter,
                listAboveAvg: false,
                listAboveOrderfrequency: false,
                listAboveRetention: false,
                listAboveDept: false
            },
            data: {
                storeCountsByScore: []
            },
            years: [],
            quarter: this.currentQuarter
        };
    }

    $onInit() {
        let previousSearch = sessionStorage.crm4001;
        if (angular.isUndefined(previousSearch)) {
            this.search();
        } else {
            previousSearch = angular.fromJson(previousSearch);
            var page = previousSearch.page;
            delete previousSearch['page'];
            this.m.filter = angular.copy(previousSearch);
            this.doSearch(page);
        }
        this.loadYears();
        this.loadLineChart();
        this.lineChart = null;
        this.$scope.$watch(() => this.m.filter.year, (newValue, oldValue) => {
            if (newValue !== oldValue) {
                if (this.lineChart) {
                    this.lineChart.destroy();
                    this.lineChart = null;
                    this.loadLineChart();
                }
            }
        });

        this.$scope.$watch(() => this.m.filter.quarter, (newValue, oldValue) => {
            if (newValue !== oldValue) {
                if (this.lineChart) {
                    this.lineChart.destroy();
                    this.lineChart = null;
                    this.loadLineChart();
                }
            }
        });
    }
   
    loadLineChart() {
        console.log(this.m.filter.year);

        let param = {
            year: this.m.filter.year,
            quarter: this.m.filter.quarter
        };

        this.API.service('search', this.API.all('crm4001')).post(param)
            .then((response) => {
                this.m.data.storeCountsByScore = response.data.storeCountsByScore; // Cập nhật data từ phản hồi
                var line = document.getElementById('line');
                if (line) {
                    line.height = 280;
                    this.lineChart = new Chart(line, {
                        type: 'line',
                        data: {
                            labels: ['45', '50', '55', '60', '65', '70','75','80','85','90','95','100'],
                            datasets: [{
                                label: 'Số Lượng Đại Lý', // Tên series
                                data: this.m.data.storeCountsByScore, // Cập nhật data
                                fill: false,
                                borderColor: '#2196f3', // Màu viền
                                backgroundColor: '#2196f3', // Màu nền
                                borderWidth: 2, // Độ rộng viền
                            },
                            {
                                label: 'Số Lượng Đại Lý Cùng Kỳ', // Tên series mới
                                data: this.m.data.storeCountsByScoreSamePeriod, // Cập nhật data mới
                                fill: false,
                                borderColor: '#ff0000', // Màu viền đỏ
                                backgroundColor: '#ff0000', // Màu nền đỏ
                                borderWidth: 2 // Độ rộng viền
                            }
                        ]
                        },
                        options: {
                            responsive: true, // Đáp ứng
                            maintainAspectRatio: false, // Giữ tỉ lệ
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontSize: 12, // Tăng kích thước font chữ cho nhãn trục y
                                        fontStyle: 'bold', // Đặt độ đậm của font chữ cho nhãn trục y
                                        fontColor: '#333333' // Màu sắc của nhãn trục y
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontSize: 12, // Tăng kích thước font chữ cho nhãn trục x
                                        fontStyle: 'bold', // Đặt độ đậm của font chữ cho nhãn trục x
                                        fontColor: '#333333' // Màu sắc của nhãn trục x
                                    }
                                }]
                            },
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    fontColor: '#333333',
                                    fontStyle: 'bold',
                                    fontSize: 14
                                }
                            } 
                        }
                    });
                } else {
                    console.log('Canvas element not found');
                }
            })
            .catch((error) => {
                console.error('Error loading line chart data:', error);
            });
    }


    onQuarterChange() {
        this.$log.info('Quarter changed to:', this.m.filter.quarter);
        this.doSearch(1);
    }

    searchByStoreName() {
        this.$log.info('Filter by store name:', this.m.filter.storeName);
        this.m.filter.listAboveAvg = false;
        this.m.filter.listAboveRetention = false;
        this.m.filter.listAboveDept = false;
        this.m.filter.listAboveOrderfrequency = false;
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }

    resetSearch() {
        this.m.filter.storeName = '';
        this.m.filter.listAboveAvg = false;
        this.m.filter.listAboveRetention = false;
        this.m.filter.listAboveDept = false;
        this.m.filter.listAboveOrderfrequency = false;
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }

    listStoreAvg() {
        this.$log.info('Button clicked: listStoreAvg');
        this.m.filter.storeName = '';
        this.m.filter.listAboveAvg = true;
        this.m.filter.listAboveRetention = false;
        this.m.filter.listAboveDept = false;
        this.m.filter.listAboveOrderfrequency = false;
        this.$log.info('listAboveAvg:', this.m.filter.listAboveAvg);
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }

    listStoreRetention() {
        this.m.filter.storeName = '';
        this.m.filter.listAboveRetention = true;
        this.m.filter.listAboveAvg = false;
        this.m.filter.listAboveDept = false;
        this.m.filter.listAboveOrderfrequency = false;
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }

    listStoreDept() {
        this.m.filter.storeName = '';
        this.m.filter.listAboveDept = true;
        this.m.filter.listAboveAvg = false;
        this.m.filter.listAboveRetention = false;
        this.m.filter.listAboveOrderfrequency = false;
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }

    listStoreOrderfrequency() {
        this.m.filter.storeName = '';
        this.m.filter.listAboveOrderfrequency = true;
        this.m.filter.listAboveAvg = false;
        this.m.filter.listAboveRetention = false;
        this.m.filter.listAboveDept = false;
        this.doSearch(1);
        setTimeout(() => {
            var tableElement = document.querySelector('.table_4001');
            if (tableElement) {
                tableElement.scrollIntoView({ behavior: 'smooth' });
            }
        }, 500);
    }
   
    
    loadYears() {
        this.API.all('crm4001').customGET('years')
            .then((response) => {
                this.m.years = response.plain();
            })
            .catch((error) => {
                this.$log.error('Error loading years:', error);
            });
    }
    
    search() {
        this.m.filter.orderBy = null;
        this.m.filter.orderDirection = null;
        this.doSearch(1);
    }

    resetFilter() {
        this.m.filter = {
            orderBy: this.m.filter.orderBy,
            orderDirection: this.m.filter.orderDirection
        };
    }

    getTotalScore(sale, retention, order_frequency, checkdept, totalSales120, countOrderYear120) {
        sale = Number(sale);
        retention = Number(retention);
        order_frequency = Number(order_frequency);
        totalSales120 = Number(totalSales120);
        countOrderYear120 = Number(countOrderYear120);
        let sale_score = 0;
        let retention_score = 0;
        let order_frequency_score = 0;
        let payment_score = 0;
        let total_score = 0;

        if (order_frequency > countOrderYear120) {
            order_frequency_score = 25;
        } else {
            order_frequency_score = 10;
        }

        if (sale > totalSales120) {
            sale_score = 25;
        } else {
            sale_score = 10;
        }

        if (retention >= 3) {
            retention_score = 25;
        } else {
            retention_score = 10;
        }

        if (checkdept) {
            payment_score = 15;
        } else {
            payment_score = 25;
        }

        total_score = order_frequency_score + sale_score + retention_score + payment_score;
        return total_score;
    }

    doSearch(page) {
        let searchService = this.API.service('search', this.API.all('crm4001'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        param.per_page = 15;
        sessionStorage.crm4001 = angular.toJson(param);
        this.$log.info('doSearch param', param);
        searchService.post(param)
            .then((response) => {
                this.m.data = response.plain().data;
                this.$log.info("check data search: ", this.m.data);
            })
            .catch((error) => {
                this.$log.error('Error in doSearch', error);
            });
    }
    
}


export const Crm4001Component = {
    templateUrl: "/views/admin.crm4001",
    controller: Crm4001Controller,
    controllerAs: "vm",
    bindings: {}
};
