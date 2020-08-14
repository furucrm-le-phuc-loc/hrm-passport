<template>
    <div>

        <p>Report absent</p>
        <select class="" v-model="option">
            <option selected

                value="all">All Absent</option>

            <option
                value="month"
            > Month </option>

            <option
                value="season"
            > Season </option>

        </select>
        <table class="table table-bordered" id width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Number date off</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Number date off</th>

                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ number_daysoff(index) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
export default {
    data() {
        return {
            option: "all",
            users: {},
        }
    },

    created() {
        this.getUsersAbsents();
    },

    methods: {
        getUsersAbsents: function() {
            axios.get("/api/admin/report")
            .then(response => {
                console.log("asdasdasd");
                this.users = response.data.users;

            })
        },

        number_daysoff: function(index) {
            if (this.option === 'all') {
                var absentObser = this.users[index].absents;
                // console.log(reportObser);
            }
            else if (this.option === 'month') {
                // console.log(this.project_id);
                var absentObser = Object.values(this.users[index].absents).filter(function(absent) {
                    var num_days = absent.date_off - Date.now();
                    console.log(num_days)
                    return (absent.project.id === this) ? true : false;
                }, this.project_id);
            }
            // console.log("Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
            // console.log(reportObser);
            return Object.values(absentObser).reduce(function(sum, absent) {
                    return sum + absent.number_off;
                }, 0)
        }

    }
}
</script>

<style>

</style>
