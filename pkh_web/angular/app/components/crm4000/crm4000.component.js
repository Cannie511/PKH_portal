class Crm4000Controller{
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, ClientService){
        'ngInject';
            this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.currentDate  = new Date();
        this.currentYear = this.currentDate.getFullYear();
        // this.currentMonth = this.currentDate.getMonth() + 1
        // this.currentQuarter = Math.floor((this.currentMonth - 1) / 3);
        this.years = [];
        for (let year = 2016; year <= this.currentYear; year++)
        {
            this.years.push(year);
        }
        this.m = {
            filter: {},
            data: null,
            
            year: this.years
        }
        
    }

    $onInit(){
        let previousSearch = sessionStorage.crm4000;
        if (angular.isUndefined(previousSearch)) {
            this.search();
            return;
        }
        previousSearch = angular.fromJson(previousSearch);
        var page = previousSearch.page;
        delete previousSearch['page'];
        this.m.filter = angular.copy(previousSearch);
        this.doSearch(page);
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

    saleScore(sale) {   
        let avgSale = this.m.data.avg_sale;
        avgSale = parseFloat( avgSale);
        sale = Number(sale)
        if ( sale > avgSale)
        {
            return 25;
        }
     return  10;
      
       
    }
    pay(id) {
        let param = {}; 
        param.payment_id= id; 
        
        this.$log.info('ID', param);
    
        let paymentService = this.API.service('pay', this.API.all('crm4000'));
        paymentService.post(param)
            .then((response) => {
                // Xử lý dữ liệu trả về từ API
                this.m.data = response.plain().data;
                this.$log.info('Phản hồi từ API:', this.m.data);
            })
            .catch((error) => {
              
                this.$log.error(error);
            });
    }
    
    frequencyScore(frequency)
    {
        let avgFrequency = this.m.data.avg_Frequency;
        
        avgFrequency = parseFloat(avgFrequency);
        frequency = Number(frequency);
      
       if (frequency > avgFrequency)
       {
        return 25;
       }
       else
       {
        return 10
       }
      
       
    }

    totalScore(sale,rentention, frequency){
      sale = Number(sale);
      rentention = Number(rentention);
      frequency = Number(frequency);
      let Score = 0;
      if(sale > +this.m.data.avg_sale){
        Score += 25;
    }
        
      else {Score += 10;}

      if( rentention >= 3) 
      {Score += 25;}
      else {Score +=10;}
      
      if(frequency > this.m.data.avg_Frequency)
      {
        Score += 25;
      }
      else{Score += 10;}
      return Score;
    }
    doSearch(page)
    {
        let searchService = this.API.service('search', this.API.all('crm4000'));
        let param = angular.copy(this.m.filter);
        param.page = page;
        this.$log.info(param.page);
        let currentYear = new Date().getFullYear();
        if (angular.isUndefined(param.year) ) {
            param.year = currentYear;
        }
        else {
            
            if (param.year < currentYear) {
                param.year = param.year 
               
            }
        }
        this.$log.info(param.year);
        sessionStorage.crm3000 = angular.toJson(param);
        this.$log.info('param', param);
        searchService.post(param)
        .then((response) => {
            this.m.data = response.plain().data;
            this.$log.info("check data search: ",this.m.data);
            
        });
}
}

export const Crm4000Component = {
    templateUrl: '/views/admin.crm4000',
    controller: Crm4000Controller,
    controllerAs: 'vm',
    bindings: {}
}
