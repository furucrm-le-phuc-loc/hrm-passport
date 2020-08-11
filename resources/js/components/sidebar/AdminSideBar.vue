<template>
    <nav id="sidebar">
        <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4">
            <h1><a href="index.html" class="logo">Portfolic <span>Portfolio Agency</span></a></h1>
            <ul class="list-unstyled components mb-5">
                <li class="active" v-on:click="changeController('user')">
                    <a href="#" >
                        <span class="fa fa-home mr-3"></span>
                        Users
                    </a>
                </li>

                <li class="active" v-on:click="changeController('project')">
                    <a href="#" >
                        <span class="fa fa-home mr-3"></span>
                        Projects
                    </a>
                </li>

                <li class="active" v-on:click="changeController('absent')">
                    <a href="#" >
                        <span class="fa fa-home mr-3"></span>
                        Absent Application
                    </a>
                </li>

                <li class="active" v-on:click="changeController('dashboard')">
                    <a href="#" >
                        <span class="fa fa-home mr-3"></span>
                        Dashboard
                    </a>
                </li>
                <Logout></Logout>

                <!-- <div id="example-3">
                <button v-on:click="say('hi')">Say hi</button>
                <button v-on:click="say('what')">Say what</button>
                </div> -->
            </ul>

        </div>
    </nav>
</template>

<script>
import Logout from "../auth/Logout";
export default {
    data() {
        return {
            controller: 'user'
        }
    },
    methods: {
        changeController: function(msg) {
            // alert(msg);
            this.$emit('changeController', msg)
        },

        logout: function() {

        }
        // say: function (message) {
        //     alert(message)
        // }
    },

    computed: {

    },
    components: {
        Logout,
    }
}
</script>

<style>

</style>
