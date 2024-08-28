<section class="content-header">
    <h1>Lịch sử điểm <small></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border d-flex justify-content-between align-items-center">
                    <h3 class="box-title">{{ vm.m.data.name }}</h3>
                    <div class="box-tools">
                        <!-- Custom tools or buttons can be added here -->
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span><strong>Địa chỉ:</strong> {{ vm.m.data.address }}</span>
                        </div>
                        <div class="col-md-6">
                            <span><strong>Phụ trách hiện tại:</strong> {{ vm.m.data.salesman_name }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <span><strong>Khu vực:</strong> {{ vm.m.data.area1_name }} - <i>{{ vm.m.data.area2_name }}</i></span>
                        </div>
                        <div class="col-md-6">
                            <span><strong>Liên hệ:</strong> {{ vm.m.data.contact_tel }} - {{ vm.m.data.contact_mobile1 }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <span><strong>Ngày sinh:</strong> </span>
                        </div>
                        <div class="col-md-6">
                            <span><strong>Điểm tích lũy:</strong> {{ vm.m.data.scorecard }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="year" style="margin-right: 5px;">Năm Bắt Đầu:</label>
                        <select ng-model="vm.m.selectedYear" ng-change="vm.loadDataForYear()" class="form-control d-inline-block" style="width: 150px;">
                            <option ng-repeat="year in vm.m.years" ng-value="{{ year.year }}">
                                {{ year.year }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-hover table_history">
                            <thead class="thead-light">
                                <tr class="tr_history" style="border: 2px solid #dee2e6;">
                                    <th style="border: 2px solid #dee2e6;">Quý</th>
                                    <th style="border: 2px solid #dee2e6;">Doanh số</th>
                                    <th style="border: 2px solid #dee2e6;">Thâm niên</th>
                                    <th style="border: 2px solid #dee2e6;">Tần suất đặt hàng</th>
                                    <th style="border: 2px solid #dee2e6;">Công nợ</th>
                                    <th style="border: 2px solid #dee2e6;">Tổng điểm</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="quarter in [1, 2, 3, 4]" style="border: 2px solid #dee2e6;">
                                    <td style="border: 2px solid #dee2e6;">{{ quarter }}</td>
                                    <td style="border: 2px solid #dee2e6;">
                                        {{ vm.m.TotalSale[quarter] | currency:'':0 }} VNĐ
                                        <br>
                                        <small class="text-success font-weight-bold">+{{ vm.m.totalScoreCard[quarter].sale_score }} điểm</small>
                                    </td>
                                    <td style="border: 2px solid #dee2e6;">
                                        {{ vm.m.Retention[quarter] ? "Có Thâm Niên" : "Không Thâm Niên" }}
                                        <br>
                                        <small class="text-success font-weight-bold">+{{ vm.m.totalScoreCard[quarter].retention_score }} điểm</small>
                                    </td>
                                    <td style="border: 2px solid #dee2e6;">
                                        {{ vm.m.CountOrder[quarter] | currency:'':2 }} Đơn
                                        <br>
                                        <small class="text-success font-weight-bold">+{{ vm.m.totalScoreCard[quarter].order_score }} điểm</small>
                                    </td>
                                    <td style="border: 2px solid #dee2e6;">
                                        {{ vm.m.Dept[quarter] ? "Không Công Nợ" : "Có Công Nợ" }}
                                        <br>
                                        <small class="text-success font-weight-bold">+{{ vm.m.totalScoreCard[quarter].dept_score }} điểm</small>
                                    </td>
                                    <td class="total_score_card" style="border: 2px solid #dee2e6;">
                                        <b>{{ vm.m.totalScoreCard[quarter].total_score_card }} điểm</b>
                                    </td>
                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
