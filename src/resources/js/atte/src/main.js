import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'


const token = "1|ltOxtxqHjGRtTmXBevB4e5TyVRsaopIZi3BuB2Hy";
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
createApp(App).mount('#app')
