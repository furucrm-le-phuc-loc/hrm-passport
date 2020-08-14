<template>
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Project Manager</h2>
    <button class="btn btn-primary" id="show-modal" @click="showModalCreateProject = true">Create Project</button>

    <!-- modal -->
    <ModalCreateProject
        v-if="showModalCreateProject"
        @close-project-create="showModalCreateProject = false"

    />

    <ModalUpdateProject
        v-if="showModalUpdateProject"
        @close-update-project="showModalUpdateProject = false"
        @refresh="getProjects"
        v-bind:project_id="project_id"
    />

    <ModalAssignProject
        v-if="showModalAssignProject"
        @close-project-assign="showModalAssignProject = false"
        v-bind:project_id="project_id"
    />

    <table class="table table-bordered" id width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Manager by</th>
          <th>Workers</th>
          <th>From date</th>
          <th>From to</th>
          <th>location</th>
          <th>Action</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Name</th>
          <th>Manager by</th>
          <th>Workers</th>
          <th>From date</th>
          <th>From to</th>
          <th>location</th>
          <th>Action</th>
        </tr>
      </tfoot>
      <tbody>
        <tr v-for="project in projects" :key="project.id">
          <td>{{project.project_name}}</td>
          <td>{{project.manager.name }}</td>
          <td>{{project.number_worker}}</td>
          <td>{{project.from_date}}</td>
          <td>{{project.to_date}}</td>
          <td>{{project.location.location_name}}</td>
          <td>
            <button class="btn btn-primary btn-user-edit"
                @click="showProjectUpdateModal(project.id)">
              <i class="fa fa-edit" alt="Edit" aria-hidden="true"></i>
            </button>
            <a
              type="button"
              class="btn btn-primary btn-user-delete"
              v-on:click="deleteProject(project.id)"
            >
              <i class="fa fa-trash" alt="Delete" aria-hidden="true"></i>
            </a>

            <a
              class="btn btn-primary btn-assign-project"
              role="button"
              v-on:click="showProjectAssignModal(project.id)"
            >
              <i class="fa fa-tasks" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
        <!-- <GoogleMap/> -->

  </div>
</template>

<script>
import GoogleMap from "../../../GoogleMap.vue";

import ModalCreateProject from '../../../object/CreateProjectModal.vue';
import ModalUpdateProject from '../../../object/UpdateProjectModal.vue';
import ModalAssignProject from '../../../object/AssignProjectModal.vue';

export default {
    data() {
        return {
            showModalCreateProject: false,
            showModalUpdateProject: false,
            showModalAssignProject: false,
            projects: {},
            project_id: null,
        };
    },

    created() {
        this.getProjects();
    },

    methods: {
        getProjects: function () {
            axios.get("/api/admin/project").then((response) => {
                //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
                //   console.log(response.data.users);
                this.projects = response.data.projects;
            });
            // console.log(this.projects);
        },



        showProjectUpdateModal: function (id) {
            this.project_id = id;
            // console.log(this.project);
            this.showModalUpdateProject = true
        },

        showProjectAssignModal: function (id) {
            this.project_id = id;
            // console.log(this.project);
            this.showModalAssignProject = true
        },

        deleteProject: function (id) {
            if (confirm("are you sure to delete")) {
                axios.delete("/api/admin/project/" + id).then((reponse) => {
                    this.getProjects();
                    alert("Project was deleted");
                });
            }

        },
    },
    components: {
        ModalCreateProject,
        ModalUpdateProject,
        ModalAssignProject,
        GoogleMap,

    }
};
</script>

<style>
</style>
