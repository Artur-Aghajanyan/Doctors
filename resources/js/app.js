require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import  VueEouter from "vue-router";


Vue.use(VueEouter);
import App from './components/App'
const app = new Vue({
    el: '#app',
    render:h => h(App),
    router
});
