<template>
  <vs-tabs v-model="activeTab" :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">

    <!-- GENERAL -->
      <vs-tab icon-pack="feather" icon="icon-user" :label="!isSmallerScreen ? 'Basic Information' : ''">
        <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
          <basic-information @nextActiveTab="nextActiveTab($event)" />
        </div>
      </vs-tab>
      <vs-tab icon-pack="feather" icon="icon-lock" :label="!isSmallerScreen ? 'User Management' : ''">
        <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
          <user-management @nextActiveTab="nextActiveTab($event)" />
        </div>
      </vs-tab>
      <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'Contact Information' : ''">
        <div class="tab-info md:ml-4 md:mt-0 mt-4 ml-0">
          <user-contact-info @nextActiveTab="nextActiveTab($event)" />
        </div>
      </vs-tab>
      <vs-tab icon-pack="feather" icon="icon-github" :label="!isSmallerScreen ? 'Personal Information' : ''">
        <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
          <user-personal-information @nextActiveTab="nextActiveTab($event)" />
        </div>
      </vs-tab>
   
    <vs-tab icon-pack="feather" icon="icon-github" :label="!isSmallerScreen ? 'Password Updation' : ''">
        <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
          <user-update-password  @nextActiveTab="nextActiveTab($event)" />
        </div>
      </vs-tab>
    
  </vs-tabs>
</template>

<script>
  import BasicInformation from './BasicInformation.vue';
  import UserManagement from './UserManagement.vue';
  import UserContactInfo from './UserContactInfo.vue';
  import UserPersonalInformation from './UserPersonalInformation.vue';
  import UserUpdatePassword from './UserUpdatePassword.vue';

  export default {
    components: {
      BasicInformation,
      UserManagement,
      UserContactInfo,
      UserPersonalInformation,
      UserUpdatePassword
    },
    data () {
      return {
        activeTab:0,	
        basic:'',
        userId : '',
        checkUserId : true
      }
    },
    methods: {
      responseHandle: function (type = 'warning', message = '') {
        this.$vs.notify({
          color: type,
          title: '',
          text: message
        })
      },
      nextActiveTab: function(action)
      {
        this.activeTab = action;  
        this.checkUserData();
      },
      checkUserData(){
        let currentRoute = this.$router.currentRoute;   
        var user_id = currentRoute.params.userID;
        if(user_id && user_id != undefined){
          this.userId = user_id
          this.checkUserId = true
        }else{
          this.checkUserId = false
        }
      }
    },
    computed: {
      isSmallerScreen () {
        return this.$store.state.windowWidth < 768
      },
      activeUserInfo () {
        return this.$store.state.AppActiveUser
      }
    },
    beforeMount() {
      if(this.$route){
        this.activeTab = this.$route.query.activeTab;
      }
      this.checkUserData();
      
    }
}
</script>

<style lang="scss">
#profile-tabs {
  .vs-tabs--content {
    padding: 0;
  }
}
</style>
