window.Vue = require('vue');
import VueRouter from "vue-router";
import Signup from "./components/Signup";
import Login from "./components/Login";
import DoctorPage from "./components/DoctorPage";

Vue.use(VueRouter)

export default new VueRouter({
    routes:[
        {path: '/signup', component: Signup},
        {path: '/login', component: Login},
        {path: '/user', component: DoctorPage},
    ],
    mode: 'history'
})
//
// export default new Vue({
//     el: '#app',
//     router: router
// })
