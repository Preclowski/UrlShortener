'use strict';

angular.module('urlerApp')
  .filter('parseLinks', function (ShortenLink) {

    return function (message) {

      return message.replace( /\n/g, " " ).split( " ");
    };
  });