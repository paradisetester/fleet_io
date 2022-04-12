<!-- =========================================================================================
    File Name: ForgotPassword.vue
    Description: FOrgot Password Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col w-4/5 sm:w-4/5 md:w-3/5 lg:w-3/4 xl:w-3/5 mx-auto self-center">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row">
                        <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                            <img src="@/assets/images/pages/forgot-password.png" alt="login" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center d-theme-dark-bg">
                            <div class="p-8" v-if="startTrial == true">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">Recover your password</h4>
                                    <p>Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                </div>

                                <vs-input
                                  v-validate="'required|email'"
                                  data-vv-validate-on="blur"
                                  name="email"
                                  type="email"
                                  label-placeholder="Email"
                                  placeholder="Email"
                                  v-model="email"
                                  @input="emailChange($event)"
                                  class="w-full mt-6" />
                                <span class="text-danger text-sm">{{ errors.first('email') }}</span>
                                <vs-button type="border" to="/" class="px-4 w-full md:w-auto">Back To Login</vs-button>
                                <vs-button class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0"  @click="sendEmailOtp" :disabled="!validateFormEmail">Recover Password</vs-button>
                            </div>

                            <div class="clearfix" v-if="verifyOTP == true">

                                <vs-input
                                  v-validate="'required|numeric'"
                                  data-vv-validate-on="blur"
                                  name="email_otp"
                                  label-placeholder="OTP Code"
                                  placeholder="OTP Code"
                                  v-model="email_otp"
                                  class="w-full mt-6" />
                                <span class="text-danger text-sm">{{ errors.first('email_otp') }}</span>
                                <vs-button class="float-right mt-6" @click="otpVerify">Verify</vs-button>
                            </div>

                        <div class="p-8" v-if="newpassword == true">
                            <div class="vx-card__title mb-8">
                                <p>Please enter your new password.</p>
                            </div>
                            <vs-input type="password" label-placeholder="Password" name="password" v-validate="'required|min:6|max:10'" ref="password" v-model="password" class="w-full mb-6" />
                            <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                          <vs-input type="password" label-placeholder="Confirm Password" v-validate="'required|min:6|max:10|confirmed:password'" name="confirm_password" v-model="confirm_password" data-vv-as="password" class="w-full mb-8" />
                            <span class="text-danger text-sm">{{ errors.first('confirm_password') }}</span>

                              <div class="flex flex-wrap justify-between flex-col-reverse sm:flex-row">
                                  <vs-button type="border" to="/auth/login" class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto">Go Back To Login</vs-button>
                                  <vs-button class="w-full sm:w-auto" @click="Resetpassword" >Reset</vs-button>
                              </div>
                          </div>
                          <vs-popup classContent="popup-example" class="company-login-popup" title="Please Select Which Compnay Password You Want To Change" :active.sync="companyPopup">
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
            </vx-card>
        </div>
    </div>
</template>

<script>

import { siteIndexURL} from '@/axios'
import axios from 'axios';

export default {
    name:'auth-forgot-password',
    data () {
        return {
            email:'',
            verifyOTP:false,
            startTrial:true,
            newpassword:false,
            companyPopup:false,
            password:'',
            confirm_password:'',
            companies:[],
            email_otp: '',
            tenant_id: ''
        }
    },
    computed: {
      // validateForm () {
      //   return !this.errors.any() && this.password != '' && this.confirm_password != ''
      // },
      validateFormEmail () {
        return !this.errors.any() && this.email !== '' && this.tenant_id
      }
    },
    methods: {
      emailChange(email){
          this.startTrial = true;
          this.companyPopup = false
          this.newpassword = false
          this.verifyOTP = false
          this.tenant_id = '';
          var dataString = {
            email: email,          
          };
          this.$session.start()  
          this.$session.set('tenant_id', '');    
          var $this = this;
          axios.post(siteIndexURL+'/v1/login/verifyEmail',dataString)
          .then((result)=>{
            if (result.data.status == true) {
              if(result.data.response.length > 1){
                this.companies = result.data.response;
                this.companyPopup = true
              }else{
                this.companies = [];
                this.tenant_id = result.data.response[0].tanant_id;
                this.$session.set('tenant_id', this.tenant_id);
                // this.SendOTP(email);
              }
            }else{
                this.companies = [];
            }
          }).catch(function (error) {
            if (error.response !== undefined) {
              if (error.response.data.message) {
                $this.responseHandle('warning', error.response.data.message);
              } 
            }        
          });
      },
      sendEmailOtp() {
        // If form is not validated or user is already login return
        if (!this.validateFormEmail) return
        var $this = this;
        const obj = {
          email: this.email
        }
        axios.post(siteIndexURL+"/v1/resetpassword", obj)
        .then( result => {
          if (result.data.status == true) {
            $this.responseHandle('success', result.data.message);
            $this.verifyOTP=true
            $this.startTrial=false
            $this.newpassword=false
          }
        }).catch(function (error) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          }
          if (error.response.data.errors) {
            $this.responseHandle('warning', error.response.data.errors);
          }
          if (error.response.data.email) {
            $this.responseHandle('warning', error.response.data.email[0]);
          }
        });
      },
      setTenantId(tenant_id)
      {
        if(tenant_id){
          this.tenant_id = tenant_id;
          this.$session.start();  
          this.$session.set('tenant_id', tenant_id);
          this.startTrial = true;
          this.verifyOTP = false;
          this.companyPopup = false;
          this.newpassword = false;
          this.companies = [];
        }

      },
      otpVerify () {
        this.verifyOTP = true;
        this.startTrial = false;
        this.companyPopup = false;
        this.newpassword = false;
        this.companies = [];

        var $this = this;
        if (!this.email_otp) {
          $this.responseHandle('warning', 'OTP Code is required.');
          return false;
        }
        if (!this.email) {
          $this.responseHandle('warning', 'Email is required.');
          return false;
        }
        var dataString = {
          otp_code: this.email_otp,
          email:this.email      
        };
        axios.post(siteIndexURL+'/v1/verifyotp', dataString)
        .then((result)=>{
          if (result.data.status == true) {
            this.newpassword = true
            this.verifyOTP = false
          }
        }).catch(function (error) {
          if (error.response.data.detail) {
            $this.responseHandle('warning', error.response.data.detail);
          } 
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
    },
    Resetpassword () {
      this.newpassword = true;
      this.verifyOTP = false;
      this.startTrial = false;
      this.companyPopup = false;
      this.companies = [];

      var $this = this;
      if (!this.password) {
        $this.responseHandle('warning', 'Password is required.');
        return false;
      } else if (!this.confirm_password) {
        $this.responseHandle('warning', 'Confirm Password is required.');
        return false;
      } else if (!this.email) {
        $this.responseHandle('warning', 'Email is required.');
        return false;
      }
      
      var dataString = {
        email: this.email,
        password: this.password,
        password_confirmation: this.confirm_password
      };
      axios.post(siteIndexURL+'/v1/forgotpasswordupdate', dataString)
      .then((result)=>{
        if (result.data.status == true) {
          this.$router.push('/auth/login')
          $this.responseHandle('success', result.data.message);
        }
      }).catch(function (error) {
        if(error.response !== undefined){
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            } 
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
        }
        
      });     
    },
      responseHandle: function (type = 'warning', message = '') {
       this.$vs.notify({
          color: type,
          title: '',
          text: message
       })
      }
    },
    beforeMount() { 
      this.$session.start();
    }
}
</script>

<style lang="scss">
  .company-login-popup i.vs-icon.notranslate.icon-scale.vs-popup--close.vs-popup--close--icon.material-icons.null {
    display: none;
  }
</style>
