
import Vue from 'vue';

//Componentes de terceros
import VueGoodTablePlugin from 'vue-good-table';
import Toast from "vue-toastification";
import VueMaterial from 'vue-material'

//Dependencias de estilo de componentes de terceros
import "vue-toastification/dist/index.css"
import 'vue-good-table/dist/vue-good-table.css'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

require('./bootstrap');

window.Vue = require('vue').default;


//Registramos nuestros componentes de VUE
require('./components');


//Vue Uses
Vue.use(VueGoodTablePlugin);
Vue.use(Toast, { position: "bottom-right" });
Vue.use(VueMaterial);


// Lanzmos nueva instancia de Vue
const app = new Vue({
    el: '#app',
});
