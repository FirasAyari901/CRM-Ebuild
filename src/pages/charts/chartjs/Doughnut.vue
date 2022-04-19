<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  var secondary = localStorage.getItem('secondary_color') || '#f73164';

  import { Doughnut } from 'vue-chartjs';

  export default {
    extends: Doughnut,
    data: () => ({
      datacollection : {
        datasets: [{
          data: [300, 50, 100],
          backgroundColor: [primary, secondary, '#51bb25'],
        }],
        labels: ['Primary', 'Secondary', 'Success'],
      },
      options: {
        animation: {
          duration: 1000,
          easing: 'linear'
        },
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false,
        },
        tooltips: {
          mode: 'index',
          intersect: false,
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