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
                      <br><br>
                      <div class="avaiabilty">
                        <img class="img-30 img-fluid m-r-20 rounded-circle" :src="staff.image " alt="staff.name">
                        <span>{{staff.name}}</span>
                      </div>
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
														
                            <div class="your-msg " v-for="(comment,index) in comments" :key="index">
															<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" :src="staff.image ">
																<div class="media-body shadow-sm shadow-showcase"><span class="f-w-600">{{ staff.name }} </span>
																	<p>{{ comment.description }}</p>
                                  <feather v-if="access"  type="edit" stroke="#ffcd01" v-b-modal.add ></feather> 
                                <feather v-if="access" @click="deleteCmnt(comment.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
																</div>
															</div>
														</div>
                    
								
													</div>
													<div class="comments-box" v-if="access">
                             <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" :src="staff.image ">															<div class="media-body shadow-sm shadow-showcase">
																<div class="input-group text-box">
																	<input class="form-control input-txt-bx" v-model="cmnt.description" type="text" name="message-to-send" placeholder="Post Your commnets">
																	<div class="input-group-append">
																		<button @click="addCmnt" class="btn btn-transparent" type="button"><i class="fa fa-paper-plane-o   ">  </i></button>
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
        <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'primaryy' cancelVariant= 'seacndarfy' id="add" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Update comment</h5>
                      </div>
                      <div>
                        <b-form @submit.stop.prevent="add">
                          <b-form-group id="example-input-group-1" label="Description" label-for="example-input-1">
                            <b-form-input
                              id="example-input-1"
                              name="example-input-1"
                              v-model="form.description"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-5" label="file" label-for="example-input-5">
                            <b-form-file
                              id="example-input-5"
                              name="example-input-5"
                              v-model="form.file"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-5')"
                              aria-describedby="input-5-live-feedback"
                              data-vv-as="CV">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                          </b-form-group>
                        <b-form-group id="example-input-group-5" label="image" label-for="example-input-5">
                            <b-form-file
                              name="example-input-5"
                              v-model="form.image"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-5')"
                              aria-describedby="input-5-live-feedback"
                              data-vv-as="CV">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-button type="submit"  variant="primary">Submit</b-button>
                        </b-form>
                      </div>                       
                    </div>
                  </b-modal>
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
        form: {
          file:'',
          image:'',
          description:'',

        },
        cmnt: {
        description: '',
        sous_tache_id:parseInt(this.id, 10),
        personnel_id:''
      },
       subtask:null,
       staff:null,
      }},
    created() {
      const user = JSON.parse(localStorage.getItem('personnel'))
      if (localStorage.getItem("role")) {
        if (localStorage.getItem("role") === "admin") {
          this.role = "admin"
        } else {
          this.role = "other"
        }
      } else {
        this.role = "client"
      }
      if(this.role == 'admin'){
       axios.get('soustaches/'+String(this.id)).then(res =>{
             this.subtask = res.data.soustache
             this.staff = res.data.personnel
             this.comments = res.data.commentaire
             if (user.id == res.data.personnel.id) {
              this.access = true
            } else {
              this.access = false
            }
          });
       }
       if(this.role == 'other'){
          axios.get('subtasks/'+String(this.id)).then(res =>{
             this.subtask = res.data.soustache
             this.staff = res.data.personnel
             this.comments = res.data.commentaire
             if (user.id == res.data.personnel.id) {
              this.access = true
            } else {
              this.access = false
            }
          });
       }
     
    },
    methods:{
add() {},
 validateState(ref) {
        if (
          this.veeFields[ref] &&
          (this.veeFields[ref].dirty || this.veeFields[ref].validated)
        ) {
          return !this.veeErrors.has(ref);
        }
        return null;
      },
      addCmnt() {
         const user = JSON.parse(localStorage.getItem('personnel'))
        this.cmnt.personnel_id = user.id
        
        console.log(this.cmnt);
          axios.post('comments',this.cmnt).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('Comment added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            }
          
         
        });
       

    },
    deleteCmnt(id) {
 axios.delete('comments/'+id).then(res =>{
              this.$toastr.s('Comment deleted ! ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },
      
    }
  };
</script>
