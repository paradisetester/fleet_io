<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Service Details</h6>
 <form v-on:submit.prevent>
  <div class="mt-4">
      <label class="text-sm">Name</label>
       <vs-input class="w-full" v-model="name" v-validate="'required'" placeholder="Enter Name" name="name"></vs-input>
  </div>
  <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

    <div class="mt-4">
      <label class="text-sm">Template</label>
      <vs-input class="w-full" v-model="template" v-validate="'required'" placeholder="Enter Template" name="template"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('template')">{{ errors.first('template') }}</span>
    
	<div class="mt-4">
      <label class="text-sm">Primary Meter</label>
      <vs-input class="w-full" v-model="primary_meter" v-validate="'required'" placeholder="Enter Primary Meter" name="primary_meter"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('primary_meter')">{{ errors.first('primary_meter') }}</span>
   
    <div class="mt-4">
      <label class="text-sm">Secondary Meter</label>
      <vs-input class="w-full mb-base" v-model="secondary_meter" v-validate="'required'" placeholder="Enter Secondary Meter" name="secondary_meter"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('secondary_meter')">{{ errors.first('secondary_meter') }}</span>
    
  
    
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
                  <vs-button type="flat" color="#999" @click="pageImage = null">Remove File</vs-button>
               </div>
            </template>
            <div class="upload-img mt-5" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>

         
   
    <!-- Save & Reset Button -->
         <div class="flex flex-wrap items-center justify-end">
            <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
            <vs-button class="ml-4 mt-2" type="border" @click.prevent="resetForm" color="warning">Reset</vs-button>
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
import {siteIndexURL} from '../../../axios'



export default {
  components: {
    flatPickr,
    vSelect,
    quillEditor,
  },
  data () {
    return {
      
		pageFile: '',
		pageImage: '',
		name:'',  
		template:'',   
		primary_meter:'', 
		secondary_meter:'',  
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
          formData.append("name", $this.name);        
          formData.append("template", $this.template);        
          formData.append("primary_meter", $this.primary_meter);        
          formData.append("secondary_meter", $this.secondary_meter);
          formData.append("pageFile", $this.pageFile);      
         
          axios.post(siteIndexURL+"/v1/serviceprogram", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/services/program')
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
    resetForm () {
      this.name = '';
      this.template = '';
      this.primary_meter = '';
      this.secondary_meter = '';
      this.pageFile = '';
      this.pageImage = ''
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
    getVehiclelist: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/vehiclemake')
      .then((result)=>{
         if (result.data.status == true) {   
         var make={}
         this.vehicleOptions=[]    
            result.data.response.vehiclemake.forEach((key) => {
              make={
                label:key.name,
                value:key.id
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