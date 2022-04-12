<!-- =========================================================================================
  File Name: UserTabBroadcast.vue
  Description: User Tab Broadcast
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
   <div>
      <div class="vx-row box_outter">
         <vx-card>
            <div class="mt-5 user_no_mg">
               <div class="vx-row box_outter broadcast_outter">
                  <div class="vx-col sm:w-1/1 w-full">
                     <h5>Special Occasion:</h5>
                     <div class="vx-row box_outter">
                        <ul class="demo-alignment broad_first">
                          <li>
                            <vs-checkbox v-model="special_occasion.cny">CNY</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="special_occasion.xmas">XMAS</vs-checkbox>
                          </li>
                       
                          <li>
                            <vs-checkbox v-model="special_occasion.lantern_festival">Lantern Festival</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="special_occasion.vesak_day">Vesak Day</vs-checkbox>
                          </li>
                        </ul>
                     </div>
                  </div>
                  <div class="vx-col sm:w-1/1 w-full">
                     <h5>Workshops:</h5>
                     <div class="vx-row box_outter">
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="workshops.explain_about_medical_insurance">Explain about medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="workshops.why_term_insurance_is_important">Why term insurance is important</vs-checkbox>
                          </li>
                        </ul>
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="workshops.profit_of_medical_insurance">Profit of medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="workshops.best_investment_portfolio">Best investment portfolio</vs-checkbox>
                          </li>
                        </ul>
                     </div>
                  </div>
                  <div class="vx-col sm:w-1/1 w-full">
                     <h5>Seminars:</h5>
                     <div class="vx-row box_outter">
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="seminars.explain_about_medical_insurance">Explain about medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="seminars.why_term_insurance_is_important">Why term insurance is important</vs-checkbox>
                          </li>
                        </ul>
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="seminars.profit_of_medical_insurance">Profit of medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="seminars.best_investment_portfolio">Best investment portfolio</vs-checkbox>
                          </li>
                        </ul>
                     </div>
                  </div>
                  <div class="vx-col sm:w-1/1 w-full">
                     <h5>Collaboration:</h5>
                     <div class="vx-row box_outter">
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="collaboration.explain_about_medical_insurance">Explain about medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="collaboration.why_term_insurance_is_important">Why term insurance is important</vs-checkbox>
                          </li>
                        </ul>
                        <ul class="demo-alignment">
                          <li>
                            <vs-checkbox v-model="collaboration.profit_of_medical_insurance">Profit of medical insurance</vs-checkbox>
                          </li>
                          <li>
                            <vs-checkbox v-model="collaboration.best_investment_portfolio">Best investment portfolio</vs-checkbox>
                          </li>
                        </ul>
                     </div>
                  </div>
                  <div class="vx-col sm:w-1/1 w-ful">
                     <div class="vx-col w-full">
                        <vs-button class="mr-3 mb-2" @click.prevent="saveForm">Submit</vs-button>
                        <vs-button color="warning" type="border" class="mb-2">Reset</vs-button>
                     </div>
                  </div>
               </div>
            </div>
         </vx-card>
      </div>
   </div>
</template>

<script>
export default {
  name: 'user-tab-broadcast',
  data () {
    return {
      special_occasion: {
        cny:'',
        xmas: '',
        lantern_festival:'',
        vesak_day:'',
      },
      workshops: {
        explain_about_medical_insurance:'',
        why_term_insurance_is_important:'',
        profit_of_medical_insurance:'',
        best_investment_portfolio:''
      },
      seminars: {
        explain_about_medical_insurance:'',
        why_term_insurance_is_important:'',
        profit_of_medical_insurance:'',
        best_investment_portfolio:''        
      },
      collaboration: {
        explain_about_medical_insurance:'',
        why_term_insurance_is_important:'',
        profit_of_medical_insurance:'',
        best_investment_portfolio:''  
      }
    }
  },
  watch: {
    
  },
  methods: {
    saveForm () {
      
    }
  },
  created () {
  }
}

</script>
