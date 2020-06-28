<template>
    <div class="container">
        <br>
        <br>
        <div class="login-popup-wrap new_login_popup">
            <div class="login-popup-heading text-center">
                <h1><i class="fa fa-lock" aria-hidden="true"></i> Login </h1>
            </div>
            <!--<form accept-charset="utf-8" method="post" action="">-->
            <form id="loginMember" role="form"
                  @submit.prevent="logDoctPage"
                  action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control"
                           id="user_id" placeholder="e-mail"
                           name="user_id" v-model="email"
                           v-bind:class="[validate? 'validate':'']">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control"
                           id="password" placeholder="Password"
                           name="password" v-model="password"
                           v-bind:class="[validate? 'validate':'']">
                </div>
                <button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1">Login</button>
            </form>
        </div>
    </div>
</template>

<script>
    var Vue = require('vue')
    import VueCookies from 'vue-cookies';
    Vue.use(VueCookies)
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                password: '',
                validate: false,
                login: null,
            }
        },
        methods: {
            logDoctPage: function () {
                if(this.email !== '' && this.password !== '') this.validate = false;
                else this.validate = true;
                axios.get('./api/login').then(resp => {
                    for (let i = 0; i < resp.data.length; i++) {
                        if (resp.data[i].email === this.email && resp.data[i].password === this.password) {
                            this.login = true;
                            Vue.$cookies.set('id', resp.data[i].id, 60 * 60 * 24)
                                .set('login', this.login, 60 * 60 * 24);
                            window.location.href = 'user';
                            break
                        } else {
                            if(i === resp.data.length-1){
                                alert('There isn`t user like this');
                                this.login = false;
                                Vue.$cookies.set('login', this.login, 60 * 60 * 24)
                            }
                        }
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .login-popup-heading>h1 {
        color: #258b47;
        font-size: 25px;
        line-height: 30px;
    }
    .new_reg_popup, .new_login_popup {
        border-radius: 2px;
        min-height: 332px;
        width: 500px;
        margin: 0px auto;
    }
    .login-popup-btn {
        background: #258b47;
        border: none;
        border-radius: 25px;
        color: #fff;
        display: block;
        font-size: 18px;
        height: 38px;
        line-height: 28px;
        margin: 20px auto 5px;
        width: 150px;
        -webkit-transition: all 700ms ease;
        -moz-transition: all 700ms ease;
        -ms-transition: all 700ms ease;
        -o-transition: all 700ms ease;
    }
    a{
        color: #258b47;
        font-size: 18px;
    }
    .validate{
        border-color: darkred;
    }
</style>
