<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Page</h6>
	<!-- Info -->
<form v-on:submit.prevent>  
	<vs-input class="w-full mb-base" label-placeholder="Name" v-model="title"></vs-input>
	
<div class="mt-5">
<label class="text-sm">Description</label>
    <vs-textarea v-model="description" />
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
<div class="mt-4">
<label class="text-sm">Status</label>
<v-select v-model="status" :options="pageStatusOptions"  />
 <span class="text-danger text-sm" v-show="errors.has('status')">{{ errors.first('status') }}</span>
</div>
	
	<div class="mt-8">
		<h6 class="mb-4">Author Data</h6>
		<vs-input class="w-full mb-base" label-placeholder="Author Name" v-model="heading"></vs-input>
		<vs-input class="w-full mb-base" label-placeholder="Author Description" v-model="short_description"></vs-input>
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
import definedStrings from '../../../../definedStrings'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'


export default {
  components: {
    flatPickr,
    vSelect,

  },
  data () {
 
    return {
    definedStrings:{},		
			title:'',
			status:'',
			description:'',
			heading:'',
			short_description:'',
      pageImage:'',
      // Options
      makeOptions: [
        { label: 'Toyota',  value: 'toyota'  },
        { label: 'GMC',     value: 'gmc'     },
        { label: 'Chevrolet',    value: 'chevrolet'    },
        { label: 'India',      value: 'india'      },
        { label: 'Jordan',     value: 'jordan'     },
        { label: 'Morocco',    value: 'morocco'    },
        { label: 'Portuguese', value: 'portuguese' },
        { label: 'Syria',      value: 'syria'      },
        { label: 'USA',        value: 'usa'        }
      ],
     pageStatusOptions: [
        { label: 'Publish',  value: 'publish'  },
        { label: 'UnPublish',  value: 'unpublish'  },
        { label: 'Draft',  value: 'draft'  },
       
      ],
     
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
          formData.append("heading", $this.heading);
          formData.append("pageFile", $this.pageFile);
          formData.append("short_description", $this.short_description);
          formData.append("status", $this.status.value);
          formData.append("meta_title", $this.meta_title);
          formData.append("meta_description", $this.meta_description);
          formData.append("description", $this.description);
          formData.append("type", 'testimonial');
          formData.append("user_id", '1');
           formData.append("template", 'default');
          axios.post(siteIndexURL+"/v1/testimonials", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/testimonials')
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
