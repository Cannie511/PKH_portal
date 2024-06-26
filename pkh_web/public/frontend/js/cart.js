console.log('this is cart.js');

var myApp = angular.module('pkhApp', []);
myApp.controller('CartController', ['$scope', '$http', function($scope, $http) {

    $scope.greeting = 'Hola!';
    $scope.cart = {};
    $scope.payment = 0;
    $scope.checkName = 1; // check user name
    $scope.checkPhone = 1; // check user phone
    $scope.form = {}; // user information
    $scope.isLoaded = false; // có đang tạo cart trên server 
    $scope.initCart = function() {
        $scope.form.name = sessionStorage.userName;
        $scope.form.phone = sessionStorage.userPhone;
        if (localStorage.cart == null) {
            $scope.cart = {};
            $scope.cart.amount = 0;
            $scope.cart.list = {}

        } else {
            $scope.cart = angular.fromJson(localStorage.cart);
            $scope.makePayment();
        }
    }

    $scope.removeFromCart = function(item) {
        $scope.cart.amount -= item.amount;
        delete $scope.cart.list[item.product_id];
        $scope.makePayment();
    }

    $scope.makePayment = function() {
        $scope.payment = 0;
        angular.forEach($scope.cart.list, function(value, key) {
            $scope.payment += value.amount * value.selling_price;
        });
    }

    $scope.updateCart = function() {
        $scope.cart.amount = 0;
        angular.forEach($scope.cart.list, function(value, key) {
            $scope.cart.amount += value.amount;
        });
        localStorage.cart = angular.toJson($scope.cart);
    }

    checkCartCondition = function() {
        var ok = true;

        // 0 :rỗng
        // -1 : chưa điền so lượng ô
        // -2 : Giống cart trước
        if ($scope.cart.amount == 0) {
            ok = false;
            $scope.checkCart = 0;
            return ok;
        } else {
            $scope.checkCart = 1;
        }
        //sessionStorage.cart = angular.toJson({});
        var previousCartPro;
        var previousCart;
        if (sessionStorage.cart) {
            previousCartPro = angular.fromJson(sessionStorage.cart);
            previousCart = previousCartPro.list;
        } else {
            previousCart = {};
        }
        // console.log('check old cart', previousCart);
        var similarRate = Object.keys(previousCart).length;
        var countSimilar = 0;
        var count = 0;
        angular.forEach($scope.cart.list, function(value, key) {
            if (!value.amount) {
                $scope.checkCart = -1;
                ok = false;

            }
            count++;
            if (previousCart[key]) {
                countSimilar++;
            }
        });
        //console.log('check old cart length', similarRate);
        //console.log('check old cart length', countSimilar);
        if (countSimilar == similarRate && countSimilar != 0 && similarRate != 0 && countSimilar == count) {
            $scope.checkCart = -2;
            ok = false;
        }

        return ok;
    }

    checkConditionToMakeOrder = function(name, phone) {
        $scope.ok = true;
        //Kiem tra tinh hop le cua ten
        // + Độ dài >= 5 và <=50 kí tự và không chứa kí tự đặc biệt
        if ($scope.form.name == null || $scope.form.name == "") {
            $scope.checkName = 0;
            $scope.ok = false;
        } else {
            var name = $scope.form.name;
            if (name.length < 5 || name.length > 50) {
                $scope.checkName = 0;
                $scope.ok = false;
            } else {
                var specialCharacter = /[-!$#%^&*()_+|~=`{}\[\]:";'<>?,.\/]/;
                if (name.match(specialCharacter)) {
                    $scope.checkName = 0;
                    $scope.ok = false;
                } else {
                    $scope.checkName = 1;
                }
            }
        }

        //Kiem tra tinh hop le cua so dien thoai
        if ($scope.form.phone == null || $scope.form.phone == "") {
            $scope.checkPhone = 0;
            $scope.ok = false;
        } else {
            var phone10so = /^\d{10}$/; // check sdt du 10 so
            var phone11so = /^\d{11}$/; // check sdt du 11 so
            if (!phone.match(phone10so) && !phone.match(phone11so)) {
                $scope.ok = false;
                $scope.checkPhone = 0;
                //alert("message");
            } else {
                $scope.checkPhone = 1;
            }
        }
        if (!checkCartCondition()) {
            $scope.ok = false;
        }
        return $scope.ok;
    }

    $scope.makeOrder = function() {
        //console.log('check scope', $scope.isLoaded);
        if ($scope.isLoaded) {
            alert("đang gửi thông tin");
            return;
        }
        //console.log('check session storage before', sessionStorage);
        var ok = checkConditionToMakeOrder($scope.form.name, $scope.form.phone);
        //console.log('check oke', ok);
        if (!ok) {
            return;
        }
        sessionStorage.userName = $scope.form.name;
        sessionStorage.userPhone = $scope.form.phone;
        if ($scope.isLoaded) {
            alert("đang gửi thông tin");
            return;
        }
        $scope.isLoaded = true;
        //console.log('check session storage', sessionStorage);
        $http({
            method: "POST",
            url: "/tao-don-hang",
            data: {
                name: $scope.form.name,
                phone: $scope.form.phone,
                total: $scope.payment,
                cart: $scope.cart
            }
        }).then(function mySuccess(response) {
            //console.log('thành công');
            sessionStorage.cart = angular.toJson($scope.cart); // Luu lai ket qua truoc để tránh gửi cùng nội dung nhiều lần lên server
            localStorage.cart = angular.toJson($scope.cart);
            $scope.isLoaded = false;
            alert("Đặt hàng thành công");
        }, function myError(response) {
            alert("Đặt hàng thất bại. Vui lòng tải lại trang");
            $scope.isLoaded = false;
        });
    }

    $scope.updateCart = function() {
        localStorage.cart = angular.toJson($scope.cart);
    }

    $scope.emptyCart = function() {
        $scope.cart = {};
        $scope.cart.amount = 0;
        $scope.cart.list = {}
        $scope.payment = 0;
        localStorage.cart = angular.toJson($scope.cart);
    }

}]);