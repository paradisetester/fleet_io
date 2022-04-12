<template>
  <vx-card no-shadow>
    <h6 class="mb-4">User Management</h6>
<div class="flex items-center mb-4">
        <vs-switch v-model="comment" />
        <span class="ml-4">Enable User</span>
        Enables login access and permissions
      </div>

    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
  </vx-card>
</template>

<script>
export default {
  data () {
    return {
      comment: false,
      
      old_password: '',
      new_password: '',
      confirm_new_password: ''
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeMount() {
    
  }
}
</script>
