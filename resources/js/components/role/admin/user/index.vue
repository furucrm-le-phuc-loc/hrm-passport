<template>
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #05</h2>
    <p>Admin User</p>
    <!-- <input type="button" class="btn btn-success btn-xs" @click="openModel" value="Add" /> -->

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
      users: {},
    };
  },

  created() {
    this.getUsers();
  },
  methods: {
    getUsers: function () {
      axios.get("/api/admin/user").then((response) => {
        //     console.log('asdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
        //   console.log(response.data.users);
        this.users = response.data.users;
      });
    },
    deleteUser: function (id) {
      axios.delete("/api/admin/user/" + id).then((reponse) => {
        this.getUsers();
        alert("User was deleted");
      });
    },
  },
};
</script>

<style>
</style>
