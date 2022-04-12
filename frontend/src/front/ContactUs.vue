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
    <section class="padding-all last-sec contact_outter">
	 <form>
      <div class="container">
      	<div class="contact">
           <h1>{{ page.heading }}</h1>
              
                  <div class="vx-row"> 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
                       <vs-input class="w-full"  v-validate="'required'" label-placeholder="First Name" v-model="first_name"  data-vv-rules="required" />
					    <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
						<vs-input class="w-full" label-placeholder="Last Name" v-model="last_name" /> 
						 <span class="text-danger text-sm" v-show="errors.has('last_name')">{{ errors.first('last_name') }}</span>
                      </div> 
                      </div> 
                 
                  <div class="vx-row">
                      <div class="vx-col sm:w-1/2 w-full mb-2"> 
					  
                          <vs-input class="w-full" label-placeholder="Phone Number" v-model="phone" name="number" v-validate="'digits:10|required'" />
						   <span class="text-danger text-sm" v-show="errors.has('number')">{{ errors.first('number') }}</span>
                      </div> 
                      <div class="vx-col sm:w-1/2 w-full">
                      <vs-input type="email" class="w-full" name="email" label-placeholder="Email" v-model="email" v-validate="'required|email'"  /> 
					  <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                      </div> 
                  </div>
                  <div class="vx-row"> 
                      <div class="vx-col w-full mb-6"> 
                           <label class="text-sm">Message</label>
                          <vs-textarea v-model="message" />
                      </div>
                  </div> 
                 
                  <div class="vx-row"> 
                  <div class="vx-col w-full"> 
                  <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button> 

                  <vs-button color="warning" type="border" class="mb-2" @click.prevent="resetForm">Reset</vs-button> 
                  </div> 
                  </div> 
              
          </div>
	     </div>
		 </form>
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
        teamMemebers:{},
        aboutPageData:{},
        first_name:'',
        last_name:'',
        phone:'',
        email:'',
        message:'',
        digits: '',
        number: '',
    }),
    props:[
        'postTitle',
        'page'
    ],
	computed: {
    validateForm () {
      return !this.errors.any() && this.first_name !== '' && this.email !== '' && this.phone !== ''
    },   
  },
     methods: {
	  resetForm: function(e) {
            e.preventDefault()
            this.first_name='',
			this.last_name='',
			this.phone='',
			this.email='',
			this.message=''
        },
		
    saveForm: function()
    {
	
      var $this = this;
      if (!this.first_name) {
        $this.responseHandle('warning', 'Name is required.');
        return false;
      } else if (!this.email) {
        $this.responseHandle('warning', 'Email is required.');
        return false;
      } else if (!this.phone) {
        $this.responseHandle('warning', 'phone is required.');
        return false;
      }
	  
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("firstname", $this.first_name);
          formData.append("lastname", $this.last_name);
          formData.append("email", $this.email);
          formData.append("phoneno", $this.phone);
          formData.append("message", $this.message);          
          
        axios.post(siteIndexURL+"/v1/contactus", formData)
          .then( result => {
            if (result.data.status == true) {
              this.responseHandle('success', 'Thank you for contact with us.');             
            }else{
			  this.responseHandle('success', result.data.message); 
			}
          }).catch(function (error) {
            if (error.data.status==false) {
              $this.responseHandle('warning', error.data.message);
            }
          });
        
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
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

