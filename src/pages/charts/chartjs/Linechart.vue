<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  var secondary = localStorage.getItem('secondary_color') || '#f73164';

  import { Line } from 'vue-chartjs';

  export default {
    extends: Line,
    data() {
      return {
        linechart: {
          labels: ['','10', '20', '30', '40', '50', '60', '70', '80'],
          datasets: [{
            backgroundColor: 'rgba(81, 187, 37, 0.2)',
            borderColor: primary,
            pointBackgroundColor: primary,
            data: [10, 20, 40, 30, 0, 20, 10, 30, 10]
          },{
            backgroundColor: 'rgba(247, 49, 100, 0.2)',
            borderColor: secondary,
            pointBackgroundColor: secondary,
            data: [20, 40, 10, 20, 40, 30, 40, 10, 20]
          }, {
            backgroundColor: 'rgb(145, 46, 252, 0.2)',
            borderColor: '#7366ff',
            pointBackgroundColor: '#7366ff',
            data: [60, 10, 40, 30, 80, 30, 20, 90, 0]
          }]
        },
        options: {
          animation: {
            duration: 1000,
            easing: 'linear'
          },
          maintainAspectRatio: false,
          responsive: true,
          scales: {
            yAxes: [{ ticks: { beginAtZero: true, stepSize: 5, } }],
            xAxes: [{ barThickness: 39, }],
          },
          legend: {
            display: false,
          },
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          elements: {
            line: {
              tension: 0.000001
            }
          },

        }
      };
    },
    mounted () {
      this.renderChart(this.linechart, this.options);
    }
  };
</script>

<style>
</style>