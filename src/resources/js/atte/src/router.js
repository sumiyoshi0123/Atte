import { createRouter, createWebHashHistory } from 'vue-router';
import Login from './components/Login';
import Attendance from './components/Attendance';

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

export default router;