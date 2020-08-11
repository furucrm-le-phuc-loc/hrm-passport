<template>
     <li class="active" v-on:click="logout">
        <a href="#">
            <span class="fa fa-home mr-3"></span>
            Logout
        </a>
    </li>
</template>

<script>
export default {
    methods: {
        logout: function() {
            // alert(msg);
            // console.log("logout");
            this.$store.dispatch('auth/logoutUser');

        },
        // say: function (message) {
        //     alert(message)
        // }
    },
}
</script>

<style>

</style>
