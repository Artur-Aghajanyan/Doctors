import Vue from "vue";

window.Vue = require('vue');
import VueRouter from "vue-router";
import Signup from "./components/Signup";
import Login from "./components/Login";
import DoctorPage from "./components/DoctorPage";
import Navbar from "./components/Navbar";
import Contact from "./components/Contact";
import About from "./components/About";
import Home from "./components/Home";
Vue.use(VueRouter)

export default new VueRouter({
    routes:[
        {path: '/signup', component: Signup},
        {path: '/login', name: 'login',component: Login},
        {path: '/user', name: 'user',component: DoctorPage},
        {path: '/navbar', component: Navbar},
        {path: '/contact', component: Contact},
        {path: '/about', component: About},
        {path: '/', component: Home},
    ],
    mode: 'history'
})

//
// export default new Vue({
//     el: '#app',
//     router: router
// })
