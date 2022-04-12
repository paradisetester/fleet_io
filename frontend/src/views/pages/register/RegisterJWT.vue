<!-- =========================================================================================
File Name: RegisterJWT.vue
Description: Register Page for JWT
----------------------------------------------------------------------------------------
Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div>
    <div class="clearfix " v-if="startTrial == true">
      <vs-input
        v-validate="'required'"
        data-vv-validate-on="blur"
        label-placeholder="Name"
        name="name"
        placeholder="Name"
        v-model="name"
        class="w-full" />
      <span class="text-danger text-sm">{{ errors.first('name') }}</span>

      <vs-input
        v-validate="'required|email'"
        data-vv-validate-on="blur"
        name="email"
        type="email"
        label-placeholder="Email"
        placeholder="Email"
        v-model="email"
        class="w-full mt-6" />
      <span class="text-danger text-sm">{{ errors.first('email') }}</span>

      <vs-input
        ref="password"
        type="password"
        data-vv-validate-on="blur"
        v-validate="'required|min:6|max:10'"
        name="password"
        label-placeholder="Password"
        placeholder="Password"
        v-model="password"
        class="w-full mt-6" />
      <span class="text-danger text-sm">{{ errors.first('password') }}</span>

      <vs-checkbox v-validate="'required'" v-model="isTermsConditionAccepted" class="mt-4">I accept the terms & conditions.</vs-checkbox>
      <vs-button  type="border" to="/auth/login" class="mt-6">Login</vs-button>
      <vs-button class="float-right mt-6" @click="registerUserJWt" :disabled="!validateForm">Register</vs-button>
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
  </div>
</template>

<script>
import {API, siteIndexURL} from '../../../axios'
export default {
  data () {
    return {
      min: "",
      max: "",
      name: '',
      email: '',
      password: '',
      email_otp:'',
      startTrial:true,
      verifyOTP:false,
      siteDetails:false,
      isTermsConditionAccepted: false,
      plan_id: ''
    }
  },
  computed: {
    validateForm () {
      return !this.errors.any() && this.displayName !== '' && this.email !== '' && this.password !== ''
    },
    validateOtpForm () {
      return !this.errors.any() && this.email_otp !== ''
    }
  },
  methods: {
    registerUserJWt () {
      if (!this.validateForm) return
      var $this = this;
      if (!this.name) {
        $this.responseHandle('warning', 'Name is required.');
        return false;
      } else if (!this.email) {
        $this.responseHandle('warning', 'Email is required.');
        return false;
      } else if (!this.password) {
        $this.responseHandle('warning', 'Password is required.');
        return false;
      }
      else if (this.isTermsConditionAccepted==false) {
        $this.responseHandle('warning', 'Please accept the terms & conditions.');
        return false;
      }
      
      var dataString = {
        name: this.name,
        tenant_email: this.email,
        password: this.password,
      };
      API.post(siteIndexURL+'/v1/registerRequest', dataString)
      .then((result)=>{
        if (result.data.status == true) {
          this.startTrial = false;
          this.verifyOTP = true;
          //this.email_otp = result.data.response.otpCode
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
    otpVerify () {
      var $this = this;
      if (!this.name) {
        $this.responseHandle('warning', 'Name is required.');
        return false;
      } else if (!this.email) {
        $this.responseHandle('warning', 'Email is required.');
        return false;
      } else if (!this.password) {
        $this.responseHandle('warning', 'Password is required.');
        return false;
      } else if (!this.email_otp) {
        $this.responseHandle('warning', 'OTP Code is required.');
        return false;
      }
     
      var dataString = {
        name: this.name,
        tenant_email: this.email,
        password: this.password,        
        otp_code: this.email_otp,       
        plan_id: this.plan_id,
      };
      API.post(siteIndexURL+'/v1/registerComplete', dataString)
      .then((result)=>{
        if (result.data.status == true) {
          this.$session.start()     
          this.$session.set('userdata', result.data.response.user);
          $this.responseHandle('success', result.data.message);
          window.location.href = "/site/details";
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  beforeMount()
  {
    this.$session.start();  
    this.plan_id = this.$session.get('cart').id;
  }
}
</script>
