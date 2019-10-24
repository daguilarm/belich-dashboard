/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/sections/index.js":
/*!****************************************!*\
  !*** ./resources/js/sections/index.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/**
 *
 * ////////////////////////////////////
 * ////// * Index methods  * //////
 * ////////////////////////////////////
 *
 */

/*
Section: Table
Description: Check all the fields from the index table
*/

function checkAll(selector) {
  var checkboxes = document.querySelectorAll('input[type="checkbox"].form-index-selector');

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].type == 'checkbox') {
      checkboxes[i].checked = selector.checked === true ? true : false;
    }
  } //Toogle buttons


  checkForSelectedFields();
}
/*
Section: Table
Description: Check if there is a field selected
*/


function checkForSelectedFields() {
  //Toogle buttons
  toggleOnSelection('.button-selected', document.querySelectorAll('input[type="checkbox"]:checked.form-index-selector'));
}
/*
Section: Search
Description: Empty the input value when click on reset icon
*/


function resetSearch() {
  //Reset value
  document.getElementById('_search').value = ''; //Hide icon

  onSelection('#icon-search-reset', 'hide');
}
/*
Section: Search
Description: Show the reset icon when the input is not empty
*/


function showResetSearch() {
  if (document.getElementById('_search').value.length > 0) {
    onSelection('#icon-search-reset', 'show');
  }
}
/*
Section: Form
Description: Select all the checked checkboxes
*/


function getCheckboxSelected() {
  //Reset the elements list
  var listOfCheckedElements = []; //Get all the checked elements

  var elements = document.querySelector('#belich-index-table').querySelectorAll('input[type="checkbox"]'); //Add all the elements to the list

  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      listOfCheckedElements[i] = elements[i].value;
    }
  }

  return listOfCheckedElements;
}
/*
Section: Form
Description: Add all the checked checkboxes to the hidden field
Methods: getCheckboxSelected()
*/


function addCheckboxesToField(fieldID) {
  return document.getElementById(fieldID).value = getCheckboxSelected();
}
/*
Section: Delete
Description: Delete the selected fields or all the fields
Methods: getCheckboxSelected()
*/


function deleteSelectedFields(fieldID) {
  //Get the selected items
  var items = getCheckboxSelected(); //Add selected values

  document.getElementById(fieldID).value = items;

  if (items.length <= 0) {
    return false;
  }
}
/*
Section: Delete
Description: Delete the field
*/


function deleteField(form, url) {
  document.getElementById(form).setAttribute('action', url);
}
/*
Section: Global
Description: Toggle container base on item selection
*/


function toggleOnSelection(selector, items) {
  items.length <= 0 ? onSelection(selector, 'hide') : onSelection(selector, 'show');
}
/*
Section: Global
Description: Show or hide container base on item selection
*/


function onSelection(selector, type) {
  var elements = document.querySelectorAll(selector); //Show each element

  for (var i = 0; i < elements.length; i++) {
    type === 'hide' ? elements[i].classList.add('hidden') : elements[i].classList.remove('hidden');
  }
}
/*
Section: Search
Description: Live search
*/


function liveSearch() {
  var query = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

  //Min. search filter
  if (query.length < minSearch) {
    return;
  }

  var xhttp = new XMLHttpRequest();
  var ajaxUrl = window.liveSearchRoute + '?query=' + query + '&resourceNam=' + window.liveSearchResource + '&type=search&fields=' + liveSearchFields;

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('tableContainer').innerHTML = this.responseText;
    }
  };

  xhttp.open('GET', ajaxUrl, true);
  xhttp.send();
}

/***/ }),

/***/ 3:
/*!**********************************************!*\
  !*** multi ./resources/js/sections/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/daguilarm/Sites/Packages/belich/resources/js/sections/index.js */"./resources/js/sections/index.js");


/***/ })

/******/ });