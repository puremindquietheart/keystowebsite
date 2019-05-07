import Vue from 'vue';
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import CKEditor from '@ckeditor/ckeditor5-vue'
import VueNumeric from 'vue-numeric'
import VueSweetalert2 from 'vue-sweetalert2';
 
// use imported vue file

Vue.use(VueSweetalert2);
Vue.use(VueNumeric)
Vue.use(VueRouter)
Vue.use(CKEditor)
Vue.use(VueAxios, axios)

// views
Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 2
    });
    return formatter.format(value);
});

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
