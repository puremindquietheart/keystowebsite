import Vue from 'vue';
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import CKEditor from '@ckeditor/ckeditor5-vue'

Vue.use(VueRouter)
Vue.use(CKEditor)
Vue.use(VueAxios, axios)

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
            path: '/keysto-add-product',
            component: AddProduct,
        },
        {
            path: '/keysto-product-list',
            component: ProductList,
        },
    ],
});

new Vue({
    el: '#app',
    router
});
