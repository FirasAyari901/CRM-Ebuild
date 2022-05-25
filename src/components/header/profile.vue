<template>
  <li class="profile-nav onhover-dropdown p-0 mr-0">
    <div class="media profile-media">
      <img
        class="b-r-10"
        :src="image"
        alt=""
        width="30"
      />
      <div class="media-body">
        <span>{{name}}</span>
        <p class="mb-0 font-roboto">
          {{ role }} <i class="middle fa fa-angle-down"></i>
        </p>
      </div>
    </div>
    <ul class="profile-dropdown onhover-show-div">
      
      <li>
        <a @click="logout"
          ><feather type="log-in"></feather><span>Log out</span></a
        >
      </li>
    </ul>
  </li>
</template>

<script>
 import axios from 'axios'; 

  export default {
    name: 'Profile',
     created() {
      
      if (localStorage.getItem("role")) {
        
          this.role = localStorage.getItem('role')
          this.image =  JSON.parse(localStorage.getItem('personnel')).image
          this.name =  JSON.parse(localStorage.getItem('personnel')).name
          
        
      } else {
        this.role = "client"
        this.image =  JSON.parse(localStorage.getItem('client')).logo
        this.name =  JSON.parse(localStorage.getItem('client')).name
      }
     },
    methods: {
      logout: function() {
        axios.delete("logout")
        localStorage.clear()
        this.$router.push('/login'); 
      },
    },
  }; 
</script>