import Vue from 'vue'
import App from './App.vue'

// Vuesax Component Framework
import Vuesax from 'vuesax'
import 'material-icons/iconfont/material-icons.css' //Material Icons
import 'vuesax/dist/vuesax.css'; // Vuesax
Vue.use(Vuesax)

import VueEasySession from 'vue-easysession'
Vue.use(VueEasySession.install)

import axios from 'axios';
import VueAxios from 'vue-axios';
 
Vue.use(VueAxios, axios);

//register service worker
import './registerServiceWorker'

// mock
import './fake-db/index.js'

// i18n
import i18n from './i18n/i18n'

// Theme Configurations
import '../themeConfig.js'


// Globally Registered Components
import './globalComponents.js'


// Styles: SCSS
import './assets/scss/main.scss'


// Tailwind
import '@/assets/css/main.css'


// Vue Router
import router from './router'


// Vuex Store
import store from './store/store'


// Vuejs - Vue wrapper for hammerjs
import { VueHammer } from 'vue2-hammer'
Vue.use(VueHammer)

// VeeValidate
import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

// Tour
import VueTour from 'vue-tour'
Vue.use(VueTour)
require('vue-tour/dist/vue-tour.css')

// PrismJS
import 'prismjs'
import 'prismjs/themes/prism-tomorrow.css'


// Feather font icon
require('./assets/css/iconfont.css')

//fontawesome-free
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'


// Vue select css
// Note: In latest version you have to add it separately
 import 'vue-select/dist/vue-select.css';

 // Vuexy Admin Filters
import './filters/filters'

import 'froala-editor/js/plugins.pkgd.min.js';
//Import third party plugins
import 'froala-editor/js/third_party/embedly.min';
import 'froala-editor/js/third_party/font_awesome.min';
import 'froala-editor/js/third_party/spell_checker.min';
import 'froala-editor/js/third_party/image_tui.min';
// Import Froala Editor css files.
import 'froala-editor/css/froala_editor.pkgd.min.css';

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)

import CKEditor from 'ckeditor4-vue';
Vue.use( CKEditor );

import VueClipboard from 'vue-clipboard2' 
Vue.use(VueClipboard)

import tinymce from 'vue-tinymce-editor'
Vue.component('tinymce', tinymce)

import VueGoogleCharts from 'vue-google-charts' 
Vue.use(VueGoogleCharts)
import VueCardFormat from 'vue-credit-card-validation';
Vue.use(VueCardFormat);

Vue.config.productionTip = false

new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#app')
