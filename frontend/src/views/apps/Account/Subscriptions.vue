<template>
    <GeneralSettings />
</template>

<script>
import GeneralSettings from './GeneralSettings.vue'

export default {
  components: {
    GeneralSettings,   
  },
  data () {
    return {

    }
  },
  computed: {
    isSmallerScreen () {
      return this.$store.state.windowWidth < 768
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
