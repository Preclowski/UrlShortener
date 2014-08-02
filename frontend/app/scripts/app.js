'use strict';

/**
 * @ngdoc overview
 * @name urlerApp
 * @description
 * # urlerApp
 *
 * Main module of the application.
 */
angular
  .module('urlerApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
