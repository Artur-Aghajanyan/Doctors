<template>
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img :src="image" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <h6><b><u>Name:</u></b> {{name}}</h6>
                            <h6><b><u>Surname:</u></b> {{surname}}</h6>
                        </div>
                        <br>
                        <div class="profile-usertitle-speciality">
                            <h6><b style="color: black"><u>Speciality</u></b></h6>
                            {{speciality}}
                        </div>
                    </div>
                    <div class="profile-usermenu">
                        <h6 class="about"><b><u>About me</u></b></h6>
                        {{about}}
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9" style="background: white">
                <div class="profile-content">
                    <div class="profile-content">
                        <v-date-picker
                            required=""
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
                        <div class="form-group">
                            <div id="option_1">
                                <label for="inputTimeCounseling">Counseling</label>
                                <select class="form-control" @change="getCounsVal" name="cars" id="inputTimeCounseling" required="">
                                    <option value='No Selected'>No Selected</option>
                                    <option value="09:00 - 09:30">09:00 - 09:30</option>
                                    <option value="09:30 - 10:00">09:30 - 10:00</option>
                                    <option value="10:00 - 10:30">10:00 - 10:30</option>
                                    <option value="10:30 - 11:00">10:30 - 11:00</option>
                                    <option value="11:00 - 11:30">11:00 - 11:30</option>
                                    <option value="11:30 - 12:00">11:30 - 12:00</option>
                                    <option value="12:00 - 12:30">12:00 - 12:30</option>
                                    <option value="12:30 - 13:00">12:30 - 13:00</option>
                                </select>
                                <br><span v-if="counselingType !== 'No Selected'">{{counselingType}}</span>
                                <hr>
                                <br><br>
                                <label for="inputName" >Name</label>
                                <input type="text"
                                       class="form-control"
                                       id="inputName"
                                       placeholder="name"
                                       v-model="patient.name"
                                       required="">
                                <br><br>
<!--                                pattern="[+]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}"-->
                                <label for="inputPhone" >Phone</label>
                                <input type="tel"
                                       pattern="[+]{1}[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2}"
                                       class="form-control"
                                       id="inputPhone"
                                       placeholder="+374-55-55-55"
                                       v-model="patient.phone"
                                       required>
                            </div>
                            <div id="option_2">
                                <label for="inputTimeSickPatient" >Sick Patient</label>
                                <select class="form-control" @change="getSickVal" name="cars" id="inputTimeSickPatient">
                                    <option value="No Selected">No Selected</option>
                                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                                    <option value="16:00 - 17:00">16:00 - 17:00</option>
                                    <option value="17:00 - 18:00">17:00 - 18:00</option>
                                </select>
                                <br><span v-if="sickPatientType !== 'No Selected'">{{sickPatientType}}</span>
                                <hr>
                                <br><br>
                                <label for="inputSurname" >Surname</label>
                                <input type="text"
                                       class="form-control"
                                       id="inputSurname"
                                       placeholder="surname"
                                       v-model="patient.surname"
                                       required="">
                                <br><br><br><br>
                                <button class="btn btn-success" @click="Register">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VCalendar from 'v-calendar';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    Vue.use(VCalendar);
    export default {
        name: "DoctorPageForUser",

        data(){
            return{
                dataTable:[],
                name: JSON.parse(localStorage.getItem('DoctorData')).name,
                surname: JSON.parse(localStorage.getItem('DoctorData')).surname,
                speciality: JSON.parse(localStorage.getItem('DoctorData')).speciality,
                about: JSON.parse(localStorage.getItem('DoctorData')).about,
                image: './images/'+JSON.parse(localStorage.getItem('DoctorData')).image,
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
                counselingVal:Array(8),
                sickPatientVal:Array(4),
                counseling:[
                    "09:00 - 09:30",
                    "09:30 - 10:00",
                    "10:00 - 10:30",
                    "10:30 - 11:00",
                    "11:00 - 11:30",
                    "11:30 - 12:00",
                    "12:00 - 12:30",
                    "12:30 - 13:00"
                ],
                sickPatient:[
                    "14:00 - 15:00",
                    "15:00 - 16:00",
                    "16:00 - 17:00",
                    "17:00 - 18:00"
                ],
                counselingType:'No Selected',
                sickPatientType:'No Selected',
                patient:{
                    name:'',
                    surname:'',
                    phone: null,
                    time:'',
                    date:'',
                    doctorName:'',
                    type:'',
                },
                resCheck: true,

            }
        },
        methods:{
            Register(){
                this.patient.date = this.dates.toLocaleDateString();
                this.patient.doctorName = JSON.parse(localStorage.getItem('DoctorData')).name+' '+JSON.parse(localStorage.getItem('DoctorData')).surname;
                if(this.patient.name === ''){
                    document.getElementById('inputName').style.borderColor = 'darkred';
                }else{
                    document.getElementById('inputName').style.borderColor = 'grey';
                }
                if(this.patient.surname === ''){
                    document.getElementById('inputSurname').style.borderColor = 'darkred';
                }else{
                    document.getElementById('inputSurname').style.borderColor = 'grey';
                }
                if(this.patient.phone === null){
                    document.getElementById('inputPhone').style.borderColor = 'darkred';
                }else{
                    document.getElementById('inputPhone').style.borderColor = 'grey';
                }
                if(this.counselingType === 'No Selected' && this.sickPatientType === 'No Selected'){
                    document.getElementById('inputTimeSickPatient').style.borderColor = 'darkred';
                    document.getElementById('inputTimeCounseling').style.borderColor = 'darkred';
                }else{
                    document.getElementById('inputTimeSickPatient').style.borderColor = 'grey';
                    document.getElementById('inputTimeCounseling').style.borderColor = 'grey';
                    if(this.counselingType !== 'No Selected'){
                        this.patient.time = this.counselingType;
                        this.patient.type = 'Counseling';
                    }else{
                        this.patient.time = this.sickPatientType;
                        this.patient.type = 'Sick Patient';
                    }
                }
                if(this.patient.name !== ''
                    && this.patient.surname !== ''
                    && this.patient.phone !== null
                    && this.patient.time !== ''
                    && this.patient.date !== ''
                    && this.patient.doctorName !== ''
                    && this.patient.type !== ''){
                        var app = this;
                        window.axios.post('./api/patient-data',{
                            doctor:app.patient.doctorName
                        })
                        .then(function(resp){
                            if(resp.data){
                                for(let item of resp.data){
                                    if(item.date === app.patient.date && item.time === app.patient.time){
                                        alert(app.patient.date+'  '+app.patient.time+' date busy !!!\n Please choose another date');
                                        app.resCheck = false;
                                        break;
                                    }else{
                                        app.resCheck = true;
                                    }
                                }
                            }
                            if(app.resCheck === true){
                                window.axios.post('./api/patient-data-post', {
                                    name: app.patient.name,
                                    surname: app.patient.surname,
                                    phone: app.patient.phone,
                                    time: app.patient.time,
                                    date: app.patient.date,
                                    doctorName: app.patient.doctorName,
                                    type: app.patient.type,
                                })
                                .then(function (response) {
                                    alert('success');
                                    window.location.reload(true)
                                })
                                .catch(function (error) {
                                    alert(error);
                                });
                            }
                        })
                        .catch(function (error) {
                            alert(error);
                        });
                }
            },
            getCounsVal(e){
                this.counselingType = e.target.value;
                this.sickPatientType = 'No Selected';
            },
            getSickVal(e){
                this.sickPatientType = e.target.value;
                this.counselingType = 'No Selected';
            },
        },
    }
</script>

<style scoped>

    /* table */
    table{
        margin-top: 25px;
    }
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
    .table-label{
        color: #4cb1d2;
        text-decoration: underline;
        font-size: 30px;
    }
    /*END table */

    .vc-container{
        width: 100%;
    }
    .form-group{
        display: grid;
        grid-template-columns: auto auto;
    }

    .form-group div{
        width: 70%;
        margin: 40px auto;
    }

    .form-group div label{
        color: blueviolet;
        font-weight: 900;
        font-size: 20px;
    }

    @media only screen and (max-width:1000px){
        .form-group{
            display: block;
        }
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
