<template>
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="mb-4">Sidebar #05</h2>
    <p>Admin User</p>
     <b-table striped hover :items="items"></b-table>
  </div>
</template>

<script>
export default {
    data() {
      return {
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
      }
    }
  }
</script>

<style>
</style>
