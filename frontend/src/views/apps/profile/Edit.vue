<!-- =========================================================================================
  File Name: UserEdit.vue
  Description: User Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-user-edit">
    <div id="user-edit-tab-info">
      <!-- Avatar Row -->
      <vx-card>

        <div slot="no-body" class="tabs-container px-6 pt-6">

          <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
            <vs-tab label="Account" icon-pack="feather" icon="icon-user">
           
               <div class="clearfix">
                                      <div class="vx-row">                                        
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-input
                                            label-placeholder="Full Name"
                                            placeholder="Full Name"
                                            v-model="name" 
                                            v-validate="'required'"                                           
                                            class="w-full" />
                                          <span class="text-danger text-sm">{{ errors.first('name') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-input     
                                            label-placeholder="Email"
                                            placeholder="Email"
                                            v-model="email"
                                            name="email"
                                            v-validate="'required|email'"
                                            readonly
                                            class="w-full" />
                                          <span class="text-danger text-sm">{{ errors.first('email') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Phone"
                                            placeholder="Phone"
                                            v-model="siteDetails.mobile"
                                            name="client_number"
                                            class="w-full mt-8" />
                                          <span class="text-danger text-sm">{{ errors.first('client_number') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Company or Organization name"
                                            placeholder="Company or Organization name"
                                            v-model="siteDetails.name"
                                            name="company_name"
                                            class="w-full mt-8" />
                                          <span class="text-danger text-sm">{{ errors.first('company_name') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-select
                                             placeholder="Search and select"
                                             v-validate="'required'"
                                             data-vv-as="Select your fleet size"
                                             class=" mt-2 "
                                             style="width: 100%;"
                                             label="Select your fleet size"
                                             name="fleet_size"
                                             v-model="siteDetails.fleet_size"
                                             vs-multiple
                                             autocomplete
                                             >
                                             <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in feetSizeOptions" />
                                          </vs-select>
                                          <span class="text-danger text-sm">{{ errors.first('fleet_size') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-select
                                             placeholder="Search and select"
                                             v-validate="'required'"
                                             data-vv-as="Select your industry"
                                             class=" mt-2"
                                             style="width: 100%;"
                                             label="Select your industry"
                                             name="industry"
                                             v-model="siteDetails.industry"
                                             vs-multiple
                                             autocomplete
                                             >
                                             <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in industriesOptions" />
                                          </vs-select>
                                          <span class="text-danger text-sm">{{ errors.first('industry') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-select
                                             placeholder="Search and select"
                                             v-validate="'required'"
                                             data-vv-as="Time zone"
                                             class=" mt-5"
                                             style="width: 100%;"
                                             label="Time zone"
                                             name="time_zone"
                                             v-model="siteDetails.time_zone"
                                             vs-multiple
                                             autocomplete
                                             >
                                             <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in timeZoneOptions" />
                                          </vs-select>
                                          <span class="text-danger text-sm">{{ errors.first('time_zone') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-select
                                             placeholder="Search and select"
                                             v-validate="'required'"
                                             data-vv-as="Currency"
                                             class="mt-5"
                                             style="width: 100%;"
                                             label="Currency"
                                             name="currency"
                                             v-model="siteDetails.currency"
                                             vs-multiple
                                             autocomplete
                                             >
                                             <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in currencyOptions" />
                                          </vs-select>
                                          <span class="text-danger text-sm">{{ errors.first('currency') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/1 w-full mt-1">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Tagline"
                                            placeholder="Tagline"
                                            v-model="siteDetails.tagline"
                                            name="tagline"
                                            class="w-full mt-10" />
                                          <span class="text-danger text-sm">{{ errors.first('tagline') }}</span>
                                        </div>
                                      </div>
                                    <vs-button class="float-right mt-6" @click="completeSiteDetails">Update</vs-button>
                                  </div>
           
            </vs-tab>
              <vs-tab label="Change password" icon-pack="feather" icon="icon-settings">
           
               <div class="clearfix">
                    <div class="vx-row">                                        
                      <div class="vx-col w-full">
                        <vs-input
                          type='password'
                          label-placeholder="Old password"
                          placeholder="Old password"
                          v-model="password.old_password"  
                          name="old_password"                                          
                          class="w-full" />
                        <span class="text-danger text-sm">{{ errors.first('old_password') }}</span>
                      </div>
                      <div class="vx-col w-full">
                        <vs-input   
                          type='password'  
                          label-placeholder="New password"
                          placeholder="New password"
                          v-model="password.password"
                          v-validate="'required|min:6'" 
                          name="password"  
                          ref="password"           
                          class="w-full" />
                        <span class="text-danger text-sm">{{ errors.first('password') }}</span>
                      </div>  
                        <div class="vx-col w-full">
                        <vs-input   
                          type='password'  
                          label-placeholder="Confirm password"
                          placeholder="Confirm password"
                          v-validate="'required|min:6|max:10|confirmed:password'"
                          v-model="password.password_confirmation"
                          name="password_confirmation"            
                          class="w-full" />
                        <span class="text-danger text-sm">{{ errors.first('password_confirmation') }}</span>
                      </div>                                       
                    </div>
                  <vs-button class="float-left mt-6" @click="changePassword">Update</vs-button>
                </div>
           
            </vs-tab>
          </vs-tabs>

        </div>

      </vx-card>
    </div>
  </div>
</template>

<script>

import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';  
import axios from 'axios';
import {siteIndexURL} from '@/axios'
export default {
  components: {
    vSelect,
    'datepicker': Datepicker
  },
  data () {
    return {
      name: '',
      email: '',
      password:{
        old_password: '',
        password: '',
        password_confirmation: '',  
        type: 'password'
      },
      activeTab:0,
      siteDetails:{}, 
      free_trial : '',
      cartDatas : '',
      userdata:{},
      feetSizeOptions: [
        {
          text: 'Less than 15 assets',
          value: '<15'
        },
        {
          text: '15-99 assets',
          value: '15-99'
        },
        {
          text: '100-499 assets',
          value: '100-499'
        },
        {
          text: '500-999 assets',
          value: '500-999'
        },
        {
          text: 'More than 1000 assets',
          value: '>1000'
        }
      ],
      industriesOptions: [
        {
          text: 'Transportation & Logistics',
          value: 'Transportation & Logistics'
        },
        {
          text: 'Rental & Leasing',
          value: 'Rental & Leasing'
        },
        {
          text: 'Consumer/Business Services',
          value: 'Consumer/Business Services'
        },
        {
          text: 'Construction Contractors & Services',
          value: 'Construction Contractors & Services'
        },
        {
          text: 'Government',
          value: 'Government'
        },
        {
          text: 'Energy, Utilities & Mining',
          value: 'Energy, Utilities & Mining'
        },
        {
          text: 'Retail, Wholesale & Manufacturing',
          value: 'Retail, Wholesale & Manufacturing'
        },
        {
          text: 'Information & Telecommunications',
          value: 'Information & Telecommunications'
        },
        {
          text: 'Education',
          value: 'Education'
        },
        {
          text: 'Arts, Entertainment & Recreation',
          value: 'Arts, Entertainment & Recreation'
        },
        {
          text: 'Non-Profit/Religious Organizations',
          value: 'Non-Profit/Religious Organizations'
        },
        {
          text: 'Other',
          value: 'Other'
        }
      ],
      timeZoneOptions: [
        {
          text: '(GMT-10:00) America/Adak',
          value: 'America/Adak' 
        },
        {
          text: '(GMT-10:00) Hawaii',
          value: 'Hawaii' 
        },
        {
          text: '(GMT-09:00) Alaska',
          value: 'Alaska' 
        }
      ],
      currencyOptions: [
        {
          text: '(USD) United States Dollar ($1,000.00)',
          value: 'USD' 
        },
        {
          text: '(EUR) Euro (€1,000.00)',
          value: 'EUR' 
        },
        {
          text: '(GBP) British Pound (£1,000.00)',
          value: 'GBP' 
        }
      ]
    }
  },
  watch: {
  },
  methods: {
    changePassword () {
      var $this = this;
      axios.post(siteIndexURL+'/v1/profile/update', $this.password)
      .then((result)=>{
        if (result.data.status == true) {            
          $this.responseHandle('success', result.data.message);
          this.$router.push('/home')
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
     completeSiteDetails () {
      var $this = this;
      this.$validator.validateAll().then(result => {
        if (result) {
          var dataString = {
            mobile:this.siteDetails.mobile,
            company_name:this.siteDetails.name,
            fleet_size:this.siteDetails.fleet_size,
            industry:this.siteDetails.industry,
            time_zone:this.siteDetails.time_zone,
            currency:this.siteDetails.currency,
            tagline: this.siteDetails.tagline,
            name: this.name,
            type: 'company'
          };
          axios.post(siteIndexURL+'/v1/profile/update', dataString)
          .then((result)=>{
            if (result.data.status == true) { 
                if(result.data.response) {
                  $this.$session.start(); 
                  $this.$session.set('profile', result.data.response.user);
                  $this.responseHandle('success', result.data.message);
                  this.$router.push('/auth-profile')
                }    
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            } 
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          }); 
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
   computed: {
   
  },
  created () {
    
  },
  beforeMount(){
    this.$session.start()   
    this.profile = this.$session.get('profile');
    this.name = this.profile.name
    this.email = this.profile.email
    this.siteDetails = this.profile.company
   
  }
}

</script>