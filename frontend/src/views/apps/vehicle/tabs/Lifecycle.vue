<template>
   <vx-card no-shadow>
      <form v-on:submit.prevent autocomplete="off">
         <div class="mb-base">
            <h6 class="mb-4">In-Service</h6>
            <div class="mt-4">
               <label class="text-sm">In-Service Date</label>
               <datepicker                          
                  class="selectExample w-full"
                  v-validate="'required'"
                  :format="'yyyy-MM-dd'"
                  name="service_date"
                  icon-pack="feather" icon="icon-edit-2" icon-before
                  v-model="vehicleLifecycle.service_date"
                  data-vv-as="In-Service Date"></datepicker>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('service_date')">{{ errors.first('service_date') }}</span>
            <vs-input class="w-full my-base" label-placeholder="In-Service Odometer" v-model="vehicleLifecycle.odometer" v-validate="'numeric'" name="odometer"></vs-input>
            <span class="text-danger text-sm" v-show="errors.has('odometer')">{{ errors.first('odometer') }}</span>
         </div>
         <div>
            <h6 class="mb-4">Vehicle Life Estimates</h6>
            <vs-input class="w-full" label-placeholder="Estimated Service Life in Months" v-model="vehicleLifecycle.service_life_in_month" v-validate="'numeric'" name="service_life_in_month"></vs-input>
            <span class="text-danger text-sm" v-show="errors.has('service_life_in_month')">{{ errors.first('service_life_in_month') }}</span>
            <vs-input class="w-full" label-placeholder="Estimated Service Life in Miles" v-model="vehicleLifecycle.service_life_in_miles" v-validate="'numeric'" name="service_life_in_miles"></vs-input>
            <span class="text-danger text-sm" v-show="errors.has('service_life_in_miles')">{{ errors.first('service_life_in_miles') }}</span>
            <vs-input class="w-full" label-placeholder="Estimated Resale Value" v-model="vehicleLifecycle.resale_value" v-validate="'required'" name="resale_value"></vs-input>
            <span class="text-danger text-sm" v-show="errors.has('resale_value')">{{ errors.first('resale_value') }}</span>   
         </div>
         <div>
            <h6 class="mt-8">Out-of-Service</h6>
            <div class="mt-4">
               <label class="text-sm">Out-of-Service Date</label>
               <datepicker                          
                  class="selectExample w-full"
                  v-validate="'required'"
                  :format="'yyyy-MM-dd'"
                  name="out_of_service_date"
                  icon-pack="feather" icon="icon-edit-2" icon-before
                  v-model="vehicleLifecycle.out_of_service_date"
                  data-vv-as="Out-of-Service Date"></datepicker>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('out_of_service_date')">{{ errors.first('out_of_service_date') }}</span>
            <vs-input class="w-full my-base" label-placeholder="Out-of-Service Odometer" v-model="vehicleLifecycle.out_of_service_odometer" v-validate="'numeric'" name="out_of_service_odometer"></vs-input>
            <span class="text-danger text-sm" v-show="errors.has('out_of_service_odometer')">{{ errors.first('out_of_service_odometer') }}</span>
         </div>
         <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
         </div>
      </form>
   </vx-card>
</template>
<script>
import {
  siteIndexURL
} from '../../../../axios'
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';

export default {
  components: {
    'datepicker': Datepicker
  },
  data () {
    return {
      numeric:'',
      vehicleLifecycle: {
        vehicle_id: 0,
        service_date:'',
        odometer:'',
        service_life_in_month:'',
        service_life_in_miles:'',
        resale_value:'',
        out_of_service_date:'',
        out_of_service_odometer:'',
      },        
      pageStatusOptions: [
        { label: 'Deactive',  value: '0'  },
        { label: 'Active',  value: '1'  },
        { label: 'Pending',  value: '2'  },       
      ],   
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          axios.post(siteIndexURL+"/v1/vehiclelifecycle", this.vehicleLifecycle)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              $this.vehicleLifecycle = result.data.response.vehicleLifecycle;
              this.$router.replace({ name: "vehicle-edit", params: {ID:$this.vehicleLifecycle.vehicle_id}, query: {activeTab: 2} });
              this.$emit('nextActiveTab', 2);
            }
          }).catch(function (error) {
            if (error.response) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
    getVehicleDetail: function (vehicle_id = null)
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehiclelifecycle?vehicle_id='+vehicle_id)
      .then((result)=>{
        if (result.data.status == true) {
          if (result.data.response.vehicleLifecycle != null) {
            $this.vehicleLifecycle = result.data.response.vehicleLifecycle;
          }                    
        }
      }).catch(function (error) {
        if (error.response) {
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
  beforeMount() {
    let currentRoute = this.$router.currentRoute.params;
    if (currentRoute.ID!=undefined) {
      this.vehicleLifecycle.vehicle_id = currentRoute.ID
      this.getVehicleDetail(currentRoute.ID);
    }
  }
}
</script>
