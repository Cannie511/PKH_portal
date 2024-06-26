class Cms0210Controller {
    constructor($scope, $state, $compile, $log, AclService, API, UtilsService, $stateParams, ClientService, RouteService) {
        'ngInject'

        this.$scope = $scope;
        this.$state = $state;
        this.$compile = $compile;
        this.$log = $log;
        this.AclService = AclService;
        this.API = API;
        this.UtilsService = UtilsService;
        this.ClientService = ClientService;
        this.RouteService = RouteService;

        this.m = {
            form: {
                publishDate: moment(),
                file: null
            },
            formUpload: {
                file: null,
                images: []
            },
            datetimepicker_options: {
                viewMode: 'days',
                format: 'YYYY-MM-DD'
            }
        }

        if ($stateParams.id > 0) {
            this.m.form.id = $stateParams.id;
        } else {
            this.m.form.id = 0;
        }
    }

    $onInit() {
        this._setupFileUpload("file", this.m.form);
        this._setupFileUpload("fileUpload", this.m.formUpload);

        this.m.urlImageFrontend = document.getElementById('urlImageFrontend').value;
        this.loadInitData();
        this.loadImageList();
    }

    _setupFileUpload(fileControlId, formModel) {
        var self = this;
        let fileControl = angular.element("#" + fileControlId);
        fileControl.on('change', function() {
            var filesSelected = fileControl[0].files;
            if (filesSelected.length > 0) {
                var fileToLoad = filesSelected[0];
                var fileReader = new FileReader();

                fileReader.onload = function(fileLoadedEvent) {
                    var srcData = fileLoadedEvent.target.result; // <--- data: base64 
                    self.$scope.$apply(function() {
                        formModel.file = srcData;
                    });
                }
                fileReader.readAsDataURL(fileToLoad);
            }
        });
    }

    loadInitData() {
        let self = this;
        if (this.m.form.id > 0) {
            let service = this.API.service('load', this.API.all('cms0210'));
            let param = { newsId: this.m.form.id };
            service.post(param)
                .then(function(response) {
                    self.m.form.title = response.data.news[0].title;
                    self.m.form.publishDate = moment(response.data.news[0].publish_date);
                    self.m.form.description = response.data.news[0].description;
                    self.m.form.keywords = response.data.news[0].keywords;
                    self.m.form.content = response.data.news[0].content;
                    self.m.form.short_content = response.data.news[0].short_content;
                    self.m.form.slug = response.data.news[0].slug;
                    if (response.data.news[0].feature_image_path != null && response.data.news[0].feature_image_path.length > 0) {
                        self.m.form.pathFile = self.m.urlImageFrontend + response.data.news[0].feature_image_path;
                    }
                });
        } else {
            this.m.form.content = `
<p>
    Nhằm hỗ trợ các đại lý kinh doanh sản phẩm WaterTec, Công ty Phan Khang Home thực hiện đăng quảng cáo dòng sản phẩm cao cấp KATANA trên Báo Tuổi trẻ ra ngày thứ Tư (15/2/2017). 
    Mọi chi tiết vui lòng liên hệ hotline <a class="btn-ga" ga-cat="contact" ga-action="call" ga-label="0906610116" href="tel:0906610116">(+84)90-6610-116</a> hoặc <a class="btn-ga" ga-cat="contact" ga-action="click" ga-label="www.phankhangco.com" href="http://www.phankhangco.com">www.phankhangco.com</a>
</p>`;
        }
    }

    save(isValid) {
        let thisClass = this;

        if (isValid) {
            thisClass.$log.info('send');
            let service = this.API.service('cms0210');
            let param = angular.copy(this.m.form);
            if (param.publishDate != null && moment.isMoment(param.publishDate)) {
                param.publishDate = param.publishDate.format('YYYY-MM-DD');
            }
            service.post(param)
                .then(function(response) {
                    thisClass.$log.info('response', response);
                    if (thisClass.m.form.id > 0) {
                        thisClass.ClientService.success('Cập nhật tin tức thành công');
                    } else {
                        thisClass.ClientService.success('Thêm mới tin tức thành công');
                    }

                    // thisClass.RouteService.goState('app.cms0200')
                    thisClass.RouteService.goState('app.cms0211', {id: response.data.newsId})
                }, function(response) {
                    thisClass.$log.info('response', response);
                    thisClass.ClientService.error('Đã có lỗi xãy ra');
                });
        } else {
            this.formSubmitted = true
        }
    }

    upload() {
        let self = this;
        let service = this.API.service('upload', this.API.all('cms0210'));
        let param = {
            id: this.m.form.id,
            file: this.m.formUpload.file
        }

        if ( param.id > 0) {
            service.post(param)
            .then(function(response) {
                if (response.data.rtnCd == true) {
                    self.m.formUpload.file = null;
                    self.ClientService.success('Thêm hình ảnh tin tức thành công');
                    self.loadImageList();
                } else {
                    self.ClientService.error('Không thể thêm hình ảnh');
                }
            });
        }
    }

    loadImageList() {
        let self = this;
        let param = {
            id: this.m.form.id
        };

        if ( param.id > 0) {
            let service = this.API.service('load-images', this.API.all('cms0210'));
            
            service.post(param)
                .then(function(response) {
                    if (response.data.rtnCd == true) {
                        self.m.formUpload.images =response.data.list;
                    } else {
                        self.ClientService.error('Có lỗi khi tải hình ảnh');
                    }
                });
        }
    }

    removeImage(file) {
        file = file.substr(file.lastIndexOf("/") + 1);

        var self = this; 
        swal({
            title: `Bạn có muốn xóa hình ảnh "${file}" không?`,
            text: "Hình ảnh này sẽ không còn hiển thị trong nội dung tin tức được nữa, hãy chắn chắn rằng bạn đã không còn sử dụng hình ảnh này.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55', 
            confirmButtonText: 'Đồng ý',
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            html: false
        }, function() {
            var param = {
                id: self.m.form.id,
                file: file
            };

            let service = self.API.service('remove-image', self.API.all('cms0210'));
            service.post(param)
                .then((res) => {
                    self.loadImageList();
                });
        });
    }

    insertImage(file) {
        let imgTag = `
        <p class="text-center" style="align: text-center">
        <img class="img-responsive" src='${this.m.urlImageFrontend}/${file}' alt="watertec" style="margin:0 auto" />
        </p>
        `;
        this.m.form.content = this.m.form.content + imgTag;
    }
}

export const Cms0210Component = {
    //templateUrl: './views/app/components/cms0210/cms0210.component.html',
    templateUrl: '/views/admin.cms0210',
    controller: Cms0210Controller,
    controllerAs: 'vm',
    bindings: {}
}