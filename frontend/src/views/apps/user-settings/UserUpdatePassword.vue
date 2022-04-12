<template>
  <vx-card no-shadow>
    <h6>Update Password</h6>
        <form v-on:submit.prevent>
    <vs-input type="password" class="w-full mt-12" icon-pack="feather" icon="icon-lock" icon-no-border label-placeholder="Password" v-validate="'required|min:6'" ref="password" name="password" v-model="password"></vs-input>
    <span class="text-danger text-sm">{{ errors.first('password') }}</span>
    <vs-input type="password" class="w-full mt-8" icon-pack="feather" icon="icon-lock" icon-no-border label-placeholder="Confirm Password" v-validate="'required|min:6|max:10|confirmed:password'" name="conf_password" v-model="conf_password"></vs-input>
    <span class="text-danger text-sm">{{ errors.first('conf_password') }}</span>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end mt-4">
      <vs-button class="ml-auto" @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4" type="border" color="warning">Reset</vs-button>
    </div>
      </form>
  </vx-card>
</template>

<script>
import { siteIndexURL } from '@/axios'
import axios from 'axios';
export default {
    data () {
        return {
          userId:'',
          activeName:'',
          password : '',
          conf_password : ''
        }
    },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    saveForm: function(){
      this.$validator.validateAll().then(result => {
        if (result) {            
          let userId = this.userId;
        
          var $this = this
          if (userId) {
            var formData = new FormData();
            formData.append("password", $this.password);
            formData.append("password_confirmation", $this.conf_password );
            formData.append("type", 'password');
            formData.append("_method", 'PUT');
            formData.append("user_id", userId);
			
            axios.post(siteIndexURL+"/v1/users/"+userId, formData)
            .then( result => {
              if (result.data.status == true) {
                this.responseHandle('success', result.data.message);
                this.$router.replace({ name: $this.activeName, params: {userID:userId}, query: {activeTab: 4} });
                // this.$emit('nextActiveTab', 4);
                this.$router.push('/users')
              }
            }).catch(function (error) {
              if (error.response) {
                this.responseHandle('warning', error.response.data.message);
              }
            });
          }
        } else {        
          this.responseHandle('warning', 'Please solve errors');
        }
      })
      
    },
	  responseHandle: function (type = 'warning', message = '') {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    },
    },
  beforeMount() {
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
}
</script>
