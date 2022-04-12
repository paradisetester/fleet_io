<template>
   <vx-card no-shadow>
      <h6 class="mt-4">Fuel</h6>
      <form v-on:submit.prevent autocomplete="off">
         <div class="vx-row mb-6">
            <div class="vx-col sm:w-1/2 w-full">
               <label class="text-sm">Primary Meter</label>
               <ul class="demo-alignment">
                  <li>
                     <vs-radio v-model="vehicleSettings.primary_meter" vs-value="Miles">Miles</vs-radio>
                  </li>
                  <li>
                     <vs-radio v-model="vehicleSettings.primary_meter" vs-value="Kilometers">Kilometers</vs-radio>
                  </li>
                  <li>
                     <vs-radio v-model="vehicleSettings.primary_meter" vs-value="Hours">Hours</vs-radio>
                  </li>
               </ul>
            </div>
            <div class="vx-col sm:w-1/2 w-full">
               <vs-input class="w-full mt-5" label-placeholder="Current Reading" name="current_reading" v-validate="'numeric'" v-model="vehicleSettings.current_reading" />
               <span class="text-danger text-sm" v-show="errors.has('current_reading')">{{ errors.first('current_reading') }}</span>
               <vs-input class="w-full mt-5" label-placeholder="Average Usage per Day" name="average_usage_per_day" v-validate="'numeric'" v-model="vehicleSettings.average_usage_per_day" />
               <span class="text-danger text-sm" v-show="errors.has('average_usage_per_day')">{{ errors.first('average_usage_per_day') }}</span>
            </div>
         </div>
         <div class="vx-row mb-6">
         <div class="vx-col w-full">
         <!--	<label class="text-sm">Primary Meter</label> -->
         	<ul class="demo-alignment">
              <li>
                 <vs-checkbox v-model="vehicleSettings.secondary_meter_check">Secondary Meter</vs-checkbox>
              </li>
          	</ul>
          	<p>Track an additional meter, such as a concrete mixer, street sweeper, cleaning equipment, etc.</p>
         </div>
         </div>
         <div class="vx-row mb-6" v-if="vehicleSettings.secondary_meter_check == true">
            <div class="vx-col sm:w-1/2 w-full">
               <ul class="demo-alignment">
                  <li>
                     <vs-radio v-model="vehicleSettings.secondary_meter_unit" vs-value="Miles">Miles</vs-radio>
                  </li>
                  <li>
                     <vs-radio v-model="vehicleSettings.secondary_meter_unit" vs-value="Kilometers">Kilometers</vs-radio>
                  </li>
                  <li>
                     <vs-radio v-model="vehicleSettings.secondary_meter_unit" vs-value="Hours">Hours</vs-radio>
                  </li>
               </ul>
            </div>
            <div class="vx-col sm:w-1/2 w-full">
               <vs-input class="w-full mt-5" label-placeholder="Current Reading" name="secondary_current_reading" v-validate="'numeric'" v-model="vehicleSettings.secondary_current_reading" />
               <span class="text-danger text-sm" v-show="errors.has('secondary_current_reading')">{{ errors.first('secondary_current_reading') }}</span>
               <vs-input class="w-full mt-5" label-placeholder="Average Usage per Day" name="secondary_average_usage_per_day" v-validate="'numeric'" v-model="vehicleSettings.secondary_average_usage_per_day" />
               <span class="text-danger text-sm" v-show="errors.has('secondary_average_usage_per_day')">{{ errors.first('secondary_average_usage_per_day') }}</span>
            </div>
         </div>
         <div class="mb-6">
            <label class="text-sm">Fuel Unit</label>
            <ul class="demo-alignment">
               <li>
                  <vs-radio v-model="vehicleSettings.fuel_unit" vs-value="gallons_us">Gallons (US)</vs-radio>
               </li>
               <li>
                  <vs-radio v-model="vehicleSettings.fuel_unit" vs-value="gallons_uk">Gallons (UK)</vs-radio>
               </li>
               <li>
                  <vs-radio v-model="vehicleSettings.fuel_unit" vs-value="liters">Liters</vs-radio>
               </li>
            </ul>
         </div>
         <div class="mb-6">
            <label class="text-sm">Measurement Units</label>
            <ul class="demo-alignment">
               <li>
                  <vs-radio v-model="vehicleSettings.measurement_unit" vs-value="imperial">Imperial (inches, pounds, gallons, miles)</vs-radio>
               </li>
               <li>
                  <vs-radio v-model="vehicleSettings.measurement_unit" vs-value="metric">Metric (centimeters, kilograms, liters, kilometers)</vs-radio>
               </li>
            </ul>
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
import {siteIndexURL} from '../../../../axios'
import axios from 'axios';
export default {
	data() {
		return {
         numeric:'',
			vehicleSettings: {
				vehicle_id: 0,
				primary_meter: '',
				current_reading: '',
				average_usage_per_day: '',
				auto_calculate:0,
				secondary_meter_check:false,
				secondary_meter_unit:'',
				secondary_current_reading:'',
				secondary_average_usage_per_day:'',
				secondary_auto_calculate:0,
				fuel_unit: '',
				measurement_unit: '',
			},
		}
	},
	computed: {},
	methods: {
		saveForm: function () {
			this.$validator.validateAll().then(result => {
				if (result) {
					var $this = this
					axios.post(siteIndexURL + "/v1/vehicleSettings", $this.vehicleSettings)
						.then(result => {
							if (result.data.status == true) {
								this.responseHandle('success', result.data.message);
								$this.vehicleSettings = result.data.response.vehicleSettings;
								this.$router.replace({
									name: "vehicle-edit",
									params: {
										ID: $this.vehicleSettings.vehicle_id
									},
									query: {
										activeTab: 0
									}
								});
								// this.$emit('nextActiveTab', 0);
                        this.$router.push('/vehicle')
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
		getVehicleDetail: function (vehicle_id = null) {
			var $this = this;
			axios.get(siteIndexURL + '/v1/vehicleSettings?vehicle_id=' + vehicle_id)
				.then((result) => {
					if (result.data.status == true) {
                  if (result.data.response.vehicleSettings != null) {
                     $this.vehicleSettings = result.data.response.vehicleSettings;
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
		if (currentRoute.ID != undefined) {
			this.vehicleSettings.vehicle_id = currentRoute.ID
			this.getVehicleDetail(currentRoute.ID);
		}
	}
}
</script>
