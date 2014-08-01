'use strict';

/**
 * @ngdoc function
 * @name urlerApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the urlerApp
 */
angular.module('urlerApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
