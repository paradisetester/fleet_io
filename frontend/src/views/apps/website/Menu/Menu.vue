<template>
   <vx-card no-shadow>
      <h6 class="mb-4">Add menu items</h6>
      <!-- Info -->
      <vs-row>
         <vs-col vs-w="4" class="p-4 sm:p-2 menus_list">
            <label class="text-sm">Pages</label>
            <div class="flex flex-wrap items-center mb-base">
               <ul>
                  <li v-for="(page, index) in pagesList" :key="index">
                     <vs-checkbox v-model="selectedPage" :vs-value="page">{{page.link_name}}</vs-checkbox>
                  </li>
                  <li>
                     <vs-button class="ml-auto mt-2" @click="addToMenu">Add to menu</vs-button>
                  </li>
               </ul>
            </div>
         </vs-col>
         <vs-col vs-w="8" class="p-4 sm:p-2 menus_list">
            <div class="col-3">
               <draggable v-model="menusList" class="dragable-list-item" draggable=".list-item">
                  <div v-for="(element, elIndex) in menusList" :key="elIndex" class="list-item">
                    <vs-input class="w-full w-full-input" v-model="element.link_name"></vs-input> 
                     <span class="list-remove-btn" @click="removeMenuItem(elIndex)"><i class="feather icon-trash-2"></i></span>
                  </div>
               </draggable>
            </div>
         </vs-col>
      </vs-row>
      <!-- Save & Reset Button -->
      <div class="flex flex-wrap items-center justify-end">
         <vs-button class="ml-auto mt-2" @click="saveChanges();">Save Changes</vs-button>
         <vs-button class="ml-4 mt-2" type="border" color="warning" v-on:click="menusList = [], selectedPage=[]">Reset</vs-button>
      </div>
   </vx-card>
</template>

<script>
import draggable from 'vuedraggable'
import axios from 'axios';
import {siteIndexURL} from '../../../../axios'

export default {
  components: {
    draggable
  },
  data() {
    return {
      selectedPage:[],
      pagesList: [],
      menusList: [],
      deletedItem: []
    }
  },
  computed: {
  },
  methods: {
    getPages: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/posts')
      .then((result)=>{
         if (result.data.status == true) {
          var pages = result.data.response.posts;  
          var page;  
          if (pages.length > 0) {
            for (var i = 0; i < pages.length; i++) {              
              page = {
                post_id: pages[i].post_id,
                link_name: pages[i].title,
                link_url: pages[i].slug,
                link_order: i,
                link_parent: 0,
                link_id:0
              };
              this.pagesList.push(page);
            }
          }
        }
      }).catch(function (error) {
        if (error.response != undefined) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          } 
        } 
      });
    },
    getMenus: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/menus')
      .then((result)=>{
         if (result.data.status == true) {
          var pages = result.data.response.menus;    
          var page;
          if (pages.length > 0) {
            this.menusList = [];
            for (var i = 0; i < pages.length; i++) {              
              page = {
                post_id: pages[i].post_id,
                link_name: pages[i].link_name,
                link_url: pages[i].link_url,
                link_id: pages[i].link_id,
                link_order: i,
                link_parent: 0,
              };
              this.menusList.push(page);
            }
          }
        }
      }).catch(function (error) {
        if (error.response != undefined) {
          if (error.response.data.message) {
            $this.responseHandle('warning', error.response.data.message);
          } 
        }        
      });
    },
    addToMenu() {
      if (this.selectedPage.length > 0) {
        var page = {};
        for (var i = 0; i < this.selectedPage.length; i++) {
          page = {
            post_id: this.selectedPage[i].post_id,
            link_name: this.selectedPage[i].link_name,
            link_url: this.selectedPage[i].link_url,
            link_id: this.selectedPage[i].link_id,
            link_order: i,
            link_parent: 0,
          }
          this.menusList.push(page);
        }
        this.selectedPage = [];
      }
    },
    removeMenuItem: function(index)
    {
      var menu = this.menusList[index];
      var item = menu.link_id;
      this.deletedItem.push(item);
      if (index > -1) {
        this.menusList.splice(index, 1);
      }
    },
    saveChanges: function()
    {
      this.$validator.validateAll().then(result => {
        if (result) {
          var $this = this          
          const dataString = {
            menus: this.menusList,
            deletedItem: this.deletedItem
          }
          axios.post(siteIndexURL+"/v1/menus", dataString)
          .then( result => {
            if (result.data.status == true) {
              var pages = result.data.response.menus;    
              var page;
              if (pages.length > 0) {
                this.menusList = [];
                for (var i = 0; i < pages.length; i++) {              
                  page = {
                    post_id: pages[i].post_id,
                    link_name: pages[i].link_name,
                    link_url: pages[i].link_url,
                    link_id: pages[i].link_id,
                    link_order: i,
                    link_parent: 0,
                  };
                  this.menusList.push(page);
                }
              }
              this.responseHandle('success', result.data.message);
            }
          }).catch(function (error) {
            if (error.response.data.detail) {
              $this.responseHandle('warning', error.response.data.detail);
            }
            if (error.response.data.message) {
              $this.responseHandle('warning', error.response.data.message);
            }
          });
        } else {
          this.responseHandle('warning', 'Please solve errors');
        }
      })
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
  beforeMount() { 
    this.getPages();
    this.getMenus();
  }
}
</script>
