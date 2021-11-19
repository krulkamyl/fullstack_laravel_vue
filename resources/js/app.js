require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index.vue";


window.axios.defaults.headers.common = {'Accept': 'application/json'}
window.axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://127.0.0.1:8000/api' : ''

window.Vue = require('vue').default;

// Vue.component(
//     'ExampleComponent', 
//     require('./components/ExampleComponent.vue').default
// );


Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }
});
