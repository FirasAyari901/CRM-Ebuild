<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  var secondary = localStorage.getItem('secondary_color') || '#f73164';
  
  import { Line } from 'vue-chartjs';

  export default {
    extends: Line,
    data() {
      return {
        linechart: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            backgroundColor: 'rgba(145, 46, 252, 0.3)',
            borderColor: primary,
            strokeColor: primary,
            pointBackgroundColor: primary,
            pointHoverBackgroundColor: primary,
            pointHoverBorderColor: primary,
            pointHighlightStroke: '#000',
            data: [10, 59, 80, 81, 56, 55, 40]
          }, {
            backgroundColor: 'rgba(247, 49, 100, 0.3)',
            borderColor: secondary,
            strokeColor: secondary,
            pointBackgroundColor: secondary,
            pointBorderColor: secondary,
            pointHoverBackgroundColor: secondary,
            pointHoverBorderColor: secondary,
            pointHighlightStroke: 'rgba(30, 166, 236, 1)',
            data: [28, 48, 40, 19, 86, 27, 90]
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