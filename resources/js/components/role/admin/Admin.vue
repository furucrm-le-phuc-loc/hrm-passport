<template>
    <div class="wrapper d-flex align-items-stretch">

        <AdminSideBar
            v-on:changeController="updateController"
        >
        </AdminSideBar>
        <!-- Page Content  -->
        <AdminUsers
            v-if="controller === 'user'"
        >
        </AdminUsers>


        <AdminProjects
            v-else-if="controller === 'project'"
        >
        </AdminProjects>


        <AdminAbsents
            v-else-if="controller === 'absent'"
        >
        </AdminAbsents>


        <AdminDashboard
            v-else-if="controller === 'dashboard'"
        >
        </AdminDashboard>
    </div>
</template>

<script>
    import AdminSideBar from "../../sidebar/AdminSideBar.vue";

    import AdminUsers from "./user/index.vue";
    import AdminProjects from "./project/index.vue";
    import AdminAbsents from "./absent/index.vue";
    import AdminDashboard from "./dashboard/index.vue";


    export default {
        data() {
            return {
                controller: "user"
            }
        },
        components: {
            AdminSideBar,
            AdminUsers,
            AdminProjects,
            AdminAbsents,
            AdminDashboard,
        },
        methods: {
            updateController: function(msg) {
                // alert(msg);
                this.controller = msg;
            }
        },



    }
</script>

<style>

</style>
