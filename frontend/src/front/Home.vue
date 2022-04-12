<template>
  <div>
    <section class="banner" style="background-image: url(/img/banner-bg.jpg);">
      <div class="container">
        <div class="banner-outr">
          <h1>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h1>
          <p>Whether you have 5 or 50,000 assets, Fleetio allows you to 
              automate essential operations, manage exceptions instantly 
              and collaborate in one shared workspace to keep vehicles on 
              the road.</p>
          <div class="bnnr-btns"><a  v-on:click="redirectPage('/front/plans')">Take a Tour </a><a  v-on:click="redirectPage('/front/plans')" class="scnd-btn">Start Free Trial </a></div>
        </div>
      </div>
    </section>
    <section class="padding-all second-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="video-outr">
              <div class="img-outr">
                <img src="img/product-screenn.jpg">
              </div>
              <a href="#" class="play-button"><img src="img/play-btn.png"></a>
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
    <section class="padding-all third-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="three-box">
              <div class="three-box-img">
                <img src="img/real-time.png">
              </div>
              <h3>Real-time communication</h3>
              <p>The entire team can actively collaborate on fleet operations with unlimited users, flexible permissions and features built around exception management.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="three-box">
              <div class="three-box-img">
                <img src="img/remote.png">
              </div>
              <h3>Remote fleet management</h3>
              <p>Handle any fleet-related task or surface critical data anytime, anywhere with intuitive web and smartphone apps designed for busy, distributed fleets.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="three-box">
              <div class="three-box-img">
                <img src="img/workflow.png">
              </div>
              <h3>Automated workflows</h3>
              <p>Automate your maintenance process from end to end through powerful operational workflows and data integrations. No more manual data entry.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="padding-all fourth-sec">
      <div class="container">
        <div class="row">

          <div class="col-md-6">
            <div class="right-side-text">
              <h2>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h2>
              <p>A disconnect between fleet managers, owners, vendors, drivers, technicians, admins and other operations personnel can mean unexpected downtime and profit loss. Fleetio gives your team the tools and data they need to manage vehicles and equipment from acquisition to disposal anytime, anywhere.</p>
              <div class="learn-more">
                <a href="#">See Fleet Maintenance features <img src="img/arrow.png"></a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="img-outr">
              <img src="img/order-repair.png">
            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="padding-all fifth-sec">
      <div class="container">
        <div class="testimonial-sec">
          <h1>Testimonials</h1>
          <h6>You're in good company</h6>
        </div>
        <vueper-slides
         slide-image-inside
         class="no-shadow"
         :visible-slides="3"
         slide-multiple
         :gap="1"
         :slide-ratio="1 / 4"
         :dragging-distance="200"
         :breakpoints="{ 800: { visibleSlides: 2, slideMultiple: 2 } }">
          <vueper-slide v-for="(slide, i) in slides" :key="i" :image="slide.image" />
        </vueper-slides>
      </div>
    </section>
    <section class="padding-all last-sec">
      <div class="container">
        <div class="testimonial-sec last-sec-outr">
          <h6>Ready to get started?</h6>
          <h1>Lorem Ipsum is simply dummy text of the printing </h1>
          <p class="lead">Questions? Call us at <a href="tel:11111111111">1-111-111-1111</a> or email <a href="mailto:help@example.com">help@example.com</a></p>
          <div class="start-btn">
            <a v-on:click="redirectPage('/front/plans')">Start Free Trial </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
  import { VueperSlides, VueperSlide } from 'vueperslides'
  import 'vueperslides/dist/vueperslides.css'
  import axios from 'axios';
  import {siteIndexURL, siteURL} from '../axios'

export default {
  components: {
    VueperSlides, VueperSlide
  },
  data() {
    return {
      slides: []
    }
  },
  watch: {
  },
  computed: {
    
  },
  methods: {
  redirectPage($page = '/'){
      this.$router.push($page).catch(() => {})
    },
	
    getTestimonial: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/testimonials')
      .then((result)=>{
         if (result.data.status == true) {           
              result.data.response.posts.forEach((key) => {
           
              var typeFreeText = {         
                image: this.siteIndexUrl+key.image,
                post_id:key.post_id,
                slud:key.slug
              };
              this.slides.push(typeFreeText)
            });

        }
      }).catch(function (error) {
        if (error.response != undefined) {
          if (error.response.data.detail) {
            $this.responseHandle('warning', error.response.data.detail);
          } 
        }
      });
    },
  },
  beforeMount() { 
    this.getTestimonial();
    this.siteIndexUrl = siteURL;
  },
  created() {
    
  }
}

</script>

