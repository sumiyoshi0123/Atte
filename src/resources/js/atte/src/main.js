import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router';


const token = localStorage.getItem("token");
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
createApp(App)
.use(router)
.mount('#app')

