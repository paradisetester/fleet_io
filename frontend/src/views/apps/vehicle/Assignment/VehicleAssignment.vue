<template>
  <div id="simple-calendar-app">    
    <div class="vx-card no-scroll-content">
      <calendar-view
        ref="calendar"
        :displayPeriodUom="calendarView"
        :show-date="showDate"
        :events="simpleCalendarEvents"
        enableDragDrop
        :eventTop="windowWidth <= 400 ? '2rem' : '3rem'"
        eventBorderHeight="0px"
        eventContentHeight="1.65rem"
        class="theme-default"
        @click-date="openAddNewEvent"
        @click-event="openEditEvent"
        @drop-on-date="eventDragged">

        <div slot="header" class="mb-4">

          <div class="vx-row no-gutter">

            <!-- Month Name -->
            <div class="vx-col w-1/3 items-center sm:flex hidden">
              <!-- Add new event button -->
              <vs-button icon-pack="feather" icon="icon-plus" @click="promptAddNewEvent(new Date())">Add</vs-button>
            </div>

            <!-- Current Month -->
            <div class="vx-col sm:w-1/3 w-full sm:my-0 my-3 flex sm:justify-end justify-center order-last">
              <div class="flex items-center">
                <feather-icon
                  :icon="$vs.rtl ? 'ChevronRightIcon' : 'ChevronLeftIcon'"
                  @click="updateMonth(-1)"
                  svgClasses="w-5 h-5 m-1"
                  class="cursor-pointer bg-primary text-white rounded-full" />

                <span class="mx-3 text-xl font-medium whitespace-no-wrap">{{ showDate | month }}</span>

                <feather-icon
                  :icon="$vs.rtl ? 'ChevronLeftIcon' : 'ChevronRightIcon'"
                  @click="updateMonth(1)"
                  svgClasses="w-5 h-5 m-1"
                  class="cursor-pointer bg-primary text-white rounded-full" />
              </div>
            </div>

            <div class="vx-col sm:w-1/3 w-full flex justify-center">
              <template v-for="(view, index) in calendarViewTypes">
                <vs-button
                  v-if="calendarView === view.val"
                  :key="String(view.val) + 'filled'"
                  type="filled"
                  class="p-3 md:px-8 md:py-3"
                  :class="{'border-l-0 rounded-l-none': index, 'rounded-r-none': calendarViewTypes.length !== index+1}"
                  @click="calendarView = view.val"
                  >{{ view.label }}</vs-button>
                <vs-button
                  v-else
                  :key="String(view.val) + 'border'"
                  type="border"
                  class="p-3 md:px-8 md:py-3"
                  :class="{'border-l-0 rounded-l-none': index, 'rounded-r-none': calendarViewTypes.length !== index+1}"
                  @click="calendarView = view.val"
                  >{{ view.label }}</vs-button>
              </template>

            </div>
          </div>
          <div class="vx-row sm:flex hidden mt-4">
            <div class="vx-col w-full flex">
              <!-- Labels -->
              <div class="flex flex-wrap sm:justify-start justify-center">
                  <div v-for="(label, index) in calendarLabels" :key="index" class="flex items-center mr-4 mb-2">
                      <div class="h-3 w-3 inline-block rounded-full mr-2" :class="'bg-' + label.color"></div>
                      <span>{{ label.text }}</span>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </calendar-view>
    </div>

    <!-- ADD EVENT -->
    <vs-prompt
        class="calendar-event-dialog"
        title="Add Inspection"
        accept-text= "Add Inspection"
        @accept="addEvent"
        :active.sync="activePromptAddEvent">
        <div class="my-4">
          <vs-select
            placeholder="Search and select"
            class=""
            label="Vehicle"
            label-placeholder="Vehicle"
            v-validate="'required'"
            autocomplete
            style="width: 100%;"
            v-model="vehicleAssignment.vehicle_id"
            >
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in vehicleOptions" />
          </vs-select>
        </div>
        <div class="my-4">
          <vs-select
            placeholder="Search and select"
            class=""
            label="Operator"
            label-placeholder="Operator"
            v-validate="'required'"
            autocomplete
            style="width: 100%;"
            v-model="vehicleAssignment.contact_id"
            >
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in vendorOptions" />
          </vs-select>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">Start Date</label>
              <datepicker :language="$vs.rtl ? langHe : langEn" v-validate="'required'" :disabledDates="disabledDatesFrom" name="start-date" v-model="vehicleAssignment.start_date"></datepicker>
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">Start Time</label>
              <flat-pickr :config="configdateTimePicker" v-validate="'required'" @on-close="checkEventTime" class="form-control" v-model="vehicleAssignment.start_time" placeholder="Start Time" />
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter" v-if="vehicleAssignment.vehicle_id && vehicleAssignment.contact_id">
              <label class="date-label">Starting Odometer</label>
              <vs-input name="starting_odometer" v-validate="'required'" class="w-full mt-6" v-model="vehicleAssignment.starting_odometer"></vs-input> 
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">End Date</label>
              <datepicker :language="$vs.rtl ? langHe : langEn" v-validate="'required'" :disabledDates="disabledDatesTo" name="end-date" v-model="vehicleAssignment.end_date"></datepicker>
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">End Time</label>
              <flat-pickr :config="configdateTimePicker" v-validate="'required'" @on-close="checkEventTime" class="form-control" v-model="vehicleAssignment.end_time" placeholder="End Time" />
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter" v-if="vehicleAssignment.vehicle_id && vehicleAssignment.contact_id">
              <label class="date-label">Ending Odometer</label>
              <vs-input name="ending_odometer" v-validate="'required'" class="w-full mt-6" v-model="vehicleAssignment.ending_odometer"></vs-input> 
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter">
              <label class="date-label">Comment</label>
              <vs-textarea name="comment" class="w-full mt-6" v-model="vehicleAssignment.comment"></vs-textarea>
          </div>
        </div>
               
    </vs-prompt>

    <!-- EDIT EVENT -->
    <vs-prompt
        class="calendar-event-dialog"
        title="Edit Inspection"
        accept-text= "Submit"
        cancel-text = "Remove"
        button-cancel = "border"
        @cancel="removeEvent"
        @accept="editEvent"
        :active.sync="activePromptEditEvent">

        <div class="my-4">
          <vs-select
            placeholder="Search and select"
            class=""
            label="Vehicle"
            label-placeholder="Vehicle"
            v-validate="'required'"
            autocomplete
            style="width: 100%;"
            v-model="vehicleAssignment.vehicle_id"
            >
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in vehicleOptions" />
          </vs-select>
        </div>
        <div class="my-4">
          <vs-select
            placeholder="Search and select"
            class=""
            label="Operator"
            label-placeholder="Operator"
            v-validate="'required'"
            autocomplete
            style="width: 100%;"
            v-model="vehicleAssignment.contact_id"
            >
            <vs-select-item :key="index" :value="item.value" :text="item.text" v-for="(item,index) in vendorOptions" />
          </vs-select>
        </div>
        <div class="vx-row">
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">Start Date</label>
              <datepicker :language="$vs.rtl ? langHe : langEn" v-validate="'required'" :disabledDates="disabledDatesFrom" name="start-date" v-model="vehicleAssignment.start_date"></datepicker>
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">Start Time</label>
              <flat-pickr :config="configdateTimePicker" v-validate="'required'" @on-close="checkEventTime" class="form-control" v-model="vehicleAssignment.start_time" placeholder="Start Time" />
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter" v-if="vehicleAssignment.vehicle_id && vehicleAssignment.contact_id">
              <label class="date-label">Starting Odometer</label>
              <vs-input name="starting_odometer" v-validate="'required'" class="w-full mt-6" v-model="vehicleAssignment.starting_odometer"></vs-input> 
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">End Date</label>
              <datepicker :language="$vs.rtl ? langHe : langEn" v-validate="'required'" :disabledDates="disabledDatesTo" name="end-date" v-model="vehicleAssignment.end_date"></datepicker>
          </div>
          <div class="vx-col sm:w-1/2 w-full margin_tp_10 box_outter">
              <label class="date-label">End Time</label>
              <flat-pickr :config="configdateTimePicker" v-validate="'required'" @on-close="checkEventTime" class="form-control" v-model="vehicleAssignment.end_time" placeholder="End Time" />
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter" v-if="vehicleAssignment.vehicle_id && vehicleAssignment.contact_id">
              <label class="date-label">Ending Odometer</label>
              <vs-input name="ending_odometer" v-validate="'required'" class="w-full mt-6" v-model="vehicleAssignment.ending_odometer"></vs-input> 
          </div>
          <div class="vx-col sm:w-1/1 w-full margin_tp_10 box_outter">
              <label class="date-label">Comment</label>
              <vs-textarea name="comment" class="w-full mt-6" v-model="vehicleAssignment.comment"></vs-textarea>
          </div>
        </div>       
    </vs-prompt>

  </div>
</template>

<script>
  import { CalendarView, CalendarViewHeader } from 'vue-simple-calendar'
  import 'vue-simple-calendar/static/css/default.css';

  import Datepicker from 'vuejs-datepicker'
  import { en, he } from 'vuejs-datepicker/src/locale'
  import flatPickr from 'vue-flatpickr-component'
  import 'flatpickr/dist/flatpickr.css'
  import {
    siteIndexURL
  } from '../../../../axios'
  import axios from 'axios';

  export default {
    components: {
      CalendarView,
      CalendarViewHeader,
      Datepicker,
      flatPickr
    },
    data () {
      return {
        showDate: new Date(),
        disabledFrom: false,
        simpleCalendarEvents:[],
        vehicleAssignment: {
          vehicle_id: '',
          contact_id: '',
          start_date: '',
          start_time: '',
          starting_odometer: '',
          end_date: '',
          end_time: '',
          ending_odometer: '',
          comment: ''
        },
        vehicleOptions:[],
        vendorOptions:[],
        configdateTimePicker: {
          enableTime: true,
          enableSeconds: true,
          noCalendar: true
        },
        langHe: he,
        langEn: en,
        calendarView: 'month',
        activePromptAddEvent: false,
        activePromptEditEvent: false,
        calendarViewTypes: [
          {
            label: 'Month',
            val: 'month'
          },
          {
            label: 'Week',
            val: 'week'
          },
          {
            label: 'Year',
            val: 'year'
          }
        ]
      }
    },
    computed: {
      disabledDatesTo () {
        return { to: new Date(this.start_date) }
      },
      disabledDatesFrom () {
        return { from: new Date(this.end_date) }
      },
      calendarLabels () {
        return [
          {
            color: "success",
            text: "Assignments",
            value: "1"
          }
        ];
      },
      windowWidth () {
        return this.$store.state.windowWidth
      }
    },
    methods: {
      getAssignments: function()
      {
        this.simpleCalendarEvents = [];
        var $this = this;
        axios.get(siteIndexURL+'/v1/vehicleAssignment')
        .then((result)=>{
          if (result.data.status == true) {
            var vehicleAssignments = result.data.response.vehicleAssignments; 
            vehicleAssignments.forEach((data) => {
              data.title = data.vehicleName+'-'+data.start_date+'-'+data.end_date;
              data.startDate = data.start_date;
              data.endDate = data.end_date;
              data.classes = 'event-success';
              data.label = data.vehicleName+'-'+data.start_date+'-'+data.end_date;
              this.simpleCalendarEvents.push(data);
            });
          }
        }).catch(function (error) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          } 
        });      
      },
      getVehicles: function()
      {
        var $this = this;
        axios.get(siteIndexURL + '/v1/vehicledetails')
        .then((result) => {
          if (result.data.status == true) {
            var vehicleOption = {}
            result.data.response.vehicleDetails.forEach((data) => {
              vehicleOption = {
                text: data.name,
                value: data.vehicle_id
              }
              this.vehicleOptions.push(vehicleOption);
            });
          }
        }).catch(function (error) {
          if (error.response != undefined) {
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          }
        });      
      },
      getVendors: function()
      {
        var $this = this;
        axios.get(siteIndexURL + '/v1/vendor')
        .then((result) => {
          if (result.data.status == true) {
            var vendorOption = {}
            result.data.response.vendors.forEach((data) => {
              vendorOption = {
                text: data.name,
                value: data.vendor_id
              }
              this.vendorOptions.push(vendorOption);
            });
          }
        }).catch(function (error) {
          if (error.response != undefined) {
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          }
        });       
      },
      responseHandle: function(type = 'warning', message = '')
      {
        this.$vs.notify({
          color: type,
          title: '',
          text: message
        })
      },
      checkEventTime: function()
      {
        var start_time = this.vehicleAssignment.start_time.split(':');
        var startTime = start_time[0];
        var end_time = this.vehicleAssignment.end_time.split(':');
        start_time = start_time.join('');
        end_time = end_time.join('');
        if (start_time >= end_time) {         
          if (this.vehicleAssignment.start_time && this.end_time) {
            this.responseHandle('warning', 'End Time is greater then start time');
          }         
          this.vehicleAssignment.end_time = (parseInt(startTime)+1) + ':00:00'; 
        }
      },
      addEvent () {
        this.activePromptAddEvent = true
        var $this = this
          axios.post(siteIndexURL+"/v1/vehicleAssignment", this.vehicleAssignment)
          .then( result => {
            if (result.data.status == true) {
              this.getAssignments();
              this.responseHandle('success', result.data.message);
              this.activePromptAddEvent = false
            }
          }).catch(function (error) {
            if (error.response) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
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
      updateMonth (val) {
        this.showDate = this.$refs.calendar.getIncrementedPeriod(val)
      },
      clearFields () {
        this.vehicleAssignment = {
          vehicle_id: '',
          contact_id: '',
          start_date: '',
          start_time: '',
          starting_odometer: '',
          end_date: '',
          end_time: '',
          ending_odometer: '',
          comment: ''
        };
      },
      promptAddNewEvent (date) {
        this.disabledFrom = false
        this.addNewEventDialog(date)
      },
      addNewEventDialog (date) {
        this.clearFields()
        this.vehicleAssignment.start_date = date
        this.vehicleAssignment.end_date = date
        this.activePromptAddEvent = true
      },
      openAddNewEvent (date) {
        this.disabledFrom = true
        this.addNewEventDialog(date)
      },
      openEditEvent (event) {
        var originalEvent = event.originalEvent
        this.vehicleAssignment = originalEvent;
        this.activePromptEditEvent = true
      },
      editEvent () {
        this.activePromptEditEvent = true
        var $this = this
          axios.put(siteIndexURL+"/v1/vehicleAssignment/"+this.vehicleAssignment.assignment_id, this.vehicleAssignment)
          .then( result => {
            if (result.data.status == true) {
              this.getAssignments();
              this.responseHandle('success', result.data.message);
              this.activePromptEditEvent = false
            }
          }).catch(function (error) {
            if (error.response) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
      },
      removeEvent () {
        this.activePromptEditEvent = true
        if (!confirm('Are you sure, you want to delete')) {
          return false
        }
        var $this = this;
        axios.delete(siteIndexURL+'/v1/vehicleAssignment/'+this.vehicleAssignment.assignment_id)
        .then((result) => {
          if (result.data.status == true) {
            this.responseHandle('success', result.data.message);
              this.getAssignments();
            this.activePromptEditEvent = false;                                  
          }
        }).catch(function (error) {
          if (error.response.data.detail) {
            $this.responseHandle('warning', error.response.data.detail);
          }
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          }
          this.activePromptEditEvent = false;
        })
      },
      eventDragged (event, date) {
        this.$store.dispatch('calendar/eventDragged', {event, date})
      }
    },
    created () {
    },
    beforeDestroy () {
      this.$store.unregisterModule('calendar')
    },
    beforeMount(){
      this.getAssignments();
      this.getVehicles();
      this.getVendors();
    }
  }
</script>

<style lang="scss">
@import "@/assets/scss/vuexy/apps/simple-calendar.scss";
</style>
