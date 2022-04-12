<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Expense Entry Details</h6>
 
 	<div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <v-select v-model="vehicle_id" :options="vehicleOptions" v-validate="'required'" name="vehicle_id" />
    </div>
	<label class="text-sm">Odometer Reading</label>
	<vs-input class="w-full" v-model="odometer_reading"></vs-input>
	
	<label class="text-sm">Date</label>
	<flat-pickr v-model="date" :config="{ dateFormat: 'd F Y' }" class="w-full" />	
	
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2"  @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
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
    vSelect
  },
  data () {
    return {
				
		vehicleOptions:[],
		vehicle_id:'',
		date:'',
		odometer_reading:'',
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
          formData.append("odometer_reading", $this.odometer_reading);
         
		  
          axios.post(siteIndexURL+"/v1/vehiclemeterhistory", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/meter')
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
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  }
}
</script>
