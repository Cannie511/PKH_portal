<section class="content-header">
    <h1>CRM 4002 2021 Quý 1<small></small></h1>
</section>
<section class="content-header">
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
</section>
<section class="content">
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
                                    <th class="text-center">Điểm ScoreScard</th>
                                    <th class="text-center">Chiết Khấu</th>
                                    <th class="text-center">Voucher quà tặng</th>
                                    <!-- <th class="text-center">Quà tặng đề xuất</th>
                                    <th class="text-center">Mô tả</th>
                                    <th class="text-center">Hình ảnh</th>                                  -->
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
                                    <td class="text-center" style="color:red"><b>{{item.total_score_card}}<b></td>
                                    <td class="text-center"><b> 5% </b>     </td>                                                                                         
                                    <td class="text-center"><b>{{+item.voucher|currency:'':0}} đ</b></td>
                                    <!-- <td class="text-center"></td>
                                    <td class="text-center"></td>                                              
                                    <td class="text-center"></td>                                                                                                -->
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
