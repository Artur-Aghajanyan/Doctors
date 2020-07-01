<template>
    <div class="container-home">
        <div class="card-deck mb-3 text-center">
            <div class="card polaroid"
                 v-for="user in users" v-if="showOnly === '' || showOnly === user.speciality"
                 @click="goPageForUser(user.name, user.surname,user.speciality,user.about,user.image,user.id)">
                <div class="card-body mx-auto">
                    <img class="w3-card-4" :src="'./images/'+ user.image" alt="">
                </div>
                <div class="card-footer">
                    <h5 class="my-0 font-weight-normal">{{user.name}} {{user.surname}}</h5>
                </div>
                <div class="card-speciality card-footer">
                    <h5 class="my-0 font-weight-normal">{{user.speciality}}</h5>
                </div>
            </div>

        </div>
        <div class="filter">
            <h3><u>Speciality</u></h3>
            <div class="list-grup">
                <button type="button" @click="filtering('all','all')"
                        :class = "['all' === indexElForValidate ? 'validate':'']"
                        class="list-group-item list-group-item-action">All</button>
                <button type="button" v-for="(item, index) in specialities"
                        :class = "[index === indexElForValidate ? 'validate':'']"
                        @click="filtering(item,index)"
                        class="list-group-item list-group-item-action">
                    {{item}}
                </button>
            </div>
        </div>
        <a id="myBtn" href="#top"><h1>&#708;</h1></a>
    </div>

</template>

<script>
    export default {
        name: "Home",
        data(){
            return{
                users: [],
                specialities:[
                    "Radiologist",
                    "Psychologist",
                    "Gynecologist",
                    "Ophthalmologist",
                    "Cardiologist",
                    "Neonatologist",
                    "Therapeutist",
                    "Laboratory assistant",
                    "Nephrologist",
                    "Urologist",
                    "Traumatologist-orthopedist",
                    "Therapeutist",
                    "Surgeon-vascular",
                    "Stomatologist"
                ],
                showOnly: '',
                indexElForValidate: null,
            }
        },
        destroyed () {
            window.removeEventListener('scroll', this.scrollFunction);
        },
        created() {
            window.addEventListener('scroll', this.scrollFunction);
            window.axios.get('./api/user').then(resp=>{
                this.users = resp.data;
            })
        },
        methods:{
            filtering: function(specialitiy, indexEl){
                this.showOnly = (specialitiy === 'all')? '': specialitiy;
                this.indexElForValidate = indexEl;
            },
            scrollFunction() {
                var mybutton = document.getElementById("myBtn");
                if (document.body.scrollTop > 300 ||
                    document.documentElement.scrollTop > 300) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            },
            goPageForUser: function (name,surname,speciality,about,image,id) {
                localStorage.setItem('DoctorData',JSON.stringify({
                    name: name,
                    surname: surname,
                    speciality:speciality,
                    about:about,
                    image:image,
                    id: id
                }))
                window.location.href = `/line_up:${JSON.parse(localStorage.getItem('DoctorData')).id}`;
            }
        }
    }
</script>

<style scoped>
    #myBtn{
        display: none;
    }

    .container-home{
        width: 100%;
        margin: auto;
        padding-top: 100px;
    }

    .container-home a{
        float: right;
        right: 55px;
        top: 522px;
        position: fixed;
        color: white;
        display: block;
        background: forestgreen;
        height: 50px;
        width: 50px;
        text-align: center;
        -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.75);
        -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.75);
        box-shadow: 0 0 10px 0 rgba(0,0,0,0.75);
        text-decoration: none;
        border-radius: 5px;
    }
    .container-home a:hover{
        color: forestgreen;
        background: white;
    }
    .container-home a h1{
        font-size: 66px;
        position: relative;
        top: -12px;
    }

    .validate{
        background: #b9b9b9;
        color: black;
        font-weight: 600;
    }

    .filter{
        float: right;
        text-align: center;
        width: 245px;
        border: 1px solid black;
    }

    .filter button{
        height: 36px;
        padding: 0;
    }

    .filter h3{
        padding: 10px 0;
    }

    .card-deck{
        width: 65%;
        position: absolute;
        grid-template-columns: auto auto auto auto;
        display: grid;
        text-align: center;
    }
    .card-deck img{
        width: 90%;
    }

    .card-body{
        overflow: hidden;
    }
    @media only screen and (max-width:1000px){
        .card-deck{
            width: 42%;
            grid-template-columns: auto auto;
            float: left;
        }
        .filter{
            width: 194px;
        }
    }
    @media only screen and (max-width:780px){
        .card-deck{
            width: 50%;
            grid-template-columns: auto;
            float: left;
        }
    }

    @media only screen and (max-width:770px){
        .card-deck{
            width: 33%;
        }
    }
    .card{
        width: 80%;
        float: left;
        margin-bottom: 35px;
        transition: 1s;
    }

    .card:hover{
        cursor: pointer;
        -webkit-box-shadow: -12px -10px 17px -5px rgba(0,0,0,0.75);
        -moz-box-shadow: -12px -10px 17px -5px rgba(0,0,0,0.75);
        box-shadow: -12px -10px 17px -5px rgba(0,0,0,0.75);
    }
    .card-footer{
        height: 57px;
        padding:11px 15px;
    }

    .card-speciality{
        background: ghostwhite;
        height: 40px;
    }
    .card-speciality h5{
        font-size: 14px;
    }
</style>
