import Vue from 'vue';
import VueRouter from "vue-router";

// Auth
import RegisterComponent from "./components/Auth/RegisterComponent";
import LoginComponent from "./components/Auth/LoginComponent";

// Products
import ProductDetailComponent from "./components/ProductDetailComponent";
import ProductsComponent from "./components/ProductsComponent";

//Cart
import CartComponent from "./components/CartComponent";

//Order
import OrderComponent from "./components/OrderComponent";

Vue.use(VueRouter);

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
        return next("/login");
    }
};

const routes = new VueRouter({
    routes: [
        {
            path:'/product/:id',
            name: 'product.detail',
            component:ProductDetailComponent
        },
        {
            path: '/shoppingCart',
            component: CartComponent
        },
        {
            path: '/',
            name: 'Home',
            component: ProductsComponent
        },
        {
            path: "/login",
            name: "Login",
            beforeEnter: guest,
            component: LoginComponent
        },
        {
            path: "/register",
            name: "Register",
            beforeEnter: guest,
            component: RegisterComponent
        },
        {
            path: "/orderOverview",
            name: "OrderOverview",
            beforeEnter: auth,
            component: OrderComponent
        }
        // {
        //     path: "/placeOrder",
        //     name: 'placeOrder',
        //     beforeEnter: auth,
        //     component: OrderComponent
        // }
    ]
});

export default routes

