<template>
  <div>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full md:w-full lg:w-1/1 mx-auto self-center d-theme-dark-bg">
                            <div class="px-8 pt-8 register-tabs-container">
                                <div class="vx-card__title mb-4">
                                  <h4 class="mb-4">Welcome to Fleetio</h4>
                                </div>
                                <form autocomplete="off">
                                <vs-tabs>
                                  <vs-tab label="Site Details">
                                    <div class="clearfix">
                                      <div class="vx-row">          
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                          <vs-input
                                            label-placeholder="Full Name"
                                            placeholder="Full Name"
                                            :value="userdata.name"
                                            readonly
                                            class="w-full" />
                                          <span class="text-danger text-sm">{{ errors.first('name') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-5">
                                          <vs-input     
                                            label-placeholder="Email"
                                            placeholder="Email"
                                            :value="userdata.email"
                                            readonly
                                            class="w-full" />
                                          <span class="text-danger text-sm">{{ errors.first('email') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-3">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Phone"
                                            placeholder="Phone"
                                            v-model="siteDetails.client_number"
                                            name="client_number"
                                            class="w-full mt-5" />
                                          <span class="text-danger text-sm">{{ errors.first('client_number') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full mt-3">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Company or Organization name"
                                            placeholder="Company or Organization name"
                                            v-model="siteDetails.company_name"
                                            name="company_name"
                                            class="w-full" />
                                          <span class="text-danger text-sm">{{ errors.first('company_name') }}</span>
                                        </div>
                                        <div class="vx-col md:w-1/2 w-full">
                                          <vs-select
                                             placeholder="Search and select"
                                             v-validate="'required'"
                                             data-vv-as="Select your fleet size"
                                             class=" mt-1 "
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
                                             class=" mt-1"
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
                                             class=" mt-4"
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
                                             class="mt-4"
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
                                        <div class="vx-col md:w-1/1 w-full mt-3">
                                          <vs-input
                                            v-validate="'required'"
                                            data-vv-validate-on="blur"
                                            label-placeholder="Tagline"
                                            placeholder="Tagline"
                                            v-model="siteDetails.tagline"
                                            name="tagline"
                                            class="w-full mt-8" />
                                          <span class="text-danger text-sm">{{ errors.first('tagline') }}</span>
                                        </div>
                                      </div>
                                    <vs-button class="float-right mt-6" @click="completeSiteDetails" :disabled="!validateForm">Let's Get Start</vs-button>
                                  </div>
                                </vs-tab>
                              </vs-tabs>
                            </form>
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
import axios from 'axios';  
import {siteIndexURL} from '../../../axios'
export default {
  data () {
    return {		
		plan_id:'',
		siteDetails:{
		client_number:'',
		company_name:'',
		fleet_size:'',
		industry:'',
		time_zone:'',
		currency:'',
		tagline:'',
    digits:''
      },
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
  computed: {
    validateForm () {
      return !this.errors.any() && this.siteDetails.client_number !== '' && this.siteDetails.company_name !== '' && this.siteDetails.fleet_size !== '' && this.siteDetails.industry !== '' && this.siteDetails.time_zone !== '' && this.siteDetails.currency !== '' && this.siteDetails.tagline !== ''
    }
  },
  methods: {
    completeSiteDetails () {
      if (!this.validateForm) return
      var $this = this;
      var dataString = {
        client_number:this.siteDetails.client_number,
        company_name:this.siteDetails.company_name,
        fleet_size:this.siteDetails.fleet_size,
        industry:this.siteDetails.industry,
        time_zone:this.siteDetails.time_zone,
        currency:this.siteDetails.currency,
        tagline: this.siteDetails.tagline,
        free_trial: this.free_trial,
        plan_id:this.cartDatas.id,
        tenant_email: this.userdata.email,
        name: this.userdata.name,

      };
      axios.post(siteIndexURL+'/v1/completeSiteDetails', dataString)
      .then((result)=>{
        if (result.data.status == true) { 
            if(result.data.response) {
              this.$session.start();
              if(this.free_trial == 'free'){
                this.$session.set('access', result.data.response.access_tokens);
                this.$session.set('refresh', result.data.response.refresh_token);
                this.$session.set('profile', result.data.response.user);             
                this.$session.set('tenant_id', result.data.response.tenant_id);
                this.$session.set('free_trial', '');
              }else{
                this.$session.set('userdata', result.data.response.user);        
              }
            }    
          $this.responseHandle('success', result.data.message);
          if(this.free_trial == 'free'){
            this.$router.push('/home')
          }else{
            $this.$router.push('/front/checkout').catch(() => {})
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
		this.userdata = this.$session.get('userdata');
		
	  this.free_trial = this.$session.get('free_trial');
	  this.cartDatas = this.$session.get('cart');
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