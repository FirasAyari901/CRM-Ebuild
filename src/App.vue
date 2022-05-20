<template>
  <div id="app">
  <!-- Loader starts-->
    
  <!-- Loader ends-->

    <!--<Main/>-->
    <router-view></router-view>
  </div>
</template>

<script>
  export default {
    name: 'app',
    data(){
      return{
        show: true
      };
    },
    mounted() {
// console.log( 'tokennn',   localStorage.getItem('token')
// );
this.timeOut();
    },
    methods:{
      timeOut(){
        var self = this;
        setTimeout(function(){
          self.show = false;
        }, 1000);
      }
    }
  };
</script>

<style lang="scss" scoped>
.loader-wrapper.loderhide {
  display: none;
}
</style>
