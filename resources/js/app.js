import VueRouter from 'vue-router';
import App from './App.vue';
import router from './Route/index';
import store from './Store/index';
import Toasted from 'vue-toasted';
import VueFileAgent from 'vue-file-agent';

import BootstrapVue from 'bootstrap-vue';
import Vue from 'vue';
import axios from 'axios';

import excel from 'vue-excel-export'

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
Vue.use(excel);
Vue.use(VueFileAgent);


// var mixin = Vue.mixin("can", (permissionName) => {
//     axios.get('/api/users/permission/'+permissionName).then((response) => {
//         console.log(response.data);
//         return response.data;
//     })
// });

Vue.mixin({
    methods: {
        can(permissionName) {
            axios.get('/api/users/permission/' + permissionName).then((response) => {
                return response.data;
            });
        }
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: { App }
});
