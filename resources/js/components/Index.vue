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
        <!-- <p> aasdasdas {{ currentUser.name }}</p> -->
    </div>
</template>

<script>


import IndexAdmin from "./role/admin/Admin.vue";
import IndexManager from "./role/manager/Manager.vue";
import IndexWorker from "./role/worker/Worker.vue";

export default {
    mounted() {
        // console.log(this.$store.state.auth.role);
        console.log("Component mounted.");
    },

    data() {
        return {
            role: "",
        }
    },
    computed: {

        currentUser: {
            get() {
                return this.$store.state.auth.user;
            }
        },

        // role: function () {
        //     return this.currentUser;
        // }
    },
    // watch: {
    //     role: function() {
    //         this.
    //     }
    // },
    created() {
        axios.interceptors.response.use(function (response) {


            return response;
        }, function (error) {
            // Any status codes that falls outside the range of 2xx cause this function to trigger
            // Do something with response error
            // console.log(error.response);
            if (error.response.status == 401) {
                localStorage.removeItem('token');
                this.$router.go('/login');
            }
            return Promise.reject(error);
        });
        axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('token');
        axios.get('/api/auth/user')
        .then(response => {
            // console.log(response.data);
            this.role = response.data.user.role;
        })


    },

    components: {
        IndexAdmin,
        IndexManager,
        IndexWorker,
    },
};
</script>

<style >

    .alert-error{
        color: red;
    }

</style>
