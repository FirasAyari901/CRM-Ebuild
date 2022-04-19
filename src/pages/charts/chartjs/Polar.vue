<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  var secondary = localStorage.getItem('secondary_color') || '#f73164';

  import { PolarArea } from 'vue-chartjs';

  export default {
    extends: PolarArea,
    data: () => ({

      data: {
        datasets: [{
          data:[300, 50, 100, 40, 120],
          backgroundColor: [ primary, '#f8d62b', '#51bb25', '#a927f9', secondary],
          label: 'My dataset', // for legend
          borderColor:'#fff',
        }],
        labels: [
          'Blue',
          'Yellow',
          'Green',
          'Orange',
          'red'
        ]
      },
      option: {
        lineWidth:10,
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
        }
      }
    }),

    mounted () {
      this.renderChart(this.data, this.option);
    }
  };
</script>

<style>
</style>