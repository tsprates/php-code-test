import Vue from 'vue'
import Chakra, { CThemeProvider, CReset } from '@chakra-ui/vue'
import App from './App.vue'
import axios from 'axios'

Vue.config.productionTip = false

// axios
axios.defaults.baseURL = `http://localhost/api/`;
Vue.use(axios)

// Chakra UI
Vue.use(Chakra)

new Vue({
  el: '#app',
  render: (h) => h(CThemeProvider, [h(CReset), h(App)])
}).$mount()
