<template>
  <div>
    <section class="banner-head-section">
      <div class="container">
        <div class="page-title-sec">
          <h1>{{ page.title }}</h1>
        </div>
      </div>
    </section>
    <section class="padding-all full-img  dynamic-section" v-if="page.heading">
      <div class="container">
        <div class="row">
          
            <div class="right-side-text">
              <h2>{{ page.heading }}</h2>
              <p>{{ page.short_description }}</p>
                <p class="about-description" v-html="page.description"> </p>
            </div>          

        </div>
      </div>
    </section>

    <section class="padding-all pricing-plans">
      <div class="container">
        <div class="row">

          <div class="col-md-4 col-sm-6" v-for="plan in usersData" :key="plan.id">
                        <div :class="'pricingTable2 '+ plan.color">
                            <div class="pricingTable-header">
                                <h3 class="title">{{plan.heading}}</h3>
                                <div class="price-value">${{plan.price}} per month</div>								
								 <a  href="javascript:void(0)"  v-on:click="addToCart(plan,'free')" class="freetrail pricingTable-signup_free">{{plan.description}}</a>
                            </div>
                            
                            <p v-html="plan.features"></p>
                            <a  href="javascript:void(0)"  v-on:click="addToCart(plan,'paid')" class="pricingTable-signup">Subscribe Now</a>
                        </div>
                    </div>
                    
        </div>
      </div>
    </section>
    
    <section class="padding-all last-sec">
      <div class="container">
        <div class="testimonial-sec last-sec-outr">
          <h6>Ready to get started?</h6>
          <h1>Lorem Ipsum is simply dummy text of the printing </h1>
          <p class="lead">Questions? Call us at <a href="tel:11111111111">1-111-111-1111</a> or email <a href="mailto:help@example.com">help@example.com</a></p>
          <div class="start-btn">
            <a href="#">Start Free Trial </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
import axios from 'axios';
import {siteIndexURL, siteURL} from '../axios'

export default {
  components: {
  },
  data() {
    return {
       usersData: [],
       url :siteURL
    }
  },
  props:[
        'page'
    ],
  watch: {
  },
  computed: {
    
  },
  methods: {
    getPlans: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/plans')
      .then((result)=>{
         if (result.data.status == true) {
          this.usersData = result.data.response.plans;		
        }
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
	
	  addToCart:function(plan,free_trial)
    {
      this.$session.start();
      this.$session.set('cart', plan)
	    this.$session.set('free_trial', free_trial)

      let profile = this.$session.get('profile');
      if (profile == undefined || !profile) {   
	  
        this.$router.push('../auth/register');      
      }else{      
      this.$router.push('/front/checkout');   
}	
    },
  },
  created() {
    
  },
  beforeMount() { 
    this.getPlans();
  }
}

</script>

