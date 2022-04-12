<template>
  <vx-card no-shadow>
 <h6 class="mb-4">Theme Setting</h6>
	<!-- Info -->
	<vs-input class="w-full mb-base" label-placeholder="Website Title" v-model="website_title"></vs-input>

	
	   <div class="mt-5">
			<label class="text-sm">Header Script</label>
            <vs-textarea v-model="header_script" />
       </div>
		
	   <div class="mt-5">
			<label class="text-sm">Footer Script</label>
            <vs-textarea v-model="footer_script" />
       </div>
		
	
    <!-- Save & Reset Button -->
    <div class="flex flex-wrap items-center justify-end">
      <vs-button class="ml-auto mt-2">Save Changes</vs-button>
      <vs-button class="ml-4 mt-2" type="border" color="warning">Reset</vs-button>
    </div>
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

export default {
  components: {
    flatPickr,
    vSelect,
	 quillEditor,
  },
  data () {
  var quill = new Quill('#editor', {
	modules: {
		toolbar: '#toolbar'
	},
	theme: 'snow'
	});
    return {
		 content: `...`,
      // Options
      makeOptions: [
        { label: 'Toyota',  value: 'toyota'  },
        { label: 'GMC',     value: 'gmc'     },
        { label: 'Chevrolet',    value: 'chevrolet'    },
        { label: 'India',      value: 'india'      },
        { label: 'Jordan',     value: 'jordan'     },
        { label: 'Morocco',    value: 'morocco'    },
        { label: 'Portuguese', value: 'portuguese' },
        { label: 'Syria',      value: 'syria'      },
        { label: 'USA',        value: 'usa'        }
      ],
     pageStatusOptions: [
        { label: 'Publish',  value: 'publish'  },
        { label: 'UnPublish',  value: 'unpublish'  },
        { label: 'Draft',  value: 'draft'  },
       
      ],
     
    }
  },
  computed: {
    activeUserInfo () {
      return this.$store.state.AppActiveUser
    }
  }
}
</script>
