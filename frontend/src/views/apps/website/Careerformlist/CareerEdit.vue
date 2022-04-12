<!-- =========================================================================================
  File Name: VehicleEdit.vue
  Description: Vehicle Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
   <vx-card no-shadow>
      <h6 class="mb-4">Carrer Details</h6>
      <form v-on:submit.prevent>
         <!-- Info -->
      
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                       <vs-input class="w-full" label-placeholder="First Name" name="first_name" v-model="first_name" />
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                      <vs-input class="w-full" label-placeholder="Last Name" name="last_name" v-model="last_name" /> 
                      </div> 
                 
                 
                 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                          <vs-input class="w-full" label-placeholder="Phone Number" name="phone" v-model="phone" /> 
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full mb-6">
                      <vs-input type="email" class="w-full" label-placeholder="Email" name="email" v-model="email" /> 
                      </div> 
                 <h6 class="mb-4">Resume</h6>
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
               <vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('resume')">{{ errors.first('resume') }}</span>
         </div>

                  <div class="vx-row"> 
                      <div class="vx-col w-full mb-6"> 
                        <vs-input class="w-full" label-placeholder="Apply For" name="apply_for" v-model="apply_for" /> 

                           <label class="text-sm">Cover letter</label>
                          <vs-textarea v-model="cover_letter" />
                      </div>
                  </div> 
                 
                  <div class="vx-row"> 
                  <div class="vx-col w-full"> 
                  <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button> 

                  <vs-button color="warning" type="border" class="mb-2" >Reset</vs-button> 
                  </div> 
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
import definedStrings from '../../../../definedStrings'
import { quillEditor } from 'vue-quill-editor'
import { siteIndexURL, siteURL} from '../../../../axios'
import axios from 'axios';
export default {
  components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
    return {
        siteUrl: siteIndexURL,
        pageFile: '',
        pageImage: '',
        first_name:'',
        last_name:'',
        phone:'',
        email:'',
        cover_letter:'',       
        resume:'',
        apply_for:'',
        career:{},
        id:'',
    }
  },
  watch: {
  },
  methods: {
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
         formData.append("first_name", $this.first_name);
          formData.append("last_name", $this.last_name);
          formData.append("email", $this.email);
          formData.append("phone", $this.phone);                   
          formData.append("pageFile", $this.pageFile);
          formData.append("cover_letter", $this.cover_letter);
          formData.append("apply_for", $this.apply_for);
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/career/"+this.id, formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/career')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
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
      axios.get(siteIndexURL+'/v1/career/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {
        var career = result.data.response.career;
        this.first_name=career.first_name,
        this.last_name=career.last_name,
        this.phone=career.phone,
        this.email=career.email,
        this.cover_letter=career.cover_letter,       
        this.pageImage = this.siteIndexUrl+'/'+career.resume
        this.apply_for=career.apply_for
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
        if (error.response.data.message) {
          $this.responseHandle('warning', error.response.data.message);
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  created () {
    
  },
  beforeMount(){
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.ID
    
    this.getPost();
    this.siteIndexUrl = siteURL;
    this.definedStrings = definedStrings
  }
}

</script>