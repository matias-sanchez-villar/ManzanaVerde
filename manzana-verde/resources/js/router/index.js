import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue"
import welcome from "../views/welcome.vue"
import Login from "../views/Login.vue"
import Register from "../views/Register.vue"
import Foods from "../views/Foods.vue"
import Orders from "../views/Orders.vue"
import NotFound from "../views/NotFound.vue"

const guest = (to, from, next) => {
    if (!localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/");
    }
};
const auth = (to, from, next) => {
    if (localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/");
    }
};

const routes = [
    {
        path: "/",
        name: "Home",
        beforeEnter: guest,
        component: Home
    },
    {
        path: "/welcome",
        name: "welcome",
        beforeEnter: auth,
        component: welcome
    },
    {
        path: "/login",
        name: "Login",
        beforeEnter: guest,
        component: Login
    },
    {
        path: "/register",
        name: "Register",
        beforeEnter: guest,
        component: Register
    },
    {
        path: "/foods",
        name: "Foods",
        beforeEnter: auth,
        component: Foods
    },
    {
        path: "/orders",
        name: "Orders",
        beforeEnter: auth,
        component: Orders
    },
    { 
        path: '/:patchMatch(.*)*', 
        name: "NotFound",
        component: NotFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;