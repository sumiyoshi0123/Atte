import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router';


const token = "1|ltOxtxqHjGRtTmXBevB4e5TyVRsaopIZi3BuB2Hy";
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
createApp(App)
    .use(router)
    .mount('#app')

