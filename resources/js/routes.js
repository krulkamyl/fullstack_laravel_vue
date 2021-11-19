import VueRouter from "vue-router"
import Bookables from "./bookables/Bookables.vue"
import SecondComponent from "./components/SecondComponent"

const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home"
    },
    {
        path: "/second",
        component: SecondComponent,
        name: "second"
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;