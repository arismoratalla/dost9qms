var app = angular.module(HeaderController, ['ui.bootstrap']);
app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});
app.controller(MainController, ['$scope', '$http', '$timeout' ,function ($scope, $http, $timeout) {
    $http({
        origin: "*",
        method: 'GET',
        url:  frontendURI + 'ajax/' + HeaderController,
    }).then(function (success){
        $scope.list = success.data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter
        $scope.totalItems = $scope.list.length;

    },function (error){

    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() {
           // $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
}]);
//