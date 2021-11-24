require('./bootstrap');

import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import router from "./routes";
import moment from "moment";

import storeDefinition from "./store"

import Index from "./Index";

import StarRating from "./shared/components/StarRating"
import FatalError from "./shared/components/FatalError"
import Success from "./shared/components/Success"
import ValidationErrors from "./shared/components/ValidationErrors"

window.axios.defaults.headers.common = {'Accept': 'application/json'}
window.axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://127.0.0.1:8000/api' : ''

window.Vue = require('vue').default;


Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component("StarRating", StarRating);
Vue.component("FatalError", FatalError);
Vue.component("Success", Success);
Vue.component("v-errors", ValidationErrors);


const store = new Vuex.Store(storeDefinition);

Vue.filter("fromNow", (value) => {
    return moment(value).fromNow();
});

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        "index": Index
    },
    beforeCreate() {
        this.$store.dispatch('loadStoredState');
    }
});
