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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/sections/forms.js":
/*!****************************************!*\
  !*** ./resources/js/sections/forms.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
Section: Form
Description: Count textArea Characters.
*/
function textAreaCount(container, id) {
  document.getElementById('chars-' + id).innerHTML = window.message_chart_left + ": <b>" + (container.maxLength - container.value.length) + "</b>";
}
/*
Section: Form
Description: Toggle checkbox
*/


function toggleCheckbox(id) {
  var container = document.getElementById(id);
  container.value = container.checked == 0 ? 0 : 1;
}
/*
Section: Tabs
Description: Tabs for forms
*/


function switchTab(id, key) {
  var currentTab; // Prevent doubble click

  if (currentTab === key) {
    return false;
  } //Close all tabs


  var elements = document.querySelectorAll('.content');
  var container = document.getElementById('content_' + id); //Hide all the containers

  for (var i = 0; i < elements.length; i++) {
    elements[i].classList.add('hidden'), elements[i].classList.remove('block');
  } //Set visible


  container.classList.remove('hidden'), container.classList.add('block'); //Add active

  document.querySelector('.tabs ul li a.active').classList.remove('active');
  document.getElementById('menu_' + id).classList.add('active'); //Set current tab

  currentTab = key;
}
/*
Section: Form
Description: Limit decimal in inputs
Example: <input class="fixed" type="text" decimals="2" />
*/


var floatInputs = document.querySelectorAll('.float');
floatInputs.forEach(function (element) {
  element.addEventListener('input', function () {
    var decimals = element.getAttribute('decimals');
    var regex = new RegExp('(\\.\\d{' + decimals + '})\\d+', 'g');
    element.value = element.value.replace(regex, '$1');
  });
});

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/sections/forms.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/daguilarm/Sites/Packages/belich/resources/js/sections/forms.js */"./resources/js/sections/forms.js");


/***/ })

/******/ });