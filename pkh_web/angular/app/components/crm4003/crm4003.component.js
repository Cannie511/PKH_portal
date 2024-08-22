class Crm4003Controller {
    constructor(
        $scope,
        $state,
        $log,
        API,
        UtilsService,
        ClientService,
        $stateParams,
        RouteService,
        AclService
    ) {
        "ngInject";
        this.$state = $state;
        this.$log = $log;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;
        this.can = AclService.can;
        this.m = {
            data: {
                total_with_discount_5: 0,
                total: 0,
                additional_discount: 0,
            },
            total_discount: 5,
            total_Current_Quarter: 0, // Biến để lưu trữ tổng danh số quý hiện tại
            SaleScoreExpected: 0,
            OrderScoreExpected:0,
            SaleScoreDifference:0,
            OrderScoreDifference:0,
            order_Current_Quarter:0,     
            TotalScoreCardDifference:0, 
            init: {},
        };
        this.m.store_id = $stateParams.store_id;
        this.m.isSaving = false;
    }

    $onInit() {
        this.loadInit();
    }

    calculateTotalWithDiscount5() {
        let total = parseFloat(this.m.data.total) || 0;
        let additionalDiscount = parseFloat(this.m.data.additional_discount) || 0;
        
        this.m.total_discount = 5 + additionalDiscount;
        // Tính thành tiền sau chiết khấu
        let discountAmount = total * (this.m.total_discount / 100);
        this.m.data.total_with_discount_5 = total - discountAmount;

        // Cập nhật tổng danh số quý hiện tại
        this.calculateTotalCurrentQuarter();
    }

    calculateTotalCurrentQuarter() {
        this.m.total_Current_Quarter = (parseFloat(this.m.total_Sale) || 0) + (parseFloat(this.m.data.total_with_discount_5) || 0);
        this.calculateSaleScoreExpected();
        this.compareSaleScores();
        this.calculateTotalSaleExpected();
        this.compareTotal_ScoresCard(); 
       
    }
    calculateOrderCurrentQuarter() {
        this.m.order_Current_Quarter = (parseFloat(this.m.OrderFrequencyCurrent)) + 0.33;
        this.calculateOrderScoreExpected();
        this.calculateTotalOrderExpected();
        this.compareOrderScores();
        this.compareTotal_ScoresCard(); 
    }
  
   

    calculateSaleScoreExpected() {
        let totalSaleSamePeriod = parseFloat(this.m.total_Sale_SamePeriod) || 0;
        let totalCurrentQuarter = parseFloat(this.m.total_Current_Quarter) || 0;

        if (totalCurrentQuarter < totalSaleSamePeriod * 0.8) {
            this.m.SaleScoreExpected = 0;
        } else if (totalCurrentQuarter > totalSaleSamePeriod * 1.2) {
            this.m.SaleScoreExpected = 25;
        } else {
            this.m.SaleScoreExpected = 10;
        }
    }
    calculateOrderScoreExpected() {
        let totalOrderSamePeriod = parseFloat(this.m.OrderFrequencySamePeriod);
        let totalOrderCurrentQuarter = parseFloat(this.m.order_Current_Quarter);

        if (totalOrderCurrentQuarter < totalOrderSamePeriod * 0.8) {
            this.m.OrderScoreExpected = 0;
        } else if (totalOrderCurrentQuarter > totalOrderSamePeriod* 1.2) {
            this.m.OrderScoreExpected= 25;
        } else {
            this.m.OrderScoreExpected = 10;
        }
    }
    
    calculateCoreCardcoreExpected() {
        let totalscorecard = parseFloat(this.m.total_Score_Card) || 0;
        let TotalScoreCardDifference = parseFloat(this.m.TotalScoreCardDifference) || 0;
        this.m.total_Score_Card_Expected = totalscorecard + TotalScoreCardDifference;
    }




    calculateTotalOrderExpected() {
        let totalOrderSamePeriod = parseFloat(this.m.OrderFrequencySamePeriod);
        let totalOrderCurrentQuarter = parseFloat(this.m.order_Current_Quarter);
        let nextMilestoneAmountOrder = 0;
    
        if (totalOrderCurrentQuarter < totalOrderSamePeriod * 0.8) {
            // Cần đạt đến mốc 10 điểm, tức là cần đạt ít nhất 80% của tổng doanh số cùng kỳ
            nextMilestoneAmountOrder = (totalOrderSamePeriod * 0.8 - totalOrderCurrentQuarter)*3;
        } else if (totalOrderCurrentQuarter >= totalOrderSamePeriod * 0.8 && totalOrderCurrentQuarter <= totalOrderSamePeriod * 1.2) {
            // Cần đạt đến mốc 25 điểm, tức là cần đạt ít nhất 120% của tổng doanh số cùng kỳ
            nextMilestoneAmountOrder = (totalOrderSamePeriod * 1.2 - totalOrderCurrentQuarter)*3;
        } else {
            // Nếu đã vượt quá 120% thì không còn mốc tiếp theo để tính toán
            nextMilestoneAmountOrder = 0;
        }
    
        // Gán giá trị doanh số còn thiếu cho một biến trong `this.m`
        this.m.nextMilestoneAmountOrder = nextMilestoneAmountOrder > 0 ? nextMilestoneAmountOrder : 0;
    }
     
    calculateTotalSaleExpected() {
        let totalSaleSamePeriod = parseFloat(this.m.total_Sale_SamePeriod) || 0;
        let totalCurrentQuarter = parseFloat(this.m.total_Current_Quarter) || 0;
        let nextMilestoneAmount = 0;
    
        if (totalCurrentQuarter < totalSaleSamePeriod * 0.8) {
            // Cần đạt đến mốc 10 điểm, tức là cần đạt ít nhất 80% của tổng doanh số cùng kỳ
            nextMilestoneAmount = totalSaleSamePeriod * 0.8 - totalCurrentQuarter;
        } else if (totalCurrentQuarter >= totalSaleSamePeriod * 0.8 && totalCurrentQuarter <= totalSaleSamePeriod * 1.2) {
            // Cần đạt đến mốc 25 điểm, tức là cần đạt ít nhất 120% của tổng doanh số cùng kỳ
            nextMilestoneAmount = totalSaleSamePeriod * 1.2 - totalCurrentQuarter;
        } else {
            // Nếu đã vượt quá 120% thì không còn mốc tiếp theo để tính toán
            nextMilestoneAmount = 0;
        }
    
        // Gán giá trị doanh số còn thiếu cho một biến trong `this.m`
        this.m.nextMilestoneAmount = nextMilestoneAmount > 0 ? nextMilestoneAmount : 0;
    }
    
    
    compareOrderScores() {
        let scoreExpected = parseFloat(this.m.OrderScoreExpected) || 0;
        let scoreActual = parseFloat(this.m.OrderScore) || 0;

        if (scoreActual < scoreExpected) {
            this.m.OrderScoreDifference = scoreExpected - scoreActual;
        } else {
            this.m.OrderScoreDifference = 0;
        }
    }

    compareSaleScores() {
        let scoreExpected = parseFloat(this.m.SaleScoreExpected) || 0;
        let scoreActual = parseFloat(this.m.SaleScore) || 0;

        if (scoreActual < scoreExpected) {
            this.m.SaleScoreDifference = scoreExpected - scoreActual;
        } else {
            this.m.SaleScoreDifference = 0;
        }
    }

    compareTotal_ScoresCard() {
        let SaleScoreDifference = parseFloat(this.m.SaleScoreDifference) || 0;
        let OrderScoreDifference = parseFloat(this.m.OrderScoreDifference ) || 0;

        this.m.TotalScoreCardDifference = SaleScoreDifference + OrderScoreDifference;
    }

    loadInit() {
        let param = {
            store_id: this.m.store_id,
        };

        let searchService = this.API.service("search", this.API.all("crm4003"));
        searchService.post(param).then((response) => {
            this.$log.info("m init: ", response.data.data);
            this.m.data = response.data.data;
            this.m.total_Score_Card = response.data.total_Score_Card;
            this.m.total_Sale = response.data.total_Sale;
            this.m.total_Sale_SamePeriod = response.data.total_Sale_SamePeriod;
            this.m.SaleScore = response.data.SaleScore;
            this.m.OrderFrequencySamePeriod = response.data.OrderFrequencySamePeriod;
            this.m.OrderFrequencyCurrent = response.data.OrderFrequencyCurrent;
            this.m.OrderScore = response.data.OrderScore;

            this.calculateTotalCurrentQuarter();
            this.calculateOrderCurrentQuarter();
            this.compareOrderScores();
            this.compareSaleScores();
            this.compareTotal_ScoresCard();
    
        });
    }
}

export const Crm4003Component = {
    templateUrl: "/views/admin.crm4003",
    controller: Crm4003Controller,
    controllerAs: "vm",
    bindings: {}
};
