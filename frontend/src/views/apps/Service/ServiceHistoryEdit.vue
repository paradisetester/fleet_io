<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Service Details</h6>
 <form v-on:submit.prevent>
  <div class="mt-4">
      <label class="text-sm">Vehicle</label>
      <select v-model="vehicle_id" class="w-full form-control">
        <option :value="vehicleOptions.value" v-for='vehicleOptions in vehicleOptions' :key="vehicleOptions.value" v-validate="'required'" name="vehicle_id">{{vehicleOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('vehicle_id')">{{ errors.first('vehicle_id') }}</span>

  <div class="mt-4">
      <label class="text-sm">UserId</label>
    <vs-input class="w-full mb-base" v-model="user_id" v-validate="'required'" name="user_id"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('user_id')">{{ errors.first('user_id') }}</span>


  <div class="mt-4">
      <label class="text-sm">Odometer</label>
      <vs-input class="w-full mb-base" v-model="odometer" v-validate="'required'" name="odometer"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('odometer')">{{ errors.first('odometer') }}</span>
    <vs-checkbox v-model="Void"> Mark as Void</vs-checkbox>
    <br>
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/2 w-full">
       <label class="text-sm">Completion Date</label>
<flat-pickr v-model="completion_date" :config="{ dateFormat: 'Y-m-d' }" class="w-full" v-validate="'required'" name="completion_date"/>
      </div>
      <span class="text-danger text-sm" v-show="errors.has('completion_date')">{{ errors.first('completion_date') }}</span>
      <div class="vx-col sm:w-1/2 w-full">
        <br>
        <label class="text-sm">Completion Time</label>
         <flat-pickr :config="configdateTimePicker" v-model="completion_time" placeholder="Choose time" v-validate="'required'" name="completion_time"/>
      </div>
       <span class="text-danger text-sm" v-show="errors.has('completion_time')">{{ errors.first('completion_time') }}</span>
    </div>
    <div class="mt-4">
      <label class="text-sm">Vendor</label>
      <select v-model="vendor_id" class="w-full form-control">
        <option :value="vendorOptions.value" v-for='vendorOptions in vendorOptions' :key="vendorOptions.value" v-validate="'required'" name="vendor_id">{{vendorOptions.label}}</option>
      </select>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('vendor_id')">{{ errors.first('vendor_id') }}</span>
    <div class="mt-4">
      <label class="text-sm">Reference</label>
      <vs-input class="w-full mb-base" v-model="reference" v-validate="'required'" name="reference"></vs-input>
      Optional (e.g. invoice number, etc.)
    </div>
    <span class="text-danger text-sm" v-show="errors.has('reference')">{{ errors.first('reference') }}</span>
    <div class="mt-4">
      <label class="text-sm">Labels</label>
      <select v-model="labels" class="w-full form-control">
        <option :value="FuelOptions.value" v-for='FuelOptions in FuelOptions' :key="FuelOptions.value" v-validate="'required'" name="labels">{{FuelOptions.label}}</option>
      </select>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('labels')">{{ errors.first('labels') }}</span>
    <br>
    <h6 class="mb-4">Issues</h6>
    <br>
    <h6 class="mb-4">Line Items</h6>
    <h6 class="mb-4">Photo</h6>
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

          <h6 class="mb-4">Document</h6>
         <div class="vx-row box_outter mt-5">
            <template v-if="pageDocument">
               <!-- Image Container -->
               <div class="img-container mt-6 w-64 mx-auto flex items-center justify-center">
                  <img :src="pageDocument" alt="img" class="responsive"  v-if="ext=='png' || ext=='jpeg' || ext=='jpg' ">
                  <img src="/img/doc.png" alt="img" class="responsive iconimage" width="36px" v-else>
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
            <vs-textarea v-validate="'required'" v-model="comment" name="comment"/>
       </div>
       <span class="text-danger text-sm" v-show="errors.has('comment')">{{ errors.first('comment') }}</span>
    <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
           <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset">Reset</vs-button>
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



export default {
 components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
    return {
      service_id:null,
      Void:'',
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
      user_id:'', 
      odometer:'',
      completion_date:'',
      completion_time:'',
      vendor_id:'',
      reference:'',
      labels:'',
      photo:'',
      document:'',
      comment:'',
      vehicleOptions:[],
      vendorOptions:[], 
      ext:'', 
      FuelOptions: [
        { label: 'CNG(Compressed Natural Gas)',  value: 'CNG(Compressed Natural Gas'  },
        { label: 'Diesel',  value: '1'},
        { label: 'Gasoline',  value: '2'},       
        { label: 'Propane',  value: '3' },       
      ],     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    reset: function () {
      this.vehicle_id = '';
      this.odometer = '';
      this.completion_date = '';
      this.completion_time = '';
      this.vendor_id = '';
      this.reference = '';
      this.labels = '';
      this.reference = '';
      this.pageFile = '';
      this.pageDocFile = '';
      this.comment = '';
      },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("vehicle_id", $this.vehicle_id);
          formData.append("user_id", $this.user_id);
          formData.append("odometer", $this.odometer);
          formData.append("completion_date", $this.completion_date);
          formData.append("completion_time", $this.completion_time);
          formData.append("vendor_id", $this.vendor_id);
          formData.append("reference", $this.reference);
          formData.append("labels", $this.labels);
          formData.append("reference", $this.reference);
          formData.append("pageFile", $this.pageFile);
          formData.append("pageDocFile", $this.pageDocFile);
          formData.append("comment", $this.comment);
          axios.post(siteIndexURL+"/v1/servicehistory/update/"+this.id, formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/services/history')
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
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/servicehistory/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          var service = result.data.response.service;

          this.service_id  = service.id
          this.vehicle_id = service.vehicle_id
          this.user_id = service.user_id
          this.odometer = service.odometer
          this.completion_date = service.completion_date
          this.completion_time = service.completion_time
          this.vendor_id = service.vendor_id
          this.fuel_type = service.fuel_type
          this.reference = service.reference
          this.labels = service.labels
          this.partial_fuel_up = service.partial_fuel_up
          if(service.photo == null)
          {
            this.pageImage
          }
          else{
            this.pageImage = this.siteIndexUrl+'/public'+'/'+service.photo
          }

          if(service.document == null)
          {
            this.pageDocument
          }
          else{
            this.pageDocument = this.siteIndexUrl+'/public'+'/'+service.document
          }

          this.comment = service.comment
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
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
      axios.get(siteIndexURL+'/v1/vendor/?type=service')
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
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.serviceID
    this.getPost();
    this.siteIndexUrl = siteURL;
}
}
</script>