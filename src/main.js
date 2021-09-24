import Vue from 'vue'
import App from './App.vue'
import VueScrollReveal from 'vue-scroll-reveal';
import Axios from 'axios'
import Toasted from 'vue-toasted'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'

Vue.config.productionTip = false

Vue.use(Toasted, {
  duration: 3000
})

Vue.use(VueLodash, { lodash: lodash })

Vue.use(VueScrollReveal, {
  class: 'v-scroll-reveal', // A CSS class applied to elements with the v-scroll-reveal directive; useful for animation overrides.
  duration: 800,
  scale: 1,
  distance: '5px'
});

Vue.prototype.$axios = Axios;

new Vue({
  render: h => h(App),
}).$mount('#app')
