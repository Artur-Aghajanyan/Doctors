require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import  VueRouter from "vue-router";


Vue.use(VueRouter);
import App from './components/App'
const app = new Vue({
    el: '#app',
    render:h => h(App),
    router
});
