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
                            <div class="p-8">
                                <div class="vx-card__title mb-8">
                                    <h4 class="mb-4">Update your password</h4>
                                </div>

                                <vs-input
                                  ref="password"
                                  type="password"
                                  data-vv-validate-on="blur"
                                  v-validate="'required|min:6|max:15'"
                                  name="password"
                                  label-placeholder="Password"
                                  placeholder="Password"
                                  v-model="password"
                                  class="w-full mt-6" />
                                <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                                <vs-input
                                  type="password"
                                  v-validate="'min:6|max:15|confirmed:password'"
                                  data-vv-validate-on="blur"
                                  data-vv-as="password"
                                  name="password1"
                                  label-placeholder="Confirm Password"
                                  placeholder="Confirm Password"
                                  v-model="password1"
                                  class="w-full mt-6" />
                                <span class="text-danger text-sm">{{ errors.first('password1') }}</span>
                                <vs-button class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0"  @click="updatePassword" :disabled="!validateForm">Update Password</vs-button>
                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>

import {API, siteIndexURL} from '../../axios'
export default {
    name:'auth-forgot-password-update',
    data () {
        return {
            token:'',
            password: '',
            password1: ''
        }
    },
    computed: {
      validateForm () {
        return !this.errors.any() && this.password !== '' && this.password1 !== '' && this.password == this.password1
      }
    },
    methods: {
      updatePassword () {
        // If form is not validated or user is already login return
        if (!this.validateForm) return
          var $this = this;
          const obj = {
              password: this.password,
              password2: this.password1
            }
        API.post(siteIndexURL+"/password_change/"+this.token, obj)
        .then( result => {
          if (result.data.status) {
            this.responseHandle('success', result.data.status);
            this.password = '';
            this.password1 = '';
            this.$router.push('/');
          }
        }).catch(function (error) {
          if (error.response.data.detail) {
            $this.responseHandle('warning', error.response.data.detail);
          }
          if (error.response.data.password) {
            $this.responseHandle('warning', error.response.data.password[0]);
          }
          if (error.response.data.status) {
            $this.responseHandle('warning', error.response.data.status);
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
        let currentRoute = this.$router.currentRoute.params;
        
        this.token = currentRoute.token
    }
}
</script>
