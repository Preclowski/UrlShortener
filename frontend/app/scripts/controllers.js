'use strict';

angular.module('urlerApp')
  .controller('MainCtrl', function ($scope) {
    $scope.activeTab = 'single';
  })
  .controller('ShortenCtrl', function ($scope, $rootScope, $filter, Shorten) {

    $scope.message = '';

    $scope.submit = function () {

      var links = $filter('parseLinks')($scope.message);

      for (var link in links) {
        Shorten.get({url: links[link]}).$promise.then(function (data) {

          $rootScope.$emit('links.shorten', data);
        }, function (err) {
          $rootScope.$emit('alert.fail', err);
        });
      }
    };
  })
  .controller('ResultsCtrl', function ($scope, $rootScope) {
    $scope.open = false;

    $scope.results = [];

    $rootScope.$on('links.shorten', function (evt, data) {
      $scope.open = true;

      $scope.results.push(data);
    });
  });