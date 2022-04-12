<template>
  <div>
     <section class="banner-head-section">
        <div class="container">
           <div class="page-title-sec">
              <h1>Payment</h1>
           </div>
        </div>
     </section>
     <section class="padding-all">
        <div class="container">
           <div class="payment-outr">
              <div class="row cart-body">
                 <div class="payment-sec address-section">
                    <form v-on:submit.prevent> 
                       <div class="panel panel-info">
                          <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                          <div class="panel-body">
                             <div class="form-group">
                                <div class="col-md-12"><strong>Card Number:</strong></div>
                                <div class="col-md-12"><input v-cardformat:formatCardNumber type="text" class="form-control" name="card_number" v-model="card_number" value="" /></div>
                             </div>
                             <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                     <div class="col-md-12"><strong>Exp Year:</strong></div>
                                     <input type="text" class="form-control" name="exp_year" v-model="exp_year" placeholder="2020" /> 
                                  </div>
                                   <div class="col-md-6 margin-bt">
                                    <div class="col-md-12"><strong>Exp Month:</strong></div>
                                      <select class="form-control" name="exp_month" v-model="exp_month">
                                         <option value="">Month</option>
                                         <option value="01">01</option>
                                         <option value="02">02</option>
                                         <option value="03">03</option>
                                         <option value="04">04</option>
                                         <option value="05">05</option>
                                         <option value="06">06</option>
                                         <option value="07">07</option>
                                         <option value="08">08</option>
                                         <option value="09">09</option>
                                         <option value="10">10</option>
                                         <option value="11">11</option>
                                         <option value="12">12</option>
                                      </select>
                                   </div>                                   
                                </div>
                                <div class="form-group">
                                  <div class="col-md-12"><strong>Card CVV:</strong></div>
                                  <div class="col-md-12">
                                    <input type="text" class="form-control" v-cardformat:formatCardCVC name="cvv" v-model="cvv" placeholder="123" />
                                  </div>
                                </div>
                             </div>                             
                             <div class="form-group">
                                <div class="col-sm-6 col-xs-12">
                                   <button type="button" @click="placeOrder()" class="btn btn-primary btn-submit-fix">Place Order</button>
                                </div>
                             </div>
                          </div>
                       </div>
                    </form>
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
import {siteIndexURL} from '../axios'
export default {
  components: {    
  },
  data() {
    return {
      card_number:'',
      exp_year: '',
      exp_month:'',
      cvv:''
    }
  },
  watch: {
  },
  computed: {    
  },
  methods: {
    placeOrder: function()
    {
      var details = {
        card_number: this.card_number,
        exp_year: this.exp_year,
        exp_month: this.exp_month,
        cvv: this.cvv
      };
      var $this = this;
      axios.post(siteIndexURL+'/v1/subscribe/plan', details)
      .then(()=>{
       
       
      }).catch(function (error) {
        if (error.response.data.detail) {
          $this.responseHandle('warning', error.response.data.detail);
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
  created() {
    
  }
}

</script>

