<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
<div>
  
  <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">

          <div class="vx-row no-gutter justify-center items-center">

            <div class="vx-col hidden lg:block lg:w-1/2 login_img">
              <img src="@/assets/images/pages/login_main.jpg" alt="login" class="mx-auto">
            </div>

            <div class="vx-col sm:w-full md:w-full lg:w-1/2 d-theme-dark-bg">
              <div class="p-8 login-tabs-container">

                <div class="vx-card__title mb-4">
                  <h4 class="mb-4">Login</h4>
                  <p>Welcome back, please login to your account.</p>
                </div>

                <div>
                  <form autocomplete="off">
                  <vs-input
                      name="email"
                      icon-no-border
                      icon="icon icon-user"
                      icon-pack="feather"
                      label="Email"
                      v-model="username"
                      placeholder="Enter Email"
                      class="w-full"  @change="emailChange()"/>

                  <vs-input
                      type="password"
                      name="password"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      label="Password"
                      placeholder="Enter Password"
                      v-model="password"
                      class="w-full mt-6" />
                  <div class="flex flex-wrap justify-between my-5">
                      <vs-checkbox v-model="checkbox_remember_me" @click="rememberme" class="mb-3">Remember Me</vs-checkbox>
                      <router-link to="/auth/forgot/password">Forgot Password?</router-link>
                  </div>
                  <div class="flex flex-wrap justify-between mb-3">
                    <vs-button  type="border" @click="registerUser">Register</vs-button>
                    <vs-button @click="requestSignIn" :disabled="loginBtn">Login</vs-button>
                  </div>
                </form>
                </div>
                <vs-popup classContent="popup-example" class="company-login-popup" title="Please Select Company For Login Fleet" :active.sync="companyPopup">
                    <transition-group class="company-list" tag="ul" appear>
                      <li
                        class="cursor-pointer company-login-item p-4"
                        v-for="(company, index) in companies"
                        :key="index"
                        @click="setTenantId(company.tanant_id)"
                      >
                        <div>{{ company.company_name ? company.company_name : 'Fleet Admin' }}</div>
                      </li>
                    </transition-group>
                </vs-popup>
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
  import { siteIndexURL } from '@/axios'
  import axios from 'axios';
  
  export default{
    name:'AmcCategory',
    data:() =>({
      username:'',
      password:'',
      checkbox_remember_me: false,
	    showMobileMenu:false,
      menusList:[],
      profile:{},
      tenant_id:'fleet_admin',
      companyPopup: false,
      companies:[],
      loginBtn : true
    }),
    methods:{
	    emailChange(){
          this.loginBtn = true
          this.companyPopup = false
          var dataString = {
            email: this.username,          
          };
          this.$session.start()  
          this.$session.set('tenant_id', 'fleet_admin');    
          var $this = this;
          axios.post(siteIndexURL+'/v1/login/verifyEmail',dataString)
          .then((result)=>{
            if (result.data.status == true) {
              if(result.data.response.length > 1){
                this.companies = result.data.response;
                this.companyPopup = true
              }else{
                this.tenant_id = result.data.response[0].tanant_id;
                this.$session.set('tenant_id', this.tenant_id);
                this.loginBtn = false;
				
              }
            }else{
				this.companies = [];					
				 $this.responseHandle('warning', result.data.message);
            }
          }).catch(function (error) {
            if (error.response !== undefined) {
              if (error.response.data.message) {
                $this.responseHandle('warning', error.response.data.message);
              } 
            }        
          });
      },
      rememberme(){
            const rmCheck = this.checkbox_remember_me;
            this.email = this.email;
            if(localStorage.checkbox && localStorage.checkbox !== "") {
            rmCheck.setAttribute("checked", "checked");
            this.email = localStorage.email;
            } else {
            rmCheck.removeAttribute("checked");
            this.email = "";
            }
        if(this.rmCheck.checked && this.email.value !== "") {
              localStorage.email = this.email.value;
              localStorage.checkbox = rmCheck.value;
        } else {
              localStorage.email = "";
              localStorage.checkbox = "";
        }
      },
      redirectPage($page = '/'){
        this.$router.push($page).catch(() => {})
      },
      logoutSession()
      {
        this.$session.start()      
        this.$session.set('access', '');
        this.$session.set('refresh', '');
        this.$session.set('profile', '');
        this.$session.set('tenant_id', '');
        this.$session.set('cart', '');
        this.$session.set('free_trial', '');
        window.location.href = '/auth/login';
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
      requestSignIn: function(){
        var $this = this;
        if (!this.username) {
          $this.responseHandle('warning', 'Username is required.');
          return false;
        } else if (!this.password) {
          $this.responseHandle('warning', 'Password is required.');
          return false;
        }
        
        var dataString = {
          email: this.username,
          password: this.password,
          tenant_id: this.tenant_id,
        };
		
        axios.post(siteIndexURL+'/v1/login', dataString)
        .then((result)=>{
          if (result.data.status == 'success') {
            this.$session.start(); 
            this.$session.set('access', result.data.data.access_tokens);
            this.$session.set('refresh', result.data.data.refresh_token);
            this.$session.set('profile', result.data.data.user);
            $this.responseHandle('success', 'Login successfully');
			      window.location.href="/home";
          } else {           
            $this.responseHandle('warning', result.data.message);
          }
        }).catch(function (error) {
			     $this.loginBtn = true;
          if (error.response != undefined) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            } 
            if (error.response.data.username) {
              $this.responseHandle('warning', error.response.data.username[0]);
            } 
            if (error.response.data.password) {
              $this.responseHandle('warning', error.response.data.password[0]);
            }
			
          }
		 
        });
      },
      setTenantId(tenant_id){
        this.tenant_id = tenant_id;
        this.$session.set('tenant_id', tenant_id);
        this.companyPopup = false;
        this.loginBtn = false;
      },
      registerUser () {
        this.$router.push('/auth/register').catch(() => {})
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
    if(this.profile){
      this.$router.push('/home').catch(() => {})
    }
    this.getMenus();
  }
  }
</script>

<style lang="scss">
  .company-login-popup i.vs-icon.notranslate.icon-scale.vs-popup--close.vs-popup--close--icon.material-icons.null {
    display: none;
  }
</style>