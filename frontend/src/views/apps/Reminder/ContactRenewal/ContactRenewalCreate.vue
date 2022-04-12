<template>
  <vx-card no-shadow>
 <h6 class="mb-4">New Service Task</h6>
 <form v-on:submit.prevent>
<div class="mt-4">
<label class="text-sm">Name</label>
<vs-input class="w-full mb-base" v-model="contact_name" v-validate="'required'" name="contact_name"></vs-input>
</div>
<span class="text-danger text-sm" v-show="errors.has('contact_name')">{{ errors.first('contact_name') }}</span>

<div class="mt-4">
<label class="text-sm">Contact Type</label>
<vs-input class="w-full mb-base" v-model="contact_type" v-validate="'required'" name="contact_type"></vs-input>
</div>
<span class="text-danger text-sm" v-show="errors.has('contact_type')">{{ errors.first('contact_type') }}</span>

<div class="mt-4">
      <label class="text-sm">Due Date</label>
       <flat-pickr v-model="due_date" :config="{ dateFormat: 'Y-m-d' }" class="w-full" v-validate="'required'" name="due_date" />
    </div>
  <span class="text-danger text-sm" v-show="errors.has('due_date')">{{ errors.first('due_date') }}</span>

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
import {siteIndexURL} from '../../../../axios'



export default {
  components: {
    flatPickr,
    vSelect,
    quillEditor,
  },
  data () {
    return {
      configdateTimePicker: {
      enableTime: true,
      enableSeconds: true,
      noCalendar: true
      },
      contact_name:'',
      contact_type:'',
      due_date:'',  
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
          formData.append("contact_name", $this.contact_name);
          formData.append("contact_type", $this.contact_type);
          formData.append("due_date", $this.due_date);
       axios.post(siteIndexURL+"/v1/contact_renewal_reminder", formData)
       .then( result => {
         if (result.data.status == true) {
           this.responseHandle('success', result.data.message);
           this.$router.push('/contact/renewal')
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
    responseHandle: function (type = 'warning', message = '') {
     this.$vs.notify({
        color: type,
        title: '',
        text: message
     })
    }
  },
  beforeMount() {

  }
}
</script>