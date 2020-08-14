<template>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row ">
            <h2 class="col-6 justify-align-end"
                v-bind:class="{active: isTime}"
                v-on:click="time"> Time working </h2>
            <h2 class="col-6"
                v-bind:class="{active: !isTime}"
                v-on:click="absent"> Time Absent </h2>
        </div>


        <TimeWorking v-if="isTime" />
        <ReportAbsent v-else />

    </div>
</template>

<script>

import ReportAbsent from './ReportAbsent.vue';
import TimeWorking from './TimeWorking.vue';

export default {
    data() {
        return {
            isTime: true,
        }
    },
    created() {


    },
    methods: {
        time: function() {
            this.isTime = true;
        },
        absent: function() {
            this.isTime = false;
        }
    },
    components: {
        ReportAbsent,
        TimeWorking,
    }
}
</script>

<style scoped>
    h2.inactive {
        color: #cccccc;
    }

    h2.active {
        color: #0d0d0d;
        border-bottom: 2px solid #5fbae9;
    }
</style>
