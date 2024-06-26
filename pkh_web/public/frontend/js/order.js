console.log('this is order.js');

var myApp = angular.module('pkhApp', []);

myApp.controller('OrderController', ['$scope', '$http', function($scope, $http) {

    $scope.productType = 0;
    $scope.productTypeName = "Tất cả";
    $scope.cartAmount = 0;
    $scope.array = [1, 2, 3, 4, 5];
    localStorage.test = 1;

    if (localStorage.cart == null || localStorage.cart == {}) {
        $scope.cart = {};
        $scope.cart.amount = 0;
        $scope.cart.list = {}
    } else {
        $scope.cart = angular.fromJson(localStorage.cart);
        $scope.cartAmount = $scope.cart.amount;
    }


    $scope.clickTest = function(x, y) {
        $scope.testPrint = "click test ahihi" + x + y;
    }

    $scope.initOrder = function(x) {
        $http({
            method: "GET",
            url: "/san-pham"
        }).then(function mySuccess(response) {
            $scope.productList = response.data.data.productList;
            $scope.cateList = response.data.data.cateList;
        }, function myError(response) {
            $scope.myWelcome = response.statusText;
        });

    }

    $scope.addToCart = function(item) {
        $scope.cart.amount++;
        $scope.cartAmount++;
        if ($scope.cart.list[item.product_id] == null) {
            item.amount = 1;
            $scope.cart.list[item.product_id] = item;
        } else {
            $scope.cart.list[item.product_id].amount++;
        }
        localStorage.cart = angular.toJson($scope.cart);

    }

    $scope.filterProductList = function(productType, name) {
        $scope.productType = productType;
        $scope.productTypeName = name;
    }

}]);