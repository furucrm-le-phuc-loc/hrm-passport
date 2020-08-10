<template>
    <div class="wrapper d-flex align-items-stretch">

        <ManagerSideBar
            v-on:changeController="updateController"
        >
        </ManagerSideBar>
        <!-- Page Content  -->
        <ManagerUsers
            v-if="controller === 'user'"
        >
        </ManagerUsers>

        <ManagerProjects
            v-else-if="controller === 'project'"
        >
        </ManagerProjects>

        <ManagerAbsents
            v-else-if="controller === 'absent'"
        >
        </ManagerAbsents>

        <ManagerReport
            v-else-if="controller === 'report'"
        >
        </ManagerReport>
    </div>
</template>

<script>
    import ManagerSideBar from "../../sidebar/ManagerSideBar.vue";

    import ManagerUsers from "./user/index.vue";
    import ManagerProjects from "./project/index.vue";
    import ManagerAbsents from "./absent/index.vue";
    import ManagerReport from "./report/index.vue";


    export default {
        data() {
            return {
                controller: "user"
            }
        },
        components: {
            ManagerSideBar,
            ManagerUsers,
            ManagerProjects,
            ManagerAbsents,
            ManagerReport,
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
