<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Theme Setting</h6>
  <form v-on:submit.prevent>
	<vs-input class="w-full mb-base" label-placeholder="Website Title" v-model="title" name="title"></vs-input>

	
	   <div class="mt-2">
			<label class="text-sm">Header Script</label>
            <vs-textarea v-model="header" name="header"/>
       </div>
		
	   <div class="mt-3">
			<label class="text-sm">Footer Script</label>
            <vs-textarea v-model="footer" name="footer" />
       </div>

       <vs-input class="w-full mb-base" label-placeholder="Phone No" v-model="phoneno" name="phoneno"></vs-input>
    <h6 class="mb-4 mt-5">Photo</h6>
  <div class="vx-row box_outter">
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
            <div class="upload-img" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload File</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
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
import { siteIndexURL, siteURL} from '../../../../axios'



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
      header:'',
      phoneno:'',
      footer:'',
      status:'',      
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  methods: {
    getTheme: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/themesetting')
      .then((result)=>{
         if (result.data.status == true) {
          var theme = result.data.response.themesetting;

          this.id = theme.id
          this.title = theme.title
          this.header = theme.header
          this.footer = theme.footer
          this.phoneno = theme.phoneno
          this.status = theme.status
          this.pageImage = this.siteIndexUrl+'/'+theme.photo
          // this.pageFile = this.siteIndexUrl+'/'+theme.photo    
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
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("title", $this.title);
          formData.append("header", $this.header);
          formData.append("footer", $this.footer);
          formData.append("phoneno", $this.phoneno);
          formData.append("pageFile", $this.pageFile);
          if(this.id){
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/themesetting/"+this.id, formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/theme/')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
          });
          }
          else
          {
            axios.post(siteIndexURL+"/v1/themesetting", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/theme/')
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
          });
          }
          
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
    this.Theme = this.getTheme();
    this.siteIndexUrl = siteURL;
  }
}
</script>
