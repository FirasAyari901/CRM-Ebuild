<template>
  <div>
    <div class="logo-wrapper">
      <Logo />
     
      
    </div>
    <br>
    <Nav />
  </div>
</template>
<script>
  import { mapState } from 'vuex';
  import Logo from './logo.vue';
  import Nav from './nav.vue';

  export default {
    name: 'Sidebar',
    components: {
      Logo,
      Nav,
    },
    computed: {
      ...mapState({
        menuItems: (state) => state.menu.data,
        activeoverlay: (state) => state.menu.activeoverlay,
      }),
    },
    methods: {
      toggle_sidebar() {
        this.$store.dispatch('menu/opensidebar');
        this.$store.state.menu.activeoverlay = false;
      },
    },
  };
</script>
