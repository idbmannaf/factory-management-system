//dealer router
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import DealerHome from './components/mobile/pages/dashboard/Home'
import AgentNew from './components/mobile/pages/agent/AgentNew'
import AgentList from './components/mobile/pages/agent/AgentList'
import AgentDetails from './components/mobile/pages/agent/AgentDetails'
import AgentEdit from './components/mobile/pages/agent/AgentEdit'
import MarketNew from './components/mobile/pages/market/MarketNew'
import MarketList from './components/mobile/pages/market/MarketList'
import MarketDetails from './components/mobile/pages/market/MarketDetails'
import MarketEdit from './components/mobile/pages/market/MarketEdit'
import EcommerceHome from './components/mobile/ecommerce/pages/Home'
import EcommerceCreateProduct from './components/mobile/ecommerce/pages/product/CreateProduct'
import EcommerceProductList from './components/mobile/ecommerce/pages/product/ProductList'
import EcommerceIncomingOrdertList from './components/mobile/ecommerce/pages/product/order/OrderList'
import EcomIncomingOrderManage from './components/mobile/ecommerce/pages/product/order/manage/OrderItemManage.vue'
import EcommerceCreateOrder from './components/mobile/ecommerce/pages/order/CreateOrder'
import EcommerceOrderList from './components/mobile/ecommerce/pages/order/OrderList'
import EcomOrderDetails from './components/mobile/ecommerce/pages/order/OrderDetails'
import EcommerceSettings from './components/mobile/ecommerce/pages/settings/EcommerceSettings'



const routes = [
    //dealer routes
    {
        name: 'dealer.home',
        path: '/dealer',
        component: DealerHome,
    },
    {
        name: 'dealer.agents',
        path: '/dealer/agents',
        component: AgentList,
    },
    {
        name: 'dealer.agent.add',
        path: '/dealer/agent/add',
        component: AgentNew,
    },
    {
        name: 'dealer.agent.details',
        path: '/dealer/agent/:agent',
        component: AgentDetails,
        props: true,
    },
    {
        name: 'dealer.agent.edit',
        path: '/dealer/agent/:agent/edit',
        component: AgentEdit,
        props: true,
    },
    {
        name: 'dealer.markets',
        path: '/dealer/markets',
        component: MarketList,
    },
    {
        name: 'dealer.market.add',
        path: '/dealer/market/add',
        component: MarketNew,
    },
    {
        name: 'dealer.market.details',
        path: '/dealer/market/:market',
        component: MarketDetails,
        props: true,
    },
    {
        name: 'dealer.market.edit',
        path: '/dealer/market/:market/edit',
        component: MarketEdit,
        props: true,
    },
    {
        name: 'dealer.ecommerce.home',
        path: '/dealer/ecommerce',
        component: EcommerceHome,
    },
    {
        name: 'dealer.ecommerce.product.create',
        path: '/dealer/ecommerce/product/create',
        component: EcommerceCreateProduct,
    },
    {
        name: 'dealer.ecommerce.product.list',
        path: '/dealer/ecommerce/product/all',
        component: EcommerceProductList,
    },
    {
        name: 'dealer.ecom.incoming.order.list',
        path: '/dealer/ecommerce/product/orders',
        component: EcommerceIncomingOrdertList,
    },
    {
        name: 'dealer.ecom.incoming.order.manage',
        path: '/dealer/ecommerce/product/order/:order',
        component: EcomIncomingOrderManage,
        props: true,
    },
    {
        name: 'dealer.ecommerce.order.create',
        path: '/dealer/ecommerce/order/create',
        component: EcommerceCreateOrder,
    },
    {
        name: 'dealer.ecommerce.order.list',
        path: '/dealer/ecommerce/order/all',
        component: EcommerceOrderList,
    },
    {
        name: 'dealer.ecom.order.details',
        path: '/dealer/ecommerce/order/:order',
        component: EcomOrderDetails,
        props: true,
    },
    {
        name: 'dealer.ecommerce.settings',
        path: '/dealer/ecommerce/settings',
        component: EcommerceSettings,
    },
]

export default new Router({
    mode: 'history',
    routes
})