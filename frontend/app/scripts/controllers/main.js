'use strict';

/**
 * @ngdoc function
 * @name urlerApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the urlerApp
 */
angular.module('urlerApp')
  .controller('MainCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
