require('./bootstrap');
import Vue from 'vue';
window.axios = require('axios');
import mixins from './mixins';
import SvgVue from 'svg-vue';
import api from '../../api/index.js';
import vSelect from 'vue-select';
import vmodal from 'vue-js-modal';
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect);

import { ITSHelpers } from './utils/ITSUtilities';
import VueSocialSharing from 'vue-social-sharing'

Vue.use(VueSocialSharing);
Vue.prototype.$api = api;
Vue.prototype.$settings = SETTINGS;
Vue.prototype.$images = SETTINGS.images;
Vue.config.productionTip = false;
Vue.use(SvgVue);
Vue.use(vmodal);
Vue.mixin(mixins);

const files = require.context('./', true, /\.vue$/i);
files.keys().map((key) =>
	Vue.component(
		key
			.split('/')
			.pop()
			.split('.')[0],
		files(key).default
	)
);

new Vue({
	el: '#app',
	beforeCreate() {
		ITSHelpers.vueFixWpPlugins(document.querySelector('#app'));
	},

	mounted() {
		document.querySelector('#app').classList.remove('invisible');
		ITSHelpers.forceExternalLinks();
	},
});
