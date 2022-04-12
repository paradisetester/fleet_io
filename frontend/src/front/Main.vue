<template>
  <div>
    <v-header></v-header>
      <router-view />
    <v-footer></v-footer>
  </div>
</template>


<script>
import Header from './Header'
import Footer from './Footer'
export default {
  components: {
    'v-header': Header,
    'v-footer': Footer
  },
  data() {
    return {
      
    }
  },
  watch: {
  },
  computed: {
    
  },
  methods: {
    
  },
  created() {
    
  }
}

</script>

