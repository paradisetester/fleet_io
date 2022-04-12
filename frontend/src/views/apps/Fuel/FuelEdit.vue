<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Fuel Entry Details</h6>
 <form v-on:submit.prevent>
   <div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <select v-model="vehicle_id" class="w-full form-control">
        <option :value="vehicleOptions.value" v-for='vehicleOptions in vehicleOptions' :key="vehicleOptions.value" v-validate="'required'" name="vehicle_id">{{vehicleOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('vehicle_id')">{{ errors.first('vehicle_id') }}</span>
<br>
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/2 w-full">
       <label class="text-sm">Reported Date</label>
       <flat-pickr v-model="date" :config="{ dateFormat: 'Y-m-d' }" class="w-full" v-validate="'required'" name="date" />
      </div>
      <span class="text-danger text-sm" v-show="errors.has('date')">{{ errors.first('date') }}</span>
      <div class="vx-col sm:w-1/2 w-full">
        <br>
        <label class="text-sm">Start Time</label>
         <flat-pickr :config="configdateTimePicker" v-model="time" v-validate="'required'" name="time" placeholder="Choose time" />
      </div>
      <span class="text-danger text-sm" v-show="errors.has('time')">{{ errors.first('time') }}</span>
    </div>

     <div class="mt-4">
      <label class="text-sm">Odometer</label>
    <vs-input class="w-full mb-base" v-model="odometer" v-validate="'required'" name="odometer"></vs-input>
    </div>
     <span class="text-danger text-sm" v-show="errors.has('odometer')">{{ errors.first('odometer') }}</span>
    <div class="mt-4">
      <vs-checkbox v-model="fuelvoid"> Mark as void</vs-checkbox>
    </div>
      <div class="mt-4">
      <label class="text-sm">Price/Unit</label>
    <vs-input class="w-full mb-base" v-model="price" v-validate="'required'" name="price"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('price')">{{ errors.first('price') }}</span>


 <div class="mt-4">
      <label class="text-sm">litres (capacity)</label>
    <vs-input class="w-full mb-4" v-model="litres" v-validate="'required'" name="litres"></vs-input>
    </div>

    
  <div class="mt-4">
      <label class="text-sm">Fuel Type/Grade</label>
        <select v-model="fuel_type" v-validate="'required'" name="fuel_type" class="w-full form-control">
        <option v-for="(FuelOptions, index) in FuelOptions" :key="index" :value="FuelOptions.value">{{FuelOptions.label}}</option>
        </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('fuel_type')">{{ errors.first('fuel_type') }}</span>
  <br>
  <h6 class="mb-4">Additional Details</h6>
  <div class="mt-4">
      <label class="text-sm">Vendor</label>
      <!-- <v-select v-model="vehicle_id" :options="FuelOptions" v-validate="'required'" name="vehicle_id" /> -->

      <select v-model="vendor_id" class="w-full form-control">
        <option :value="vendorOptions.value" v-for='vendorOptions in vendorOptions' :key="vendorOptions.value" v-validate="'required'" name="vendor_id">{{vendorOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('vendor_id')">{{ errors.first('vendor_id') }}</span>

  <!-- <vs-checkbox v-model="Personal"> Personal</vs-checkbox> -->
  <vs-checkbox v-model="personal" vs-value="1" v-validate="'required'" name="personal">Personal</vs-checkbox>
  <span class="text-danger text-sm" v-show="errors.has('personal')">{{ errors.first('personal') }}</span>

  <div class="mt-4">
      <label class="text-sm">Refrence</label>
    <vs-input class="w-full mb-base" v-model="reference" v-validate="'required'" name="reference"></vs-input>
    Optional (e.g. invoice number, transaction ID, etc.)
    </div>
    <span class="text-danger text-sm" v-show="errors.has('reference')">{{ errors.first('reference') }}</span>
    <br>
    <h6 class="mb-4">Settings</h6>

    <label class="text-sm">Partial fuel-up</label>
    <vs-switch v-model="partial_fuel_up" v-validate="'required'" name="partial_fuel_up">
      <span slot="Not Full">Off</span>
      <span slot="full">On</span>
      </vs-switch>
      <span class="text-danger text-sm" v-show="errors.has('partial_fuel_up')">{{ errors.first('partial_fuel_up') }}</span>
      Turn on if the tank was not filled up to "full"

      <label class="text-sm">Photo</label>
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
                  <vs-button type="flat" color="#999" @click="pageImageremove">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img mt-5" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>

    <label class="text-sm">Document</label>
         <div class="vx-row box_outter mt-5">
            <template v-if="pageDocument">
               <!-- Image Container -->
               <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
                  <img :src="pageDocument" alt="img" class="responsive">
               </div>
               <!-- Image upload Buttons -->
               <div class="modify-img flex justify-between mt-5">
                  <input type="file" class="hidden" ref="updateDocInput" @change="updateCurrDocument" accept="image/*">
                  <vs-button class="mr-4" type="flat" @click="$refs.updateDocInput.click()">Update File</vs-button>
                  <vs-button type="flat" color="#999" @click="pageDocumentremove">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img mt-5" v-if="!pageDocument">
               <input type="file" class="hidden" ref="uploadDocInput" @change="updateCurrDocument" accept="image/*">
               <vs-button @click="$refs.uploadDocInput.click()">Upload Document</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageDocFile')">{{ errors.first('pageDocFile') }}</span>
         </div>

         <div class="mt-5">
      <label class="text-sm">Comment</label>
            <vs-textarea v-model="comment" name="comment"/>
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
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor'
import axios from 'axios';
import { siteIndexURL, siteURL} from '../../../axios'
import VueEasySession from 'vue-easysession'
export default {
  components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
    return {
      fuel_id:null,
      time: null,
      partial_fuel_up:'Full',
      configdateTimePicker: {
      enableTime: true,
      enableSeconds: true,
      noCalendar: true
      },
      pageFile: '',
      pageImage: '',
      pageDocFile: '',
      pageDocument: '',
      vehicle_id:'',  
      date:'', 
      odometer:'',
      price:'',
      fuel_type:'',
      fuelvoid:1,
      personal:0,
      vendor_id:'',
      user_id:'',
      reference:'',
      comment:'',
      litres:'',
      vehicleOptions:[], 
      vendorOptions:[], 
      FuelOptions: [
        { label: 'CNG(Compressed Natural Gas)',  value: 'CNG(Compressed Natural Gas'  },
        { label: 'Diesel',  value: 'Diesel'},
        { label: 'Gasoline',  value: 'Gasoline'},       
        { label: 'Propane',  value: 'Propane' },       
      ],     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/fuel/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          var fuel = result.data.response.fuel;

          this.fuel_id = fuel.id
          this.vehicle_id = fuel.vehicle_id
          this.date = fuel.date
          this.time = fuel.time
          this.user_id = fuel.user_id
          this.odometer = fuel.odometer
          this.price = fuel.price
          this.fuel_type = fuel.fuel_type
          this.vendor_id = fuel.vendor_id
          this.reference = fuel.reference
          this.personal = fuel.personal
          this.partial_fuel_up = fuel.partial_fuel_up
          if(fuel.photo == null)
          {
            this.pageImage
          }
          else{
            this.pageImage = this.siteIndexUrl+'/'+fuel.photo
          }

          if(fuel.document == null)
          {
            this.pageDocument
          }
          else{
            this.pageDocument = this.siteIndexUrl+'/'+fuel.document
          }
          this.comment = fuel.comment
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("vehicle_id",  this.vehicle_id);
          formData.append("date", this.date);
          formData.append("time", this.time);
          formData.append("odometer", this.odometer);
          formData.append("price", this.price);
          formData.append("fuel_type", this.fuel_type);
          formData.append("vendor_id", this.vendor_id);
          formData.append("user_id", this.user_id);
          formData.append("reference", this.reference);
          formData.append("pageFile", this.pageFile);
          formData.append("pageDocFile", this.pageDocFile);
          formData.append("personal", this.personal);
          formData.append("partial_fuel_up", this.partial_fuel_up);
          formData.append("comment", this.comment);
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/fuel/"+this.id, formData)
          .then( result => {    
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/Fuel/lists')
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
    updateCurrImg (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageFile = input.target.files[0]
          this.pageImage = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    updateCurrDocument (input) {
      if (input.target.files && input.target.files[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.pageDocFile = input.target.files[0]
          this.pageDocument = e.target.result
        }
        reader.readAsDataURL(input.target.files[0])
      }
    },
    pageImageremove()
    {
      this.pageFile = '',
      this.pageImage = ''
    },
    pageDocumentremove()
    {
      this.pageDocFile = '',
      this.pageDocument = ''
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
    getVendorlist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vendor/?type=Fuel')

      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vendorOptions=[]    
            result.data.response.vendors.forEach((key) => {
              make={
                label:key.name,
                value:key.vendor_id
              }
               this.vendorOptions.push(make);      
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
    this.getVendorlist();

  var session = VueEasySession.getInstance();    
  var profile = session.get('profile');
  this.user_id = profile.basic.user_id;

    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.fuelid
    this.getPost();
    this.siteIndexUrl = siteURL;
    // this.definedStrings = definedStrings
  }
}
</script>

