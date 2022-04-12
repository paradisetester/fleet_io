<template>
  <vx-card no-shadow>
      <h6 class="mb-4">Basic Information</h6>
      <!-- Info -->
      <form v-on:submit.prevent>
          <vs-input class="w-full mb-base" label-placeholder="Name" v-validate="'required'" name="name" v-model="basic.name"></vs-input>
          <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>
          <vs-input class="w-full" label-placeholder="Email" v-validate="'required'" name="email" v-model="basic.email"></vs-input>
          <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
    
          <div v-if="tenantId != 'fleet_admin'">
            <div class="mt-4 user_dt">
              <vs-checkbox v-model="basic.operator"> Operator</vs-checkbox>
              <p>This contact can be assigned to vehicles</p>
            </div>
            <div class="mt-4 user_dt">
              <vs-checkbox v-model="basic.employee"> Employee</vs-checkbox>
              <p>For identifiable purposes only</p>
            </div>
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
               <vs-button @click="$refs.uploadImgInput.click()">Upload Photo</vs-button>
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
import { siteIndexURL } from '../../../axios'
import axios from 'axios';

  export default {
    data () {
      return {
        pageFile: '',
        pageImage: '',
        activeName:'',
		    user_id:'',
        tenantId:'',
        baseSiteUrl:siteIndexURL.replace('api',''),
        basic: {
            type: Object,
            default: () => ({})
        }
      }
    },
    methods: {
      saveForm: function()
      {
        this.$validator.validateAll().then(result => {
        if (result) {
          let userid=this.user_id;
          this.basic.image = this.pageFile;
          var $this = this
          var formData = new FormData();
          formData.append("name", $this.basic.name);
          formData.append("email", $this.basic.email);
          formData.append("operator", $this.basic.operator);
          formData.append("employee", $this.basic.employee);
          formData.append("image", $this.pageFile);
          formData.append("user_id", userid);
          formData.append("type", 'basic');
          if (userid) {
		        formData.append("_method", 'PUT');
		  
            axios.post(siteIndexURL+"/v1/users/"+userid, formData)
            .then( result => {
              if (result.data.status == true) {
                this.responseHandle('success', result.data.message);
                this.$router.replace({ name: $this.activeName, params: {userID:userid}, query: {activeTab: 1} });
                this.$emit('nextActiveTab', 1);
              }
            }).catch(function (error) {
              if (error.response) {
                $this.responseHandle('warning', error.response.data.message);
              }
            });
          }
          else {            
            axios.post(siteIndexURL + "/v1/users", formData)
            .then(result => {
              if (result.data.status == true) {
			          var userid = result.data.response.user.id;
                this.responseHandle('success', result.data.message);
                this.$router.replace({ path: '/users/edit/'+userid, params: {userID:userid}, query: {activeTab: 1} });
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
    getUserDetail: function (userID = null)
    {
      var $this = this;
      var userDataUrl = userID ? siteIndexURL+'/v1/users/'+userID+'/edit' : siteIndexURL+'/v1/users/show';
      axios.get(userDataUrl).then((result)=>{
        if (result.data.status == true) {         
          this.basic = result.data.response.user.basic;
          if(this.basic.image == '')
          {
            this.pageImage
          }
          else{
            this.pageImage = this.baseSiteUrl+'/'+result.data.response.user.basic.image
          }
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.message);
        }
      });
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
    },
    computed: {
    },
    mount() {
        
    },

    beforeMount() 
    {
      this.$session.start();
      this.tenantId = this.$session.get('tenant_id');
      let currentRoute = this.$router.currentRoute;   
      var user_id = currentRoute.params.userID;
      if(user_id && user_id != undefined){
        this.user_id = user_id
        this.activeName = this.$router.currentRoute.name;
        this.getUserDetail(user_id);
      }else{
        this.getUserDetail();
      }
     
    }
  }
</script>

