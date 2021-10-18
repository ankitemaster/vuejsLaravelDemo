import VueRouter from 'vue-router';

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        meta: {
            auth: true
        },
        component: () => import('./../components/DashboardComponent')
    },
    {
        path: '/profile',
        name: 'profile',
        meta: {
            auth: true
        },
        component: () => import('./../components/ProfileComponent')
    },
    {
        path: '/role-and-permission',
        name: 'role-and-permission',
        meta: {
            auth: true
        },
        component: () => import('./../components/RoleAndPermission')
    },
    {
        path: '/users/edit/:id',
        name: 'users-edit',
        meta: {
            auth: true
        },
        component: () => import('./../components/EditUserComponent')
    },
];

const router = new VueRouter({
    base: 'admin',
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        window.location.href = '/login';
      return
    }
    next()
});

export default router;
