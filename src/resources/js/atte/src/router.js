import { createRouter, createWebHashHistory } from 'vue-router';
import Login from './components/Login.vue';
import Attendance from './components/Attendance.vue';

const routes = [
    {
        path: "/",
        name: "attendance",
        component: Attendance
    },
    {
        path: "/login",
        name: "login",
        component: Login
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem("token");

    if (to.name != 'login' && !isAuthenticated) {
        next({ name: "login" });
        return;
    }

    if (to.name == 'login' && isAuthenticated) {
        next({ name: "attendance" });
        return;
    }

    next();
})
export default router;