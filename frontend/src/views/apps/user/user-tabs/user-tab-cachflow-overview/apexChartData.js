/*=========================================================================================
    File Name: apexChartData.vue
    Description: Data shown by charts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


function generateData (baseval, count, yrange) {
  let i = 0
  const series = []
  while (i < count) {
    //var x =Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
    const y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
    const z = Math.floor(Math.random() * (75 - 15 + 1)) + 15

    series.push([baseval, y, z])
    baseval += 86400000
    i++
  }
  return series
}

function generateDataHeatMap (count, yrange) {
  let i = 0
  const series = []
  while (i < count) {
    const x = `w${(i + 1).toString()}`
    const y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min

    series.push({
      x,
      y
    })
    i++
  }
  return series
}

const themeColors = ['#7367F0', '#28C76F', '#EA5455', '#FF9F43', '#1E1E1E']

export default {
  
  mixedChart: {
    series: [
      {
        name: 'Income',
        type: 'column',
          data: [44, 55, 41, 67, 22, 43]
      },
	  {
        name: 'Cashflow',
        type: 'column',
        data: [13, 23, 20, 8, 13, 27]
      },
	  {
        name: 'Revenue',
        type: 'column',
       data: [11, 17, 15, 15, 21, 14]
      },
      
    ],
    chartOptions: {
     // colors: themeColors,
      chart: {
       stacked: true,
	   type: 'bar',
	    toolbar: {
            show: true
          },
          zoom: {
            enabled: true
          }
      },
      stroke: {
        width: [0, 2, 5],
        curve: 'smooth'
      },
      plotOptions: {
        bar: {
          columnWidth: '50%'
        }
      },

      fill: {
        opacity: [1, 1, 1],
        gradient: {
          inverseColors: false,
          
          opacityFrom: 1,
          opacityTo: 0.55,
          stops: [0, 100, 100, 100]
        }
      },
      labels: ['2019', '2020','2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035','2036','2037','2038','2039','2040'],
      markers: {
        size: 0
      },
	  legend: {
          position: 'right',
          offsetY: 40
        },
      xaxis: {
        type: 'datetime'
      },
      yaxis: {
        title: {
          text: 'Points'
        },
        min: 0
      },
      tooltip: {
        shared: true,
        intersect: false,
        y: {
          formatter (y) {
            if (typeof y !== 'undefined') {
              return `${y.toFixed(0)} points`
            }
            return y

          }
        }
      }
    }
  },
  mixedChartCode:
`<template>
  <vue-apex-charts type="line" height="350" :options="mixedChart.chartOptions" :series="mixedChart.series"></vue-apex-charts>
</template>

<script>
  data() {
    return {
      themeColors: ['#7367F0', '#28C76F', '#EA5455', '#FF9F43', '#1E1E1E']
      mixedChart: {
        series: [ {
        name: 'Income',
        type: 'column',
          data: [44, 55, 41, 67, 22, 43]
      },
	  {
        name: 'Cashflow',
        type: 'column',
        data: [13, 23, 20, 8, 13, 27]
      },
	  {
        name: 'Revenue',
        type: 'column',
       data: [11, 17, 15, 15, 21, 14]
      },],
        chartOptions: {
       
          chart: {
            stacked: true,
			type: 'bar',
          },
		   toolbar: {
            show: true
          },
          zoom: {
            enabled: true
          },
          stroke: {
            width: [0],
            curve: 'smooth'
          },
          plotOptions: {
            bar: {
               horizontal: false,
            }
          },

          fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
              inverseColors: false,
              shade: 'light',
              type: "vertical",
              opacityFrom: 0.85,
              opacityTo: 0.55,
              stops: [0, 100, 100, 100]
            }
          },
          labels: ['2019', '2020','2021','2022','2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033','2034','2035','2036','2037','2038','2039','2040'],
          markers: {
            size: 0
          },
		  legend: {
          position: 'right',
          offsetY: 40
        },
          xaxis: {
            type: 'datetime'
          },
          yaxis: {
            title: {
              text: 'Points',
            },
            min: 0
          },
          tooltip: {
            shared: true,
            intersect: false,
            y: {
              formatter: function(y) {
                if (typeof y !== "undefined") {
                  return y.toFixed(0) + " points";
                }
                return y;

              }
            }
          }
        }
      }
    }
  }
</script>`,
}