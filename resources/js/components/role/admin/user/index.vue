<template>
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #05</h2>
    <p>Admin User</p>
    <table class="table table-bordered" id width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Manager By</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Manager By</th>
          <th>Actions</th>
        </tr>
      </tfoot>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>
            <button
            >
              <i class="fa fa-edit" alt="Edit" aria-hidden="true"></i>
            </button>
            <a

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
        }
    },

    created() {
        axios.get('/api/admin/user')
        .then(response => {
            console.log(response.data.users);
            this.users = response.data.users;
        });
    }
};
</script>

<style>
</style>
