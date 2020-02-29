require('./bootstrap');

window.Vue=require('vue');
import VueRouter from "vue-router";
window.Vue.use(VueRouter);
import App from './components/App'

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import Home from './components/indexComponent';
import Suppliers from './components/SuppliersComponent';
import Products from './components/ProductsComponent';
import Orders from './components/OrdersComponent';
import Supplier from './components/SupplierComponent';
import Order from './components/OrderComponent';
import Login from  './components/AuthLoginComponent';
const router = new VueRouter({
   routes:[
       {path:'/',component:Home},
       {path:'/suppliers',component:Suppliers},
       {path:'/products',component:Products},
       {path:'/orders',component:Orders},
       {path:'/supplier/:id',component:Supplier},
       {path:'/order/:id',component:Order},
       {path:'/auth/login',component:Login},
   ]
});

var app=new Vue(
    Vue.util.extend(
        { router },
        App
    )
).$mount('#app');
