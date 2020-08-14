<template>
    <div>
        <div class="select col-md-6">
            <select class="" v-model="project_id">
                <option selected

                    v-bind:value="-1">All Project</option>

                <option v-for="project in projects"
                    v-bind:key="project.id"
                    v-bind:value="project.id"
                >{{ project.project_name }}</option>
            </select>

        </div>

        <table class="table table-bordered" id width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Time Working</th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Time Working</th>

                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ user.name }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ time_working(index) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
export default {
    data() {
        return {
            users: {},
            projects: {},
            project_id: -1,
        }
    },

    created() {
        this.getUsersTimeWorking();
        this.getProjects();
    },

    methods: {
        getUsersTimeWorking: function() {
            axios.get("/api/admin/report")
            .then(response => {

                this.users = response.data.users;
                // console.log(this.users[7]);

            })
        },

        getProjects: function() {
            axios.get("/api/admin/project")
            .then(response => {
                // console.log(response.data.projects);
                this.projects = response.data.projects;
            })
        },

        time_working: function(index) {
            if (this.project_id === -1) {
                var reportObser = this.users[index].reports;
                // console.log(reportObser);
            }
            else {
                // console.log(this.project_id);
                var id = this.project_id;
                var reportObser = Object.values(this.users[index].reports).filter(function(report) {
                    // console.log("meoaosdko");
                    // console.log(this);
                    return (report.project.id === this) ? true : false;
                }, this.project_id);
            }
            // console.log("Aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
            // console.log(reportObser);
            return Object.values(reportObser).reduce(function(sum, report) {
                    return sum + report.time_working;
                }, 0)
        }

    },

    // watch: {
    //     time_working: function(index) {
    //         return Object.values(this.users[index].reports).reduce(function(sum, report) {
    //                 return sum + report.time_working;
    //             }, 0)
    //     }
    // },
    computed: {

    }
}
</script>

<style>

</style>
