<template>
   <vx-card no-shadow>
      <h6 class="mb-4">Page</h6>
      <form v-on:submit.prevent>
         <!-- Info -->
         <vs-input class="w-full mb-base" v-validate="'required'" label-placeholder="Page Name" v-model="title" name="title"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') }}</span>
         <vs-input class="w-full mb-base" v-validate="'required'" label-placeholder="Page Heading" v-model="page_heading" name="page_heading"></vs-input>
         <span class="text-danger text-sm" v-show="errors.has('page_heading')">{{ errors.first('page_heading') }}</span>
         <label class="text-sm">Description</label>
         <quill-editor v-model="description"></quill-editor>
         <div class="mt-5">
            <label class="text-sm">Short Description</label>
            <vs-textarea v-model="short_description" />
         </div>         
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
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>
         <div class="mt-8">
            <h6 class="mb-4">Meta Data</h6>
            <vs-input class="w-full mb-base" label-placeholder="Meta title" v-model="meta_title"></vs-input>
            <vs-input class="w-full mb-base" label-placeholder="Meta Description" v-model="meta_description"></vs-input>
         </div>
         <div class="mt-4">
            <label class="text-sm">Status</label>
            <v-select v-model="status" v-validate="'required'" name="status" :options="pageStatusOptions"  />
            <span class="text-danger text-sm" v-show="errors.has('status')">{{ errors.first('status') }}</span>
         </div>
         <div class="mt-4">
            <label class="text-sm">Page Template</label>
            <select v-model="template" v-validate="'required'" name="template" class="w-full form-control">
              <option v-for="(templateOption, index) in templateOptions" :key="index" :value="templateOption.value">{{templateOption.label}}</option>
            </select>
            <span class="text-danger text-sm" v-show="errors.has('template')">{{ errors.first('template') }}</span>
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
import definedStrings from '../../../../definedStrings'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'


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
      title:'',
      page_heading:'',
      short_description:'',
      status:'',
      meta_title:'',
      meta_description:'',
      description: '',
      definedStrings:{},	   
      template:'',
      pageStatusOptions: [
        { label: 'Publish',  value: 'publish'  },
        { label: 'UnPublish',  value: 'unpublish'  },
        { label: 'Draft',  value: 'draft'  },       
      ],    
      templateOptions: [
        {
          label: 'Default', 
          value: 'defaultSingle'
        },
        {
          label: 'About US', 
          value: 'aboutUs'
        },
        {
          label: 'Career', 
          value: 'career'
        },
        {
          label: 'Checkout', 
          value: 'checkout'
        },
        {
          label: 'Contact Us', 
          value: 'contactUs'
        },
        {
          label: 'Payment', 
          value: 'payment'
        },
        {
          label: 'Plans', 
          value: 'plans'
        }
      ] 
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
          formData.append("title", $this.title);
          formData.append("heading", $this.page_heading);
          formData.append("pageFile", $this.pageFile);
          formData.append("short_description", $this.short_description);
          formData.append("status", $this.status.value);
          formData.append("meta_title", $this.meta_title);
          formData.append("meta_description", $this.meta_description);
          formData.append("description", $this.description);
          formData.append("template", $this.template);
          formData.append("type", 'page');
          formData.append("user_id", '1');
          
          axios.post(siteIndexURL+"/v1/posts", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/pages')
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
  beforeMount() {
     this.definedStrings = definedStrings
  }
}
</script>
