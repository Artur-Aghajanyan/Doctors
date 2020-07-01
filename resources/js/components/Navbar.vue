<template>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <router-link to="/" class="navbar-brand router">Home</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">

                </li>
                <li class="nav-item active">
                    <router-link to="/contact" class="navbar-brand router">Contact</router-link>
                </li>
                <li class="nav-item active">
                    <router-link to="/about" class="navbar-brand router">About</router-link>
                </li>
            </ul>
            <form class="form-inline">
                <router-link v-if="resLog === 'true'"  id="user_page" class="navbar-brand router" to="/user">Personal Data</router-link>
                <router-link v-if="resLog === 'false' || !resLog" id="login" to="/login">Login</router-link>
                <router-link id="signup" to="/signup">Sign up</router-link>
                <div  class="btn btn-info btn-lg" @click="logout" v-if="resLog === 'true'">
                    <span class="glyphicon glyphicon-log-out"></span> Log out
                </div>
            </form>
        </div>
    </nav>
</template>

<script>
    import Vue from 'vue';
    import VueCookies from 'vue-cookies';
    import VueSession from 'vue-session';

    Vue.use(VueSession)
    Vue.use(VueCookies);
    export default {
        name: "Navbar",
        data() {
            return{
                resLog: Vue.$cookies.get('login')
            }
        },
        methods:{
            logout: function(){
                Vue.$cookies.set('id', null, 60 * 60 * 24)
                    .set('login', false, 60 * 60 * 24);
                this.$session.start()
                this.$session.remove('doctor')
                console.log(this.$session.get('doctor'))
                // window.location.href = '/login';
            }
        }
    }
</script>

<style scoped>
.navbar{
    z-index: 2;
    position: fixed;
    width: 100%;
    -webkit-box-shadow: 0px 5px 12px 0px rgba(138,134,138,1);
    -moz-box-shadow: 0px 5px 12px 0px rgba(138,134,138,1);
    box-shadow: 0px 5px 12px 0px rgba(138,134,138,1);
    background: forestgreen;
}
#signup{
    border: 1px solid #845353;
    padding: 12px;
    color: white;
    border-radius: 10px;
    background: darkred;
    font-size: 15px;
    margin-right: 25px;
}
    #signup:hover{
        background: #3f9ae5;
        color: darkred;
        border: 1px solid white;
    }
    #login{
        border: 1px solid #e2e2e2;
        padding: 12px;
        color: white;
        border-radius: 10px;
        background: #4c86af;
        font-size: 15px;
        margin-right: 25px;
    }
    #login:hover{
        border: 1px solid #0e340e;
        padding: 12px;
        color: darkred;
        border-radius: 10px;
        background: forestgreen;
        font-size: 15px;
        margin-right: 25px;
    }
    .router{
        margin-left: 25px;
    }
    .router:hover{
        color: darkred;
        text-decoration: underline;
    }
</style>
