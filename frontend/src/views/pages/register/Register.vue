<!-- =========================================================================================
    File Name: Register.vue
    Description: Register Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
<div>

    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">

	
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row no-gutter">
                        <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                            <img src="@/assets/images/pages/register.jpg" alt="register" class="mx-auto">
                        </div>
                        
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center  d-theme-dark-bg">
                            <div class="px-8 pt-8 register-tabs-container">
                                <div class="vx-card__title mb-4">
                                    <h4 class="mb-4">Create Account</h4>
                                    <p v-if="startTrial == true">Start your {{cartDatas.description}}.</p>
                                    <p v-else>{{cartDatas.heading}} Plan (Monthly Price : ${{cartDatas.price}} )</p>
                                </div>
                                <vs-tabs>
                                  <vs-tab label="Register">
                                    <register-jwt></register-jwt>
                                  </vs-tab>

                                  <!-- <vs-tab label="Firebase">
                                    <register-firebase></register-firebase>
                                  </vs-tab>

                                  <vs-tab label="Auth0">
                                    <register-auth0></register-auth0>
                                  </vs-tab> -->
                                </vs-tabs>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
    </div>
</template>

<script>
import RegisterJwt from './RegisterJWT.vue'
import RegisterFirebase from './RegisterFirebase.vue'
import RegisterAuth0 from './RegisterAuth0.vue'
import {siteIndexURL} from '../../../axios'
import axios from 'axios';
export default {
  name:'auth-register',
  components: {
    RegisterJwt,
    RegisterFirebase,
    RegisterAuth0
  },data() {
    return {
      startTrial:true,
      showMobileMenu:false,
      menusList:[],
      profile:{},
    }
  }, methods: {
    redirectPage($page = '/'){
      this.$router.push($page).catch(() => {})
    },
    logoutSession()
    {
      this.$session.start()      
      this.$session.set('access', '');
      this.$session.set('refresh', '');
      this.$session.set('profile', '');
      this.$session.set('cart', '');
      this.$session.set('tenant_id', '');
      window.location.reload();
    },
    getMenus: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/menus')
      .then((result)=>{
        if (result.data.status == true) {
          this.menusList = result.data.response.menus;
        }
      }).catch(function (error) {
        if (error.response != undefined) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          } 
        }        
      });
    },
    showMenu(){
    	if(this.showMobileMenu == true){
    		this.showMobileMenu = false
    	} else {
    		this.showMobileMenu = true
    	}
    },
    responseHandle: function(type = 'warning', message = '')
    {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    }
  },
  beforeMount() { 
    this.$session.start();
    this.profile = this.$session.get('profile');
    this.getMenus();
    this.cartDatas = this.$session.get('cart');
    this.free_trial = this.$session.get('free_trial');

    if(this.free_trial=='paid'){
      this.startTrial = false;
    }

    if (!this.cartDatas) {
      this.$router.push('/front/plans')
    }		  
  }
}
</script>

<style lang="scss">
.register-tabs-container {
  min-height: 517px;

  .con-tab {
    padding-bottom: 23px;
  }
}
</style>

