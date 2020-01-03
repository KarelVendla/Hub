import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router';

import routes from './routes';
import store from './store';



require('./bootstrap');

window.Vue = require('vue');

Vue.use(Vuex);
Vue.use(VueRouter);

Vue.component('MainComponent', require('./components/App.vue').default);
Vue.component('ChatComponent', require('./components/Chat.vue'));
Vue.component('LoginComponent', require('./components/Login.vue'));
Vue.component('LoginComponent', require('./components/Register.vue'));

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store: new Vuex.Store(store)
});
