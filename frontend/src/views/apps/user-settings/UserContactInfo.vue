<template>
  <vx-card no-shadow>
    <h6 class="mb-4">Contact Information</h6>
    <form v-on:submit.prevent>
  <!-- Mobile Number -->
    <vs-input class="w-full mt-8" type="number" label-placeholder="Enter Mobile" v-model="contact.mobile" v-validate="'required'" name="mobile" />
    <span class="text-danger text-sm" v-show="errors.has('mobile')">{{ errors.first('mobile') }}</span>
    <!-- Address  -->
    <vs-input class="w-full mt-8" label-placeholder="Enter Street Address" v-model="contact.address1" v-validate="'required'" name="address1"/>
    <span class="text-danger text-sm" v-show="errors.has('address1')">{{ errors.first('address1') }}</span>
    <!-- Address  2-->
    <vs-input class="w-full mt-8" label-placeholder="Enter Address 2" v-model="contact.address2" name="address2"/>
    <vs-input class="w-full mt-8" label-placeholder="Enter City" v-model="contact.city" v-validate="'required'" name="city"/>
    <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
    <vs-input class="w-full mt-8" label-placeholder="Enter State/Province/Region" v-model="contact.state" v-validate="'required'" name="state"/>
    <span class="text-danger text-sm" v-show="errors.has('state')">{{ errors.first('state') }}</span>
    <vs-input class="w-full mt-8" label-placeholder="Enter Zip/Postal Code" v-model="contact.postal_code" v-validate="'required'" name="postal_code"/>
    <span class="text-danger text-sm" v-show="errors.has('postal_code')">{{ errors.first('postal_code') }}</span>
    <!-- Country -->
    <div>
      <label class="text-sm">Country</label>
      <v-select placeholder="Select Country" v-model="contact.country" :options="countryOptions" :dir="$vs.rtl ? 'rtl' : 'ltr'" v-validate="'required'" name="country"/>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end mt-4">
	    <input type="hidden" v-model="contact._method" name="_method"  value="PUT" />
      <vs-button class="ml-auto mt-2" @click.prevent="saveForm">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
    </form>
  </vx-card>
</template>

<script>
import vSelect from 'vue-select'
import { siteIndexURL } from '@/axios'
import axios from 'axios';
export default {
    components: {
        vSelect
    },
    data () {
      return {
		    userId:'',
		    activeName:'',
		    method: 'PUT',
        bio: this.$store.state.AppActiveUser.about,
        countryOptions: [
            { label: 'Australia',  value: 'australia'  },
            { label: 'France',     value: 'france'     },
            { label: 'Germany',    value: 'germany'    },
            { label: 'India',      value: 'india'      },
            { label: 'Jordan',     value: 'jordan'     },
            { label: 'Morocco',    value: 'morocco'    },
            { label: 'Portuguese', value: 'portuguese' },
            { label: 'Syria',      value: 'syria'      },
            { label: 'USA',        value: 'usa'        }
        ],
        contact: {
            type: Object,
            _method: 'PUT',
            default: () => ({})
        }
      }
    },
    methods: {
	    getUserDetail: function (userID = null){
        var $this = this;
        var userDataUrl = userID ? siteIndexURL+'/v1/users/'+userID+'/edit' : siteIndexURL+'/v1/users/show';
        axios.get(userDataUrl).then((result)=>{
          if (result.data.status == true) {         
            $this.contact = result.data.response.user.contact;
          }
        }).catch(function (error) {
          if (error.response) {
            $this.responseHandle('warning', error.response.data.message);
          }
        });
      },
      saveForm: function(){
        this.$validator.validateAll().then(result => {
          if (result) {
          let userId = this.userId;
          var $this = this
          if (userId) {
            	var formData = new FormData();
              formData.append("address1", $this.contact.address1);
              formData.append("address2", $this.contact.address2);
              formData.append("city", $this.contact.city);
              formData.append("country", $this.contact.country.value);
              formData.append("mobile", $this.contact.mobile);
              formData.append("postal_code", $this.contact.postal_code);
              formData.append("state", $this.contact.state);
              formData.append("type", 'contact');
              formData.append("_method", 'PUT');
              formData.append("user_id", userId);
			
              axios.post(siteIndexURL+"/v1/users/"+userId, formData)
              .then( result => {
			
                if (result.data.status == true) {
                  $this.responseHandle('success', result.data.message);
                  $this.$router.replace({ name: $this.activeName, params: {userID:userId}, query: {activeTab: 3} });
                  this.$emit('nextActiveTab', 3);
                }else{
					
					this.responseHandle('warning', 'test');
				}
              }).catch(function (error) {

                if (error.response) {
                  $this.responseHandle('warning', error.response.data.message);

                }
              });
          }else {
            $this.responseHandle('warning', 'Please Create First Basic Information');
          }
        } else {
          $this.responseHandle('warning', 'Please solve errors');
        }
      })
      
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
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeMount() {
    let currentRoute = this.$router.currentRoute;   
    var user_id = currentRoute.params.userID;
    if(user_id && user_id != undefined){
      this.userId = user_id
      this.activeName = this.$router.currentRoute.name;
      this.getUserDetail(user_id);
    }else{
      this.getUserDetail();
    }
  }
}
</script>
