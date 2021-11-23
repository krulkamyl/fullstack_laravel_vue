require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating"
import FatalError from "./shared/components/FatalError"
import Success from "./shared/components/Success"
import ValidationErrors from "./shared/components/ValidationErrors"

window.axios.defaults.headers.common = {'Accept': 'application/json'}
window.axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://127.0.0.1:8000/api' : ''

window.Vue = require('vue').default;

// Vue.component(
//     'ExampleComponent', 
//     require('./components/ExampleComponent.vue').default
// );


Vue.use(VueRouter);

Vue.component("StarRating", StarRating);
Vue.component("FatalError", FatalError);
Vue.component("Success", Success);
Vue.component("v-errors", ValidationErrors);

Vue.filter("fromNow", (value) => {
    return moment(value).fromNow();
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }
});
