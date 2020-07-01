<template>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img :src="doctor.image" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <h6><b><u>Name:</u></b> {{doctor.name}}</h6>
                            <h6><b><u>Surname:</u></b> {{doctor.surname}}</h6>
                        </div>
                        <br>
                        <div class="profile-usertitle-speciality">
                            <h6><b style="color: black"><u>Speciality</u></b></h6>
                            {{doctor.speciality}}
                        </div>
                    </div>
                    <div class="profile-usermenu">
                        <h6 class="about"><b><u>About me</u></b></h6>
                        {{doctor.about}}
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9" style="background: white">
                <div class="profile-content">
                    <div class="profile-content">
                        <v-date-picker
                            mode='single'
                            tint-color='#f142f4'
                            v-model='dates'
                            :theme-styles='themeStyles'
                            class="theme-styles"
                            is-double-paned
                            locale="en"
                            is-inline>
                        </v-date-picker>
                        <br><br><br>
                        <label class="table-label">Table of Counseling</label>
                        <table  class="table">
                            <tr style="font-family: sans-serif;">
                                <th class="number">N</th>
                                <th class="time">Time</th>
                                <th class="name-of-patient">Name of patient</th>
                                <th class="phone">Phone</th>
                            </tr>
                            <tr v-for="(timeItem,index) in dataCounseling"
                                v-if="timeItem.date === dates.toLocaleDateString() &&
                                 timeItem.type === 'Counseling'">
                                <td>{{index+1}}</td>
                                <td>{{timeItem.time}}</td>
                                <td>{{dataCounseling[index].name}} {{dataCounseling[index].surname}}</td>
                                <td>{{dataCounseling[index].phone}}</td>
                            </tr>
                        </table>
                        <br>
                        <label class="table-label">Sick of Patients Table</label>
                        <table class="table">
                            <tr style="font-family: sans-serif;">
                                <th class="number">N</th>
                                <th class="time">Time</th>
                                <th class="name-of-patient">Name of patient</th>
                                <th class="phone">Phone</th>
                            </tr>
                            <tr v-for="(timeItem,index) in dataPatient"
                                v-if="timeItem.date === dates.toLocaleDateString() &&
                                timeItem.type === 'Sick Patient'">
                                    <td>{{index+1}}</td>
                                    <td>{{timeItem.time}}</td>
                                    <td>{{dataPatient[index].name}} {{dataPatient[index].surname}}</td>
                                    <td>{{dataPatient[index].phone}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from "vue";
    import VueCookies from "vue-cookies";
    import VCalendar from 'v-calendar';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    Vue.use(VCalendar);
    Vue.use(VueCookies);
    export default {
        name: "DoctorPage",
        data(){
            return{
                selectedDate: null,
                dates: null,
                themeStyles: {
                    wrapper: {
                        border: '1',
                    },
                    header: {
                        color: '#fafafa',
                        backgroundColor: '#f142f4',
                        borderColor: '#404c59',
                        borderWidth: '1px 1px 0 1px',
                    },
                    headerVerticalDivider: {
                        borderLeft: '1px solid #404c59',
                    },
                    weekdays: {
                        color: '#ffffff',
                        backgroundColor: '#f142f4',
                        borderColor: '#ff0098',
                        borderWidth: '0 1px',
                        padding: '5px 0 10px 0',
                    },
                    weekdaysVerticalDivider: {
                        borderLeft: '1px solid #404c59',
                    },
                    weeks: {
                        border: '1px solid #dadada',
                    }},
                doctor:{
                    name:'',
                    surname:'',
                    email:'',
                    about:'',
                    speciality:'',
                    image:'',
                },
                dataPatient:[],
                dataCounseling:[],
            }
        },
        watch: {
            dates:function(){
                window.axios.get('./api/data_for_table')
                    .then(resp => {
                        var app =this;
                        let doctorName = this.doctor.name + ' ' + this.doctor.surname;
                        for(let doctor of resp.data){
                            console.log(resp.data)
                            if(doctorName === doctor.doctor){
                                if(doctor.type === 'Counseling')
                                    app.dataCounseling = resp.data;
                                else
                                    app.dataPatient = resp.data;
                            }
                        }
                    })
                    .catch(function (error) {
                        alert(error);
                    });
            }
        },

        created(){
            if(Vue.$cookies.get('login') === 'false'){
                window.location.href = '/login';
            }else{
                window.axios.get('./api/user').then(resp => {
                    for(let i = 0; i< resp.data.length;i++){
                        if(Vue.$cookies.get('id') === resp.data[i].id.toString()){
                            this.doctor.name = resp.data[i].name;
                            this.doctor.surname = resp.data[i].surname;
                            this.doctor.email = resp.data[i].email;
                            this.doctor.about = resp.data[i].about;
                            this.doctor.speciality = resp.data[i].speciality;
                            this.doctor.image = './images/'+resp.data[i].image;
                        }
                    }
                });
            }

        }
    }
</script>

<style scoped>

    .vc-container{
        width: 100%;
    }

    .number{
        width: 6%;
    }
    .time{
        width: 15%;
    }
    .name-of-patient{
        width: 25%;
    }
    .phone{
        width: 25%;
    }
    /*   **table **   */
    .table td {
        border: 1px solid black;
        font-weight: 800;
        font-size: 17px;
    }
    .table tr th{
        background: lightgray;
        border: 1px solid black;
    }
    .table-label{
        color: #4cb1d2;
        text-decoration: underline;
        font-size: 30px;
    }

    /*   **end-table **   */

    body {
        background: #F1F3FA;
    }

    /* Profile container */
    .profile {
        margin: 20px 0;
    }

    .container{
        background: #dedddd;
        padding-bottom: 15px;
        text-align: center;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #fff;
        margin-bottom: 10px;
    }
    .profile-userpic{
        text-align: center;
    }
    .profile-userpic img {
        float: none;
        margin: 0 auto;
        width: 50%;
        height: 50%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .col-md-3{
        border-radius: 15px;
    }

    .profile-usertitle-name {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }
    .about {
        color: #5a7391;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-speciality {
        text-transform: uppercase;
        color: #5b9bd1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-usermenu {
        text-align: center;
        margin-top: 30px;
    }

    .profile-usermenu ul li {
        border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
        border-bottom: none;
    }

    .profile-usermenu ul li a {
        color: #93a3b5;
        font-size: 14px;
        font-weight: 400;
    }

    .profile-usermenu ul li a i {
        margin-right: 8px;
        font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #fafcfd;
        color: #5b9bd1;
    }

    .profile-usermenu ul li.active {
        border-bottom: none;
    }

    .profile-usermenu ul li.active a {
        color: #5b9bd1;
        background-color: #f6f9fb;
        border-left: 2px solid #5b9bd1;
        margin-left: -2px;
    }

    /* Profile Content */
    .profile-content {
        padding: 20px;
        background: #fff;
        min-height: 460px;
    }
</style>
