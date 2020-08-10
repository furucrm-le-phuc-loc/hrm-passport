<template>
  <mdb-datatable-2 v-model="data" />
</template>

<script>
  import { mdbDatatable2 } from 'mdbvue';
  export default {
    name: 'DatatablePage',
    components: {
      mdbDatatable2
    },
    data() {
      return {
        data: {
          columns: [
            {
              label: 'Name',
              field: 'name',
              sort: true
            },
            {
              label: 'Manage by',
              field: 'manage',
              sort: true
            },
            {
              label: 'Number',
              field: 'number',
              sort: true
            },
           {
              label: 'From date ',
              field: 'fdate',
              sort: true
            },
            {
              label: 'To date ',
              field: 'date',
              sort: true
            },
            {
              label: 'Location ',
              field: 'location',
              sort: true
            },
            {
              label: 'Action',
              field: '',
              sort: true
            },
         
          ],
          rows: [
            {
              name: 'Tiger Nixon',
              manage: 'System Architect',
              number: '61',
              fdate: '1/1/2011',
              date:'2/2/2022',
              location:'Can Tho'
             
            },
              {
              name: 'Tiger Nixon',
              manage: 'System Architect',
              number: '61',
              fdate: '1/1/2011',
              date:'2/2/2022',
              location:'Can Tho'
             
            },
             
          
            {
              name: 'Donna Snider',
              position: 'Customer Support',
              office: 'New York',
              age: '27',
              date: '2011/01/25',
              salary: '112'
            }
          ]
        }
      }
    }
  }
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap');

</style>
