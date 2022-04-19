<script>
  var primary = localStorage.getItem('primary_color') || '#7366ff';
  
  import { Radar } from 'vue-chartjs';

  export default {
    extends: Radar,
    data: () => ({
      datacollection: {
        labels: ['Ford', 'Chevy', 'Toyota', 'Honda', 'Mazda'],
        datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgba(145, 46, 252, 0.4)',
          borderColor: primary,
          pointBackgroundColor: primary,
          pointHoverBackgroundColor: primary,
          pointHighlightFill: '#263238',
          pointHighlightStroke: 'rgba(145, 46, 252, 0.4)',
          data: [12, 3, 5, 18, 7]
        }]
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
        }
      }
    }),

    mounted () {
      this.renderChart(this.datacollection, this.options);
    }
  };
</script>

<style>
</style>