<template>
  <div class="the-navbar__user-meta flex items-center" v-if="activeUserInfo.displayName">

    <div class="text-right leading-tight hidden sm:block">
     
      <small>{{profile.name}}</small>
    </div>

    <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">

      <div class="con-img ml-3">
        <img v-if="activeUserInfo.photoURL" key="onlineImg" :src="'/img/dummy-person.png'" alt="user-img" width="40" height="40" class="rounded-full shadow-md cursor-pointer block" />
      </div>

      <vs-dropdown-menu class="vx-navbar-dropdown">
        <ul style="min-width: 9rem">

          <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white" @click="viewProfile" v-if='tenant_id != "fleet_admin"'>
            <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">Profile</span>
          </li>
          <vs-divider class="m-1" />

          <li
            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
            @click="logout">
            <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
            <span class="ml-2">Logout</span>
          </li>
        </ul>
      </vs-dropdown-menu>
    </vs-dropdown>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tenant_id:'',
      profile: {
        name:'',
        email:''
      }
    }
  },
  computed: {
    activeUserInfo() {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    logout() {
      this.$session.start()      
      this.$session.set('access', '');
      this.$session.set('refresh', '');
      this.$session.set('profile', '');
      this.$session.set('cart', '');
      this.$session.set('tenant_id', '');
      this.$session.set('free_trial', '');
      this.$router.push('/auth/login').catch(() => {});
    },
    viewProfile() {
      this.$router.push('/auth-profile').catch(() => {})
    }
  },
  mounted() {
    this.$session.start()   
    this.profile = this.$session.get('profile');
    this.tenant_id = this.$session.get('tenant_id');
    if (this.$session.get('access') == undefined || !this.$session.get('access')) {
      this.$router.push('/').catch(() => {})
    }
  }
}
</script>
