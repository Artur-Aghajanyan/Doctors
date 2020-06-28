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
<!--                        <date-picker v-model="date" :config="{format: 'DD/MM/YYYY'}"></date-picker>-->
<!--                        <button id="datepicker-valid" type="button" aria-haspopup="dialog" aria-expanded="false" class="btn h-auto"><svg viewBox="0 0 16 16" width="1em" height="1em" focusable="false" role="img" alt="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi-calendar b-icon bi"><g><path fill-rule="evenodd" d="M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm1-3a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z"></path><path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5zm9 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"></path></g></svg></button>-->
                        <v-date-picker
                            mode='single'
                            tint-color='#f142f4'
                            v-model='dates'
                            :theme-styles='themeStyles'
                            class="theme-styles"
                            :min-date='new Date()'
                            is-double-paned
                            locale="en"
                            is-inline>
                        </v-date-picker>
                        <br>
<!--                        <button class="btn btn-success" @click="getDate">Look</button>-->
                        <br>
                        <br>
                        <label class="table-lable">Table of Counseling</label>
                        <table  class="table">
                            <tr style="font-family: sans-serif;">
                                <th class="number">N</th>
                                <th>Time</th>
                                <th>Name of patient</th>
                            </tr>
                            <tr v-for="(timeItem,index) in dataCounseling"
                                v-if="timeItem.date === dates.toLocaleDateString() &&
                                 timeItem.type === 'Counseling'">
                                <td>{{index+1}}</td>
                                <td>{{timeItem.time}}</td>
                                <td>{{dataCounseling[index].name}} {{dataCounseling[index].surname}}</td>
                            </tr>
                        </table>
                        <br>
                        <label class="table-lable">Sick of Patients Table</label>
                        <table class="table">
                            <tr style="font-family: sans-serif;">
                                <th class="number">N</th>
                                <th>Time</th>
                                <th>Name of patient</th>
                            </tr>
                            <tr v-for="(timeItem,index) in dataPatient"
                                v-if="timeItem.date === dates.toLocaleDateString() &&
                                timeItem.type === 'Sick Patient'">
                                    <td>{{index+1}}</td>
                                    <td>{{timeItem.time}}</td>
                                    <td>{{dataPatient[index].name}} {{dataPatient[index].surname}}</td>
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
                dates: new Date(),
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
                window.axios.get('./api/patient-data')
                    .then(resp => {
                        var app =this;
                        let doctorName = this.doctor.name + ' ' + this.doctor.surname;
                        for(let doctor of resp.data){
                            if(doctorName === doctor.doctor){
                                if(doctor.type === 'Counseling')
                                    app.dataCounseling = resp.data;
                                else
                                    app.dataPatient = resp.data;
                            }
                            console.log(typeof doctor.time,doctor.time)
                        }
                        console.log(this.dates.toLocaleDateString());
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
    table tr th{
        width: 41%;
    }
    table .number{
        width: 8%;
    }
    .vc-container{
        width: 100%;
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
    .table-lable{
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
