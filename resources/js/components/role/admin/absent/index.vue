<template>
    <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Absent Application admin</h2>

        <ModalShowAbsent
            v-if="showModalAbsent"
            @close-show-absent="showModalAbsent = false"
            v-bind:absent_id="absent_id"
        />

        <ModalRejectAbsent
            v-if="showModalRejectAbsent"
            @close-show-absent="showModalRejectAbsent = false"
            v-bind:absent_id="absent_id"
            v-bind:user_id="user_id"
            v-on:reject-click="rejectAbsent"
        />

        <table class="table table-bordered" id width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Date off</th>
                <th>Number days off</th>
                <th>Created At</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Date off</th>
                <th>Number days off</th>
                <th>Created At</th>
                <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="absent in absents" :key="absent.id">
                    <td>{{absent.user.name}}</td>
                    <td>{{absent.user.role}}</td>
                    <td>{{absent.date_off}}</td>
                    <td>{{absent.number_off}}</td>
                    <td>{{absent.created_at}}</td>
                    <td>
                        <button class="btn btn-primary btn-user-edit"
                            @click="showAbsentModal(absent.id)"
                            >
                        <i class="fa fa-edit" alt="Edit" aria-hidden="true"></i>
                        </button>

                        <a
                            type="button"
                            class="btn btn-primary btn-user-delete"
                            v-if="absent.state !== 2"
                            v-on:click="approveAbsent(absent.id, absent.user.id)"
                        >

                            <i class="fa fa-thumbs-up"></i>
                        </a>
                        <a
                            type="button"
                            class="btn btn-primary btn-user-delete"
                            v-if="absent.state !== 2"
                            v-on:click="showRejectAbsentModal(absent.id, absent.user.id)"
                        >

                           <i class="fa fa-thumbs-down"></i>
                        </a>

                    </td>
                </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
import ModalShowAbsent from '../../../object/ShowAbsentModal.vue';
import ModalRejectAbsent from '../../../object/RejectAbsentModal.vue';

export default {
    data() {
        return {
            showModalAbsent: false,
            showModalRejectAbsent: false,
            absents: {},
            absent: {},
            absent_id: null,
            user_id: null,
        };
    },

    created() {
        this.getAbsents();
    },
    methods: {
        getAbsents: function () {
            axios.get("/api/admin/absent").then((response) => {
                //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
                //   console.log(response.data.absents);
                // console.log("updaasdfghjk");
                this.absents = response.data.absents;
            });
        },

        approveAbsent: function(absent_id, user_id) {
            console.log("approve");
            axios.post("/api/admin/absent/approve/" + absent_id, {
                user_id: user_id,
            })
            .then((response) => {
                alert('approve successfully');
                this.getAbsents();
                //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
                //   console.log(response.data.absents);
                // console.log("updaasdfghjk");
                // this.absents = response.data.absents;
            });
        },

        rejectAbsent: function(data) {

            axios.post("/api/admin/absent/reject/" + data.absent_id, {
                user_id: data.user_id,
                content: data.content,
            })
            .then((response) => {
                alert('reject successfully');
                console.log("reject");
                this.showModalRejectAbsent = false;
                this.getAbsents();
                //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
                //   console.log(response.data.absents);
                // console.log("updaasdfghjk");
                // this.absents = response.data.absents;
            });
        },

        showAbsentModal: function(id) {
            // console.log("show content");
            this.absent_id = id;
            this.showModalAbsent = true;

        },

        showRejectAbsentModal: function(absent_id, user_id) {
            // console.log(user_id);
            this.absent_id = absent_id;
            this.user_id = user_id;
            this.showModalRejectAbsent = true;
        },

    },
    components: {
        ModalShowAbsent,
        ModalRejectAbsent,
        // modalUpdateUser,
    }
}
</script>

<style>

</style>
