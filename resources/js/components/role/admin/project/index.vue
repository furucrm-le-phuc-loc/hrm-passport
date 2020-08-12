<template>
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #05</h2>
    <p>Admin User</p>
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
          <td>{{project.manager.name}}</td>
          <td>{{project.number_worker}}</td>
          <td>{{project.from_date}}</td>
          <td>{{project.to_date}}</td>
          <td>{{project.location.location_name}}</td>
          <td>
            <button class="btn btn-primary btn-user-edit">
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
            >
              <i class="fa fa-tasks" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    data() {
        return {
            projects: {},
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
};
</script>

<style>
</style>
