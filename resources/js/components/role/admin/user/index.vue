<template>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Sidebar #05</h2>
        <div id="app">
            <i class="fas fa-table mr-1"></i>List
            <button style="float: right;" @click="showModal = true">Show Modal</button>
            <modal v-if="showModal" @close="showModal = false">
                <h3 slot="header">Create</h3>
            </modal>
        </div>

        <table class="table table-bordered" id width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.role}}</td>
                    <td>
                        <div >
                             <button style="float: right;" @click="showModal1 = true">Show Modal</button>
                                <modal v-if="showModal1" @close="showModal1 = false">
                                    <h3 slot="header">Edit</h3>
                                </modal>
                            <button class="btn btn-primary btn-user-edit">
                            <i class="fa fa-edit" alt="Edit" aria-hidden="true"></i>
                            </button>
                            <a
                        type="button"
                        class="btn btn-primary btn-user-delete"
                        v-on:click="deleteUser(user.id)"
                        >
                        <i class="fa fa-trash" alt="Delete" aria-hidden="true"></i>
                        </a>
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import modal from '../../../object/createUser.vue'

export default {
    components:{modal},
    data() {
        return {
            show:false,
            users: {},
            showModal: false,
            showModal1:false,
        };
        },

        created() {
            this.getUsers();
        },

    methods: {
        // Get user
        getUsers: function () {
        axios.get("/api/admin/user").then((response) => {
            //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
            //   console.log(response.data.users);
            this.users = response.data.users;
        });
        },
        // Delete User
        deleteUser: function (id) {
        axios.delete("/api/admin/user/" + id).then((reponse) => {
            this.getUsers();
            alert("User was deleted");
        })
        },

  }



};
</script>

<style>
</style>
