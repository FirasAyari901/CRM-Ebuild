<template>
    <div>
      <br><br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   
                    <div class="card-body">

                      <div class="row">
                        <div class="col-10"><h2>{{subtask.titre}}</h2></div>
              
                      </div>

                      <span class="badge badge-primary" >{{subtask.attributes.etat}}</span>
                      <br>
   
                      <div class="avaiabilty">
                          <div class="text-success">Deadline : {{subtask.attributes.deadline}}</div>
                      </div>
                      <br>
                      <p>{{subtask.attributes.description}}</p> 
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
															<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../../assets/images/user/firas.jpg">
																<div class="media-body shadow-sm shadow-showcase"><span class="f-w-600">Firas ayari </span>
																	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis dignissimos culpa molestias consectetur quisquam pariatur, quidem perferendis quod impedit, doloremque assumenda animi sit voluptatem corrupti corporis, accusantium sed porro vero?</p>
																</div>
															</div>
														</div>
                    
								
													</div>
													<div class="comments-box">
														<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" src="../../assets/images/user/firas.jpg">
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
 import Multiselect from 'vue-multiselect';
 import axios from 'axios'; 

  export default {
    props: ['id'],
    components: {
      Multiselect,
    },
    data(){
      return {
       subtask:null,
       staff:null,
      }},
    created() {
      axios.get('soustaches/'+String(this.id)).then(res =>{
             
             this.subtask = res.data.soustache
             this.staff = res.data.personnel
          });
    },
    methods:{

      
    }
  };
</script>
