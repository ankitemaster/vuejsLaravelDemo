import VueRouter from 'vue-router';
import App from './App.vue';
import router from './Route/index';
import store from './Store/index';
import Toasted from 'vue-toasted';

import BootstrapVue from 'bootstrap-vue';
import Vue from 'vue';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('add-user-component', require('./components/AddUserComponent.vue').default);

Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Toasted, {
    duration: 1500
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App }
});
