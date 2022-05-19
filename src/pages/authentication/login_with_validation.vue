
<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-7 order-1 b-center bg-size" :style="{ backgroundImage: 'url('+ require('../../assets/images/logo/login-image.png') +')' }"
          style="background-size: 60vw 80vh;background-repeat: no-repeat; background-position: center center; display: block;">

      </div>
      <div class="col-xl-5 p-0">
        <div class="login-card">
          <div>
            <div>
              <a class="logo text-left">
                <img
                  class="img-fluid for-light"
                  src="../../assets/images/logo/logoebuild.png"
                  alt="looginpage"
                  width="150"
                   />
                </a>
            </div>
            <div class="login-main container ">
             
              <form style="padding : 30px;" class="container theme-form">
                        <h4>Sign in to account</h4>
                        <p>Enter your email & password to login</p>
                       
                        <div class="form-group">
                          <label class="col-form-label">Email Address</label>
                          <input
                            v-model="email"
                            class="form-control"
                            type="email"
                            required=""
                            placeholder="Test@gmail.com"
                            :class="{
                              'is-invalid': submitted && !email,
                            }"
                          />
                          <div
                            v-show="submitted && !email"
                            class="invalid-feedback"
                          >
                            Email is required
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-form-label">Password</label>
                          <input
                            v-model="password"
                            autocomplete=""
                            class="form-control"
                            :type="type"
                            name="login[password]"
                            required=""
                            placeholder="*********"
                            :class="{
                              'is-invalid': submitted && !email,
                            }"
                          />
                          <div
                            v-show="submitted && !password"
                            class="invalid-feedback"
                          >
                            Email is required
                          </div>
                          <div class="show-hide" @click="showPassword">
                            <span class="show"></span>
                          </div>
                        </div>
                        <div class="form-group mb-0">
                          <div class="checkbox p-0">
                            <input id="checkbox1" type="checkbox" />
                            <label class="text-muted" for="checkbox1"
                              >Remember password</label
                            >
                          </div>
                          <button
                            class="btn btn-primary btn-block"
                            type="button"
                            @click="signUp"
                          >
                            Login
                          </button>
                        </div>
          
                      </form>
                 
             
                  
                  
               
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';  


  export default {
    name: 'login',
    data() {
      return {
        type: 'password',
        email: '',
        password: '',
        username: '',
        passwordjwt: '',
        submitted: false,
        name:'',
        role:'',
      };
    },
    computed: {
      // JWT authentication
      loggingIn() {
        return this.$store.state.authentication.status.loggingIn;
      },
    },
    created() {
      this.$store.dispatch('authentication/logout');
    },
    methods: {
      
      showPassword: function () {
        if (this.type === 'password') {
          this.type = 'text';
        } else {
          this.type = 'password';
        }
      },
      // Firebase login
      signUp: async  function () {
        this.submitted = true;
        if (this.password !=''  && this.email != '') {
          const data = { password: this.password,  email: this.email, };
          console.log(data);
          const response = await axios.post('login',data);
          console.log(response.data);
          if (response.data.status == 200){
            localStorage.setItem('token',response.data.token);
            if(response.data.client){
              localStorage.setItem('client',JSON.stringify(response.data.client));
            }
            if(response.data.personnel){
              localStorage.setItem('role',response.data.personnel.role);
              localStorage.setItem('personnel',JSON.stringify(response.data.personnel));
        
            }
            this.$router.push('/app/customers');  
            this.$toastr.s('welcome '+response.data.personnel.name);
          
          } else{
            if (response.data.status==401) {
              this.$toastr.e(''+response.data.message);
              localStorage.clear();
              this.$router.go();
            
            }
          }
              
        } else this.submitted = false;
       

      },
      // Social login
    
    },
  };
</script>