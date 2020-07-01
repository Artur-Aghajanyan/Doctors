<template>
    <div class="">
    <div class="container py-5" id="signup">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card border-secondary">
                            <div class="card-header">
                                <h1 class="mb-0 my-2">Sign Up</h1>
                            </div>
                            <div class="card-body">
                                <form class="form"
                                      role="form"
                                      method="POST"
                                      @submit.prevent="addDoct"
                                      autocomplete="off">
                                    <div class="form-group">
                                        <label for="inputName" >Name</label>
                                        <input type="text" v-model="doctor.name" class="form-control" id="inputName" placeholder="name" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" >Surname</label>
                                        <input type="text" v-model="doctor.surname" class="form-control" id="inputSurname" placeholder="surname" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" >Email</label>
                                        <input type="email" v-model="doctor.email" class="form-control" id="inputEmail" placeholder="email@gmail.com" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" >Password</label>
                                        <input type="password" v-model="doctor.password" class="form-control" id="inputPassword" placeholder="password"  required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSpeciality" >Speciality</label>
                                        <select class="form-control" v-model="doctor.speciality" name="cars" id="inputSpeciality">
                                            <option value="Radiologist">Radiologist</option>
                                            <option value="Psychologist">Psychologist</option>
                                            <option value="Gynecologist">Gynecologist</option>
                                            <option value="Ophthalmologist">Ophthalmologist</option>
                                            <option value="Cardiologist">Cardiologist</option>
                                            <option value="Neonatologist">Neonatologist</option>
                                            <option value="Therapeutist">Therapeutist</option>
                                            <option value="Laboratory assistant">Laboratory assistant</option>
                                            <option value="Nephrologist">Nephrologist</option>
                                            <option value="Urologist">Urologist</option>
                                            <option value="Traumatologist-orthopedist">Traumatologist-orthopedist</option>
                                            <option value="Therapeutist">Therapeutist</option>
                                            <option value="Surgeon-vascular">Surgeon-vascular</option>
                                            <option value="Stomatologist">Stomatologist</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAboutYou" >About you</label>
                                        <textarea type="text" v-model="doctor.about" class="form-control" id="inputAboutYou" placeholder="About you"  required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="downloadImage" >Download image</label>
                                        <label for="inputDownloadImage" class="aaalave" style="width: 100px"></label><br>
                                        <input type="file" class="tolave"
                                               multiple
                                               id="inputDownloadImage"
                                               @change="handleFileChange" required="">
                                        <h6
                                         v-bind:class = "[validateVal? 'validate':'success_add']">{{message}}</h6>
                                   </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-lg float-right">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->
    </div>
</template>

import axios from 'axios

<script>
    export default({
        name: "Signup",
        data(){
            return{
                message: 'Not selected',
                validateVal: true,
                doctor:{
                    name:'',
                    surname:'',
                    email:'',
                    password:'',
                    about:'',
                    image:'',
                    speciality:'',
                },
            }
        },
        methods:{
            handleFileChange(e) {
                if(e.target.value === ''){
                    this.message = 'Not selected';
                    this.validateVal = true
                }else {
                    this.message = 'Selected';
                    this.validateVal = false;
                    var imageRider = new FileReader();
                    imageRider.readAsDataURL(e.target.files[0]);
                    imageRider.onload = (e)=>{
                        this.doctor.image = e.target.result;
                    }
                }
            },
            addDoct(){
                var app = this;
                axios.get('./api/login').then(resp => {
                    if(resp.data.length === 0){
                        window.axios.post('./api/result', this.doctor)
                            .then(function (response) {
                                alert('success');
                                window.location.href = '/login';
                            })
                            .catch(function (error) {
                                alert(error);
                            });
                    }
                    for (let i = 0; i < resp.data.length;i++) {
                        if(resp.data[i].email === this.doctor.email){
                            alert('There is email like that');
                            break;
                        }else{
                            if(i === resp.data.length-1){
                                window.axios.post('./api/result', this.doctor)
                                    .then(function (response) {
                                        alert('success');
                                        window.location.href = '/login';
                                    })
                                    .catch(function (error) {
                                        alert(error);
                                    });
                            }
                        }
                    }
                });
            }
        }
    })

</script>
<style scoped>
.container{
    background: url("../../images/rethink-target-heart-rate-number-ftr.jpg") no-repeat;
    background-size: cover;
}

.card-header{
    background: #1cb31c;
}
.mb-0, .my-2{
    font-weight: 900;
    text-align: center;
}

#inputDownloadImage{
    width: 125px;
}
.aaalave{
    background: url("http://100dayscss.com/codepen/upload.svg") no-repeat;
    cursor: pointer;
    background-size: 100px;
    width: 100px;
    height: 59px;
}
.tolave{
    display: none;
}

.downloadImage{
    display: block;
}
    .validate{
        color: darkred;
        border-color: darkred;
    }
.success_add{
    color: green;
}
</style>
