<template>
   <transition name="modal">
        <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <slot name="header">Creater User </slot>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Enter Name</label>
                                    <input type="text" class="form-control" placeholder="Name...." required />
                                </div>
                                <div class="form-group">
                                    <label>Enter Email</label>
                                    <input type="email" class="form-control" placeholder="Email...." required />
                                </div>
                                <div class="form-group">
                                    <label>Enter Password</label>
                                    <input type="password" class="form-control" placeholder="Password...." required />
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <div class="select">
                                        <select class="custom-select" >
                                            <option selected>Choose...</option>
                                            <option value="manager">Manager</option>
                                            <option value="worker">Worker</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary">Create</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$emit('close')">Close</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
      </transition>
</template>

<script>
 export default {
   data() {
     return {
      showModal: false
     }
   },
   methods: {
     show() {
      this.showModal = true
     },
     hide(){
      this.showModal = false
     }
   }
 }
</script>
<style >
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

</style>
