<template>
  <vx-card no-shadow>
    <h6 class="mb-4">User Management</h6>
    <form v-on:submit.prevent>
<div class="flex items-center mb-4">
        <vs-switch v-model="user_management.enable" />
        <span class="ml-4">Enable User</span>
        Enables login access and permissions
      </div>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
    </form>
  </vx-card>
</template>

<script>
import { siteIndexURL } from '../../../axios'
import axios from 'axios';
export default {
 
    data () {
      return {
				userId:'',
				activeName:'',				
				user_management: {
					type: Object,
					default: () => ({}),
					enable:''
				}
      }
    },
    methods: {
      saveForm: function(){
        var $this = this
        let userid = this.userId;
        var formData = new FormData();
        formData.append("enable", $this.user_management.enable);
        formData.append("type", 'user_management');
        formData.append("_method", 'PUT');
        formData.append("user_id", userid);
      
        if (userid) {
          axios.post(siteIndexURL+"/v1/users/"+userid, formData)
          .then( result => {
    
            if (result.data.status == true) {
              $this.responseHandle('success', result.data.message);
              $this.$router.replace({ path: '/users/edit/'+userid, params: {userID:userid}, query: {activeTab: 2} }).catch(()=>{});
              this.$emit('nextActiveTab', 2);
            }
          }).catch(function (error) {
            if (error.response) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
        }else {
          $this.responseHandle('warning', 'Please Create First Basic Information');
        }
      
      },
      responseHandle: function (type = 'warning', message = '') {
        this.$vs.notify({
          color: type,
          title: '',
          text: message
        })
      },
	    getUserDetail: function (userID = null)
      {
        var $this = this;
        var userDataUrl = userID ? siteIndexURL+'/v1/users/'+userID+'/edit' : siteIndexURL+'/v1/users/show';
        axios.get(userDataUrl).then((result)=>{
          if (result.data.status == true) {         
            this.user_management = result.data.response.user.user_management;
          }
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
      },
      checkUserIdInRoute(){
        let currentRoute = this.$router.currentRoute; 
        var user_id = currentRoute.params.userID;
        if(user_id && user_id != undefined){
          this.userId = user_id
          this.activeName = this.$router.currentRoute.name;
          this.getUserDetail(user_id);
        }else{
          this.getUserDetail();
        }
      }
    },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeUpdate() {
    if(!this.userId){
      this.checkUserIdInRoute();
    }
  },
  beforeMount() {
    this.checkUserIdInRoute();
  }
}
</script>
