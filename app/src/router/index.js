import { createRouter, createWebHistory  } from 'vue-router';
import Home from '../views/Home.vue';
import PostDetail from '../views/PostDEtail.vue';
import Login from '../views/Login.vue';
import AdminDashboard from '../views/AdminDashboard.vue';

const routes = [
{
    path : '/',
    name: 'Home',
    component: Home,
},
{
    path: 'post/:slug',
    name: 'PostDetail',
    component: PostDetail,
    props: true,
},
{
    path: '/login',
    name: 'Login',
    component: Login,
},
{
    path: 'admin',
    name: 'AdminDashboard',
    component: AdminDashboard,
    beforeEnter: (to, from, next) => {
        if (!localStorage.getItem('token')) {
        } else {
            next();
        }
    },
},
];

const router = createRouter({
    history:createWebHistory(),
    routes,
});

export default router;