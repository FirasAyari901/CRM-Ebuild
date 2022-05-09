<template>
    <div>
      <br><br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-body">
                      <h2>Task name</h2>
                      <span class="badge badge-primary" >Doing</span>
                      <br>
                      <div class="avaiabilty">
                          <div class="text-success">start date : 01-02-2022</div>
                      </div>
                      <div class="avaiabilty">
                          <div class="text-success">Deadline : 01-04-2022</div>
                      </div>
                      <br>
                      <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p> 
                    </div>
                </div>
                <div class="col-sm-12 p-0">
                        
                            <div class="row">
                              <div class="col-sm-12 col-xl-6">
                                <b-card header-tag="div" header-bg-variant="secondary" class="card-absolute" @click="redirect">
                                  <h5 slot="header">Doing</h5>
                                  <h4>title subtask</h4>
                                  <div class="media">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
															</div>
                              <br>
                                   <div class="avaiabilty">
                                      <div class="text-success">start date : 01-02-2022</div>
                                  </div>
                                  <div class="avaiabilty">
                                      <div class="text-success">Deadline : 01-04-2022</div>
                                  </div>
                                  <br>
                                  <b-card-text class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</b-card-text>
                                </b-card>
                              </div>
                              <div class="col-sm-12 col-xl-6">
                                <b-card header-tag="div" header-bg-variant="success" class="card-absolute">
                                  <h5 slot="header">Done</h5>
                                  <h4>title subtask</h4>
                                  <div class="media">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
                                    <img class="img-30 img-fluid m-r-5 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
															</div>
                              <br>
                                   <div class="avaiabilty">
                                      <div class="text-success">start date : 01-02-2022</div>
                                  </div>
                                  <div class="avaiabilty">
                                      <div class="text-success">Deadline : 01-04-2022</div>
                                  </div>
                                  <br>
                                  <b-card-text class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</b-card-text>
                                </b-card>
                              </div>

                            </div>
                        </div>
                      
              </div>               
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</template>

<script>
  export default {
    methods:{
      
      redirect () {
        this.$router.push({ path:'/app/subtask' });  
      },
      
    }
  };
</script>