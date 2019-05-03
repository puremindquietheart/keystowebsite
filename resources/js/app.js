import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Main from './views/Main'
import AddProduct from './views/AddProduct'
import ProductList from './views/ProductList'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/keysto-admin-dashboard',
            component: Main
        },
        {
            path: '/keysto-admin-dashboard/add-product',
            component: AddProduct,
        },
        {
            path: '/keysto-admin-dashboard/product-list',
            component: ProductList,
        },
    ],
});

new Vue({
    el: '#app',
    router
});
