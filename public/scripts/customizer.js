/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunksage"] = self["webpackChunksage"] || []).push([["/scripts/customizer"],{

/***/ "./resources/scripts/customizer.js":
/*!*****************************************!*\
  !*** ./resources/scripts/customizer.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

eval("/* provided dependency */ var $ = __webpack_require__(/*! jquery */ \"./node_modules/jquery/dist/jquery.js\");\n/**\n * This file allows you to add functionality to the Theme Customizer\n * live preview. jQuery is readily available.\n *\n * {@link https://codex.wordpress.org/Theme_Customization_API}\n */\n\n/**\n * Change the blog name value.\n *\n * @param {string} value\n */\nwp.customize('blogname', function (value) {\n  value.bind(function (to) {\n    return $('.brand').text(to);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc2NyaXB0cy9jdXN0b21pemVyLmpzIiwibWFwcGluZ3MiOiI7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBQSxFQUFFLENBQUNDLFNBQVMsQ0FBQyxVQUFVLEVBQUUsVUFBQUMsS0FBSyxFQUFJO0VBQ2hDQSxLQUFLLENBQUNDLElBQUksQ0FBQyxVQUFBQyxFQUFFO0lBQUEsT0FBSUMsQ0FBQyxDQUFDLFFBQVEsQ0FBQyxDQUFDQyxJQUFJLENBQUNGLEVBQUUsQ0FBQztFQUFBLEVBQUM7QUFDeEMsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vc2FnZS8uL3Jlc291cmNlcy9zY3JpcHRzL2N1c3RvbWl6ZXIuanM/Y2NlMCJdLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIFRoaXMgZmlsZSBhbGxvd3MgeW91IHRvIGFkZCBmdW5jdGlvbmFsaXR5IHRvIHRoZSBUaGVtZSBDdXN0b21pemVyXG4gKiBsaXZlIHByZXZpZXcuIGpRdWVyeSBpcyByZWFkaWx5IGF2YWlsYWJsZS5cbiAqXG4gKiB7QGxpbmsgaHR0cHM6Ly9jb2RleC53b3JkcHJlc3Mub3JnL1RoZW1lX0N1c3RvbWl6YXRpb25fQVBJfVxuICovXG5cbi8qKlxuICogQ2hhbmdlIHRoZSBibG9nIG5hbWUgdmFsdWUuXG4gKlxuICogQHBhcmFtIHtzdHJpbmd9IHZhbHVlXG4gKi9cbndwLmN1c3RvbWl6ZSgnYmxvZ25hbWUnLCB2YWx1ZSA9PiB7XG4gIHZhbHVlLmJpbmQodG8gPT4gJCgnLmJyYW5kJykudGV4dCh0bykpO1xufSk7XG4iXSwibmFtZXMiOlsid3AiLCJjdXN0b21pemUiLCJ2YWx1ZSIsImJpbmQiLCJ0byIsIiQiLCJ0ZXh0Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/scripts/customizer.js\n");

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/scripts/vendor"], () => (__webpack_exec__("./resources/scripts/customizer.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);