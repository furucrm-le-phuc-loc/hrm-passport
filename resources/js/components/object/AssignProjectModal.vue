<template>
   <transition name="modal">
        <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h2 v-bind:class="{active: isAssign}" v-on:click="assign"> Assign </h2>
                                    <h2 v-bind:class="{active: !isAssign}" v-on:click="assigned">Assigned </h2>
                                </div>


                                <form action="" v-if="isAssign" v-on:submit.prevent="assignWorkers">
                                    <div class="modal-body">
                                        <div class="wrapper" >
                                            <div id="">
                                                <!-- assign -->
                                                <ul class="list-group">

                                                    <li class="list-group-item"
                                                        v-for="worker in workersFree"
                                                        :key="worker.id">
                                                        <input type="checkbox"
                                                            v-model="checkedWorkers"
                                                            v-bind:value="worker.id"
                                                            id="workers-project">

                                                        {{ worker.name }}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" >Assign</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close-project-assign')">Close</button>
                                    </div>
                                </form>

                                <form action="" v-if="!isAssign" >
                                    <div class="modal-body">
                                    <div class="wrapper" >
                                            <div id="">
                                                <!-- assign -->
                                                    <ul class="list-group">

                                                        <li class="list-group-item d-flex justify-content-between align-items-center"
                                                            v-for="assignedWorker in assignedWorkers"
                                                            :key="assignedWorker.id">
                                                            {{ assignedWorker.name }}

                                                            <span>
                                                                <i class="fas fa-trash-alt"
                                                                    v-on:click="deleteAssigned(assignedWorker.id)"
                                                                ></i>
                                                             </span>

                                                        </li>

                                                    </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close-project-assign')">Close</button>
                                    </div>
                                </form>


                        </div>
                    </div>
                </div>
            </div>
      </transition>
</template>

<script>
 export default {
    props: {
        project_id: {
            type: Number
        }
    },
    data() {
        return {
            // showModal: false,
            isAssign: true,
            assignedWorkers: {},
            checkedWorkers: [],
            workers: {},
            error: false,
            errors: {},
        }
    },

    computed: {
        workersFree: function() {
            return Object.values(this.workers).filter(function(worker) {
                // console.log(worker[1].projects.length);
                return (worker.projects.length < 2) ? true : false;
                // if (worker.projects === undefined) return true;
                // else {
                //     return (worker.projects.length < 2) ? true : false;
                // }

            });
        }
    },
    methods: {
        // show() {
        //     this.showModal = true
        // },
        // hide(){
        //     this.showModal = false
        // },

        createUser() {
            axios.post("/api/admin/user", {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                role: this.user.role,
            })
            .then(response => {
                //save token
                // console.log(response.data.user);
                this.error =  false;
                this.$emit('close');
            })
            .catch(error =>  {
                // handle error
                // console.log('ssssssssssssssssss');
                this.error = true;
                this.errors = error.response.data.error;
                // console.log(error.response.data.error);
            })
        },

        getWorker: function() {
            axios.get("/api/admin/project/assign/" + this.project_id, {

            })
            .then(response => {
                //save token
                // console.log(response.data.workers);
                this.workers =  response.data.workers;
                console.log(typeof(this.workers));
            })

        },
        getAssignedWorker: function() {
            // console.log("mmmmmmmmmmmmmmmmmmmmmm");
            axios.get("/api/admin/project/assigned/" + this.project_id, {

            })
            .then(response => {
                //save token
                // console.log("mmmmmmmmmmmmmmmmmmmmmm");
                // console.log(response.data.project.users);
                this.assignedWorkers =  response.data.project.users;
            })

        },

        assign: function() {
            this.isAssign = true;
            // console.log((this.workersFree));
        },

        deleteAssigned: function(id) {
            // console.log("delete user id " + id);
            if (confirm("are you sure delete this worker!!")) {
                axios.delete("/api/admin/project/assigned/" + this.project_id, {
                    data: {
                        user_id: id,
                    }
                })
                .then(response => {
                    alert('delete successfull!!!');
                    this.getWorker();
                    this.getAssignedWorker();
                })
            }

        },

        assignWorkers: function() {
            // console.log(this.checkedWorkers);
            axios.post("/api/admin/project/assign/" + this.project_id, {
                workers: this.checkedWorkers,
            })
            .then(response => {
                //save token
                console.log(this.workers);
                this.getAssignedWorker();
                this.getWorker();
                this.isAssign = false;
            })

        },

        assigned: function() {
            this.isAssign = false;
        }
    },

    created() {
        this.getWorker();
        this.getAssignedWorker();
    }


 }
</script>
<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }
    input[type=text],[type=email],[type=password] {
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size:16px;
        background-color: white;
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px;
    }
    .custom-select{
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size:16px;
        background-color: white;
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 4px 20px 12px;
    }

    /*
    * The following styles are auto-applied to elements with
    * transition="modal" when their visibility is toggled
    * by Vue.js.
    *
    * You can easily play with the modal transition by editing
    * these styles.
    */

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

/* --------------------------------------------------------- */
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

    html {
        background-color: #44475f;
    }

    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
    }

    a {
        color: #92badd;
        display:inline-block;
        text-decoration: none;
        font-weight: 400;
    }

    h2 {
        cursor: pointer;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        text-transform: uppercase;
        display:inline-block;
        margin: 40px 8px 10px 8px;
        color: #cccccc;
    }



    /* TABS */

    h2.inactive {
        color: #cccccc;
    }

    h2.active {
        color: #0d0d0d;
        border-bottom: 2px solid #5fbae9;
    }

    .fa-trash-alt{
        cursor: pointer;
    }

    /* FORM TYPOGRAPHY*/



</style>
