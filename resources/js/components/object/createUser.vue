<template>
    <div v-if="myModel">
        <transition name="model">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="myModel=false">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">{{ dynamicTitle }}</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                            <label>Enter First Name</label>
                            <input type="text" class="form-control" v-model="first_name" />
                            </div>
                            <div class="form-group">
                            <label>Enter Last Name</label>
                            <input type="text" class="form-control" v-model="last_name" />
                            </div>
                            <br />
                            <div align="center">
                            <input type="hidden" v-model="hiddenId" />
                            <input
                                type="button"
                                class="btn btn-success btn-xs"
                                v-model="actionButton"
                                @click="submitData"
                            />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </transition>
    </div>
</template>
