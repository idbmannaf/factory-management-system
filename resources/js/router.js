// Customer router
import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

import ecommerceHome from "./components/mobile/ecommerce/pages/Home";
import ecommerceCart from "./components/mobile/ecommerce/pages/cart/Cart";
import ecommerceCategories from "./components/mobile/ecommerce/pages/category/Categories";
import ecomSubCategories from "./components/mobile/ecommerce/pages/category/SubCategories";
import ecommerceCustomerProfile from "./components/mobile/ecommerce/pages/profile/CustomerProfile";
import ecommerceCustomerProfileEdit from "./components/mobile/ecommerce/pages/profile/CustomerProfileEdit";
import ecommerceCustomerCheckoutStepFirst from "./components/mobile/ecommerce/pages/checkout/StepFirst";
import ecommerceCustomerCheckoutStepSecond from "./components/mobile/ecommerce/pages/checkout/StepSecond";
import ecommerceCustomerCheckoutStepThird from "./components/mobile/ecommerce/pages/checkout/StepThird";
import ecommerceCustomerCheckoutSuccessful from "./components/mobile/ecommerce/pages/checkout/OrderSuccessful";
import ecommerceCustomerPaymentSuccessful from "./components/mobile/ecommerce/pages/checkout/PaymentSuccessful";
import ecomCustomerMyOrders from "./components/mobile/ecommerce/pages/order/OrderList";
import ecomCustomerMyOrderDetails from "./components/mobile/ecommerce/pages/order/OrderDetails";
import ecommerceShop from "./components/mobile/ecommerce/pages/shop/ProductShop";
import productDetails from "./components/mobile/ecommerce/pages/product/ProductDetails";
import profileSettings from "./components/mobile/ecommerce/pages/profile/ProfileSettings";
import CreateSellerShop from "./components/mobile/ecommerce/pages/sellershop/CreateSellerShop";
import CreateSellerShopCategory from "./components/mobile/ecommerce/pages/sellershop/CreateSellerShopCategory";
import CreateSellerShopLogo from "./components/mobile/ecommerce/pages/sellershop/CreateSellerShopLogo";
import CreateSellerShopSuccess from "./components/mobile/ecommerce/pages/sellershop/CreateSellerShopSuccess";

const routes = [
    //ecommerce routes
    {
        name: "ecommerce.home",
        path: "/",
        component: ecommerceHome
    },
    {
        name: "ecommerce.categories",
        path: "/categories",
        component: ecommerceCategories
    },
    {
        name: "ecom.subcategories",
        path: "/category/:category",
        component: ecomSubCategories,
        props: true,
    },
    {
        name: "ecommerce.carts",
        path: "/cart",
        component: ecommerceCart
    },
    {
        name: "ecommerce.profile",
        path: "/profile",
        component: ecommerceCustomerProfile
    },
    {
        name: "ecommerce.myOrders",
        path: "/my-orders",
        component: ecomCustomerMyOrders
    },
    {
        name: "ecom.myOrder.details",
        path: "/my-order/:orderId",
        component: ecomCustomerMyOrderDetails,
        props: true
    },
    {
        name: "ecommerce.profile.edit",
        path: "/profile/edit",
        component: ecommerceCustomerProfileEdit
    },
    {
        name: "customer.checkout.step.first",
        path: "/cart/checkout/order/delivery-address",
        component: ecommerceCustomerCheckoutStepFirst
    },
    {
        name: "customer.checkout.step.second",
        path: "/cart/checkout/order/payment-method",
        component: ecommerceCustomerCheckoutStepSecond
    },
    {
        name: "customer.checkout.step.third",
        path: "/cart/checkout/order/payment",
        component: ecommerceCustomerCheckoutStepThird,
        props: true,
    },
    {
        name: "customer.checkout.successful",
        path: "/cart/checkout/successful",
        component: ecommerceCustomerCheckoutSuccessful,
        props: true,
    },
    {
        name: "customer.payment.successful",
        path: "/cart/payment/successful",
        component: ecommerceCustomerPaymentSuccessful,
        props: true,
    },
    {
        name: "ecommerce.shop",
        path: "/shop",
        component: ecommerceShop
    },
    {
        name: "ecommerce.product",
        path: "/product/:productId-:productSlug?",
        component: productDetails,
        props: true
    },
    {
        name: "ecommerce.profile.settings",
        path: "/profile/settings",
        component: profileSettings
    },
    {
        name: "ecommerce.sellershop.create",
        path: "/mysellershop/create",
        component: CreateSellerShop
    },
    {
        name: "ecommerce.sellershop.create.category",
        path: "/mysellershop/create/category",
        component: CreateSellerShopCategory
    },
    {
        name: "ecommerce.sellershop.create.logo",
        path: "/mysellershop/create/logo",
        component: CreateSellerShopLogo
    },
    {
        name: "ecommerce.sellershop.create.success",
        path: "/mysellershop/create/success",
        component: CreateSellerShopSuccess
    }
];

export default new Router({
    mode: "history",
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { x: 0, y: 0 };
    }
});
