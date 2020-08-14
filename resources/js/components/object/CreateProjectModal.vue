<template>
   <transition name="modal">

        <div class="modal-mask">

                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" v-on:submit.prevent="createProject" >
                                <div class="modal-header">
                                    <slot name="header">Creater Project </slot>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Project name</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" v-model="project.project_name" placeholder="Name...." required />
                                            <div class="alert-error" role="alert" v-if="error && errors.project_name">
                                                {{errors.project_name[0]}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Manager</label>
                                        <div class="select col-md-6">
                                            <select class="custom-select" v-model="project.manager">
                                                <option selected disabled>Choose...</option>
                                                <option v-for="manager in managers"
                                                    v-bind:key="manager.id"
                                                    v-bind:value="manager.id"
                                                >{{ manager.name }}</option>
                                            </select>
                                            <div class="alert-error" role="alert" v-if="error && errors.manager">
                                                {{errors.manager[0]}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Number workers</label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" min=1 v-model="project.number_worker" placeholder="Number...." required />
                                        </div>
                                        <div class="alert-error" role="alert" v-if="error && errors.number_worker">
                                            {{errors.number_worker[0]}}
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">From date</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" v-model="project.from_date" placeholder="From date...." required />
                                        </div>
                                        <div class="alert-error" role="alert" v-if="error && errors.from_date">
                                            {{errors.from_date[0]}}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">To date</label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" v-model="project.to_date" placeholder="To date...." required />
                                            <div class="alert-error" role="alert" v-if="error && errors.to_date">
                                                {{errors.to_date[0]}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Time checkin</label>
                                        <div class="col-md-6">
                                            <input type="time" class="form-control" v-model="project.time_checkin" placeholder="To date...." required />
                                        </div>
                                        <div class="alert-error" role="alert" v-if="error && errors.time_checkin">
                                            {{errors.time_checkin[0]}}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right">Time checkout</label>
                                        <div class="col-md-6">
                                            <input type="time" class="form-control" v-model="project.time_checkout" placeholder="To date...." required />
                                            <div class="alert-error" role="alert" v-if="error && errors.time_checkout">
                                                {{errors.time_checkout[0]}}
                                            </div>
                                        </div>
                                    </div>

                                    <GoogleMap v-on:set-location="updateLocation" />
                                    <div class="alert-error" role="alert" v-if="error && errors.time_checkout">
                                        {{errors.location_name[0]}}
                                    </div>
                                    <!-- <div class="form-group">
                                        <label> Location </label>
                                        <input type="text" class="form-control" v-model="project.location_name" placeholder="To date...." required />
                                    </div>
                                    <div class="alert-error" role="alert" v-if="error && errors.time_checkout">
                                        {{errors.time_checkout[0]}}
                                    </div> -->



                                </div>


                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary">Create</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close-project-create')">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
      </transition>
</template>

<script>
import GoogleMap from "../GoogleMap";
 export default {
    data() {
        return {
            // showModal: false,
            project: {
                project_name: "",
                number_worker: 0,
                manager: undefined,
                from_date: undefined,
                to_date: undefined,
                time_checkin: undefined,
                time_checkout: undefined,
                location_name: "",
                lat: 0.00,
                lng: 0.00,
                place_id: "",
            },

            managers: null,
            error: false,
            errors: {},
        }
    },
    methods: {
        // show() {
        //     this.showModal = true
        // },
        // hide(){
        //     this.showModal = false
        // },

        createProject() {
            // console.log(this.project);
            axios.post("/api/admin/project", {
                project_name: this.project.project_name,
                number_worker: this.project.number_worker,
                manager: this.project.manager,
                from_date: this.project.from_date,
                to_date: this.project.to_date,
                time_checkin: this.project.time_checkin,
                time_checkout: this.project.time_checkout,
                location_name: this.project.location_name,
                lat: this.project.lat,
                lng: this.project.lng,
                place_id: this.project.place_id,
            })
            .then(response => {
                //save token
                // console.log(response.data.user);
                this.error =  false;
                this.$emit('close-project-create');
            })
            .catch(error =>  {
                // handle error
                // console.log('ssssssssssssssssss');
                this.error = true;
                this.errors = error.response.data.error;
                // console.log(error.response.data.error);
            })
        },
        updateLocation: function(place) {
            // console.log(this.project);
            this.project.location_name = place.formatted_address;
            this.project.lat = place.geometry.location.lat();
            this.project.lng = place.geometry.location.lng();
            this.project.place_id = place.place_id;

            // console.log(this.project);
        },

        getManagers: function() {
            axios.get('api/admin/project/manager')
            .then(response => {

                this.managers = response.data.users;
                // console.log(this.managers);
            })
        }


    },
    created() {
        this.getManagers() ;
    },

    components: {
        GoogleMap,
    }



 }
</script>
<style >
.modal-mask {
  position: fixed;
  z-index: 800;
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
  z-index: 800;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  z-index: 800;
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


#pac-container {
    z-index: 999 !important;

}
.modal {
    z-index: 998 !important;
}

.modal-backdrop {
    z-index: 39;
}

</style>
