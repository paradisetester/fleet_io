<template>
  <div>
    <section class="banner-head-section">
      <div class="container">
        <div class="page-title-sec">
          <h1>{{ page.title }}</h1>
        </div>
      </div>
    </section>
	
 <section class="padding-all fourth-sec full-img dynamic-section">
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <div class="right-side-text">
              <h2>{{ page.heading }}</h2>
              <p>{{ page.short_description }}</p>
                <div class="about-description" v-html="page.description"> </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-outr">
              <img :src="siteIndexUrl+page.image" v-if="page.image">
              <img src="/img/cars.jpg" v-else>
            </div>
          </div>

        </div>
      </div>
    </section>
 <section class="padding-all fourth-sec full-img last-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="img-outr">
              <img src="/img/truck.jpg" alt="About-Us">
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-side-text">
              <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h2>
              <p>A disconnect between fleet managers, owners, vendors, drivers, technicians, admins and other operations personnel can mean unexpected downtime and profit loss. Fleetio gives your team the tools and data they need to manage vehicles and equipment from acquisition to disposal anytime, anywhere.</p>
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
            <a href="/front/plans">Start Free Trial </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>

  import {siteURL} from '../axios'


export default {
    name:'about-us',
    data:() =>({    
    }),
    props:[
        'page'
    ],
    methods:{
    },
    beforeMount(){
       this.siteIndexUrl = siteURL;
    }
}
</script>

