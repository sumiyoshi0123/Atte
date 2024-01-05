import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router';

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const token = localStorage.getItem("token");
axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

const vuetify = createVuetify({
    components,
    directives,
})

createApp(App)
.use(router)
.use(vuetify)
.mount('#app')

