<template>
  <vx-card no-shadow>
 <h6 class="mb-4">User Edit</h6>
 <form v-on:submit.prevent>
    <div class="mt-4">
      <label class="text-sm">Name</label>
    <vs-input class="w-full mb-base" v-model="name" icon-pack="feather" icon="icon-user" icon-no-border v-validate="'required'" name="name"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>
    <div class="mt-4">
      <label class="text-sm">Email</label>
    <vs-input class="w-full mb-base" icon-pack="feather" icon="icon-mail" icon-no-border v-model="email" v-validate="'required'" name="email"></vs-input>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
    <div class="mt-4">
      <label class="text-sm">Password</label>
    <vs-input type="password" class="w-full mb-base" icon-pack="feather" icon="icon-lock" icon-no-border v-model="password" v-validate="'required|min:6'" name="password"/>
    </div>
    <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>
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
import { siteIndexURL, siteURL} from '../../../axios'

export default {
  components: {
    flatPickr,
    vSelect,
   quillEditor,
  },
  data () {
    return {
      name:'',
      email:'',
      password:'',
     
    }
  },
  methods: {
    getPost: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/users/'+this.id+'/edit')
      .then((result)=>{
        if (result.data.status == true) {          
          var users = result.data.response.users;

          this.id = users.id
          this.name = users.name
          this.email  = users.email    
          this.password  = users.password    
        }
      }).catch(function (error) {
        if (error.response) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    saveForm: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this
          const formData = new FormData();
          formData.append("name", this.name);
          formData.append("email", this.email);
          formData.append("password", this.password);
          formData.append("_method", 'PUT');
          axios.post(siteIndexURL+"/v1/users/"+this.id, formData)
          .then( result => {    
            if (result.data.status == true) {
              this.responseHandle('success', result.data.message);
              this.$router.push('/users')
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  },
  beforeMount() {
    let currentRoute = this.$router.currentRoute.params;
    this.id = currentRoute.userID
    this.getPost();
    this.siteIndexUrl = siteURL;
  }
}
</script>
