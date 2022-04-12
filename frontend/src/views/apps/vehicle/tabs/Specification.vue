<template>
   <vx-card no-shadow>
      <form v-on:submit.prevent autocomplete="off">
         <div class="mb-base">
            <h6 class="mb-4">Dimensions</h6>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Width" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.width" name="width" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('width')">{{ errors.first('width') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Height" v-model="vehicleSpecifications.height" v-validate="{regex: '^([0-9 . , ]+)' }" name="height" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('height')">{{ errors.first('height') }}</span>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Length" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.length"  name="length" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('length')">{{ errors.first('length') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Interior Volume" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.interior_valume" name="interior_valume" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('interior_valume')">{{ errors.first('interior_valume') }}</span>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Passenger Volume" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.passenger_valume" name="passenger_valume" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('passenger_valume')">{{ errors.first('passenger_valume') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Ground Clearance" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.ground_clearance" name="ground_clearance" class="w-full mt-5" />
                  <span class="text-danger text-sm" v-show="errors.has('ground_clearance')">{{ errors.first('ground_clearance') }}</span>
               </div>
            </div>
            <div class="vx-col sm:w-1/2 w-full">
               <vs-input label-placeholder="Bed Length" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.bed_length" name="bed_length" class="w-full mt-5" />
               <span class="text-danger text-sm" v-show="errors.has('bed_length')">{{ errors.first('bed_length') }}</span>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mt-4">Weight</h6>
            <div class="vx-row mb-6">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Curb Weight" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.curb_weight" name="curb_weight" class="w-full mt-5"/>
                  <span class="text-danger text-sm" v-show="errors.has('curb_weight')">{{ errors.first('curb_weight') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Gross Vehicle Weight Rating" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.gross_weight" name="gross_weight" class="w-full mt-5"/>
                  <span class="text-danger text-sm" v-show="errors.has('gross_weight')">{{ errors.first('gross_weight') }}</span>
               </div>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mt-4">Performance</h6>
            <div class="demo-alignment">
               <vs-input label-placeholder="Towing Capacity" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.towing_capacity"  name="towing_capacity" />
               <span class="text-danger text-sm" v-show="errors.has('towing_capacity')">{{ errors.first('towing_capacity') }}</span>
               <vs-input label-placeholder="Max Payload" v-validate="'numeric'" v-model="vehicleSpecifications.max_payload"  name="max_payload" />
               <span class="text-danger text-sm" v-show="errors.has('max_payload')">{{ errors.first('max_payload') }}</span>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mt-4">Fuel Economy</h6>
            <div class="demo-alignment">
               <vs-input label-placeholder="EPA City" v-model="vehicleSpecifications.epa_city" name="epa_city" />
               <vs-input label-placeholder="EPA Highway" v-model="vehicleSpecifications.epa_highway" name="epa_highway" />
               <vs-input label-placeholder="EPA Combined" v-model="vehicleSpecifications.epa_combined" name="epa_combined" />
            </div>
         </div>
         <div class="mb-1">
            <h6 class="mt-4">Engine</h6>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Engine Summary" v-model="vehicleSpecifications.engine_summery" name="engine_summery"  class="w-full mt-5"/>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input label-placeholder="Engine Brand" v-model="vehicleSpecifications.engine_brand" name="engine_brand"  class="w-full mt-5"/>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                     <label for="" class="vs-select--label">Aspiration</label>
                  <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Aspiration"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Aspiration"
               name="engine_aspiration"
               v-model="vehicleSpecifications.engine_aspiration"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in aspirationOptions" >{{item.label}}</option>
            </select>
               </div>

               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Block Type</label>
                  <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Block Type"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Block Type"
               name="block_type"
               v-model="vehicleSpecifications.block_type"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in BlockOptions" >{{item.label}}</option>
            </select>


               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5"  label-placeholder="Bore" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.bore" name="bore"/>
                  <span class="text-danger text-sm" v-show="errors.has('bore')">{{ errors.first('bore') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Block Type</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Cam Type"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Cam Type"
                     name="cam_type"
                     v-model="vehicleSpecifications.cam_type"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in CamOptions" >{{item.label}}</option>
                  </select>
                  

               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Compression" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.compression" name="compression"/>
                  <span class="text-danger text-sm" v-show="errors.has('compression')">{{ errors.first('compression') }}</span>
               </div>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Cylinders" v-validate="'numeric'" v-model="vehicleSpecifications.cylinders" name="cylinders" />
                  <span class="text-danger text-sm" v-show="errors.has('cylinders')">{{ errors.first('cylinders') }}</span>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Displacement" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.displacement" name="displacement" />
                  <span class="text-danger text-sm" v-show="errors.has('displacement')">{{ errors.first('displacement') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Fuel Injection</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Fuel Induction"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Fuel Injection"
                     name="fuel_injection"
                     v-model="vehicleSpecifications.fuel_injection"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in FuelInduction" >{{item.label}}</option>
                  </select>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Max HP" v-model="vehicleSpecifications.max_hp" name="max_hp" />
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Max Torque" v-validate="'numeric'" v-model="vehicleSpecifications.max_torque" name="max_torque" />
                  <span class="text-danger text-sm" v-show="errors.has('max_torque')">{{ errors.first('max_torque') }}</span>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Redline RPM" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.redline_rpm" name="redline_rpm" />
                  <span class="text-danger text-sm" v-show="errors.has('redline_rpm')">{{ errors.first('redline_rpm') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Stroke" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.stroke" name="stroke"  />
                  <span class="text-danger text-sm" v-show="errors.has('stroke')">{{ errors.first('stroke') }}</span>
               </div>
            </div>
            <vs-input class="w-full mt-5" label-placeholder="Valves" v-validate="'numeric'" v-model="vehicleSpecifications.valves"  name="valves" />
            <span class="text-danger text-sm" v-show="errors.has('valves')">{{ errors.first('valves') }}</span>
         <div class="mb-base">
            <h6 class="mt-4">Transmission</h6>
            <div class="demo-alignment">
               <vs-input label-placeholder="Transmission Summary" v-model="vehicleSpecifications.transmission_summery" name="transmission_summery" />
               <vs-input label-placeholder="Transmission Brand" v-model="vehicleSpecifications.transmission_brand" name="transmission_brand" />

               <div class="vs-component vs-con-input-label vs-input vs-input-primary is-label-placeholder trans_type">
               <label for="" class="vs-select--label">Transmission Type</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Transmission Type"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Transmission Type"
                     name="transmission_type"
                     v-model="vehicleSpecifications.transmission_type"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in TransmissiontypeOptions" >{{item.label}}</option>
                  </select>
               </div>
               <vs-input label-placeholder="Transmission Gears" v-validate="'numeric'" v-model="vehicleSpecifications.transmission_gears" name="transmission_gears" />
               <span class="text-danger text-sm" v-show="errors.has('transmission_gears')">{{ errors.first('transmission_gears') }}</span>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mb-8">Wheels & Tires</h6>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Drive Type</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Drive Type"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Drive Type"
                     name="drive_type"
                     v-model="vehicleSpecifications.drive_type"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in driveTypeOptions" >{{item.label}}</option>
                  </select>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Brake System</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Brake System"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Brake System"
                     name="brake_system"
                     v-model="vehicleSpecifications.brake_system"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in brakeSystemOptions" >{{item.label}}</option>
                  </select>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Front Track Width" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.front_track_width" name="front_track_width"/>
                  <span class="text-danger text-sm" v-show="errors.has('front_track_width')">{{ errors.first('front_track_width') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Rear Track Width" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.rear_track_width" name="rear_track_width"/>
                  <span class="text-danger text-sm" v-show="errors.has('rear_track_width')">{{ errors.first('rear_track_width') }}</span>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Wheelbase" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.wheelbase" name="wheelbase"/>
                  <span class="text-danger text-sm" v-show="errors.has('wheelbase')">{{ errors.first('wheelbase') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Front Wheel Diameter" v-model="vehicleSpecifications.front_wheel_diameter" name="front_wheel_diameter" />
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Rear Wheel Diameter" v-model="vehicleSpecifications.rear_wheel_diameter" name="rear_wheel_diameter" />
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Rear Axle" v-model="vehicleSpecifications.rar_axle" name="rar_axle"/>
               </div>
            </div>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Front Tire Type" v-model="vehicleSpecifications.front_tyre_type" name="front_tyre_type" />
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Front Tire PSI" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.front_tyre_psi" name="front_tyre_psi"/>
                  <span class="text-danger text-sm" v-show="errors.has('front_tyre_psi')">{{ errors.first('front_tyre_psi') }}</span>
               </div>
            </div>
            <div class="vx-row mb-6">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Rear Tire Type" v-model="vehicleSpecifications.rear_tyre_type" name="rear_tyre_type" />
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Rear Tire PSI" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.rear_tyre_psi" name="rear_tyre_psi"/>
                  <span class="text-danger text-sm" v-show="errors.has('rear_tyre_psi')">{{ errors.first('rear_tyre_psi') }}</span>
               </div>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mt-4">Fuel</h6>
            <div class="vx-row">
               <div class="vx-col sm:w-1/2 w-full">
                  <label for="" class="vs-select--label">Fuel Type</label>
                  <select
                     placeholder="Search and select"
                     data-vv-as="Fuel Type"
                     class="vs-select--input vselect"
                     style="width: 100%;"
                     label="Fuel Type"
                     name="fuel_type"
                     v-model="vehicleSpecifications.fuel_type"
                     >
                     <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in FuelTypeOptions" >{{item.label}}</option>
                  </select>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-8" label-placeholder="Fuel Quality" v-model="vehicleSpecifications.fuel_quality" name="fuel_quality"/>
               </div>
            </div>
            <div class="vx-row mb-6">
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Fuel Tank 1 Capacity" v-model="vehicleSpecifications.fuel_tank_1_capacity" v-validate="{regex: '^([0-9 . , ]+)' }" name="fuel_tank_1_capacity"/>
                  <span class="text-danger text-sm" v-show="errors.has('fuel_tank_1_capacity')">{{ errors.first('fuel_tank_1_capacity') }}</span>
               </div>
               <div class="vx-col sm:w-1/2 w-full">
                  <vs-input class="w-full mt-5" label-placeholder="Fuel Tank 2 Capacity" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicleSpecifications.fuel_tank_2_capacity" name="fuel_tank_2_capacity"/>
                  <span class="text-danger text-sm" v-show="errors.has('fuel_tank_2_capacity')">{{ errors.first('fuel_tank_2_capacity') }}</span>
               </div>
            </div>
         </div>
         <div class="mb-base">
            <h6 class="mt-4">Oil</h6>
            <div class=" mb-6">
               <vs-input class="w-full mt-5" label-placeholder="Oil Capacity" v-validate="{regex: '^([0-9 . , $]+)$' }" v-model="vehicleSpecifications.oil_capacity" name="oil_capacity"/>
               <span class="text-danger text-sm" v-show="errors.has('oil_capacity')">{{ errors.first('oil_capacity') }}</span>
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
import {siteIndexURL} from '../../../../axios'
import axios from 'axios';
export default {
components: {
  },
  data () {
    return {
      numeric:'',
      regex: "",
      vehicleSpecifications: {
        vehicle_id: 0,
      	width:'',
      	height:'',
      	length:'',
      	interior_valume:'',
      	passenger_valume:'',
      	ground_clearance:'',
      	bed_length:'',
      	curb_weight:'',
      	gross_weight:'',
      	towing_capacity:'',
      	max_payload:'',
      	epa_city:'',
      	epa_highway:'',
      	epa_combined:'',
      	engine_summery:'',
      	engine_brand:'',
      	engine_aspiration:'',
      	block_type:'',
      	bore:'',
      	cam_type:'',
      	compression:'',
      	cylinders:'',
      	displacement:'',
      	fuel_injection:'',
      	max_hp:'',
      	max_torque:'',
      	redline_rpm:'',
      	stroke:'',
      	valves:'',
      	transmission_summery:'',
      	transmission_brand:'',
      	transmission_type:'',
      	transmission_gears:'',
      	front_track_width:'',
      	rear_track_width:'',
      	wheelbase:'',
      	front_wheel_diameter:'',
      	rear_wheel_diameter:'',
      	rar_axle:'',
      	front_tyre_type:'',
      	front_tyre_psi:'',
      	rear_tyre_type:'',
      	rear_tyre_psi:'',
      	fuel_type:'',
      	fuel_quality:'',
      	fuel_tank_1_capacity:'',
      	fuel_tank_2_capacity:'',
      	oil_capacity:'',	  
      },
  	  aspirationOptions: [
        { label: 'Naturally Aspirated', value: 'Naturally_Aspirated'},
        { label: 'Turbocharger', value: 'Turbocharger'},       
        { label: 'Twin Turbocharger', value: 'Twin_Turbocharger'},       
      ], 
  	  FuelTypeOptions: [
        { label: 'Gasoline', value: 'Gasoline'},
        { label: 'Diesel', value: 'Diesel'},
        { label: 'Propane', value: 'Propane'},
        { label: 'Compressed Natural Gas (CNG)', value: 'Compressed_Natural_Gas'},       
      ],
  	  brakeSystemOptions: [
        { label: 'Air', value: 'air'},
        { label: 'Hydraulic', value: 'hydraulic'},       
      ],
  	  BlockOptions: [
        { label: 'I', value: 'i'},
        { label: 'V', value: 'v'},       
      ],
  	  CamOptions: [
        { label: 'DOHC', value: 'DOHC'},
        { label: 'OHV', value: 'OHV'},       
      ],
  	  driveTypeOptions: [
        { label: '4X4', value: '4x4'},
        { label: '6X4', value: '6x4'},       
        { label: 'FWD', value: 'fwd'},       
        { label: 'RWD', value: 'rwd'},       
      ],
  	  TransmissiontypeOptions: [
        { label: 'Automatic',  value: 'Automatic' },
        { label: 'Continuously Variable', value: 'Continuously_Variable' },       
      ],
  	  FuelInduction: [
        { label: 'Common Rail Direct Injection', value: 'Common_Rail_Direct_Injection'},
        { label: 'Sequential Multiport Fuel Injection', value: 'Sequential_Multiport_Fuel_Injection'},       
        { label: 'Sequential Port Fuel Injection', value: 'Sequential_Port_Fuel_Injection'},       
      ],
    }
  },
  computed: {
  },
  methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          axios.post(siteIndexURL+"/v1/vehiclespecifications", $this.vehicleSpecifications)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              $this.vehicleSpecifications = result.data.response.vehicleSpecifications;
              this.$router.replace({ name: "vehicle-edit", params: {ID:$this.vehicleSpecifications.vehicle_id}, query: {activeTab: 3} });
              this.$emit('nextActiveTab', 3);
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
      axios.get(siteIndexURL+'/v1/vehiclespecifications?vehicle_id='+vehicle_id)
      .then((result)=>{
        if (result.data.status == true) {
         if (result.data.response.vehicleSpecifications != null) {
            $this.vehicleSpecifications = result.data.response.vehicleSpecifications;
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
      this.vehicleSpecifications.vehicle_id = currentRoute.ID
      this.getVehicleDetail(currentRoute.ID);
    }
  }
}
</script>
