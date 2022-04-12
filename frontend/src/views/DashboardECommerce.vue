<!-- =========================================================================================
  File Name: DashboardAnalytics.vue
  Description: Dashboard Analytics
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="dashboard-analytics">
    <div class="vx-row">

      <!-- CARD 1: CONGRATS -->

      <div class="vx-col w-full lg:w-1/2 mb-base" v-if="profile.basic.name">
      <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user">
                   
          <feather-icon icon="AwardIcon" class="p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow" svgClasses="h-8 w-8"></feather-icon>
          <h1 class="mb-6 text-white">Congratulations {{ profile.basic.name }},</h1>
          <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white">You have done <strong>{{ ordersRecevied }}</strong> more sales today. Check your new badge in your profile.</p>
        </vx-card>
      </div>

      <!-- CARD 2: SUBSCRIBERS GAINED -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base" v-if="subscribersGained">
        <statistics-card-line icon="UsersIcon" :statistic="subscribersGained" statisticTitle="Subscribers Gained"  type="area"></statistics-card-line>
      </div>

      <!-- CARD 3: ORDER RECIEVED -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base" v-if="ordersRecevied">
        <statistics-card-line icon="ShoppingBagIcon" :statistic="ordersRecevied" statisticTitle="Orders Received" color="warning" type="area"></statistics-card-line>
      </div>
	  
      <!-- CARD 4: ORDER RECIEVED -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base" v-if="plans_count">
        <statistics-card-line icon="ShoppingBagIcon" :statistic="plans_count" statisticTitle="Total Plan" color="warning" type="area"></statistics-card-line>
      </div>
	  
      <!-- CARD 4: ORDER RECIEVED -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base" v-if="total_payment">
        <statistics-card-line icon="DollarSignIcon" :statistic="total_payment" statisticTitle="Total Earning" color="warning" type="area"></statistics-card-line>
      </div>

      <!-- CARD 4: ORDER RECIEVED -->
      <div class="vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base" v-if="expenseCount">
        <statistics-card-line icon="DollarSignIcon" :statistic="expenseCount" statisticTitle="Total Expense" color="warning" type="area"></statistics-card-line>
      </div>


      
    </div>

<div class="vx-row">
      <!-- CUSTOMERS CHART -->
     
      <div class="vx-col w-full lg:w-1/2 lg:mt-0 mb-base"  v-if="series.length">
           <div id="chart" class="vx-card ft_chart">
             <vue-apex-charts type="pie" width="100%" :options="chartOptions" :series="series"></vue-apex-charts>
          </div>
      </div>
       <div class="vx-col w-full lg:w-1/2 lg:mt-0 mb-base" v-if="lineseries[0].data.length>0">
         <div id="charts" class="vx-card ins_month">
            <vue-apex-charts type="line" height="350" :options="linechartOptions" :series="lineseries"></vue-apex-charts>
          </div>
      </div> 
  </div>



    <div class="vx-row" v-if="vehicleAssignments">
      <!-- CARD 9: DISPATCHED ORDERS -->
      <div class="vx-col w-full mb-base">
        <vx-card title="Assignment vehicles">
          <div slot="no-body" class="mt-4">
            <vs-table :data="vehicleAssignments" class="table-dark-inverted">
              <template slot="thead">
                <vs-th>Vehicles NO.</vs-th>
                <vs-th>Status</vs-th>
                <vs-th>Odometer</vs-th>            
                <vs-th>Start Date</vs-th>
                <vs-th>End Date</vs-th>
              </template>

              <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in vehicleAssignments">
                  <vs-td :data="tr.vehicle_id">
                    <span>#{{tr.vehicleName}}</span>
                  </vs-td>
                  <vs-td :data="tr.status">
                    <span class="flex items-center px-2 py-1 rounded"><div class="h-3 w-3 rounded-full mr-2" :class="'bg-' + tr.statusColor"></div>{{tr.starting_odometer}} - {{tr.ending_odometer}}</span>
                  </vs-td>
                  <vs-td :data="tr.contact_id">
                    {{tr.contact_id}}
                  </vs-td>
                 <vs-td :data="tr.start_date">
                    {{tr.start_date}}
                  </vs-td>
                  <vs-td :data="tr.end_date">
                    {{tr.end_date}}
                  </vs-td>
                </vs-tr>
              </template>
            </vs-table>
          </div>

        </vx-card>
      </div>
    </div>


 </div>
   
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import axios from 'axios';
import {siteIndexURL} from '../axios'

export default {
  components: {
      VueApexCharts,
      StatisticsCardLine,
    
  },
  data () {
    return {
      checkpointReward: '',
      subscribersGained: '',
      ordersRecevied: '',
      plans_count: '',
      total_payment: '',
      expenseCount:'',
      profile: {},
      customersData: {}, 
      vehicleAssignments:'', 
      vehicleCount:'', 
      vehicleAssignmentsCount:'', 
      VehicleInspection:'',
      type:'pie',
        series: [],       
        lineseries:[{
              name: "Inspection",
              data: []
          }],
          chartOptions: {
            chart: {
              width: 380,
              type: 'pie',
            },
            labels: ['Assign Vehicle', 'Unassign Vehicle'],
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
          },
          linechartOptions: {
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            title: {
              text: 'Inspection by Month',
              align: 'left'
            },
            grid: {
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            xaxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            }
          }
    }
  },
  


   methods: {
    
    getDashboardData: function ()
    {
      var $this = this;
      axios.get(siteIndexURL+'/v1/dashboard')
      .then((result)=>{	 
         if (result.data.status == true) {		 
             this.checkpointReward = result.data.response.tenants_count
        		 this.subscribersGained = result.data.response.users_count
        		 this.ordersRecevied = result.data.response.orders_count
        		 this.plans_count = result.data.response.plans_count
        		 this.total_payment = result.data.response.total_payment	
             this.vehicleAssignments = result.data.response.vehicleAssignments 
             this.vehicleCount = result.data.response.vehicleCount 
             this.vehicleAssignmentsCount = result.data.response.vehicleAssignmentsCount 
             this.expenseCount = result.data.response.expenseCount 
             
            if(this.vehicleCount > 0){
               this.series.push(this.vehicleCount)
               this.series.push(this.vehicleAssignmentsCount)
            }


            this.VehicleInspections = result.data.response.VehicleInspection
            if(this.VehicleInspections.length > 0){          
                this.VehicleInspections.forEach((dataa) => {
                   this.lineseries[0].data.push(dataa.data)                 
                 })
            }         

        }
      }).catch(function (error) {
        
          $this.responseHandle('warning', error.response);
     
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
   },
    beforeMount() { 
		this.getDashboardData();
		 this.$session.start();
    if (this.$session.get('profile') != undefined) {
      this.profile = this.$session.get('profile');		
    }
	
	  }
  
}
</script>

<style lang="scss">
/*! rtl:begin:ignore */
#dashboard-analytics {
  .greet-user{
    position: relative;

    .decore-left{
      position: absolute;
      left:0;
      top: 0;
    }
    .decore-right{
      position: absolute;
      right:0;
      top: 0;
    }
  }

  @media(max-width: 576px) {
    .decore-left, .decore-right{
      width: 140px;
    }
  }
}
/*! rtl:end:ignore */
</style>
