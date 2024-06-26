console.log('this is detail.js');

var myApp = angular.module('pkhApp', []);
myApp.controller('DetailController', ['$scope', '$http', function($scope, $http) {

    $scope.greeting = 'Hola!';
    if (localStorage.cart == null) {
        cart = {};
        cart.amount = 0;
        cart.list = {}
    } else {
        cart = angular.fromJson(sessionStorage.cart);
        $scope.cartAmount = cart.amount;
    }

    $scope.addToCart = function(product_id) {
        cart.amount++;
        $scope.cartAmount++;
        if (cart.list[product_id] == null) {
            item.amount = 1;
            cart.list[item.product_id] = item;
        } else {
            cart.list[item.product_id].amount++;
        }

        localStorage.cart = angular.toJson(cart);

    }


}]);