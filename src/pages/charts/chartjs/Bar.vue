<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  var secondary = localStorage.getItem('secondary_color') || '#f73164';

  import { Bar } from 'vue-chartjs';
  
  export default {
    extends: Bar,
    data: () => ({
      datacollection: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
          data: [35, 59, 80, 81, 56, 55, 40],
          backgroundColor:'rgba(145, 46, 252, 0.4)',
          borderColor: primary,
          borderWidth: 3,
          hoverBackgroundColor: primary
        }, {
          data: [28, 48, 40, 19, 86, 27, 90],
          backgroundColor:'rgba(247, 49, 100, 0.4)',
          borderColor: secondary,
          borderWidth: 3,
          hoverBackgroundColor: secondary
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
        },
        legend: {
          display: false,
        },
        tooltips: {
          mode: 'index'
        },
      }
    }),

    mounted () {
      this.renderChart(this.datacollection, this.options);
    }
  };
</script>

<style>
</style>