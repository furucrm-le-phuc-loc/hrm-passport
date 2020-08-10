<template>
<div id="content" class="p-4 p-md-5 pt-5">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <h2 class="mb-4">Sidebar #05</h2>
        <p> Admin Dashboard </p>

            <datatable
                title="List Users"
                :columns="tableColumns1"
                :rows="tableRows1"
                :clickable="false"
                :exportable="false"
                :printable="false"
            />
        </div>

</template>
<script>
    import DataTable from "vue-materialize-datatable";
    // import 'materialize-css';
    // import 'materialize-css/dist/css/materialize.css';
    export default {
        data() {
            return {
                list: [],
                tableColumns1: [
                {
                  label: "ID",
                  field: "id",

                },
                {
                  label: "Name",
                  field: "name",

                },
                {
                  label: "Email",
                  field: "email",

                },
                {
                  label: "Role",
                  field: "role",

                },
                {
                  label: "Action",
                  field: "action",

                }

              ],
              tableRows1: [
                {
                  id: "1",
                  name: "admin",
                  email: "admin@gmail.com",
                  role: "admin"
                },
                {
                  id: "2",
                  name: "A",
                  email: "a@gmail.com",
                  role: "manager"
                },
                {
                  id: "3",
                  name: "b",
                  email: "b@gmail.com",
                  role: "worker"
                },

              ],
            }
        },
        components: {
            "datatable": DataTable
        }
    }
</script>

<style>


</style>
