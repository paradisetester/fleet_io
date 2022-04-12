<!-- =========================================================================================
  File Name: UserManage.vue
  Description: User Create Page
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
              <div class="tab-text">
                <form v-on:submit.prevent>  
                  <div class="vx-row">
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                          :label="'Customer Name'" 
                          v-model="profile.name" 
                          v-validate="'required|alpha_spaces'" 
                          name="name" />
                        <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          type="email"
                          class="w-full mt-4" 
                          icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                          :label="'Customer Email'" 
                          v-model="profile.email" 
                          v-validate="'required|email'" 
                          name="email" />
                        <span class="text-danger text-sm"  v-show="errors.has('email')">{{ errors.first('email') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Birthday</label>
                        <datepicker 
                          class="w-full" 
                          :format="'yyyy-MM-dd'"
                           :highlighted="highlightedFn"
                          :name="'dob'" 
                          icon-pack="feather" icon="icon-edit-2" icon-before
                          :placeholder="'Birthday'"
                          v-model="profile.dob" 
                          v-validate="'required'"
                          data-vv-as="field">
                        </datepicker>
                        <span class="text-danger text-sm"  v-show="errors.has('dob')">{{ errors.first('dob') }}</span>
                      </div>
                    </div>
                    
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Race</label>
                          <select 
                            class="w-full form-control" 
                            v-model="profile.race" 
                            v-validate="'required'" 
                            name="race">
                              <option value="">Select</option>
                              <option :value="raceKey" v-for="(raceValue, raceKey, index) in definedStrings.profile.race" :key="index">{{raceValue}}</option>
                          </select>
                        <span class="text-danger text-sm"  v-show="errors.has('race')">{{ errors.first('race') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Occupation</label>
                          <select 
                            class="w-full form-control" 
                            v-model="profile.occupation" 
                            v-validate="'required'" 
                            name="occupation">
                              <option value="">Select</option>
                              <option :value="occupationKey" v-for="(occupationValue, occupationKey, index) in definedStrings.profile.occupation" :key="index">{{occupationValue}}</option>
                          </select>
                        <span class="text-danger text-sm"  v-show="errors.has('occupation')">{{ errors.first('occupation') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Segment/Tiering:</label>
                        <select 
                          class="w-full form-control"
                          v-model="profile.tier" 
                          v-validate="'required'" 
                          name="tier">
                            <option value="">Select</option>
                            <option :value="tierKey" v-for="(tierValue, tierKey, index) in definedStrings.profile.tier" :key="index">{{tierValue}}</option>
                        </select>
                        <span class="text-danger text-sm"  v-show="errors.has('tier')">{{ errors.first('tier') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label="Monthly income" 
                          v-model="profile.annual_income" 
                          v-validate="'required|numeric'" 
                          data-vv-as="Monthly income"
                          name="annual_income" />
                        <span class="text-danger text-sm"  v-show="errors.has('annual_income')">{{ errors.first('annual_income') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label="Contact number" 
                          v-model="profile.phone" 
                          v-validate="'required|numeric'" 
                          name="phone" />
                        <span class="text-danger text-sm"  v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label="Address" 
                          v-model="profile.address" 
                          v-validate="'required'" 
                          name="address" />
                        <span class="text-danger text-sm"  v-show="errors.has('address')">{{ errors.first('address') }}</span>
                      </div>
                    </div> 
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Region</label>
                        <select 
                          class="w-full form-control"
                          v-model="profile.region" 
                          v-validate="'required'" 
                          name="region">
                            <option value="">Select</option>
                            <option :value="regionKey" v-for="(regionValue, regionKey, index) in definedStrings.profile.region" :key="index">{{regionValue}}</option>
                        </select>
                        <span class="text-danger text-sm"  v-show="errors.has('region')">{{ errors.first('region') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter margin_tp_10">
                        <label>Source of Acquaintance</label>
                        <select 
                          class="w-full form-control" 
                          v-model="profile.source" 
                          v-validate="'required'" 
                          name="source">
                            <option value="">Select</option>
                            <option :value="sourceKey" v-for="(sourceValue, sourceKey, index) in definedStrings.profile.source" :key="index">{{sourceValue}}</option>
                        </select>
                        <span class="text-danger text-sm"  v-show="errors.has('source')">{{ errors.first('source') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="vx-row">
                    <div class="vx-col w-full">
                      <vs-button class="mr-3 mb-2"  @click.prevent="createUser">Submit</vs-button>
                    </div>
                  </div>
                </form>
              </div>
            </vs-tab>
          </vs-tabs>

        </div>

      </vx-card>
    </div>
  </div>
</template>

<script>

// Store Module
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';  
import {API, siteIndexURL} from '../../../axios'
import definedStrings from '../../../definedStrings'
import axios from 'axios';
export default {
  components: {
    vSelect,
    'datepicker': Datepicker
  },
  data () {
    return {
      activeTab: 0, 
      definedStrings:{},   
      profile: {
        name: '',
        email: '',
        phone: '',
        dob: '',
        address: '',
        race: '',
        occupation: '',
        annual_income: '',
        tier: '',
        region: '',
        source:'',
        is_client:'CLNT'
      },
      highlightedFn: {
        customPredictor(date) {
          var selectedMOnth = date.getMonth()+1
          var selectedgetDate = date.getDate()
          var selectedDate = date.getFullYear()+''+''+((selectedMOnth < 10) ? "0" + selectedMOnth : selectedMOnth)+''+((selectedgetDate < 10) ? "0" + selectedgetDate : selectedgetDate);

          var d = new Date(),
            month = "" + (d.getMonth() + 1),
            day = "" + d.getDate(),
            year = d.getFullYear();

          if (month.length < 2) month = "0" + month;
          if (day.length < 2) day = "0" + day;

          var getCurrentDate = [year, month, day].join("");
          if (selectedDate >= getCurrentDate) {
            return true;
          }
        }
      }
    }
  },
  watch: {
  },
  methods: {
    createUser () {
      var $this = this;
      this.$validator.validateAll().then(result => {
        this.profile.dob = this.formatDate2(this.profile.dob);
        var dataString = this.profile
        if (result) {
          axios.post(siteIndexURL+'/v1/profile/create_profile/', dataString)
          .then((result)=>{
            
            $this.responseHandle('success', result.data.message);

            $this.$router.push(`/clients`).catch(() => {})

          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
            if (error.response.data.errors) {
              if (error.response.data.errors.region) {
                $this.responseHandle('warning', error.response.data.errors.region[0]);
              } else if (error.response.data.errors.source) {
                $this.responseHandle('warning', error.response.data.errors.source[0]);
              } else if (error.response.data.errors.name) {
                $this.responseHandle('warning', error.response.data.errors.name[0]);
              } else if (error.response.data.errors.race) {
                $this.responseHandle('warning', error.response.data.errors.race[0]);
              } else if (error.response.data.errors.dob) {
                $this.responseHandle('warning', error.response.data.errors.dob[0]);
              } else if (error.response.data.errors.occupation) {
                $this.responseHandle('warning', error.response.data.errors.occupation[0]);
              } else if (error.response.data.errors.annual_income) {
                $this.responseHandle('warning', error.response.data.errors.annual_income[0]);
              } else if (error.response.data.errors.phone) {
                $this.responseHandle('warning', error.response.data.errors.phone[0]);
              } else if (error.response.data.errors.address) {
                $this.responseHandle('warning', error.response.data.errors.address[0]);
              } else if (error.response.data.errors.tier) {
                $this.responseHandle('warning', error.response.data.errors.tier[0]);
              } else if (error.response.data.errors.email) {
                $this.responseHandle('warning', error.response.data.errors.email[0]);
              }              
            } 
          });
        } else {
          this.responseHandle('warning', 'Please Solve error');
        }
      })
    },
    formatDate2: function(date) {
      var d = new Date(date),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2) month = "0" + month;
      if (day.length < 2) day = "0" + day;

      return [year, month, day].join("-");
    },
    getCurrentDate: function()
    {
      var d = new Date(),
        month = "" + (d.getMonth() + 1),
        day = "" + d.getDate(),
        year = d.getFullYear();

      if (month.length < 2) month = "0" + month;
      if (day.length < 2) day = "0" + day;

      return [year, month, day].join("");
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
  created () {
  },
  beforeMount() {
     this.definedStrings = definedStrings
  }
}

</script>
