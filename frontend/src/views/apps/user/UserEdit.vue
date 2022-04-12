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
              <div class="tab-text">
                <form v-on:submit.prevent>  
                  <div class="vx-row">
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                          :label-placeholder="'Customer Name'" 
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
                          :label-placeholder="'Customer Email'" 
                          v-model="profile.email" 
                          v-validate="'required|email'" 
                          name="email" />
                        <span class="text-danger text-sm"  v-show="errors.has('email')">{{ errors.first('email') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <datepicker 
                          class="selectExample w-full" 
                          :format="'yyyy-MM-dd'"
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
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <label>Race</label>
                          <select 
                            class="w-full form-control" 
                            v-model="profile.race" 
                            v-validate="'required'" 
                            name="race">
                              <option value="">Select</option>
                              <option value="CH">Chinese</option>
                              <option value="IN">Indian</option>
                              <option value="ML">Malay</option>
                              <option value="EU">Eurasian</option>
                              <option value="OT">Others</option>
                          </select>
                        <span class="text-danger text-sm"  v-show="errors.has('race')">{{ errors.first('race') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <label>Occupation</label>
                          <select 
                            class="w-full form-control" 
                            v-model="profile.occupation" 
                            v-validate="'required'" 
                            name="occupation">
                              <option value="">Select</option>
                              <option value="SAL">Salaried</option>
                              <option value="SEP">Self Employed</option>
                              <option value="PRO">Professional</option>
                              <option value="OTR">Others</option>
                          </select>
                        <span class="text-danger text-sm"  v-show="errors.has('occupation')">{{ errors.first('occupation') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label-placeholder="Annual income" 
                          v-model="profile.annual_income" 
                          v-validate="'required|numeric'" 
                          name="annual_income" />
                        <span class="text-danger text-sm"  v-show="errors.has('annual_income')">{{ errors.first('annual_income') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label-placeholder="contact number" 
                          v-model="profile.phone" 
                          v-validate="'required|numeric'" 
                          name="phone" />
                        <span class="text-danger text-sm"  v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label-placeholder="Address" 
                          v-model="profile.address" 
                          v-validate="'required'" 
                          name="address" />
                        <span class="text-danger text-sm"  v-show="errors.has('address')">{{ errors.first('address') }}</span>
                      </div>
                    </div>                    
                    <div class="vx-col md:w-1/2 w-full">
                      <div class="vx-row box_outter">
                        <vs-input 
                          class="w-full mt-4" 
                          label-placeholder="Segment/Tiering:" 
                          v-model="profile.tier" 
                          v-validate="'required'" 
                          name="tier" />
                        <span class="text-danger text-sm"  v-show="errors.has('tier')">{{ errors.first('tier') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="vx-row">
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <label>Segment/Tiering:</label>
                        <select 
                          class="w-full form-control"
                          v-model="profile.region" 
                          v-validate="'required'" 
                          name="region">
                            <option value="">Select</option>
                            <option value="R1">Jurong</option>
                            <option value="R2">Clementi</option>
                            <option value="R3">Woodlands</option>
                            <option value="R4">Marine</option>
                            <option value="R5">parade</option>
                        </select>
                        <span class="text-danger text-sm"  v-show="errors.has('region')">{{ errors.first('region') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <label>Source of Acquaintance</label>
                        <select 
                          class="w-full form-control" 
                          v-model="profile.source" 
                          v-validate="'required'" 
                          name="source">
                            <option value="">Select</option>
                            <option value="RFR">Referral</option>
                            <option value="EXC">Existing clients</option>
                            <option value="SLM">Social media Campaigns</option>
                            <option value="PRE">Events</option>
                            <option value="OTR">others</option>
                        </select>
                        <span class="text-danger text-sm"  v-show="errors.has('source')">{{ errors.first('source') }}</span>
                      </div>
                    </div>
                    <div class="vx-col md:w-1/3 w-full">
                      <div class="vx-row box_outter">
                        <label>Profile Type</label>
                          <select 
                            class="w-full form-control" 
                            v-model="profile.is_client" 
                            v-validate="'required'" 
                            name="is_client">
                              <option value="">Select</option>
                              <option value="AGNT">Agent</option>
                              <option value="CLNT">Client</option>
                              <option value="OTR">Others</option>
                          </select>
                        <span class="text-danger text-sm"  v-show="errors.has('is_client')">{{ errors.first('is_client') }}</span>
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
import axios from 'axios';
import {API, siteIndexURL} from '../../../axios'
export default {
  components: {
    vSelect,
    'datepicker': Datepicker
  },
  data () {
    return {
      activeTab: 0,
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
        source:''
      }
    }
  },
  watch: {
  },
  methods: {
    createUser () {
      var client_id = this.client_id
      var $this = this;
      this.$validator.validateAll().then(result => {
        this.profile.dob = this.formatDate2(this.profile.dob);
        var dataString = this.profile
        if (result) {
          axios.put(siteIndexURL+'/v1/profile/profile/edit/'+client_id+'/', dataString)
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
    getProfile: function ()
    {
      var $this = this;
      var client_id = this.client_id
      axios.get(siteIndexURL+'/v1/profile/profile/'+client_id+'/')
      .then((result)=>{
        if (result.data.success == true) {
          this.profile = result.data.data[0];
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
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
  beforeMount(){
    let currentRoute = this.$router.currentRoute.params;
    this.client_id = currentRoute.ID
    this.getProfile();
  }
}

</script>