<template>
  <div>
    <section class="banner-head-section">
      <div class="container">
        <div class="page-title-sec">
          <h1>{{ page.title }}</h1>
        </div>
      </div>
    </section>
    <section class="padding-all full-img  dynamic-section" v-if="page.short_description">
      <div class="container">
        <div class="row">
          
            <div class="right-side-text">             
              <p>{{ page.short_description }}</p>
                <p class="about-description" v-html="page.description"> </p>
            </div>          

        </div>
      </div>
    </section>
    <section class="padding-all last-sec">
      <div class="container">
      	<div class="contact">
           <h1>{{ page.heading }}</h1>
              
                  <div class="vx-row"> 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                       <vs-input class="w-full" label-placeholder="First Name" name="first_name" v-model="first_name"  v-validate="'required'"/>
					   <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                      <vs-input class="w-full" label-placeholder="Last Name" name="last_name" v-model="last_name" /> 
                      </div> 
                      </div> 
                 
                  <div class="vx-row">
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                          <vs-input class="w-full" label-placeholder="Phone Number" name="phone" v-model="phone"  v-validate="'digits:10|required'"/> 
						  <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full mb-6">
      <vs-input type="email" class="w-full" label-placeholder="Email" name="email"  v-model="email"  v-validate="'required|email'"/> 
					  <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                      </div> 
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
            <div class="upload-img" v-if="!pageImage">
               <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
            </div>
            <span class="text-danger text-sm" v-show="errors.has('pageFile')">{{ errors.first('pageFile') }}</span>
         </div>

                  <div class="vx-row"> 
                      <div class="vx-col w-full mb-6"> 
                        <vs-input class="w-full" label-placeholder="Apply For" name="apply_for" v-model="apply_for"  v-validate="'required'"/> 
                        <span class="text-danger text-sm" v-show="errors.has('apply_for')">{{ errors.first('apply_for') }}</span>
                           <label class="text-sm">Cover letter</label>
                          <vs-textarea name="cover_letter" v-model="cover_letter"  v-validate="'required'"/>
						   <span class="text-danger text-sm" v-show="errors.has('cover_letter')">{{ errors.first('cover_letter') }}</span>

                      </div>
                  </div> 
                 
                  <div class="vx-row"> 
                  <div class="vx-col w-full"> 
                  <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button> 

                  <vs-button color="warning" type="border" @click="resetForm" class="mb-2" >Reset</vs-button> 
                  </div> 
                  </div> 
              
          </div>
	     </div>
     </section>
  </div>
</template>


<script>
import definedStrings from '../definedStrings'
import axios from 'axios';
import {siteIndexURL} from '../axios'

export default {
    name:'about-us',
    data:() =>({
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
        digits:''
    }),
    props:[
        'postTitle',
        'page'
    ],

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

        axios.post(siteIndexURL+"/v1/career", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
             
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
    resetForm(e)
    {
      e.preventDefault()
      this.$data.first_name = "",
      this.$data.last_name = "",
      this.$data.email = "",
      this.$data.phone = "",
      this.$data.pageFile = "",
      this.$data.cover_letter = "",
      this.$data.apply_for = ""
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

