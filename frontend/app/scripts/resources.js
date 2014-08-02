'use strict';

angular.module('urlerApp')
  .factory('Shorten', function ($resource) {

    return $resource('http://urler.dev/url');
  });