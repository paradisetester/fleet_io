<template>
   <vx-card no-shadow>
      <h6 class="mb-4">Identification</h6>
      <form v-on:submit.prevent autocomplete="off">
         <vs-input class="w-full mb-base"  v-validate="'required'" label-placeholder="Vehicle Name" v-model="vehicledetails.name" name="name"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>
         <vs-input class="w-full mb-base" label-placeholder="VIN/SN" v-model="vehicledetails.vin" name="vin"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('vin')">{{ errors.first('vin') }}</span>
         <vs-input class="w-full mb-base" label-placeholder="License Plate"  v-model="vehicledetails.license_plate" name="license_plate"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('license_plate')">{{ errors.first('license_plate') }}</span>
         <div class="mt-2 mb-5">

         	<label for="" class="vs-select--label">Type</label>
            <select              
               v-validate="'required'"               
               style="width: 100%;"
               label="Type"
               class="vs-select--input vselect"
               name="type"
               v-model="vehicledetails.type"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in vehicletypeOptions" >{{item.label}}</option>
            </select>
         </div>
         <span class="text-danger text-sm" v-show="errors.has('type')">{{ errors.first('type') }}</span>
         <div class="mt-2 mb-5">
         	<label for="" class="vs-select--label">Make</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Make"
               class="vs-select--input vselect"
               v-on:change="getModel()"
               style="width: 100%;"
               label="Make"
               name="make_id"
               v-model="vehicledetails.make_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in vehicleMake" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('make_id')">{{ errors.first('make_id') }}</span>

         </div>
         <div class="mt-2 mb-5">
         	<label for="" class="vs-select--label">Model</label>
            <select
               placeholder="Search and select"
               data-vv-as="Model"
               v-validate="'required'"
               class="vs-select--input vselect"
               style="width: 100%;"
               v-on:change="getType()"
               label="Model"
               name="model_id"
               v-model="vehicledetails.model_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in vehicleModel">{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('model_id')">{{ errors.first('model_id') }}</span>
         </div>
         <div class="mt-2 ">
         	<label for="" class="vs-select--label">Trim</label>
            <select
               placeholder="Search and select"
               data-vv-as="Trim"
               v-validate="'required'"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Trim"
               name="trim_id"
               v-model="vehicledetails.trim_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in vehicleType" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('trim_id')">{{ errors.first('trim_id') }}</span>
         </div>
         <vs-input class="w-full my-base" label-placeholder="Year" v-validate="'digits:4'" v-model="vehicledetails.year"  name="year"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('year')">{{ errors.first('year') }}</span>
         <vs-input class="w-full" label-placeholder="Registration State/Province" v-model="vehicledetails.registration_state"  name="registration_state"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('registration_state')">{{ errors.first('registration_state') }}</span>
         <div class="vx-row box_outter mt-5">
            <template v-if="pageImage">
               <!-- Image Container -->
               <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
                  <img :src="pageImage" alt="img" class="responsive">
               </div>
               <!-- Image upload Buttons -->
               <div class="modify-img flex justify-between mt-5">
                  <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                  <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Update File</vs-button>
                  <vs-button type="flat" color="#999" @click="pageImage = null">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img mt-2" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>
         <h6 class="mb-4">Preventative Maintenance</h6>
         <div class="mt-8">
         	<label for="" class="vs-select--label">Service Program</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Service Program"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Service Program"
               name="service_program"
               v-model="vehicledetails.service_program" >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in ServiceProgramOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('service_program')">{{ errors.first('service_program') }}</span>
         </div>
         <h6 class="mt-8">Classification</h6>
         <div class="mt-4">
         		<label for="" class="vs-select--label">Status</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Status"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Status"
               name="status"
               v-model="vehicledetails.status"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in pageStatusOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('status')">{{ errors.first('status') }}</span>
         </div>
         <div class="mt-4">
         	<label for="" class="vs-select--label">Group</label>
            <select
               placeholder="Search and select"              
               data-vv-as="Group"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Group"
               name="group_id"
               v-model="vehicledetails.group_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in groupsOptions" >{{item.label}}</option>
            </select>
         </div>
         <span class="text-danger text-sm" v-show="errors.has('group_id')">{{ errors.first('group_id') }}</span>
         <div class="mt-4">
         	<label for="" class="vs-select--label">Contact Id</label>
            <select
               placeholder="Search and select"
               data-vv-as="ContactId"
               v-validate="'required'"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="ContactId"
               name="contact_id"
               v-model="vehicledetails.contact_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in UsersOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('contact_id')">{{ errors.first('contact_id') }}</span>
         </div>
         <div class="mt-4">

         	<label for="" class="vs-select--label">Ownership</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Ownership"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Ownership"
               name="ownership"
               v-model="vehicledetails.ownership"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in ownerOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('ownership')">{{ errors.first('ownership') }}</span>
         </div>
         <h6 class="mt-8">Additional Details</h6>
         <vs-input class="w-full my-base" label-placeholder="color" v-model="vehicledetails.color"  name="color"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('color')">{{ errors.first('color') }}</span>
         <div class="mt-4">
         		<label for="" class="vs-select--label">Body Type</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Body Type"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Body Type"
               name="body_type_id"
               v-model="vehicledetails.body_type_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in bodytypeOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('body_type_id')">{{ errors.first('body_type_id') }}</span>
         </div>
         <div class="mt-4">
         	<label for="" class="vs-select--label">Body Subtype</label>
            <select
               placeholder="Search and select"
               v-validate="'required'"
               data-vv-as="Body Subtype"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Body Subtype"
               name="body_sub_type_id"
               v-model="vehicledetails.body_sub_type_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in subbodytypeOptions" >{{item.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('body_sub_type_id')">{{ errors.first('body_sub_type_id') }}</span>
         </div>
         <vs-input class="w-full my-base" label-placeholder="MSRP" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicledetails.msrp"  name="msrp"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('msrp')">{{ errors.first('msrp') }}</span>
        
          <vs-input class="w-full my-base" label-placeholder="Purchase Price" v-validate="{regex: '^([0-9 . , ]+)' }" v-model="vehicledetails.purchase_price"  name="purchase_price"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('purchase_price')">{{ errors.first('purchase_price') }}</span>
         
         <div class="mt-4 mb-6">
         	<label for="" class="vs-select--label">Linked Vehicles</label>
            <select
               placeholder="Search and select"
               data-vv-as="Linked Vehicles"
               class="vs-select--input vselect"
               style="width: 100%;"
               label="Linked Vehicles"
               name="linked_vehicle_id"
               v-model="vehicledetails.linked_vehicle_id"
               >
               <option :key="index" :value="item.value" :text="item.label" v-for="(item,index) in VehicleOptions" >{{item.label}}</option>
            </select>
         </div>
         <span class="text-danger text-sm" v-show="errors.has('linked_vehicle_id')">{{ errors.first('linked_vehicle_id') }}</span>
         <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
            <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
         </div>
      </form>
   </vx-card>
</template>
<script>
import definedStrings from '../../../../definedStrings'
import {
  siteIndexURL, siteURL
} from '../../../../axios'
import axios from 'axios';

export default {
  components: {
  },
  data() {
    return {
      label: '',
      digits:'',
      regex: "",
      numeric:'',
      pageFile: '',
      pageImage: '',
      vehicledetails: {
        name: '',
        vin: '',
        license_plate: '',
        type: '',
        make_id: '',
        model_id: '',
        year: '',
        trim_id: '',
        registration_state: '',
        service_program: 0,
        status: '',
        group_id: '',
        contact_id: '',
        ownership: '',
        color: '',
        body_type_id: '',
        body_sub_type_id: '',
        msrp: '',
        purchase_price:'',
        linked_vehicle_id: 0,
      },
      vehicle_id:'',
      definedStrings: {},
      vehicleMake: [],
      vehicleModel: [],
      vehicleType: [],
      UsersOptions:[],
      VehicleOptions: [],
      pageStatusOptions: [],
      ServiceProgramOptions: [],
      activeTab: 0,
      vehicletypeOptions: [
        {
          label: 'ATV',
          value: 'ATV'
        },
        {
          label: 'Boat',
          value: 'Boat'
        },
        {
          label: 'Bus',
          value: 'Bus'
        },
        {
          label: 'Car',
          value: 'Car'
        },
        {
          label: 'Forklift',
          value: 'Forklift'
        },
        {
          label: 'Generator',
          value: 'Generator'
        },
        {
          label: 'Loader',
          value: 'Loader'
        },
        {
          label: 'Motercycle',
          value: 'Motercycle'
        },
        {
          label: 'Mower',
          value: 'Mower'
        },
        {
          label: 'Other',
          value: 'Other'
        },
        {
          label: 'Pickup Truck',
          value: 'Pickup Truck'
        },
        {
          label: 'Semi Truck',
          value: 'Semi Truck'
        },
        {
          label: 'SUV',
          value: 'SUV'
        },
        {
          label: 'Trailer',
          value: 'Trailer'
        },
      ],
      ownerOptions: [
        {
          label: 'Owned',
          value: 'owned'
        },
        {
          label: 'Leased',
          value: 'Leased'
        },
        {
          label: 'Rented',
          value: 'Rented'
        },
        {
          label: 'Customer',
          value: 'Customer'
        },
      ],
      bodytypeOptions: [
        {
          label: 'Conventional',
          value: 'conventional'
        },
        {
          label: 'Full-Size',
          value: 'full-size'
        },
        {
          label: 'Hatchback',
          value: 'hatchback'
        },
        {
          label: 'Pickup',
          value: 'pickup'
        },
      ],
      subbodytypeOptions: [
        {
          label: 'Cargo',
          value: 'Cargo'
        },
        {
          label: 'Crew Cab',
          value: 'Crew Cab'
        },
        {
          label: 'Sleeper Cab',
          value: 'Sleeper Cab'
        }
      ],
      groupsOptions: [
        {
          label: 'USA/Southeast Region/Atlanta',
          value: '1'
        },
        {
          label: 'USA/Southeast Region/Birmingham',
          value: '2'
        },
        {
          label: 'USA/Southeast Region/Chicago',
          value: '3'
        },
        {
          label: 'Uk/London',
          value: '4'
        },
      ]

    }
  },
  computed: {
  },
  methods: {
    getMake: function () {

      var $this = this;
      axios.get(siteIndexURL + '/v1/vehiclemake')
        .then((result) => {
          if (result.data.status == true) {
            var make = {}
            this.vehicleMake = []
            result.data.response.vehiclemake.forEach((data) => {
              make = {
                label: data.name,
                value: data.id
              }
              this.vehicleMake.push(make);
            });
          }
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
    },
    getModel: function () {
       this.$vs.loading()
      var $this = this;
      axios.get(siteIndexURL + '/v1/vehiclemodel_by_make/' + this.vehicledetails.make_id)
        .then((result) => {
          if (result.data.status == true) {
            var model = {}
            this.vehicleModel = []
            result.data.response.vehiclemodel.forEach((data) => {
              model = {
                label: data.name,
                value: data.id
              }
              this.vehicleModel.push(model);
               
            });
          }
            this.$vs.loading.close()
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
               this.$vs.loading.close()
          }
        });
    },
    getType: function () {
      var $this = this;
      this.$vs.loading()
      axios.get(siteIndexURL + '/v1/vehicletype_by_model/' + this.vehicledetails.model_id)
        .then((result) => {
          if (result.data.status == true) {
            var type = {}
            this.vehicleType = []
            result.data.response.vehicletype.forEach((data) => {
              type = {
                label: data.name,
                value: data.id
              }
              this.vehicleType.push(type);
            });
          }
          this.$vs.loading.close()
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
            this.$vs.loading.close()
          }
        });
    },
    saveForm: function () {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("name", $this.vehicledetails.name);
          formData.append("vin", $this.vehicledetails.vin);
          formData.append("license_plate", $this.vehicledetails.license_plate);
          formData.append("type", $this.vehicledetails.type);
          formData.append("make_id", $this.vehicledetails.make_id);
          formData.append("model_id", $this.vehicledetails.model_id);
          formData.append("year", $this.vehicledetails.year);
          formData.append("trim_id", $this.vehicledetails.trim_id);
          formData.append("registration_state", $this.vehicledetails.registration_state);
          formData.append("pageFile", $this.pageFile);
          formData.append("service_program", $this.vehicledetails.service_program);
          formData.append("status", $this.vehicledetails.status);
          if ($this.vehicledetails.group_id != null) {
            formData.append("group_id", $this.vehicledetails.group_id);
          }  
          if ($this.vehicledetails.contact_id != null) {
            formData.append("contact_id", $this.vehicledetails.contact_id);
          }          
          formData.append("ownership", $this.vehicledetails.ownership);
          formData.append("color", $this.vehicledetails.color);
          formData.append("body_type_id", $this.vehicledetails.body_type_id);
          formData.append("body_sub_type_id", $this.vehicledetails.body_sub_type_id);
          formData.append("msrp", $this.vehicledetails.msrp);
          formData.append("purchase_price", $this.vehicledetails.purchase_price);
          
          formData.append("linked_vehicle_id", $this.vehicledetails.linked_vehicle_id);
          if (this.vehicle_id) {
            axios.post(siteIndexURL+"/v1/vehicledetailsUpdate/"+this.vehicle_id, formData)
            .then( result => {
              if (result.data.status == true) {
                this.responseHandle('success', result.data.message);
                $this.vehicledetails = result.data.response.vehicleDetail;
                this.$router.replace({ name: "vehicle-edit", params: {ID:$this.vehicledetails.vehicle_id}, query: {activeTab: 1} });
                this.$emit('nextActiveTab', 1);
              }
            }).catch(function (error) {
              if (error.response) {
                $this.responseHandle('warning', error.response.data.message);
              }
            });
          } else {            
            axios.post(siteIndexURL + "/v1/vehicledetails", formData)
            .then(result => {
              if (result.data.status == true) {
                this.responseHandle('success', result.data.message);
                $this.vehicledetails = result.data.response.vehicleDetail;
                this.$router.replace({ name: "vehicle-edit", params: {ID:$this.vehicledetails.vehicle_id}, query: {activeTab: 1} });
                this.$emit('nextActiveTab', 1);
              }
            }).catch(function (error) {
              if (error.response) {
                $this.responseHandle('warning', error.response.data.message);
              }
            });
          }
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
    },
    updateCurrImg(input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageFile = input.target.files[0]
          this.pageImage = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    responseHandle: function (type = 'warning', message = '') {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    },
    getServiceProgram: function () {
      var $this = this;
      axios.get(siteIndexURL + '/v1/serviceprogram')
        .then((result) => {
          if (result.data.status == true) {
            var serviceprogram = {}
            this.ServiceProgramOptions = []
            result.data.response.serviceprogram.forEach((data) => {
              serviceprogram = {
                label: data.name,
                value: data.service_program_id
              }
              this.ServiceProgramOptions.push(serviceprogram);
            });
          }
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
    },
    getvehicle: function () {
      var $this = this;
      axios.get(siteIndexURL + '/v1/vehicledetails')
        .then((result) => {
          if (result.data.status == true) {
            var vehciledetail = {}
            this.VehicleOptions=[]
            result.data.response.vehicleDetails.forEach((data) => {
              vehciledetail = {
                label: data.name,
                value: data.vehicle_id
              }
              this.VehicleOptions.push(vehciledetail);
            });
          }
        }).catch(function (error) {
          if (error.response != undefined) {
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          }
        });
    },
    getVehicleDetail: function (vehicle_id = null)
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehicledetails/'+vehicle_id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          $this.vehicledetails = result.data.response.vehicleDetail;
          this.getModel()
          this.getType()
          this.pageImage = siteURL+'/'+$this.vehicledetails.registration_photo
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.message);
        }
      });
    },
     getUser: function ()
    {
      var $this = this;
      axios.get(siteIndexURL + '/v1/users')
        .then((result) => {
          if (result.data.status == true) {
            var users = {}
            result.data.response.users.forEach((data) => {
              users = {
                label: data.name,
                value: data.id
              }
              this.UsersOptions.push(users);
            });
          }
        }).catch(function (error) {
          if (error.response != undefined) {
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          }
        });
    },
  },
  beforeMount() {
    this.definedStrings = definedStrings
    this.getMake();
    this.getServiceProgram();
    this.getvehicle();
    this.getUser();
    this.pageStatusOptions = this.definedStrings.vehicle.statusOptions
    let currentRoute = this.$router.currentRoute.params;
    if (currentRoute.ID!=undefined) {
      this.vehicle_id = currentRoute.ID
      this.getVehicleDetail(currentRoute.ID);
    }
  }
}
</script>
