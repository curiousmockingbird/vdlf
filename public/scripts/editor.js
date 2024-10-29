"use strict";
/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunksage"] = self["webpackChunksage"] || []).push([["/scripts/editor"],{

/***/ "./resources/scripts/editor.js":
/*!*************************************!*\
  !*** ./resources/scripts/editor.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ \"@wordpress/element\");\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ \"@wordpress/blocks\");\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ \"@wordpress/i18n\");\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ \"@wordpress/components\");\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);\n\n// Import necessary WordPress packages using ES6 imports\n\n\n\n\n\n// Register a new block type\n(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('vdlf/my-custom-block', {\n  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('My Custom Block', 'vdlf'),\n  description: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('A custom block for VDLF theme.', 'vdlf'),\n  icon: 'smiley',\n  category: 'common',\n  attributes: {\n    content: {\n      type: 'string',\n      source: 'html',\n      selector: 'p'\n    },\n    color: {\n      type: 'string',\n      \"default\": '#000000'\n    }\n  },\n  edit: function edit(props) {\n    var _props$attributes = props.attributes,\n      content = _props$attributes.content,\n      color = _props$attributes.color,\n      setAttributes = props.setAttributes,\n      className = props.className;\n    var onChangeContent = function onChangeContent(newContent) {\n      setAttributes({\n        content: newContent\n      });\n    };\n    var onChangeColor = function onChangeColor(newColor) {\n      setAttributes({\n        color: newColor\n      });\n    };\n    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {\n      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Text Color', 'vdlf')\n    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.ColorPalette, {\n      value: color,\n      onChange: onChangeColor\n    }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.RichText, {\n      tagName: \"p\",\n      className: className,\n      onChange: onChangeContent,\n      value: content,\n      style: {\n        color: color\n      },\n      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Write your content here...', 'vdlf')\n    }));\n  },\n  save: function save(props) {\n    var _props$attributes2 = props.attributes,\n      content = _props$attributes2.content,\n      color = _props$attributes2.color;\n    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.RichText.Content, {\n      tagName: \"p\",\n      value: content,\n      style: {\n        color: color\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc2NyaXB0cy9lZGl0b3IuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7O0FBQUE7QUFDc0Q7QUFDakI7QUFLSjtBQUNpQjs7QUFFbEQ7QUFDQUEsb0VBQWlCLENBQUMsc0JBQXNCLEVBQUU7RUFDeENNLEtBQUssRUFBRUwsbURBQUUsQ0FBQyxpQkFBaUIsRUFBRSxNQUFNLENBQUM7RUFDcENNLFdBQVcsRUFBRU4sbURBQUUsQ0FBQyxnQ0FBZ0MsRUFBRSxNQUFNLENBQUM7RUFDekRPLElBQUksRUFBRSxRQUFRO0VBQ2RDLFFBQVEsRUFBRSxRQUFRO0VBQ2xCQyxVQUFVLEVBQUU7SUFDVkMsT0FBTyxFQUFFO01BQ1BDLElBQUksRUFBRSxRQUFRO01BQ2RDLE1BQU0sRUFBRSxNQUFNO01BQ2RDLFFBQVEsRUFBRTtJQUNaLENBQUM7SUFDREMsS0FBSyxFQUFFO01BQ0xILElBQUksRUFBRSxRQUFRO01BQ2QsV0FBUztJQUNYO0VBQ0YsQ0FBQztFQUNESSxJQUFJLEVBQUUsU0FBTkEsSUFBSUEsQ0FBR0MsS0FBSyxFQUFLO0lBQ2YsSUFBQUMsaUJBQUEsR0FJSUQsS0FBSyxDQUhQUCxVQUFVO01BQUlDLE9BQU8sR0FBQU8saUJBQUEsQ0FBUFAsT0FBTztNQUFFSSxLQUFLLEdBQUFHLGlCQUFBLENBQUxILEtBQUs7TUFDNUJJLGFBQWEsR0FFWEYsS0FBSyxDQUZQRSxhQUFhO01BQ2JDLFNBQVMsR0FDUEgsS0FBSyxDQURQRyxTQUFTO0lBR1gsSUFBTUMsZUFBZSxHQUFHLFNBQWxCQSxlQUFlQSxDQUFJQyxVQUFVLEVBQUs7TUFDdENILGFBQWEsQ0FBQztRQUFFUixPQUFPLEVBQUVXO01BQVcsQ0FBQyxDQUFDO0lBQ3hDLENBQUM7SUFFRCxJQUFNQyxhQUFhLEdBQUcsU0FBaEJBLGFBQWFBLENBQUlDLFFBQVEsRUFBSztNQUNsQ0wsYUFBYSxDQUFDO1FBQUVKLEtBQUssRUFBRVM7TUFBUyxDQUFDLENBQUM7SUFDcEMsQ0FBQztJQUVELE9BQ0VDLGlFQUFBLENBQUFDLHdEQUFBLFFBQ0VELGlFQUFBLENBQUN0QixzRUFBaUIsUUFDaEJzQixpRUFBQSxDQUFDcEIsNERBQVM7TUFBQ0MsS0FBSyxFQUFFTCxtREFBRSxDQUFDLFlBQVksRUFBRSxNQUFNO0lBQUUsR0FDekN3QixpRUFBQSxDQUFDckIsaUVBQVk7TUFBQ3VCLEtBQUssRUFBRVosS0FBTTtNQUFDYSxRQUFRLEVBQUVMO0lBQWMsQ0FBRSxDQUM3QyxDQUNNLENBQUMsRUFDcEJFLGlFQUFBLENBQUN2Qiw2REFBUTtNQUNQMkIsT0FBTyxFQUFDLEdBQUc7TUFDWFQsU0FBUyxFQUFFQSxTQUFVO01BQ3JCUSxRQUFRLEVBQUVQLGVBQWdCO01BQzFCTSxLQUFLLEVBQUVoQixPQUFRO01BQ2ZtQixLQUFLLEVBQUU7UUFBRWYsS0FBSyxFQUFFQTtNQUFNLENBQUU7TUFDeEJnQixXQUFXLEVBQUU5QixtREFBRSxDQUFDLDRCQUE0QixFQUFFLE1BQU07SUFBRSxDQUN2RCxDQUNELENBQUM7RUFFUCxDQUFDO0VBQ0QrQixJQUFJLEVBQUUsU0FBTkEsSUFBSUEsQ0FBR2YsS0FBSyxFQUFLO0lBQ2YsSUFBQWdCLGtCQUFBLEdBRUloQixLQUFLLENBRFBQLFVBQVU7TUFBSUMsT0FBTyxHQUFBc0Isa0JBQUEsQ0FBUHRCLE9BQU87TUFBRUksS0FBSyxHQUFBa0Isa0JBQUEsQ0FBTGxCLEtBQUs7SUFHOUIsT0FDRVUsaUVBQUEsQ0FBQ3ZCLDZEQUFRLENBQUNnQyxPQUFPO01BQ2ZMLE9BQU8sRUFBQyxHQUFHO01BQ1hGLEtBQUssRUFBRWhCLE9BQVE7TUFDZm1CLEtBQUssRUFBRTtRQUFFZixLQUFLLEVBQUVBO01BQU07SUFBRSxDQUN6QixDQUFDO0VBRU47QUFDRixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vcmVzb3VyY2VzL3NjcmlwdHMvZWRpdG9yLmpzPzZiNWUiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gSW1wb3J0IG5lY2Vzc2FyeSBXb3JkUHJlc3MgcGFja2FnZXMgdXNpbmcgRVM2IGltcG9ydHNcbmltcG9ydCB7IHJlZ2lzdGVyQmxvY2tUeXBlIH0gZnJvbSAnQHdvcmRwcmVzcy9ibG9ja3MnO1xuaW1wb3J0IHsgX18gfSBmcm9tICdAd29yZHByZXNzL2kxOG4nO1xuaW1wb3J0IHtcbiAgUmljaFRleHQsXG4gIEluc3BlY3RvckNvbnRyb2xzLFxuICBDb2xvclBhbGV0dGUsXG59IGZyb20gJ0B3b3JkcHJlc3MvYmxvY2stZWRpdG9yJztcbmltcG9ydCB7IFBhbmVsQm9keSB9IGZyb20gJ0B3b3JkcHJlc3MvY29tcG9uZW50cyc7XG5cbi8vIFJlZ2lzdGVyIGEgbmV3IGJsb2NrIHR5cGVcbnJlZ2lzdGVyQmxvY2tUeXBlKCd2ZGxmL215LWN1c3RvbS1ibG9jaycsIHtcbiAgdGl0bGU6IF9fKCdNeSBDdXN0b20gQmxvY2snLCAndmRsZicpLFxuICBkZXNjcmlwdGlvbjogX18oJ0EgY3VzdG9tIGJsb2NrIGZvciBWRExGIHRoZW1lLicsICd2ZGxmJyksXG4gIGljb246ICdzbWlsZXknLFxuICBjYXRlZ29yeTogJ2NvbW1vbicsXG4gIGF0dHJpYnV0ZXM6IHtcbiAgICBjb250ZW50OiB7XG4gICAgICB0eXBlOiAnc3RyaW5nJyxcbiAgICAgIHNvdXJjZTogJ2h0bWwnLFxuICAgICAgc2VsZWN0b3I6ICdwJyxcbiAgICB9LFxuICAgIGNvbG9yOiB7XG4gICAgICB0eXBlOiAnc3RyaW5nJyxcbiAgICAgIGRlZmF1bHQ6ICcjMDAwMDAwJyxcbiAgICB9LFxuICB9LFxuICBlZGl0OiAocHJvcHMpID0+IHtcbiAgICBjb25zdCB7XG4gICAgICBhdHRyaWJ1dGVzOiB7IGNvbnRlbnQsIGNvbG9yIH0sXG4gICAgICBzZXRBdHRyaWJ1dGVzLFxuICAgICAgY2xhc3NOYW1lLFxuICAgIH0gPSBwcm9wcztcblxuICAgIGNvbnN0IG9uQ2hhbmdlQ29udGVudCA9IChuZXdDb250ZW50KSA9PiB7XG4gICAgICBzZXRBdHRyaWJ1dGVzKHsgY29udGVudDogbmV3Q29udGVudCB9KTtcbiAgICB9O1xuXG4gICAgY29uc3Qgb25DaGFuZ2VDb2xvciA9IChuZXdDb2xvcikgPT4ge1xuICAgICAgc2V0QXR0cmlidXRlcyh7IGNvbG9yOiBuZXdDb2xvciB9KTtcbiAgICB9O1xuXG4gICAgcmV0dXJuIChcbiAgICAgIDw+XG4gICAgICAgIDxJbnNwZWN0b3JDb250cm9scz5cbiAgICAgICAgICA8UGFuZWxCb2R5IHRpdGxlPXtfXygnVGV4dCBDb2xvcicsICd2ZGxmJyl9PlxuICAgICAgICAgICAgPENvbG9yUGFsZXR0ZSB2YWx1ZT17Y29sb3J9IG9uQ2hhbmdlPXtvbkNoYW5nZUNvbG9yfSAvPlxuICAgICAgICAgIDwvUGFuZWxCb2R5PlxuICAgICAgICA8L0luc3BlY3RvckNvbnRyb2xzPlxuICAgICAgICA8UmljaFRleHRcbiAgICAgICAgICB0YWdOYW1lPVwicFwiXG4gICAgICAgICAgY2xhc3NOYW1lPXtjbGFzc05hbWV9XG4gICAgICAgICAgb25DaGFuZ2U9e29uQ2hhbmdlQ29udGVudH1cbiAgICAgICAgICB2YWx1ZT17Y29udGVudH1cbiAgICAgICAgICBzdHlsZT17eyBjb2xvcjogY29sb3IgfX1cbiAgICAgICAgICBwbGFjZWhvbGRlcj17X18oJ1dyaXRlIHlvdXIgY29udGVudCBoZXJlLi4uJywgJ3ZkbGYnKX1cbiAgICAgICAgLz5cbiAgICAgIDwvPlxuICAgICk7XG4gIH0sXG4gIHNhdmU6IChwcm9wcykgPT4ge1xuICAgIGNvbnN0IHtcbiAgICAgIGF0dHJpYnV0ZXM6IHsgY29udGVudCwgY29sb3IgfSxcbiAgICB9ID0gcHJvcHM7XG5cbiAgICByZXR1cm4gKFxuICAgICAgPFJpY2hUZXh0LkNvbnRlbnRcbiAgICAgICAgdGFnTmFtZT1cInBcIlxuICAgICAgICB2YWx1ZT17Y29udGVudH1cbiAgICAgICAgc3R5bGU9e3sgY29sb3I6IGNvbG9yIH19XG4gICAgICAvPlxuICAgICk7XG4gIH0sXG59KTsiXSwibmFtZXMiOlsicmVnaXN0ZXJCbG9ja1R5cGUiLCJfXyIsIlJpY2hUZXh0IiwiSW5zcGVjdG9yQ29udHJvbHMiLCJDb2xvclBhbGV0dGUiLCJQYW5lbEJvZHkiLCJ0aXRsZSIsImRlc2NyaXB0aW9uIiwiaWNvbiIsImNhdGVnb3J5IiwiYXR0cmlidXRlcyIsImNvbnRlbnQiLCJ0eXBlIiwic291cmNlIiwic2VsZWN0b3IiLCJjb2xvciIsImVkaXQiLCJwcm9wcyIsIl9wcm9wcyRhdHRyaWJ1dGVzIiwic2V0QXR0cmlidXRlcyIsImNsYXNzTmFtZSIsIm9uQ2hhbmdlQ29udGVudCIsIm5ld0NvbnRlbnQiLCJvbkNoYW5nZUNvbG9yIiwibmV3Q29sb3IiLCJjcmVhdGVFbGVtZW50IiwiRnJhZ21lbnQiLCJ2YWx1ZSIsIm9uQ2hhbmdlIiwidGFnTmFtZSIsInN0eWxlIiwicGxhY2Vob2xkZXIiLCJzYXZlIiwiX3Byb3BzJGF0dHJpYnV0ZXMyIiwiQ29udGVudCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/scripts/editor.js\n");

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = wp.blockEditor;

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = wp.blocks;

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = wp.components;

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = wp.element;

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = wp.i18n;

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/scripts/editor.js"));
/******/ }
]);