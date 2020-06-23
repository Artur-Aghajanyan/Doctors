window.Vue = require('vue');
import VueRouter from "vue-router";
import Signup from "./components/Signup";

Vue.use(VueRouter)

export default new VueRouter({
    routes:[
        {path: '/signup', component: Signup},
    ],
    mode: 'history'
})
//
// export default new Vue({
//     el: '#app',
//     router: router
// })
