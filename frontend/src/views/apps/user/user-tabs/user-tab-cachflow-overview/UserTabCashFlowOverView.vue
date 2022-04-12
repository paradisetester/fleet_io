<!-- =========================================================================================
  File Name: Goal.vue
  Description: Data List - List View
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="data-list-list-view" class="data-list-container">
   <!-- MIXED CHART -->
            <div class="vx-col w-full mb-base">
                <vx-card title="Company Performance" code-toggler>
                    <vue-apex-charts type="line" height="350" :options="apexChatData.mixedChart.chartOptions" :series="apexChatData.mixedChart.series"></vue-apex-charts>
                    <template slot="codeContainer">
{{ apexChatData.mixedChartCode }}
                    </template>
                </vx-card>
            </div>
			
			
			
    <div class="vx-row">
      <div class="vx-col sm:w-1/1 w-full  chart-container">
        <div class="vx-row box_outter chart"  v-dragscroll.x>
          <GChart
            :settings="{packages:  ['bar']}"    
            :data="chartData"
            :options="chartOptions"
            :resizeDebounce="1000"
            :createChart="(el, google) => new google.charts.Bar(el)"
            @ready="onChartReady"
          />
        </div>
      </div>
    </div>
     <vx-card>
        <vs-table class="cashflowTable">
          <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">
            <div class="flex flex-wrap-reverse items-center data-list-btn-container">

              <!-- ADD NEW -->
              <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary" @click="addNewData">
                  <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                  <span class="ml-2 text-base text-primary">Add New</span>
              </div>
            </div>
          </div>
          <!-- <pre>
            {{cashflows.passive_income.lump_sum_maturity}}
          </pre> -->
          <template>
          
            <vs-tr>
              <vs-th class="sticky-col first-col"></vs-th>
              <vs-th :colspan="ageValues.length">Where From the Age Start</vs-th>
            </vs-tr>
            <vs-tr v-if="ageValues">
              <vs-th class="sticky-col first-col">Age</vs-th>
              <vs-td v-for="(ageValue, ageIndex) in ageValues" :key="ageIndex">{{ageValue}}</vs-td>
            </vs-tr>
            <vs-tr v-if="this.startYear">
              <vs-th class="sticky-col first-col">Year</vs-th>
              <vs-td v-for="(ageYear, yearIndex) in getDates(this.startYear, this.endYear)" :key="yearIndex">{{ageYear}}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col"></vs-th>
              <vs-th :colspan="ageValues.length">Inflow</vs-th>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">Active Income</vs-th>
              <vs-td v-for="(activeIncome, index) in activeIncomes" :key="index">{{activeIncome | PRICEFORMAT}}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col"></vs-th>
              <vs-th :colspan="ageValues.length">Passive Income</vs-th>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">Rental Income</vs-th>
              <vs-td v-for="(rentalIncome, rindex) in rentalIncomes" :key="rindex">{{rentalIncome | PRICEFORMAT}}</vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">Investment Income</vs-th>
              <vs-td>{{cashflows.passive_income.investment_income}}</vs-td>
              <vs-td v-for="(normalYear, normalIndex) in getDates(this.startYear, this.endYear)" :key="normalIndex">
              </vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">Annuity</vs-th>
              <vs-td v-for="(annuityYear, annuityIndex) in getDates(this.startYear, this.endYear)" :key="annuityIndex">
                {{(annuityYear >= cashflows.passive_income.annuity.start_year && annuityYear <= cashflows.passive_income.annuity.end_year ? cashflows.passive_income.annuity.yearly_amount : '')}}
              </vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">Yearly Insurance Payout</vs-th>
              <vs-td v-for="(payoutYear, payoutIndex) in getDates(this.startYear, this.endYear)" :key="payoutIndex">
                  {{(payoutYear >= cashflows.passive_income.yearly_insurance_payout.start_year && payoutYear <= cashflows.passive_income.yearly_insurance_payout.end_year ? cashflows.passive_income.yearly_insurance_payout.yearly_amount : '')}}
              </vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">LumpSum Maturity</vs-th>
              <vs-td v-for="(maturityYear, maturityIndex) in getDates(this.startYear, this.endYear)" :key="maturityIndex">
                {{lumpSumMaturity[maturityYear]}}
              </vs-td>
            </vs-tr>
            <vs-tr>
              <vs-th class="sticky-col first-col">CPF Retirement Payout</vs-th>
              <vs-td v-for="(cpfPayoutYear, cpfPayoutIndex) in getDates(this.startYear, this.endYear)" :key="cpfPayoutIndex">
                {{(cpfPayoutYear >= cashflows.passive_income.cpf_retirement_payout.start_year && cpfPayoutYear <= cashflows.passive_income.cpf_retirement_payout.end_year ? cashflows.passive_income.cpf_retirement_payout.yearly_amount : '')}}
              </vs-td>
            </vs-tr>

          </template>

        </vs-table>
      </vx-card>
     <!-- <vs-popup fullscreen class="holamundo" title="Add Scenerio" :active.sync="popupActive">
        <form v-on:submit.prevent>
           <div class="vx-row">
              <div class="vx-col sm:w-1/3 w-full">
                 <div class="vx-row box_outter">
                    <vs-input
                       v-validate="'required'"
                       icon-pack="feather" icon="icon-edit-2" icon-before icon-no-border
                       data-vv-as="Demo"
                       name="Demo"
                       label="Demo"
                       class="w-full mt-5"/>
                 </div>
              </div>
           </div>
           <div class="vx-row">
              <div class="vx-col w-full">
                 <vs-button class="mr-3 mb-2">Submit</vs-button>
                 <vs-button color="warning" type="border" class="mb-2">Reset</vs-button>
              </div>
           </div>
        </form>
     </vs-popup> -->
  </div>
</template>

<script>
import axios from 'axios';
import {API, siteIndexURL} from '../../../../../axios'
import { GChart } from 'vue-google-charts'
import { dragscroll } from 'vue-dragscroll'
import VueApexCharts from 'vue-apexcharts'
import apexChatData from './apexChartData.js'

export default {
directives: {
    dragscroll
  },
  components: {
    GChart,
	VueApexCharts
  },
  data () {
    return {
	apexChatData,
      popupActive:0,
      cashflows: {},
      ageValues: [],
      rentalIncomes: [],
      activeIncomes: [],
      lumpSumMaturity: [],
      startYear:0,
      endYear:0,
	   widthCustom:600,
      users: [
        {
          id: 1,
          name: 'email'
        }
      ],
      chartsLib: null,
      chartData: [
      ]
    }
  },
  computed : {
    chartOptions () {
      if (!this.chartsLib) return null
      return this.chartsLib.charts.Bar.convertOptions({
        legend: 'left',
        chart: {
          title: 'Company Performance',
          subtitle: 'Sales, Expenses, and Profit: 2014-2017'
        },
        bars: 'vertical', 
        hAxis: { 
          title: 'Years',
          direction: '-1',
          slantedText: true,
          slantedTextAngle: 45,
          textStyle: { fontSize: 20 },
		 
        },
        height: 400,
		width: this.widthCustom,
        colors: ['#1b9e77', '#d95f02', '#7570b3'],
      })
    }
  },
  methods: {
    onChartReady (chart, google) {
      this.chartsLib = google
    },
    getDates: function(startDate, stopDate) {
      var dateArray = [];
      var currentDate = (startDate);
      while (currentDate <= stopDate) {
          dateArray.push( currentDate )
          currentDate = currentDate + 1;
      }
      return dateArray;
    },
    calulateActiveIncomeGrowth : function()
    {
      var active_income = this.cashflows.active_income.value;
      var growth_rates = this.cashflows.growth_rate[0];
      var keys = Object.keys(growth_rates);
      if (keys.length > 0) {
        if (this.ageValues.length) {
          this.activeIncomes.push(active_income)
          for (var ai = 0; ai < this.ageValues.length; ai++) {
            var age = this.ageValues[ai]
            for (var i = 1; i < keys.length; i++) {
              var key = keys[i]
              var extKeys = key.split('-');
              if (age > extKeys[0] && age <= extKeys[1]) {
                active_income = active_income + (active_income * parseFloat(growth_rates[key]));
                this.activeIncomes.push(active_income)
              }
            }
          }
        }
      }
    },
    calulateRentalIncomeGrowth : function()
    {
      var rental_income = this.cashflows.passive_income.rental_income.value;
      var growth_rates = this.cashflows.passive_income.rental_income.growth_rate;
      var keys = Object.keys(growth_rates);
      if (this.ageValues.length) {
        this.rentalIncomes.push(rental_income)
        for (var ai = 0; ai < this.ageValues.length; ai++) {
          var age = this.ageValues[ai]
          rental_income = rental_income + (rental_income * parseFloat(growth_rates));
          this.rentalIncomes.push(rental_income)
        }
      }
    },
    randInt: function() {
        return Math.floor((Math.random()*9)+1);
    },
    getGoals: function()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/cash_flow/cash_flow_data/')
      .then((result)=>{
        if (result.data.success == true) {
          this.cashflows = result.data.data;
          this.ageValues = this.cashflows.age.value;
          this.startYear = this.cashflows.age.start_year;
          this.endYear = this.cashflows.age.end_year;
          this.calulateActiveIncomeGrowth();
          this.calulateRentalIncomeGrowth();
          this.chartData.push(['Year', 'Sales', 'Expenses']);
          var randomNum, randomNum2;
          for (var i = 2020; i < 2096; i++) {
            randomNum = this.randInt();
            randomNum2 = this.randInt();
            this.chartData.push([i, (i*randomNum), (i*randomNum2)]);
			 this.widthCustom = this.widthCustom + 100;
			 
          } 
		
          var year, value;   
          if (this.cashflows.passive_income.lump_sum_maturity.length) {
            for (var i = 0; i < this.cashflows.passive_income.lump_sum_maturity.length; i++) {
              year = this.cashflows.passive_income.lump_sum_maturity[i].year;
              value = this.cashflows.passive_income.lump_sum_maturity[i].value;
              this.lumpSumMaturity[year] = value;
            }
          }  
          
        }
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
    },
    addNewData: function()
    {
      this.popupActive = 1;
      this.responseHandle('warning', 'Wait adding new data');
    }
  },
  beforeMount () {
    this.getGoals();
  },
  mounted () {
    
  }
}
</script>
<style>
.vs-con-table .vs-con-tbody {
    background: #f8f8f8;
    border: 2px solid #efefef;
}
.vs-con-table .tr-values:nth-child(odd) {
    background: transparent!important;
}
.vs-con-table .tr-values:nth-child(even) {
    background: #fff!important;
}
.not-data-table.vs-table--not-data{
  display: none;
}
.cashflowTable tr th, .cashflowTable tr td {
  padding: 15px 15px 5px;
      border: 1px solid #ccc;
}
.cashflowTable .sticky-col {
  position: sticky;
  position: -webkit-sticky;
  background-color: white;
}

.cashflowTable .first-col {
  width: 100px;
  min-width: 100px;
  max-width: 100px;
  left: 0px;
}
.box_outter.chart > div {
  width: 100%;
  display: block; 

}
</style>
