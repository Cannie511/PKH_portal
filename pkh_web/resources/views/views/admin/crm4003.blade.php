<section class="content-header">
    <h1>Tạo đơn đặt hàng <small></small></h1>
    <ol class="breadcrumb">
        <li><a ui-sref="app.landing"><i class="fa fa-dashboard"></i><span translate="BREADCRUMBS_HOME"></span></a></li>
        <li><a ui-sref="app.crm1300">Danh sách đơn hàng </a></li>
        <li class="active">Tạo đơn hàng</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-9" >
            <div class="box box-info">  
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NO</th>
                                    <th >Mã sản phẩm</th>
                                    <th >Tên sản phẩm</th>
                                    <th> Mô tả </th>
                                    <th >Đóng gói</th>
                                    <th >Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Loại đóng gói</th>
                                    <th >Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>                    
                            </tbody>
                        </table>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                   
                        <label>Tổng Thanh Toán</label>
                        <input type="text" ng-model="vm.m.data.total" ng-change="vm.calculateTotalWithDiscount5()" class="form-control"/>
                   
                         </div>
                         <div class="col-md-6">
                         <label>Chiết Khấu Thêm (%)</label>
                         <input type="text" ng-model="vm.m.data.additional_discount" ng-change="vm.calculateTotalWithDiscount5()" class="form-control"/>
                        </div>                                                         
                        <div class="col-md-6">
                            <label>Thành tiền sau chiết khấu (Mặc định chiết khấu 5% ScoreCard)</label></br>
                            <p class="form-control-static">
                                    <b>Tổng Chiết Khấu {{vm.m.total_discount}}% : 
                                        <span style="color: red;">{{vm.m.data.total_with_discount_5 | currency : '' : 0 }} VNĐ</span>
                                    </b>
                                </p>    
                        </div>

                        
                        
                    </div>
                    <div class="row" >
                         <div class="col-md-6">
                            <label>Khách đưa ({{vm.m.cpayment_money | currency : '' : 0 }})</label>
                            <input type="text" class="form-control"/>
                        </div>
                
                                         
                        <div class="col-md-6">
                            <label>Dư</label>
                            <p class="form-control-static"></p>
                        </div>
                       
                    </div>
                </div>
                <div class="box-footer">
                    <a ui-sref="app.crm1920" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
                    <div class="pull-right">
         
                        <button type="button" class="btn btn-info m-l"  ng-if="vm.m.supplier_order_id > 0 && vm.m.orderDetail.length > 0 && vm.m.form.order_sts  == '1'" ng-click="vm.clickCreateExport()" ><i class="fa fa-opencart fa-fw"></i>Tạo PI</button>
                        <button type="button" class="btn btn-warning m-l" ng-disabled="vm.m.orderDetail.length == 0 || vm.m.order.length > 0" ng-click="vm.clickSave()" ><i class="fa fa-save fa-fw"></i>Lưu</button> 
                    </div>
                </div> 
            </div>

            <!-- #################################  -->
            <div class="box box-info collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">Tích Hợp Score Card</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="box-body form" style="display: none">
        <form role="form" ng-submit="vm.searchProduct()">
            <div class="row">
                <div class="col-md-12">
                     
                   <table class="table table-bordered" style="border: 2px solid #dee2e6;font-size: 13px;color: black;">
            <thead class="table-light">
                <tr style="border: 2px solid #dee2e6;">
                    <th scope="col" style="border: 2px solid #dee2e6;">Mô tả</th>
                    <th scope="col" style="border: 2px solid #dee2e6;">Giá trị</th>
                </tr>
            </thead>
            <tbody>
               <tr style="border: 2px solid #dee2e6;">
                    <td style="border: 2px solid #dee2e6;">Điểm tích lũy Score Card</td>
                    <td><span class="fw-bold">{{vm.m.total_Score_Card}} => Điểm tăng dự kiến (+{{vm.m.TotalScoreCardDifference}})</span> </td>
                </tr>
                <tr style="border: 2px solid #dee2e6;">
                    <td style="border: 2px solid #dee2e6;">Điểm doanh số dự kiến</td>
                    <td><span class="fw-bold">{{vm.m.SaleScoreExpected | currency : '' : 0}}</span> (+{{vm.m.SaleScoreDifference}})</td>
                </tr>
                <tr style="border: 2px solid #dee2e6;">
                    <td style="border: 2px solid #dee2e6;">Doanh số dự kiến để đạt mốc tiếp theo</td>
                    <td>{{ vm.m.nextMilestoneAmount | currency : '' : 0 }} VNĐ</td>
                </tr>
                <tr style="border: 2px solid #dee2e6;">
                    <td style="border: 2px solid #dee2e6;">Điểm tần suất đặt dự kiến</td>
                    <td><span class="fw-bold">{{vm.m.OrderScoreExpected | currency : '' : 0}}</span> (+{{vm.m.OrderScoreDifference}})</td>
                </tr>
                <tr style="border: 2px solid #dee2e6;">
                    <td style="border: 2px solid #dee2e6;">Số đơn dự kiến để đạt mốc tiếp theo</td>
                    <td>{{ vm.m.nextMilestoneAmountOrder | currency : '' : 0 }} Đơn</td>
                </tr>
            </tbody>
        </table>  
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-width-default">
                        Thanh Toán                             
                    </button>                   
                </div>
            </div> -->
        </form>
    </div>
</div>


             <!-- #################################  -->
        </div>

        <div class="col-md-3">

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Thông tin khách hàng</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row" >
            <div class="col-md-12">
                <label>Mã Khách hàng</label>
                <p class="form-control-static"><a ui-sref='app.crm2600({store_id: vm.m.store_id})'>#{{vm.m.data.store_id}}</a></p>
            </div>
            <div class="col-md-12" >
                <label>Tên Khách hàng</label>
                <p class="form-control-static">{{vm.m.data.name}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Địa chỉ</label>
                <p class="form-control-static">{{vm.m.data.address}}</p>
            </div>
         
            <div class="col-md-12">
                <label>Discount</label>
                <p class="form-control-static">{{vm.m.data.discount}}</p>
            </div>
            
            <div class="col-md-12">
                <label>Điện thoại</label>
                <p class="form-control-static">{{vm.m.data.contact_tel}}</p>
            </div>
            <div class="col-md-12">
                <label>Email</label>
                <p class="form-control-static">{{vm.m.data.contact_email}} </p>
            </div>
            

           
        </div>
    </div>
</div>




</div>

    </div>
</section>
