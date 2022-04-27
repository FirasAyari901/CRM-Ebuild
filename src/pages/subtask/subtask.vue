<template>
    <div>
      <br><br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-body">
                      <h2>Subtask name</h2>
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
                      <div class="col-sm-12">
                        <div class="card">
											<div class="card-body">
												<div class="timeline-content">
												<div class="social-chat">
														<div class="your-msg ">
															<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
																<div class="media-body shadow-sm shadow-showcase"><span class="f-w-600">Jason Borne <span>1 Year Ago </span></span>
																	<p>we are doing dance and singing songs, please vote our post which is very good for all young peoples</p>
																</div>
															</div>
														</div>
                            <div class="your-msg ">
															<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
																<div class="media-body shadow-sm shadow-showcase"><span class="f-w-600">Jason Borne <span>1 Year Ago </span></span>
																	<p>we are doing dance and singing songs, please vote our post which is very good for all young peoples</p>
																</div>
															</div>
														</div>
                    
								
													</div>
													<div class="comments-box">
														<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../../assets/images/user/1.jpg">
															<div class="media-body shadow-sm shadow-showcase">
																<div class="input-group text-box">
																	<input class="form-control input-txt-bx" type="text" name="message-to-send" placeholder="Post Your commnets">
																	<div class="input-group-append">
																		<button class="btn btn-transparent" type="button"><i class="fa fa-paper-plane-o   ">  </i></button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
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
        this.$router.push({path:'/app/subtask'});  
      },
      
    }
  };
</script>