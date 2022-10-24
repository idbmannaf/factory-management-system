//sr router
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import AgentHome from './components/mobile/pages/dashboard/Home'
import AgentProjects from './components/mobile/pages/project/ProjectList'
import EcommerceHome from './components/mobile/ecommerce/pages/Home'
// import EcommerceCreateProduct from './components/mobile/ecommerce/pages/product/create/CreateProduct'
// import EcommerceCreateProductDetails from './components/mobile/ecommerce/pages/product/create/CreateProductDetails'
// import EcommerceCreateProductCategory from './components/mobile/ecommerce/pages/product/create/CreateProductCategory'
// import EcommerceCreateProductOwner from './components/mobile/ecommerce/pages/product/create/CreateProductOwner'
// import EcommerceEditProduct from './components/mobile/ecommerce/pages/product/EditProduct'
import EcommerceProductList from './components/mobile/ecommerce/pages/product/ProductList'
import EcommerceIncomingOrdertList from './components/mobile/ecommerce/pages/product/order/OrderList'
import EcoShipmentReturnList from './components/mobile/ecommerce/pages/return/ReturnList'
import EcoShipmentReturnDetails from './components/mobile/ecommerce/pages/return/ReturnDetails'
import EcomIncomingOrderManage from './components/mobile/ecommerce/pages/product/order/manage/OrderItemManage.vue'
import EcommerceCreateOrder from './components/mobile/ecommerce/pages/order/CreateOrder'
import EcommerceOrderList from './components/mobile/ecommerce/pages/order/OrderList'
import EcomOrderDetails from './components/mobile/ecommerce/pages/order/OrderDetails'
import OrderShipmentReturn from './components/mobile/ecommerce/pages/order/shipment/ShipmentReturn'
import EcomPaymentCollectionCreate from './components/mobile/ecommerce/pages/collection/NewCollection'
import EcomPaymentCollectionList from './components/mobile/ecommerce/pages/collection/CollectionList'
import AgentSalaryStatement from './components/mobile/ecommerce/pages/salary/SalaryList'
import EcomSourceCreate from './components/mobile/ecommerce/pages/source/SourceCreate'
import EcomSourceList from './components/mobile/ecommerce/pages/source/SourceList'
import EcomUserCreate from './components/mobile/ecommerce/pages/user/UserCreate'
import EcomUserList from './components/mobile/ecommerce/pages/user/UserList'
import EcommerceSettings from './components/mobile/ecommerce/pages/settings/EcommerceSettings'
import AgentLogin from './components/mobile/ecommerce/pages/Login'

const routes = [
    //sr routes
    {
        name: 'agent.home',
        path: '/sr',
        component: AgentHome,
    },
    {
        name: 'agent.projects',
        path: '/sr/:agent',
        component: EcommerceHome,
        props: true,
    },
    {
        name: 'agent.ecommerce.home',
        path: '/sr/:agent/',
        component: EcommerceHome,
        props: true,
    },
    // {
    //     name: 'agent.ecommerce.product.create',
    //     path: '/sr/:agent/ecommerce/product/create',
    //     component: EcommerceCreateProduct,
    //     props: true,
    // },
    // {
    //     name: 'agent.ecom.product.create.details',
    //     path: '/sr/:agent/ecommerce/product/details',
    //     component: EcommerceCreateProductDetails,
    //     props: true,
    // },
    // {
    //     name: 'agent.ecom.product.create.category',
    //     path: '/sr/:agent/ecommerce/product/category',
    //     component: EcommerceCreateProductCategory,
    //     props: true,
    // },
    // {
    //     name: 'agent.ecom.product.create.owner',
    //     path: '/sr/:agent/ecommerce/product/owner',
    //     component: EcommerceCreateProductOwner,
    //     props: true,
    // },
    // {
    //     name: 'agent.ecom.product.edit',
    //     path: '/sr/:agent/ecommerce/product/:product/edit',
    //     component: EcommerceEditProduct,
    //     props: true,
    // },
    {
        name: 'agent.ecommerce.product.list',
        path: '/sr/:agent/product/all',
        component: EcommerceProductList,
        props: true,
    },
    {
        name: 'agent.ecom.incoming.order.list',
        path: '/sr/:agent/product/orders',
        component: EcommerceIncomingOrdertList,
        props: true,
    },
    {
        name: 'agent.ecom.return.list',
        path: '/sr/:agent/shipment/returns',
        component: EcoShipmentReturnList,
        props: true,
    },
    {
        name: 'agent.ecom.return.details',
        path: '/sr/:agent/shipment/return/:returnId',
        component: EcoShipmentReturnDetails,
        props: true,
    },
    {
        name: 'agent.ecom.incoming.order.manage',
        path: '/sr/:agent/product/order/:order',
        component: EcomIncomingOrderManage,
        props: true,
    },
    {
        name: 'agent.ecommerce.order.create',
        path: '/sr/:agent/order/create/:shop?',
        component: EcommerceCreateOrder,
        props: true,
    },
    {
        name: 'agent.ecommerce.order.list',
        path: '/sr/:agent/order/all',
        component: EcommerceOrderList,
        props: true,
    },
    {
        name: 'agent.ecom.order.details',
        path: '/sr/:agent/order/:orderId/details',
        component: EcomOrderDetails,
        props: true,
    },
    {
        name: 'agent.ecom.order.shipment.return',
        path: '/sr/:agent/order/:orderId/shipment/:shipmentId/return',
        component: OrderShipmentReturn,
        props: true,
    },
    {
        name: 'agent.ecom.collection.create',
        path: '/sr/:agent/shop/:shopId/collection/create',
        component: EcomPaymentCollectionCreate,
        props: true,
    },
    {
        name: 'agent.ecom.collection.list',
        path: '/sr/:agent/collection',
        component: EcomPaymentCollectionList,
        props: true,
    },
    {
        name: 'agent.ecom.salary.list',
        path: '/sr/:agent/my-salary',
        component: AgentSalaryStatement,
        props: true,
    },
    {
        name: 'agent.ecom.user.create',
        path: '/sr/:agent/user/create',
        component: EcomUserCreate,
        props: true,
    },
    {
        name: 'agent.ecom.user.list',
        path: '/sr/:agent/user',
        component: EcomUserList,
        props: true,
    },
    {
        name: 'agent.ecom.source.create',
        path: '/sr/:agent/shop/create',
        component: EcomSourceCreate,
        props: true,
    },
    {
        name: 'agent.ecom.source.list',
        path: '/sr/:agent/shops',
        component: EcomSourceList,
        props: true,

    },
    {
        name: 'agent.ecommerce.settings',
        path: '/sr/:agent/settings',
        component: EcommerceSettings,
        props: true,
    },
    {
        name: 'agent.login',
        path: '/login',
        component: AgentLogin,
    },

]

export default new Router({
    mode: 'history',
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})
