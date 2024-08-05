<section class="content-header">
    <h1 id="Name4001">Thống kê và Tính điểm ScoreCard của Đại Lý<small></small></h1>
</section>
<section class="content">
<div style="display: flex;">
    <!-- Chọn năm bắt đầu -->
    <div class="select">
    <label for="year" style="margin-right: 5px;">Năm Bắt Đầu:</label>
    <select ng-model="vm.m.filter.year" ng-change="vm.doSearch(1)">
        <option ng-repeat="year in vm.m.years" value="{{ year.year }}">{{ year.year }}</option>
    </select>
</div>


    <!-- Chọn quý bắt đầu -->
    <div class="select">
    <label for="quarter" style="margin-right: 5px; margin-left: 5px">Quý Bắt Đầu:</label>
    <select name="quarter" id="quarter" ng-model="vm.m.filter.quarter" ng-change="vm.doSearch(1)">
        <option value="1">Quý 1</option>
        <option value="2">Quý 2</option>
        <option value="3">Quý 3</option>
        <option value="4">Quý 4</option>
    </select>
</div>
    
</div>

 
<!-- Doash Board -->

<div id="root ">
    <!-- Container AVG board and cirle -->
    <div class="container container_doashboar_4001 container_flex">
    <!-- Container circle -->
    <div class="container_car">
            <div class="card-content">
                <h2>Tổng doanh số của {{vm.m.data.data.total}} Đại Lý</h2>
                <h1>{{ vm.m.data.avg_sale | number: 0 }} VNĐ</h1>
                <p class="increase">Tần suất đặt hàng trong quý {{vm.m.data.avg_OD}} đơn/Quý</p>
                <button class="withdraw-button"><i class="fa fa-gift"></i> Danh sách khuyến mãi</button>
            </div>
            <div class="card-image">
                <img src="https://devtop.io/wp-content/uploads/2023/07/back-end-developer-working-on-a-laptop-6765194-5607779.webp" class="dashboard-image">
            </div>
        </div>   
    <!-- Container AVG board -->
        <div class="container_avg">
            <div class="c-dashboardInfo col-lg-6 col-md-6 first">
                <div class="wrap">
                    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title nameCard" >Số Đại Lý Đạt Tiêu Chí  1
                    <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path d="M3 17h2v-7H3v7zm4 0h2V7H7v10zm4 0h2V4h-2v13zm4 0h2v-9h-2v9zm4 0h2v-5h-2v5z"></path>
    </svg>
                    </h4>
                    <span class="hind-font caption-12 c-dashboardInfo__count">{{ vm.m.data.storePass_1}} Đại Lý 
                    <button class="btn_listStore" type="button" ng-click="vm.listStoreAvg()"><i class="fas fa-arrow-right"></i>Xem Danh Sách </button>
                    </span>
                </div>
            </div>

    
          <div class="c-dashboardInfo col-lg-6 col-md-6 first magin_left">
    <div class="wrap">
        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title nameCard">Số Đại Lý Đạt Tiêu Chí 2
        <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
    <path  d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
    <path  d="M12 6v6l4 2"/>
</svg>
        </h4>
        <span class="hind-font caption-12 c-dashboardInfo__count">{{ vm.m.data.storePass_2}} Đại Lý
        <button class="btn_listStore" type="button" ng-click="vm.listStoreRetention()"><i class="fas fa-arrow-right"></i>Xem Danh Sách </button>
        </span>
    </div>
</div>


    <!-- text -->


            <div class="c-dashboardInfo col-lg-6 col-md-6 first container_avg_magin_top">
                <div class="wrap">
                    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title nameCard">Số Đại Lý Đạt Tiêu Chí 3
                    <svg  class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
    <path d="M7 2h10c1.1 0 2 .9 2 2v16l-3-2-3 2-3-2-3 2V4c0-1.1.9-2 2-2z"/>
    <line x1="8" y1="6" x2="16" y2="6" stroke="white" stroke-width="2"/>
    <line x1="8" y1="10" x2="16" y2="10" stroke="white" stroke-width="2"/>
    <line x1="8" y1="14" x2="16" y2="14" stroke="white" stroke-width="2"/>
</svg>
                    </h4>
                    <span class="hind-font caption-12 c-dashboardInfo__count ">{{ vm.m.data.storePass_3}} Đại Lý
                        <button class="btn_listStore" type="button" ng-click="vm.listStoreOrderfrequency()"><i class="fas fa-arrow-right"></i>Xem Danh Sách </button></span>
                </div>
            </div>
            <div class="c-dashboardInfo col-lg-6 col-md-6 first magin_left container_avg_magin_top">
                <div class="wrap">
                    <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title nameCard">Số Đại Lý Có Công Nợ
                    <svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
    <!-- Hình tròn của đồng xu -->
    <circle cx="12" cy="12" r="10" fill="none" stroke="#007bff" stroke-width="2"/>
    
    <!-- Biểu tượng đô la rõ nét -->
    <path d="M13 9c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2h2c1.1 0 2 .9 2 2s-.9 2-2 2h-2c-1.1 0-2-.9-2-2" fill="none" stroke="#007bff" stroke-width="2"/>
    <path d="M12 7v12" fill="none" stroke="#007bff" stroke-width="2"/>
</svg>


                    </h4>
                    <span class="hind-font caption-12 c-dashboardInfo__count">{{ vm.m.data.storePass_4}} Đại Lý
                    <button class="btn_listStore" type="button" ng-click="vm.listStoreDept()"><i class="fas fa-arrow-right"></i>Xem Danh Sách </button>
                    </span>
                </div>
            </div>      

        </div>

    </div>
</div>

<!-- Line-Chart-DoashBoar -->
 
<div class="line-chart-container">
    <canvas class="line-chart" id="line"></canvas>
</div>
<!-- <p>{{vm.m.data.storeCountsByScore}}</p> -->
 
<!-- Thanh search -->
<div class="search-container-4001">
    <!-- <form ng-submit="vm.searchByStoreName()">
        <input type="text" placeholder="Search.." ng-model="vm.m.filter.storeName" name="search">
        <button type="submit"><i class="fa fa-search"></i>Tìm Kiếm</button>
        <button type="button" ng-click="vm.resetSearch()"><i class="fa fa-refresh"></i>Làm mới</button>
        <button type="button" ng-click="vm.listStoreAvg()"><i class="fa fa-refresh"></i>Xem danh sách 1</button>
        <button type="button" ng-click="vm.listStoreRetention()"><i class="fa fa-refresh"></i>Xem danh sách 2</button>
        <button type="button" ng-click="vm.listStoreOrderfrequency()"><i class="fa fa-refresh"></i>Xem danh sách 3</button>
        <button type="button" ng-click="vm.listStoreDept()"><i class="fa fa-refresh"></i>Xem danh sách 4</button>
    </form> -->
    <form class="form-search" ng-submit="vm.searchByStoreName()">
    <input type="search" name="search" placeholder="Nhập tên cửa hàng ở đây.." ng-model="vm.m.filter.storeName">  
    <button type="submit">Tìm kiếm</button>   
    <button type="button" ng-click="vm.resetSearch()" class="btn_reset">Làm mới</button>      
</form>



</div>


<!-- Table  -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table_4001">
                            <thead class="bg-primary">                               
                            <tr>
                                    <th>STT.</th>
                                    <th>Tên đại lý</th>
                                    <th class="text-center">Doanh số</th>
                                    <th class="text-center">Thâm niên</th>
                                    <th class="text-center">Tần suất đặt</th>
                                    <th class="text-center">Công nợ</th>
                                    <th class="text-center">Tiêu chí 1</th>
                                    <th class="text-center">Tiêu chí 2</th>
                                    <th class="text-center">Tiêu chí 3</th>
                                    <th class="text-center">Tiêu chí 4</th>
                                    <th class="text-center">Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in vm.m.data.data.data">
                                    <td><b>{{$index + vm.m.data.data.from}}<b></td>
                                    <td id="namestore_4001">
                                        <b>{{item.name}}</b><br>
                                        <small><i>{{item.address}}</i></small>
                                    </td>
                                    <td class="text-center">{{item.total_sale | currency:'':0}}</td>
                                    <td class="text-center">{{item.retention}} năm
                                    <!-- <br>
                                    <small><i>{{item.store_id}}</i></small> -->
                                    </td>
                                   
                                    <td class="text-center">{{+item.order_frequency}} đơn</td>
                                    <td class="text-center">{{item.checkdept ? "Có":"Không"}}</td>

                                    <td class="text-center"><b>{{+item.total_sale > +item.TotalSales120 ? 25:10}}</b>
                                    <!-- <br>
                                    <small><i>{{item.total_sale}}</i></small><br>
                                    <small><i>{{item.TotalSales120}}</i></small><br> -->
                                    </td>

                                    <td class="text-center"><b>{{+item.retention >=3 ? 25:10}}</b></td>

                                    <td class="text-center"><b>{{+item.order_frequency > +item.countOrderYear120 ? 25:10}}</b>
                                    <!-- <br>
                                    <small><i>{{item.order_frequency}}</i></small><br>
                                    <small><i>{{item.countOrderYear120}}</i></small><br> -->

                                    </td>
                                    <td class="text-center"><b>{{+item.checkdept ? 15:25}}</b>
                                    <!-- <br>
                                    <small><i>{{item.checkdept}}</i></small> -->
                                    </td>
                                    <td class="text-center TotalScore_4001"><b>{{ vm.getTotalScore(item.total_sale, item.retention, item.order_frequency, item.checkdept,item.TotalSales120,item.countOrderYear120) }}</b></td>
                                    <!-- <td class="text-center TotalScore_4001"><b>{{+item.Total_score_card}}</b></td> -->
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 text-left">
                            <p class="form-control-static">&#160&#160&#160{{vm.m.data.data.from}} - {{vm.m.data.data.to}} / {{vm.m.data.data.total}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <uib-pagination
                                total-items="vm.m.data.data.total"
                                ng-model="vm.m.data.data.current_page"
                                items-per-page="vm.m.data.data.per_page"
                                ng-change="vm.doSearch(vm.m.data.data.current_page)"
                                class="pagination pagination-sm m-t-none m-b-none">
                            </uib-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</section>
