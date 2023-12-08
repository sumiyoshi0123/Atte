import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'


const token = "3|OfnPEfpiWjLA46k7zgpmtXqKxqDTsfF5dumiWNRW";
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
createApp(App).mount('#app')
