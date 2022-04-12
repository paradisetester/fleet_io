
<template>
   <vs-prompt
   title="Edit Task"
   accept-text= "Submit"
   cancel-text = "Remove"
   button-cancel = "border"
   @cancel="removeTodo"
   @accept="submitTodo"
   @close="init"
   :is-valid="validateForm"
   :active.sync="activePrompt">
   <div>
      <form>
         <div class="vx-row">
            <div class="vx-col w-full">
                <div class="my-4">
                   <vs-select
                     placeholder="Search and select"
                     class=""
                     label="Event Type"
                     label-placeholder="Event Type"
                     vs-multiple
                     autocomplete
                     style="width: 100%;"
                     v-model="taskLocal.notes_type"
                     >
                     <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in eventTypeOptions" />
                   </vs-select>
                 </div>
                <vs-input v-validate="'required'" name="title" class="w-full mb-4 mt-5"  placeholder="Title" label="Title" v-model="taskLocal.title"/>
                <vs-textarea rows="5" placeholder="Add description" label="Add description" class="mt-5" v-model="taskLocal.text" />
            </div>
         </div>
      </form>
   </div>
   </vs-prompt>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import { en, he } from 'vuejs-datepicker/src/locale'
import Datepicker from 'vuejs-datepicker'
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'

export default {
  components: {
    flatPickr,
    Datepicker
  },
  props: {
    displayPrompt: {
      type: Boolean,
      required: true
    },
    task: {}
  },
  data () {
    return {
      langHe: he,
      langEn: en,
      configdateTimePicker: {
        enableTime: true,
        enableSeconds: true,
        noCalendar: true
      },  
      eventTypeOptions: [
        {
            text: 'General',
            value: '1'
        },
        {
            text: 'Follow Up',
            value: '2'
        }
      ],    
      taskLocal : {
        title: '',
        text: '',
        notes_type: ''
      }
    }
  },
  computed: {
    activePrompt: {
      get () {
        return this.displayPrompt
      },
      set (value) {
        this.$emit('hideDisplayPrompt', value)
      }
    },
    disabledDatesTo () {
      return { to: new Date(this.start_date) }
    },
    disabledDatesFrom () {
      return { from: new Date(this.end_date) }
    },
    validateForm () {
      return !this.errors.any() && this.taskLocal.title !== ''
    }
  },
  methods: {
    checkEventTime: function()
    {
      var start_time = this.taskLocal.start_time.split(':');
      var startTime = start_time[0];
      var end_time = this.taskLocal.end_time.split(':');
      var start_time = start_time.join('');
      var end_time = end_time.join('');
      if (start_time >= end_time) {         
        if (this.taskLocal.start_time && this.taskLocal.end_time) {
          this.responseHandle('warning', 'End Time is greater then start time');
        }         
        this.taskLocal.end_time = (parseInt(startTime)+1) + ':00:00'; 
      }
    },
    removeTodo () {
      
    },
    init () {
    },
    responseHandle: function(type = 'warning', message = '')
    {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    },
    formatDate2: function (date) {
       var d = new Date(date),
          month = "" + (d.getMonth() + 1),
          day = "" + d.getDate(),
          year = d.getFullYear();

       if (month.length < 2) month = "0" + month;
       if (day.length < 2) day = "0" + day;

       return [year, month, day].join("-");
    },
    submitTodo () {
      this.activePrompt = true;
      const obj = { 
           title: this.taskLocal.title,
           text: this.taskLocal.text,
           notes_type: this.taskLocal.notes_type
       }
      var $this = this;
      let currentRoute = this.$router.currentRoute.params;
      let client_id = currentRoute.ID
      axios.put(siteIndexURL+"/v1/profile/profile_note/edit/"+this.task.id+"/", obj)
      .then( result => {
        if (result.data.success == true) {
          this.responseHandle('success', result.data.message);   
          this.$parent.$emit('getTasks')
          window.location.reload(); 
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
           $this.responseHandle('warning', error.response.data.detail);
        }
        if (error.response.data.message) {
           $this.responseHandle('warning', error.response.data.message);
        }
        if (error.response.data.errors) {
           var errors = error.response.data.errors;
           for (let value of Object.values(errors)) {
             $this.responseHandle('warning', value[0]);
           }                        
        }
      });
    }
  },
  beforeMount() { 
    this.taskLocal = this.task
  }
}
</script>
