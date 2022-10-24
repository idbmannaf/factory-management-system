/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./../bootstrap');

window.Vue = require('vue').default;

import router from './router'
import store from './store'
import VueGeolocation from 'vue-browser-geolocation';
//importing filters
import Slug from './../filters/slug';
import Date from './../filters/date';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import vSelect from 'vue-select'

Vue.filter('slug', Slug)
Vue.filter('date', Date)
Vue.use(VueGeolocation);
Vue.use(VueSweetalert2);
Vue.component('v-select', vSelect)
    /**
     * The following block of code may be used to automatically register your
     * Vue components. It will recursively scan this directory for the Vue
     * components and automatically register them with their "basename".
     *
     * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
     */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// agent components
Vue.component('agent-app', require('./components/mobile/pages/Index.vue').default);
Vue.component('agentship-item', require('./components/mobile/pages/dashboard/AgentItem.vue').default);
Vue.component('agent-project-item', require('./components/mobile/pages/project/ProjectItem.vue').default);
Vue.component('agent-ecommerce-app', require('./components/mobile/ecommerce/Index.vue').default);
Vue.component('agent-sidebar-left', require('./components/mobile/includes/SidebarLeft.vue').default);
Vue.component('agent-ecommerce-sidebar-left', require('./components/mobile/ecommerce/includes/SidebarLeft.vue').default);
Vue.component('agent-header-top', require('./components/mobile/includes/HeaderTop.vue').default);
Vue.component('agent-ecommerce-header-top', require('./components/mobile/ecommerce/includes/HeaderTop.vue').default);
Vue.component('bottom-back-bottom', require('./../components/mobile/ecommerce/includes/BottomBackButton.vue').default);

Vue.component('order-shipment', require('./components/mobile/ecommerce/pages/order/shipment/ShipmentList.vue').default);
Vue.component('order-shipment-item', require('./components/mobile/ecommerce/pages/order/shipment/ShipmentListItem.vue').default);

Vue.component('select-user', require('./components/mobile/pages/user/SelectUser.vue').default);
Vue.component('new-user-form', require('./components/mobile/pages/user/NewUserForm.vue').default);
Vue.component('ecommerce-product-list-item', require('./components/mobile/ecommerce/pages/product/ProductListItem.vue').default);
Vue.component('ecom-incoming-order-list-item', require('./components/mobile/ecommerce/pages/product/order/OrderListItem.vue').default);
Vue.component('ecommerce-order-list-item', require('./components/mobile/ecommerce/pages/order/OrderListItem.vue').default);
Vue.component('ecom-order-create-products', require('./components/mobile/ecommerce/pages/order/product/ProductList.vue').default);
Vue.component('ecom-order-create-product-item', require('./components/mobile/ecommerce/pages/order/product/ProductListItem.vue').default);
Vue.component('ecom-order-selected-products', require('./components/mobile/ecommerce/pages/order/product/SelectedProducts.vue').default);
Vue.component('ecom-order-selected-product-item', require('./components/mobile/ecommerce/pages/order/product/SelectedProductItem.vue').default);
// Vue.component('ecom-product-create-details', require('./components/mobile/ecommerce/pages/product/create/CreateProductDetails.vue').default);
// Vue.component('ecom-product-create-category', require('./components/mobile/ecommerce/pages/product/create/CreateProductCategory.vue').default);
// Vue.component('ecom-product-create-owner', require('./components/mobile/ecommerce/pages/product/create/CreateProductOwner.vue').default);
Vue.component('ecom-product-create-source', require('./components/mobile/ecommerce/pages/product/create/CreateNewSource.vue').default);
Vue.component('sales-list', require('./components/mobile/ecommerce/pages/order/product/SalesList.vue').default)
Vue.component('user-list-item', require('./components/mobile/ecommerce/pages/user/UserListItem.vue').default)
Vue.component('source-list-item', require('./components/mobile/ecommerce/pages/source/SourceListItem.vue').default)
Vue.component('select-source', require('./components/mobile/ecommerce/pages/source/SelectSource.vue').default)



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
});