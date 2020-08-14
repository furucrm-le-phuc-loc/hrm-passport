<template>
   <transition name="modal">

        <div class="modal-mask">

                <div class="modal-wrapper modal" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <slot name="header">Reject Absent </slot>
                            </div>
                            <div class="modal-body">



                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Reason</label>
                                    <div class="col-md-6">

                                        <textarea class="form-control"  v-model="reason" rows="10" columes="10"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary"
                                    v-on:click="reject">
                                Reject
                                </button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close-show-absent')">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </transition>
</template>

<script>
 export default {
    props: {
        absent_id: Number,
        user_id: Number,
    },
    created() {
        // this.getAbsent();
        // this.mapProject;
        // console.log(this.project);
        // console.log(absent_id);
    },
    data() {
        return {
            // showModal: false,
            reason: "",
        }
    },
    mounted() {
        // console.log(this.position);
    },
    methods: {

        reject: function() {

            this.$emit('reject-click', this.data)
        }

    },

    computed: {
        data: function() {
            return {
                absent_id: this.absent_id,
                user_id: this.user_id,
                content: this.reason,
            }
        }
    },


    components: {
    }



 }
</script>
<style >
.main {
  overflow: auto;
  background-color: #fff;
}

.main-text {
  height: 1000px;
}

.modal_open {
  position: fixed;
}

.modal-text {
  min-height: 400px
}

.modal-mask {
  position: fixed;
  z-index: 800;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
    z-index: 800;
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
  max-height: 600px;
  overflow-y: auto;
}

.modal-default-button {
  float: right;
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

.modal-body{
    overflow-y: auto;
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
