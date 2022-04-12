<template>
  <div>
    <about-us v-if="template == 'aboutUs'" :page="page"></about-us>
    <career v-else-if="template == 'career'" :page="page"></career>
    <checkout v-else-if="template == 'checkout'" :page="page"></checkout>
    <contact-us v-else-if="template == 'contactUs'" :page="page"></contact-us>
    <payment v-else-if="template == 'payment'" :page="page"></payment>
    <plans v-else-if="template == 'plans'" :page="page"></plans>
    <not-found v-else></not-found>
  </div>
</template>


<script>
import AboutUS from './AboutUs'
import Career from './Career'
import Checkout from './Checkout'
import ContactUs from './ContactUs'
import Payment from './Payment'
import Plans from './Plans'
import NotFound from './NotFound'

import axios from 'axios';
import {siteIndexURL} from '../axios'
export default {
    name:'front-single',
    components: {
        'about-us': AboutUS,
        'career': Career,
        'checkout': Checkout,
        'contact-us': ContactUs,
        'payment': Payment,
        'plans': Plans,
        'not-found': NotFound
    },
    data:() =>({
        slug:'',
        page:{},
        template:''
    }),
    watch:{
      '$route' (to){
        window.scrollTo(0, 0)
        this.getData(to.params.slug)
      }
    },
    mounted () {
      window.scrollTo(0, 0)
    },
    methods:{
        getData:function(slug = null){           
            var $this = this;
            axios.get(siteIndexURL+'/v1/getPostPage/'+slug)
            .then((result)=>{
                if (result.data.status == true) {
                    this.page = result.data.response.post;  
                    this.template = this.page.template;
                    if (this.page.template == undefined || !this.page.template) {
                        this.template = 'notFound';
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
        responseHandle: function(type = 'warning', message = '')
        {
          this.$vs.notify({
            color: type,
            title: '',
            text: message
          })
        }
    },
    beforeMount(){
        let currentRoute = this.$router.currentRoute.params;
        this.getData(currentRoute.slug);
    }
}
</script>

