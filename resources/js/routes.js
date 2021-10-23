import ProductIndex from './components/products/index.vue';
import ProductCreate from './components/products/create.vue';
import ProductEdit from './components/products/edit.vue';
import AboutUs from './components/AboutusComponent'
import Welcome from './components/welcomeComponent'

export const routes = [
    {
        path: '/products',
        component: ProductIndex,
        name: "ProductIndex"
    },
    {
        path: '/products/create',
        component: ProductCreate,
        name: "ProductCreate"
    },
    {
        path: '/products/edit/:id',
        component: ProductEdit,
        name: "ProductEdit"
    },
    {
        path: '/AboutUs',
        component: AboutUs,
        name: 'AboutUs'
    },
    {
        path: '/',
        component: Welcome,
        name:'welcome'
    }
];
