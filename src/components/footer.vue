<template>
  <div>

  </div>
</template>

<script>
  import json from '../data/menu';
  
  export default {
    name: 'footerpage',
    data() {
      return {
        customizer: false,
        data:
          'data:text/json;charset=utf-8,' +
          encodeURIComponent(JSON.stringify(json)),
      };
    },
  };
</script>
