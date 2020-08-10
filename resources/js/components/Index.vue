<template>
    <!-- <IndexAdmin/> -->
    <div>
        <IndexAdmin
        v-if="role === 'admin'"
        >

        </IndexAdmin>

        <IndexManager
            v-else-if="role === 'manager'"
            >
        </IndexManager>

        <IndexWorker
            v-else-if="role === 'worker'"
        >
        </IndexWorker>
    </div>
</template>

<script>


import IndexAdmin from "./role/admin/Admin.vue";
import IndexManager from "./role/manager/Manager.vue";
import IndexWorker from "./role/worker/Worker.vue";

export default {
    mounted() {
        console.log("Component mounted.");
    },

    data() {
        return {
            role: "worker",
        }
    },

    components: {
        IndexAdmin,
        IndexManager,
        IndexWorker,
    },
};
</script>

<style >



</style>
