userRegistrationApp.controller('UserController', function($scope) {
    $scope.user = {};

    $scope.register = function() {
        if ($scope.userForm.$valid) {
            alert("Registro bem-sucedido!");
            $scope.user = {};
            $scope.userForm.$setPristine();
            $scope.userForm.$setUntouched();
        }
    };
});