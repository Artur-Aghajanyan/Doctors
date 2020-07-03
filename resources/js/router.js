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
import PageNotFound from "./components/PageNotFound"
import DoctorPageForUser from "./components/DoctorPageForUser";
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
        {path: `/line_up:id`,name: 'line_up' ,component: DoctorPageForUser},
        {path: "*", component: PageNotFound }
    ],
    mode: 'history'
})
