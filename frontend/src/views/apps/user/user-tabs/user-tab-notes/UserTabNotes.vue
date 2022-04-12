<!-- =========================================================================================
  File Name: Todo.vue
  Description: Todo Application to keep you ahead of time
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>

    <div id="todo-app" class=" rounded relative overflow-hidden">
	   <div class="vx-row">
	        	<div class="vx-col w-full sm:w-3/4 "></div>
	        	<div class="vx-col w-full sm:w-1/4 ">
	        		<vs-button @click="addNotePopup()" class="w-full add_not">Add Note</vs-button>
	        	</div>
	        </div>
        <!-- <vs-sidebar class="items-no-padding" parent="#todo-app" :click-not-close="clickNotClose" :hidden-background="clickNotClose" v-model="isSidebarActive">

            

            <component :is="scrollbarTag" class="todo-scroll-area" :settings="settings" :key="$vs.rtl">
                <todo-filters @closeSidebar="toggleTodoSidebar"></todo-filters>
            </component>

        </vs-sidebar> -->
        <div class="no-scroll-content no-scroll-content">
        	
            <!-- <div class="flex d-theme-dark-bg items-center border border-l-0 border-r-0 border-t-0 border-solid d-theme-border-grey-light">

                <feather-icon class="md:inline-flex lg:hidden ml-4 mr-4 cursor-pointer" icon="MenuIcon" @click.stop="toggleTodoSidebar(true)" />

                <vs-input icon-no-border size="large" icon-pack="feather" icon="icon-search" placeholder="Search..." v-model="searchQuery" class="vs-input-no-border vs-input-no-shdow-focus w-full" />
            </div> -->

            <!-- TODO LIST -->
            <component :is="scrollbarTag" class="todo-content-scroll-area" :settings="settings" ref="taskListPS" :key="$vs.rtl">

                <transition-group class="todo-list s_todo" name="list-enter-up" tag="ul" appear>
                    <li
                      class="cursor-pointer todo_todo-item"
                      v-for="(task, index) in taskList"
                      :key="String(currFilter) + String(task.id)"
                      :style="[{transitionDelay: (index * 0.1) + 's'}]">

                       <todo-task :task="task" @showDisplayPrompt="showDisplayPrompt($event)" @showDisplayPromptEvent="showDisplayPromptEvent($event)" @showDisplayPromptEventDelete="showDisplayPromptEventDelete($event)" :key="task.id" /> 
                        <!--
                        Note: Remove "todo-task" component's key just concat lastUpdated field in li key list.
                        e.g. <li class="..." v-for="..." :key="String(currFilter) + String(task.id) + String(task.lastUpdated)" .. >
                        -->
                    </li>
                </transition-group>
            </component>
            <!-- /TODO LIST -->

        </div>

        <!-- EDIT TODO DIALOG -->
        <vs-popup class="holamundo" :title="taskLocal.id?'Edit Note':'Add Note'" :active.sync="popupActiveADD">
          <form v-on:submit.prevent>
            <div class="vx-row">
               <div class="vx-col w-full">
                  <vs-input v-validate="'required'" name="title" class="w-full mb-4 mt-5"  placeholder="Title" label="Title" v-model="taskLocal.title"/>
                  <vs-textarea rows="5" placeholder="Add description" label="Add description" class="mt-5" v-model="taskLocal.text" />
                  <vs-button class="mr-3 mb-2" @click.prevent="addTodo">Submit</vs-button>
               </div>
            </div>
          </form>
        </vs-popup>
        <vs-popup fullscreen class="holamundo" :title="taskIdToEdit.title" v-if="taskIdToEdit" :active.sync="popupActive">
          <form v-on:submit.prevent>
            <div class="vx-row">
              <div class="vx-col sm:w-1/2 w-full" >
                <h4>{{taskIdToEdit.title}}</h4>
                <p>{{taskIdToEdit.text}}</p>
                <div class="vx-row box_outter">
                   <vs-textarea
                      icon-pack="feather" icon="icon-edit-2" icon-before
                      data-vv-as="Comment"
                      v-model="notes"
                      name="notes"
                      label="Comment"
                      class="w-full" />
                   <span class="text-danger text-sm" v-show="errors.has('notes')">{{ errors.first('notes') }}</span>
                </div>
                <div class="vx-col w-full">
                   <vs-button class="mr-3 mb-2" @click.prevent="createTaskNotes">Submit</vs-button>
                </div>
                <div class="vx-col">
                  <ul class="todo-list fn_pro_todo">
                    <li class="cursor-pointer todo_todo-item" style="transition-delay: 0s;" v-for="(taskNote, index) in taskNotes">
                      <div class="px-4 py-4 list-item-component">
                        <div class="vx-col w-full sm:w-6/6 flex sm:items-center sm:flex-row flex-col">
                           <div class="flex items-center todo_in_txt">
                              <p class="todo-title">{{taskNote.text}}</p>
                           </div>
                           <div class="todo-tags sm:ml-2 sm:my-0 my-2 flex">
                              <div class="con-vs-chip vs-chip-null" style="color: rgba(0, 0, 0, 0.7);">
                                 <span class="text-chip vs-chip--text">
                                    <div :class="'h-2 w-2 rounded-full mr-1 bg-'+noteLabelColor(taskNote.comment_type)"></div>
                                    <span>{{noteLabel(taskNote.comment_type)}}</span>
                                 </span>
                                 <!---->
                              </div>
                           </div>
						    <div class="todo_icons">
                           		<feather-icon
                           	  		@click="editTaskNote(taskNote)"
    			                  	icon="EditIcon"
    			                  	class="cursor-pointer"
    			                  	svgClasses="h-5 mr-4 text-success stroke-current" />
    			                <feather-icon
    			                	@click="deleteTaskNote(taskNote.id)"
    	                  			icon="TrashIcon"
    			                  	class="cursor-pointer"
    			                  	svgClasses="w-5 h-5 text-warning stroke-current" />
							</div>  
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>    
              </div>             
              <div class="vx-col sm:w-1/3 w-full" >
                <section class="ps-container todo-scroll-area ps ps--theme_default">
                  <div class="todo__filters-container">
                    <div class="px-6 py-4">
                      <h5>Comment Type</h5>
                      <div class="todo__lables-list">
                          <vs-dropdown-item v-for="(tag, index) in taskTags" :key="index">
                              <vs-radio :vs-value="tag.value" v-model="comment_type">{{ tag.text }}</vs-radio>
                          </vs-dropdown-item>
                      </div>
                    </div>
                  </div>
                </section>
              </div>                             
            </div>
          </form>
        </vs-popup>
    </div>
</template>

<script>
import moduleTodo          from '@/store/todo/moduleTodo.js'
import TodoAddNew          from './TodoAddNew.vue'
import TodoTask            from './TodoTask.vue'
import TodoFilters         from './TodoFilters.vue'
import TodoEdit            from './TodoEdit.vue'
import VuePerfectScrollbar from 'vue-perfect-scrollbar'

import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
export default {
  data () {
    return {
      currFilter           : '',
      clickNotClose        : true,
      displayPrompt        : false,
      popupActive          : false,
      popupActiveEDIT     : false,
      popupActiveADD        : false,
      taskIdToEdit         : 0,
      isSidebarActive      : true,
      notes                : '',
      comment_type           : '',
      id 				   : '',
      taskList             : [],
      taskNotes            : [],
      client_id: '',
      settings : {
        maxScrollbarLength : 60,
        wheelSpeed         : 0.30
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
      taskLocal: {
        id: '',
        title: '',
        text: ''
      },
      taskTags:[
        {
            text: 'General',
            value: '1',
            color: 'primary'
        },
        {
            text: 'Follow Up',
            value: '2',
            color: 'info'
        }
      ]
    }
  },
  watch: {
    todoFilter () {
      const scroll_el = this.$refs.taskListPS.$el || this.$refs.taskListPS
      scroll_el.scrollTop = 0

      this.toggleTodoSidebar()

      // Fetch Tasks
      const filter = this.$route.params.filter
      this.$store.dispatch('todo/fetchTasks', { filter })
      this.$store.commit('todo/UPDATE_TODO_FILTER', filter)
    },
    windowWidth () {
      this.setSidebarWidth()
    }
  },
  computed: {
    todo ()         { return this.$store.state.todo.todoArray              },
    todoFilter ()   { return this.$route.params.filter                     },
    searchQuery:   {
      get ()        { return this.$store.state.todo.todoSearchQuery        },
      set (val)     { this.$store.dispatch('todo/setTodoSearchQuery', val) }
    },
    scrollbarTag () { return this.$store.getters.scrollbarTag              },
    windowWidth ()  { return this.$store.state.windowWidth                 }
  },
  methods: {
    addNotePopup: function(){
      this.taskLocal = {
        id: '',
        title: '',
        text: ''
      };
      this.popupActiveADD = true
    },
    addTodo () {      
      let currentRoute = this.$router.currentRoute.params;
      let client_id = currentRoute.ID
      this.$validator.validateAll().then(result => {
        if (result) {
           const obj = { 
               title: this.taskLocal.title,
               text: this.taskLocal.text
           }
           this.displayPrompt = true
           var $this = this;
          if (this.taskLocal.id) {
            axios.put(siteIndexURL+"/v1/profile/profile_note/edit/"+this.taskLocal.id+"/", obj)
            .then( result => {
              if (result.data.success == true) {
                this.taskLocal = {
                  id:'',
                  title: '',
                  text: ''
                }  
                this.popupActiveADD = false
                this.getTasks();
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
          }else{
            axios.post(siteIndexURL+"/v1/profile/"+client_id+"/create_profile_notes/", obj)
            .then( result => {
              if (result.data.success == true) {
                this.responseHandle('success', result.data.message);
                this.taskLocal = {
                  id:'',
                  title: '',
                  text: ''
                }  
                this.popupActiveADD = false
                this.getTasks();          
              }
            }).catch(function (error) {
              this.getTasks();
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
        }
      })
    },
    showDisplayPrompt (itemId) {
      this.taskIdToEdit  = itemId  
      this.taskLocal = {
        title: this.taskIdToEdit.title,
        text: this.taskIdToEdit.text,
        id: this.taskIdToEdit.id
      }
      this.popupActiveADD = true;
    },
    showDisplayPromptEvent (itemId) {
      this.taskIdToEdit  = itemId
      this.getTaskNotes(itemId);
    },
    showDisplayPromptEventDelete (itemId) {
      var $this = this;
      axios.delete(siteIndexURL+'/v1/profile/profile_note/delete/'+itemId.id+'/')
      .then((result) => {
        if (result.data.success == true) {
          this.responseHandle('success', result.data.message);
          this.getTasks();                     
        }
      }).catch(function (error) {
      	$this.getTasks();
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        }
        if (error.response.data.message) {
          $this.responseHandle('warning', error.response.data.message);
        }
      })
    },
    noteLabelColor: function(event_type)
    {
      var eventType = {
        '1': 'success',
        '2': 'warning',
      }
      return eventType[event_type]
    },
    noteLabel: function(event_type)
    {
      var eventType = {
        '1': 'General',
        '2': 'Follow Up'
      }
      return eventType[event_type]
    },
    getTaskNotes: function(itemId)
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/profile/'+itemId.id+'/note_comments/')
      .then((result)=>{
        if (result.data.success == true) {
          this.taskNotes = result.data.data;
          this.popupActive = true
        }
      }).catch(function (error) {
        $this.popupActive = true
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    createTaskNotes: function()
    { 
      if (!this.notes) {
        this.responseHandle('warning', 'Please write comment');
        return false;
      }      
      if (!this.comment_type) {
        this.responseHandle('warning', 'Please select comment type');
        return false;
      }
       const obj = { 
         text: this.notes,
         comment_type: this.comment_type
       }
       var $this = this;
       if (this.id != '') {
       		axios.put(siteIndexURL+"/v1/profile/note_comment/edit/"+this.id+"/", obj)
       		.then( result => {
       		  if (result.data.success == true) {
       		    this.responseHandle('success', result.data.message); 
       		    this.notes = '';
       		    this.comment_type = '';
       		    this.id = "";
       		    $this.getTaskNotes($this.taskIdToEdit);           
       		  }
       		}).catch(function (error) {
       		   $this.getTaskNotes($this.taskIdToEdit);
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
       } else {
       		axios.post(siteIndexURL+"/v1/profile/"+this.taskIdToEdit.id+"/create_note_comments/", obj)
       		.then( result => {
       		  if (result.data.success == true) {
       		    this.responseHandle('success', result.data.message); 
       		    this.notes = '';
       		    this.comment_type = '';
       		    this.id = '';
       		    $this.getTaskNotes($this.taskIdToEdit);           
       		  }
       		}).catch(function (error) {
       		   $this.getTaskNotes($this.taskIdToEdit);
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
    editTaskNote(taskNote) {
    	this.notes = taskNote.text;
    	this.comment_type = this.comment_type
    	this.id = taskNote.id
    },
    deleteTaskNote(id){
    	if (!confirm('Are you sure, you want to delete')) {
    	  return false
    	}
    	var $this = this;
    	axios.delete(siteIndexURL+'/v1/profile/note_comment/delete/'+id+'/')
    	.then((result) => {
    	  if (result.data.success == true) {
    	    this.responseHandle('success', result.data.message);
    	    $this.getTaskNotes($this.taskIdToEdit);                  	  
    	  }
    	}).catch(function (error) {
    	  if (error.response.data.detail) {
    	    $this.responseHandle('warning', error.response.data.detail);
    	  }
    	  if (error.response.data.message) {
    	    $this.responseHandle('warning', error.response.data.message);
    	  }
    	})
    },
    hidePrompt () {
      this.getTasks();
      this.displayPrompt = false
    },
    setSidebarWidth () {
      if (this.windowWidth < 992) {
        this.isSidebarActive = this.clickNotClose = false
      } else {
        this.isSidebarActive = this.clickNotClose = true
      }
    },
    toggleTodoSidebar (value = false) {
      this.getTasks();
      if (!value && this.clickNotClose) return
      this.isSidebarActive = value
    },
    getTasks: function() {
      var $this = this;
      axios.get(siteIndexURL+'/v1/profile/'+this.client_id+'/profile_notes/')
      .then((result)=>{
        if (result.data.success == true) {
          this.taskList = result.data.data;
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
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
    }
  },
  components: {
    TodoAddNew,
    TodoTask,
    TodoFilters,
    TodoEdit,
    VuePerfectScrollbar
  },
  created () {
    this.$store.registerModule('todo', moduleTodo)
    this.setSidebarWidth()
    let currentRoute = this.$router.currentRoute.params;
    this.client_id = currentRoute.ID
    this.getTasks();
    const filter = this.$route.params.filter

    // Fetch Tasks
    this.$store.dispatch('todo/fetchTasks', { filter })
    this.$store.commit('todo/UPDATE_TODO_FILTER', filter)

    // Fetch Tags
    this.$store.dispatch('todo/fetchTags')
  },
  beforeUpdate () {
    this.currFilter = this.$route.params.filter
  },
  beforeDestroy () {
    this.$store.unregisterModule('todo')
  },
  mounted () {
    this.$store.dispatch('todo/setTodoSearchQuery', '')
  }
}

</script>


<style lang="scss">
@import "@/assets/scss/vuexy/apps/todo.scss";
</style>
