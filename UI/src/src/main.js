import Vue from 'vue'
import Chakra, { CThemeProvider, CReset } from '@chakra-ui/vue'
import App from './App.vue'
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vuelidate from 'vuelidate'

Vue.config.productionTip = false

// axios
const HOST = process.env.API_HOST || 'localhost';
const PORT = process.env.API_PORT || 80;
axios.defaults.baseURL = `http://${HOST}:${PORT}/api/`;
Vue.use(VueAxios, axios)

// Chakra UI
Vue.use(Chakra)

// Vue validate
Vue.use(Vuelidate)

new Vue({
  el: '#app',
  render: (h) => h(CThemeProvider, [h(CReset), h(App)])
}).$mount()
