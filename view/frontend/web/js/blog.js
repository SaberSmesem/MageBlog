define('js/theme', [
    //'jquery',
    'domReady!'
], function ($) {
    'use strict';
   /* for check in this file we only add jquery code that display(in console) class of element which selector used */
    console.log("Welcome to Magento 2 Blog");
    $('.post-item-link').css('background-color','white');
});