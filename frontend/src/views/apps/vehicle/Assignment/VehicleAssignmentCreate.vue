<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Add Assignment</h6>
 
 	<div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <v-select v-model="vehicle" :options="definedStrings.vehicle.makeOptions" />
    </div>
	<div class="mt-4">
      <label class="text-sm">Operator</label>
      <v-select v-model="Operator" :options="definedStrings.vehicle.operatorOptions"  />
    </div>
	<div class="mt-4">
     	<vs-checkbox v-model="checkBox1"> Send email notification</vs-checkbox>
    </div>
	 <div class="vx-row mb-6">
			<div class="vx-col sm:w-1/2 w-full">
			 <label class="text-sm">Start Date</label>
			 <flat-pickr v-model="start_date" :config="{ dateFormat: 'd F Y' }" class="w-full" />
			</div>
			<div class="vx-col sm:w-1/2 w-full">
				<label class="text-sm">Start Time</label>
				 <flat-pickr :config="configdateTimePicker" v-model="time" placeholder="Choose time" />
				
			</div>
		</div>
	 <div class="vx-row mb-6">
			<div class="vx-col sm:w-1/2 w-full">
			 <label class="text-sm">End Date</label>
			 <flat-pickr v-model="start_date" :config="{ dateFormat: 'd F Y' }" class="w-full" />
			</div>
			<div class="vx-col sm:w-1/2 w-full">
				<label class="text-sm">End Time</label>
				 <flat-pickr :config="configdateTimePicker" v-model="time" placeholder="Choose time" />
				
			</div>
		</div>
	 <div class="mt-5">
	 	<label class="text-sm">Add Comment</label>
            <vs-textarea v-model="textarea" />
        </div>
	
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
  </vx-card>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import vSelect from 'vue-select'
import definedStrings from '../../../../definedStrings'

export default {
  components: {
    flatPickr,
    vSelect
  },
  data () {
    return {
	 time: null,
   definedStrings:{}, 
            configdateTimePicker: {
              enableTime: true,
              enableSeconds: true,
              noCalendar: true
            },
			
		 checkBox1: false,
      // Options
     statusOptions: [
        { label: 'Active',  value: 'active'  },
        { label: 'Sold',  value: 'sold'  },
        { label: 'In Active',  value: 'inactive'  },
       
      ],
     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  } ,
  beforeMount() {
     this.definedStrings = definedStrings
  }

}
</script>
