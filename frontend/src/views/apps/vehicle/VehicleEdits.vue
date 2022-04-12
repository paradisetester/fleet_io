<template>
  <vs-tabs v-model="activeTab" :position="isSmallerScreen ? 'top' : 'left'" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">

    <!-- GENERAL -->
    <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'Detail' : ''">
      <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
        <detail @nextActiveTab="nextActiveTab($event)"/>
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'Lifecycle' : ''">
      <div class="tab-change-pwd md:ml-4 md:mt-0 mt-4 ml-0">
        <lifecycle @nextActiveTab="nextActiveTab($event)"/>
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-info" :label="!isSmallerScreen ? 'Specification' : ''">
      <div class="tab-info md:ml-4 md:mt-0 mt-4 ml-0">
        <specification @nextActiveTab="nextActiveTab($event)"/>
      </div>
    </vs-tab>
    <vs-tab icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? 'Settings' : ''">
      <div class="tab-social-links md:ml-4 md:mt-0 mt-4 ml-0">
        <settings @nextActiveTab="nextActiveTab($event)"/>
      </div>
    </vs-tab>
   
  </vs-tabs>
</template>

<script>
import Detail from './tabs/Detail.vue'
import Lifecycle from './tabs/Lifecycle.vue'
import Specification from './tabs/Specification.vue'
import Settings from './tabs/Settings.vue'

export default {
  components: {
    Detail,
    Lifecycle,  
    Specification,  
    Settings,  
  },
  data () {
    return {
    activeTab:0
    }
  },
  computed: {
    isSmallerScreen () {
      return this.$store.state.windowWidth < 768
    }
  },
  methods: {
    nextActiveTab: function(action)
    {
      this.activeTab = action;
    }
  },
  beforeMount() {
    if (this.$route.query.activeTab != undefined) {
      this.activeTab = this.$route.query.activeTab
    }
  }
}
</script>

<style lang="scss">
#profile-tabs {
  .vs-tabs--content {
    padding: 0;
  }
}
</style>
