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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ \"@wordpress/element\");\n/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ \"@wordpress/blocks\");\n/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ \"@wordpress/i18n\");\n/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ \"@wordpress/block-editor\");\n/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ \"@wordpress/components\");\n/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);\n\n// Import necessary WordPress packages using ES6 imports\n\n\n\n\n\n// Register a new block type\n(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.registerBlockType)('vdlf/my-custom-block', {\n  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('My Custom Block', 'vdlf'),\n  description: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('A custom block for VDLF theme.', 'vdlf'),\n  icon: 'smiley',\n  category: 'common',\n  attributes: {\n    content: {\n      type: 'string',\n      source: 'html',\n      selector: 'p'\n    },\n    color: {\n      type: 'string',\n      \"default\": '#000000'\n    }\n  },\n  edit: function edit(props) {\n    var _props$attributes = props.attributes,\n      content = _props$attributes.content,\n      color = _props$attributes.color,\n      setAttributes = props.setAttributes,\n      className = props.className;\n    var onChangeContent = function onChangeContent(newContent) {\n      setAttributes({\n        content: newContent\n      });\n    };\n    var onChangeColor = function onChangeColor(newColor) {\n      setAttributes({\n        color: newColor\n      });\n    };\n    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {\n      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Text Color', 'vdlf')\n    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.ColorPalette, {\n      value: color,\n      onChange: onChangeColor\n    }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.RichText, {\n      tagName: \"p\",\n      className: className,\n      onChange: onChangeContent,\n      value: content,\n      style: {\n        color: color\n      },\n      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Write your content here...', 'vdlf')\n    }));\n  },\n  save: function save(props) {\n    var _props$attributes2 = props.attributes,\n      content = _props$attributes2.content,\n      color = _props$attributes2.color;\n    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.RichText.Content, {\n      tagName: \"p\",\n      value: content,\n      style: {\n        color: color\n      }\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvc2NyaXB0cy9lZGl0b3IuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7O0FBQUE7QUFDc0Q7QUFDakI7QUFLSjtBQUNpQjs7QUFFbEQ7QUFDQUEsb0VBQWlCLENBQUMsc0JBQXNCLEVBQUU7RUFDeENNLEtBQUssRUFBRUwsbURBQUUsQ0FBQyxpQkFBaUIsRUFBRSxNQUFNLENBQUM7RUFDcENNLFdBQVcsRUFBRU4sbURBQUUsQ0FBQyxnQ0FBZ0MsRUFBRSxNQUFNLENBQUM7RUFDekRPLElBQUksRUFBRSxRQUFRO0VBQ2RDLFFBQVEsRUFBRSxRQUFRO0VBQ2xCQyxVQUFVLEVBQUU7SUFDVkMsT0FBTyxFQUFFO01BQ1BDLElBQUksRUFBRSxRQUFRO01BQ2RDLE1BQU0sRUFBRSxNQUFNO01BQ2RDLFFBQVEsRUFBRTtJQUNaLENBQUM7SUFDREMsS0FBSyxFQUFFO01BQ0xILElBQUksRUFBRSxRQUFRO01BQ2QsV0FBUztJQUNYO0VBQ0YsQ0FBQztFQUNESSxJQUFJLEVBQUUsU0FBTkEsSUFBSUEsQ0FBR0MsS0FBSyxFQUFLO0lBQ2YsSUFBQUMsaUJBQUEsR0FJSUQsS0FBSyxDQUhQUCxVQUFVO01BQUlDLE9BQU8sR0FBQU8saUJBQUEsQ0FBUFAsT0FBTztNQUFFSSxLQUFLLEdBQUFHLGlCQUFBLENBQUxILEtBQUs7TUFDNUJJLGFBQWEsR0FFWEYsS0FBSyxDQUZQRSxhQUFhO01BQ2JDLFNBQVMsR0FDUEgsS0FBSyxDQURQRyxTQUFTO0lBR1gsSUFBTUMsZUFBZSxHQUFHLFNBQWxCQSxlQUFlQSxDQUFJQyxVQUFVLEVBQUs7TUFDdENILGFBQWEsQ0FBQztRQUFFUixPQUFPLEVBQUVXO01BQVcsQ0FBQyxDQUFDO0lBQ3hDLENBQUM7SUFFRCxJQUFNQyxhQUFhLEdBQUcsU0FBaEJBLGFBQWFBLENBQUlDLFFBQVEsRUFBSztNQUNsQ0wsYUFBYSxDQUFDO1FBQUVKLEtBQUssRUFBRVM7TUFBUyxDQUFDLENBQUM7SUFDcEMsQ0FBQztJQUVELE9BQ0VDLGlFQUFBLENBQUFDLHdEQUFBLFFBQ0VELGlFQUFBLENBQUN0QixzRUFBaUIsUUFDaEJzQixpRUFBQSxDQUFDcEIsNERBQVM7TUFBQ0MsS0FBSyxFQUFFTCxtREFBRSxDQUFDLFlBQVksRUFBRSxNQUFNO0lBQUUsR0FDekN3QixpRUFBQSxDQUFDckIsaUVBQVk7TUFBQ3VCLEtBQUssRUFBRVosS0FBTTtNQUFDYSxRQUFRLEVBQUVMO0lBQWMsQ0FBRSxDQUM3QyxDQUNNLENBQUMsRUFDcEJFLGlFQUFBLENBQUN2Qiw2REFBUTtNQUNQMkIsT0FBTyxFQUFDLEdBQUc7TUFDWFQsU0FBUyxFQUFFQSxTQUFVO01BQ3JCUSxRQUFRLEVBQUVQLGVBQWdCO01BQzFCTSxLQUFLLEVBQUVoQixPQUFRO01BQ2ZtQixLQUFLLEVBQUU7UUFBRWYsS0FBSyxFQUFFQTtNQUFNLENBQUU7TUFDeEJnQixXQUFXLEVBQUU5QixtREFBRSxDQUFDLDRCQUE0QixFQUFFLE1BQU07SUFBRSxDQUN2RCxDQUNELENBQUM7RUFFUCxDQUFDO0VBQ0QrQixJQUFJLEVBQUUsU0FBTkEsSUFBSUEsQ0FBR2YsS0FBSyxFQUFLO0lBQ2YsSUFBQWdCLGtCQUFBLEdBRUloQixLQUFLLENBRFBQLFVBQVU7TUFBSUMsT0FBTyxHQUFBc0Isa0JBQUEsQ0FBUHRCLE9BQU87TUFBRUksS0FBSyxHQUFBa0Isa0JBQUEsQ0FBTGxCLEtBQUs7SUFHOUIsT0FDRVUsaUVBQUEsQ0FBQ3ZCLDZEQUFRLENBQUNnQyxPQUFPO01BQ2ZMLE9BQU8sRUFBQyxHQUFHO01BQ1hGLEtBQUssRUFBRWhCLE9BQVE7TUFDZm1CLEtBQUssRUFBRTtRQUFFZixLQUFLLEVBQUVBO01BQU07SUFBRSxDQUN6QixDQUFDO0VBRU47QUFDRixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zYWdlLy4vcmVzb3VyY2VzL3NjcmlwdHMvZWRpdG9yLmpzPzZiNWUiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gSW1wb3J0IG5lY2Vzc2FyeSBXb3JkUHJlc3MgcGFja2FnZXMgdXNpbmcgRVM2IGltcG9ydHNcclxuaW1wb3J0IHsgcmVnaXN0ZXJCbG9ja1R5cGUgfSBmcm9tICdAd29yZHByZXNzL2Jsb2Nrcyc7XHJcbmltcG9ydCB7IF9fIH0gZnJvbSAnQHdvcmRwcmVzcy9pMThuJztcclxuaW1wb3J0IHtcclxuICBSaWNoVGV4dCxcclxuICBJbnNwZWN0b3JDb250cm9scyxcclxuICBDb2xvclBhbGV0dGUsXHJcbn0gZnJvbSAnQHdvcmRwcmVzcy9ibG9jay1lZGl0b3InO1xyXG5pbXBvcnQgeyBQYW5lbEJvZHkgfSBmcm9tICdAd29yZHByZXNzL2NvbXBvbmVudHMnO1xyXG5cclxuLy8gUmVnaXN0ZXIgYSBuZXcgYmxvY2sgdHlwZVxyXG5yZWdpc3RlckJsb2NrVHlwZSgndmRsZi9teS1jdXN0b20tYmxvY2snLCB7XHJcbiAgdGl0bGU6IF9fKCdNeSBDdXN0b20gQmxvY2snLCAndmRsZicpLFxyXG4gIGRlc2NyaXB0aW9uOiBfXygnQSBjdXN0b20gYmxvY2sgZm9yIFZETEYgdGhlbWUuJywgJ3ZkbGYnKSxcclxuICBpY29uOiAnc21pbGV5JyxcclxuICBjYXRlZ29yeTogJ2NvbW1vbicsXHJcbiAgYXR0cmlidXRlczoge1xyXG4gICAgY29udGVudDoge1xyXG4gICAgICB0eXBlOiAnc3RyaW5nJyxcclxuICAgICAgc291cmNlOiAnaHRtbCcsXHJcbiAgICAgIHNlbGVjdG9yOiAncCcsXHJcbiAgICB9LFxyXG4gICAgY29sb3I6IHtcclxuICAgICAgdHlwZTogJ3N0cmluZycsXHJcbiAgICAgIGRlZmF1bHQ6ICcjMDAwMDAwJyxcclxuICAgIH0sXHJcbiAgfSxcclxuICBlZGl0OiAocHJvcHMpID0+IHtcclxuICAgIGNvbnN0IHtcclxuICAgICAgYXR0cmlidXRlczogeyBjb250ZW50LCBjb2xvciB9LFxyXG4gICAgICBzZXRBdHRyaWJ1dGVzLFxyXG4gICAgICBjbGFzc05hbWUsXHJcbiAgICB9ID0gcHJvcHM7XHJcblxyXG4gICAgY29uc3Qgb25DaGFuZ2VDb250ZW50ID0gKG5ld0NvbnRlbnQpID0+IHtcclxuICAgICAgc2V0QXR0cmlidXRlcyh7IGNvbnRlbnQ6IG5ld0NvbnRlbnQgfSk7XHJcbiAgICB9O1xyXG5cclxuICAgIGNvbnN0IG9uQ2hhbmdlQ29sb3IgPSAobmV3Q29sb3IpID0+IHtcclxuICAgICAgc2V0QXR0cmlidXRlcyh7IGNvbG9yOiBuZXdDb2xvciB9KTtcclxuICAgIH07XHJcblxyXG4gICAgcmV0dXJuIChcclxuICAgICAgPD5cclxuICAgICAgICA8SW5zcGVjdG9yQ29udHJvbHM+XHJcbiAgICAgICAgICA8UGFuZWxCb2R5IHRpdGxlPXtfXygnVGV4dCBDb2xvcicsICd2ZGxmJyl9PlxyXG4gICAgICAgICAgICA8Q29sb3JQYWxldHRlIHZhbHVlPXtjb2xvcn0gb25DaGFuZ2U9e29uQ2hhbmdlQ29sb3J9IC8+XHJcbiAgICAgICAgICA8L1BhbmVsQm9keT5cclxuICAgICAgICA8L0luc3BlY3RvckNvbnRyb2xzPlxyXG4gICAgICAgIDxSaWNoVGV4dFxyXG4gICAgICAgICAgdGFnTmFtZT1cInBcIlxyXG4gICAgICAgICAgY2xhc3NOYW1lPXtjbGFzc05hbWV9XHJcbiAgICAgICAgICBvbkNoYW5nZT17b25DaGFuZ2VDb250ZW50fVxyXG4gICAgICAgICAgdmFsdWU9e2NvbnRlbnR9XHJcbiAgICAgICAgICBzdHlsZT17eyBjb2xvcjogY29sb3IgfX1cclxuICAgICAgICAgIHBsYWNlaG9sZGVyPXtfXygnV3JpdGUgeW91ciBjb250ZW50IGhlcmUuLi4nLCAndmRsZicpfVxyXG4gICAgICAgIC8+XHJcbiAgICAgIDwvPlxyXG4gICAgKTtcclxuICB9LFxyXG4gIHNhdmU6IChwcm9wcykgPT4ge1xyXG4gICAgY29uc3Qge1xyXG4gICAgICBhdHRyaWJ1dGVzOiB7IGNvbnRlbnQsIGNvbG9yIH0sXHJcbiAgICB9ID0gcHJvcHM7XHJcblxyXG4gICAgcmV0dXJuIChcclxuICAgICAgPFJpY2hUZXh0LkNvbnRlbnRcclxuICAgICAgICB0YWdOYW1lPVwicFwiXHJcbiAgICAgICAgdmFsdWU9e2NvbnRlbnR9XHJcbiAgICAgICAgc3R5bGU9e3sgY29sb3I6IGNvbG9yIH19XHJcbiAgICAgIC8+XHJcbiAgICApO1xyXG4gIH0sXHJcbn0pOyJdLCJuYW1lcyI6WyJyZWdpc3RlckJsb2NrVHlwZSIsIl9fIiwiUmljaFRleHQiLCJJbnNwZWN0b3JDb250cm9scyIsIkNvbG9yUGFsZXR0ZSIsIlBhbmVsQm9keSIsInRpdGxlIiwiZGVzY3JpcHRpb24iLCJpY29uIiwiY2F0ZWdvcnkiLCJhdHRyaWJ1dGVzIiwiY29udGVudCIsInR5cGUiLCJzb3VyY2UiLCJzZWxlY3RvciIsImNvbG9yIiwiZWRpdCIsInByb3BzIiwiX3Byb3BzJGF0dHJpYnV0ZXMiLCJzZXRBdHRyaWJ1dGVzIiwiY2xhc3NOYW1lIiwib25DaGFuZ2VDb250ZW50IiwibmV3Q29udGVudCIsIm9uQ2hhbmdlQ29sb3IiLCJuZXdDb2xvciIsImNyZWF0ZUVsZW1lbnQiLCJGcmFnbWVudCIsInZhbHVlIiwib25DaGFuZ2UiLCJ0YWdOYW1lIiwic3R5bGUiLCJwbGFjZWhvbGRlciIsInNhdmUiLCJfcHJvcHMkYXR0cmlidXRlczIiLCJDb250ZW50Il0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/scripts/editor.js\n");

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