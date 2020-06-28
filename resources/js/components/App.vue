<template>
    <div>
        <Navbar></Navbar>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Navbar  from "./Navbar";
    export default{
        components: {
            Navbar
        }
    }

</script>
<style scoped>
    .container{
        padding-top: 66px;
    }
</style>
