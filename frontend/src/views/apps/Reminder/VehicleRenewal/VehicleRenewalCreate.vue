<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Vehicle Reminder Details</h6>
 <form v-on:submit.prevent>
  <div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <v-select v-model="vehicle_id" :options="vehicleOptions"  name="vehicle_id" />
  </div>
   
<br>
<div class="mt-4">
      <label class="text-sm">Renewal Type</label>
      <v-select v-model="renewal_type" :options="renewalOptions" v-validate="'required'" name="renewal_type" />
  </div>
   <span class="text-danger text-sm" v-show="errors.has('renewal_type')">{{ errors.first('renewal_type') }}</span>
   <br>
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/2 w-full">
       <label class="text-sm">Reported Date</label>
       <flat-pickr v-model="date" :config="{ dateFormat: 'Y-m-d' }" class="w-full" v-validate="'required'" name="date" />
      </div> 
	 <div class="vx-col sm:w-1/2 w-full">       
       <vs-input class="w-full" label-placeholder="Subscribed User" v-model="user_ids"  name="user_ids"></vs-input>
      </div>
	  
    </div>
 
	 <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/2 w-full">
      
     <vs-input class="w-full" label-placeholder="Time Threshold" v-model="time_threshold"  name="time_threshold"></vs-input>
      </div>
	  
	  <div class="vx-col sm:w-1/2 w-full">
       <label class="text-sm">Weeks</label>
     <v-select v-model="week" :options="weekOption" v-validate="'required'" name="week" />
      </div>
      
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
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'

import axios from 'axios';
import {siteIndexURL} from '../../../../axios'

export default {
  components: {
    flatPickr,
    vSelect,
    
  },
  data () {
    return {
		vehicle_id:'',
		date:'',
		renewal_type:'',
		time_threshold:'',
		user_ids:'',
		week:'',
		vehicleOptions:[],  
      renewalOptions: [
        { label: 'Emission Test',  value: 'Emission Test'  },
        { label: 'Inspection',  value: 'Inspection'},
        { label: 'Insurance',  value: 'Insurance'},       
        { label: 'Registration',  value: 'Registration' },       
      ],
	  weekOption: [
        { label: 'day(s)',  value: 'day'  },
        { label: 'week(s)',  value: 'week'  },
        { label: 'month(s)',  value: 'month'  },
        { label: 'year(s)',  value: 'year'  },
              
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
          const formData = new FormData();
		  
          formData.append("vehicle_id", $this.vehicle_id.value);
          formData.append("date", $this.date);          
          formData.append("user_ids", $this.user_ids);          
          formData.append("renewal_type", $this.renewal_type.value);          
          formData.append("time_threshold", $this.time_threshold);          
          formData.append("week", $this.week.value); 
          axios.post(siteIndexURL+"/v1/vehicle_renewal_reminder", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/vehicle/renewal')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
          });
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
   
    getVehiclelist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicledetails')

      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehicleOptions=[]    
            result.data.response.vehicleDetails.forEach((key) => {
              make={
                label:key.name,
                value:key.vehicle_id
              }
               this.vehicleOptions.push(make);      
            });
        }
      
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
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
     this.getVehiclelist();
  }
}
</script>

