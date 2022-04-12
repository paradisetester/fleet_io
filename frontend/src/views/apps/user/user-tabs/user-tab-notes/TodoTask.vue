<template>
    <div class="px-4 py-4 list-item-component">
        <div class="vx-row">
            <div class="vx-col w-full sm:w-5/6 flex sm:items-center sm:flex-row flex-col">
                <div class="flex items-center">
                    <h6 class="todo-title">{{ task.title }}</h6>
                </div>
                <div class="todo-tags sm:ml-2 sm:my-0 my-2 flex" v-if="task.comment_type">
                  <vs-chip >
                    <div class="h-2 w-2 rounded-full mr-1" :class="'bg-' + todoLabelColor(task.comment_type)"></div>
                    <span>{{ todoLabel(task.comment_type) | capitalize }}</span>
                  </vs-chip>
                </div>
            </div>

            <div class="vx-col w-full sm:w-1/6 ml-auto flex sm:justify-end">
              <feather-icon
                 @click="editPrompt"
                  icon="EditIcon"
                  class="cursor-pointer"
                  svgClasses="h-5 mr-4 text-success stroke-current" />
                <feather-icon
                 @click="displayPrompt"
                  icon="InfoIcon"
                  class="cursor-pointer"
                  svgClasses="h-5 mr-4 text-primary stroke-current" />
                <feather-icon
                 @click="deletePrompt"
                  icon="TrashIcon"
                  class="cursor-pointer"
                  svgClasses="w-5 h-5 text-warning stroke-current" />
            </div>
        </div>
        <div class="vx-row" v-if="task.description">
            <div class="vx-col w-full">
                <p class="mt-2 truncate">{{ task.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
export default{
  props: {
    task: {}
  },
  data () {
    return {
    }
  },
  computed: {
    
  },
  methods: {
    todoLabelColor: function(event_type)
    {
      var eventType = {
        '1': 'success',
        '2': 'warning',
      }
      return eventType[event_type]
    },
    todoLabel: function(event_type)
    {
      var eventType = {
        '1': 'General',
        '2': 'Follow Up'
      }
      return eventType[event_type]
    },
    editPrompt () {
      this.$emit('showDisplayPrompt', this.task)      
    },
    displayPrompt () {
      this.$emit('showDisplayPromptEvent', this.task)   
    },
    deletePrompt() {
      if (!confirm('Are you sure, you want to delete')) {
        return false
      }
      this.$emit('showDisplayPromptEventDelete', this.task);      
    },
    responseHandle: function(type = 'warning', message = '')
    {
      this.$vs.notify({
        color: type,
        title: '',
        text: message
      })
    }
  }
}
</script>
