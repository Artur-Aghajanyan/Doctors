<template>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card border-secondary">
                            <div class="card-header">
                                <h1 class="mb-0 my-2">Sign Up</h1>
                            </div>
                            <div class="card-body">
                                <form class="form" role="form" autocomplete="off">
                                    <div class="form-group">
                                        <label for="inputName" v-if="show">Name</label>
                                        <label for="inputName" v-if="!show" style="color:darkred">Name</label>
                                        <input type="text" class="form-control" id="inputName" placeholder="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" v-if="show">Surname</label>
                                        <label for="inputName" v-if="!show" style="color:darkred">Surname</label>
                                        <input type="text" class="form-control" id="inputSurname" placeholder="surname">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" v-if="show">Email</label>
                                        <label for="inputEmail" v-if="!show" style="color:darkred">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="email@gmail.com" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" v-if="show">Password</label>
                                        <label for="inputPassword" v-if="!show" style="color:darkred">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" placeholder="password"  required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSpeciality" v-if="show">Speciality</label>
                                        <label for="inputSpeciality" v-if="!show" style="color:darkred">Speciality</label>
                                        <select class="form-control" name="cars" id="inputSpeciality" >
                                            <option value="radiologist">Radiologist</option>
                                            <option value="psychologist">Psychologist</option>
                                            <option value="gynecologist">Gynecologist</option>
                                            <option value="ophthalmologist">Ophthalmologist</option>
                                            <option value="cardiologist">Cardiologist</option>
                                            <option value="neonatologist">Neonatologist</option>
                                            <option value="therapeutist">Therapeutist</option>
                                            <option value="laboratory assistant">Laboratory assistant</option>
                                            <option value="nephrologist">Nephrologist</option>
                                            <option value="urologist">Urologist</option>
                                            <option value="traumatologist-orthopedist">Traumatologist-orthopedist</option>
                                            <option value="therapeutist">Therapeutist</option>
                                            <option value="surgeon-vascular">Surgeon-vascular</option>
                                            <option value="stomatologist">Stomatologist</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAboutYou" v-if="show">About you</label>
                                        <label for="inputAboutYou" v-if="!show" style="color:darkred">About you</label>
                                        <textarea type="text" class="form-control" id="inputAboutYou" placeholder="About you"  required=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="downloadImage" v-if="show">Download image</label>
                                        <label class="downloadImage" v-if="!show" style="color:darkred">Download image</label>
                                        <label for="inputDownloadImage" class="aaalave" style="width: 100px"></label><br>
                                        <input type="file" class="tolave" id="inputDownloadImage">
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
</template>

import axios from 'axios

<script>
    export default {
        name: "Signup",
        data: function () {
            return {
                show: true,
            }
        }
    }
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
</style>
