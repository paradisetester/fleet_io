<template>
  <div>
    <div class="footer">
      <div class="container">
        <div class="footer-outr">
          <div class="footer-col">
				<img :src="pageImage" alt="img" v-if="pageImage" class="responsive">
				<img src="/img/logo.png" alt="img" v-else="" class="responsive">
					
           
            <p>{{Theme.footer}}</p>
          </div>
          <div class="footer-col">
            <h3>Product</h3>
            <ul>
              <li><a href="#">Features</a></li>
              <li><a href="#">Pricing</a></li>
              <li><a href="#">Integrations</a></li>
              <li><a href="#">Developer API</a></li>
              <li><a href="#">Help Center</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h3>Company</h3>
            <ul>
              <li><a href="about-us">About</a></li>
              <li><a href="career">Careers</a></li>
              <li><a href="#">Press</a></li>
              <li><a href="#">Partners</a></li>
              <li><a href="contact-us">Contact</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h3>Related Post</h3>
            <div class="related-outr">
              <div class="thumb-outr">
                <img src="/img/slider1.png">
              </div>
              <div class="ttl-outr">
                <a href="#"><h5>Lorem ipsum, or lipsum as it is</h5></a>
              </div>
            </div>
            <div class="related-outr">
              <div class="thumb-outr">
                <img src="/img/slider1.png">
              </div>
              <div class="ttl-outr">
                <a href="#"><h5>Lorem ipsum, or lipsum as it is</h5></a>
              </div>
            </div>
            <div class="related-outr">
              <div class="thumb-outr">
                <img src="/img/slider1.png">
              </div>
              <div class="ttl-outr">
                <a href="#"><h5>Lorem ipsum, or lipsum as it is</h5></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">
      <div class="container">
        <div class="copy-outr">
          <div class="copy-text">
            <p>All Content TM & © Paradise Techsoft Solutions Pvt. Ltd. All rights reserved</p>
          </div>
          <div class="footer-icon">
            <a href="#"><img src="/img/facebook.png"></a>
            <a href="#"><img src="/img/twitter.png"></a>
            <a href="#"><img src="/img/insta.png"></a>
            <a href="#"><img src="/img/link.png"></a>
            <a href="#"><img src="/img/youtube.png"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import { siteIndexURL, siteURL} from '../axios'
export default {
  components: {
  },
  data() {
    return {
      Theme:'',
      pageImage:''
    }
  },
  watch: {
  },
  computed: {
    
  },
  methods: {
    getTheme: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/themesetting')
      .then((result)=>{
         if (result.data.status == true) {
          this.Theme = result.data.response.themesetting;
          this.pageImage = this.siteIndexUrl+'/'+this.Theme.photo
        }
      }).catch(function (error) {
        if (error.response != undefined && error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
        } 
      });
    },
    
  },
  created() {
    
  },
  beforeMount() {
    this.getTheme();
    this.siteIndexUrl = siteURL;
  }
}

</script>

