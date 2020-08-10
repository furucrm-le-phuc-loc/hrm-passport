<template>
    <div class="wrapper d-flex align-items-stretch">

        <WorkerSideBar
            v-on:changeController="updateController"
        >
        </WorkerSideBar>
        <!-- Page Content  -->

        <WorkerProjects
            v-if="controller === 'project'"
        >
        </WorkerProjects>
        <WorkerAbsents
            v-else-if="controller === 'absent'"
        >
        </WorkerAbsents>
        <WorkerReport
            v-else-if="controller === 'report'"
        >
        </WorkerReport>
    </div>
</template>

<script>
    import WorkerSideBar from "../../sidebar/WorkerSideBar.vue";
    

    import WorkerProjects from "./project/index.vue";
    import WorkerAbsents from "./absent/index.vue";
    import WorkerReport from "./report/index.vue";


    export default {
        data() {
            return {
                controller: "project"
            }
        },
        components: {
            WorkerSideBar,
            WorkerProjects,
            WorkerAbsents,
            WorkerReport,
        },

        methods: {
            updateController: function(msg) {
                // alert(msg);
                this.controller = msg;
            }
        },

        computed: {

        }
    }
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap');

</style>
