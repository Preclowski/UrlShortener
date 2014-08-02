'use strict';

angular.module('urlerApp')
  .factory('ShortenLink', function () {

    return function (url, slug, password) {

      this.url = url;
      this.slug = slug;
      this.password = password;

      return this;
    };
  });