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
                        <div class="col-10"><h2>{{task.titre}}</h2></div>
                        <div class="col-2">
                          <b-button v-if="role == 'admin'" class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg @click="$bvModal.show('bv-modal-example')" >
                          <i data-feather="plus-square" > </i>Create Subask</b-button>  
                        </div>
                      </div>

                      <span class="badge badge-primary" >{{task.attributes.etat}}</span>
                      <br><br>
                      <div class="avaiabilty">
                        <img class="img-30 img-fluid m-r-20 rounded-circle" :src="staff.image " alt="staff.name">
                        <span>{{staff.name}}</span>
                      </div>
                      <br>
                      <div class="avaiabilty">
                          <div class="text-success">Deadline : {{task.attributes.deadline}}</div>
                      </div>
                      <br>
                      <p>{{task.attributes.description}}</p> 
                    </div>
                </div>
                <div class="col-sm-12 p-0">
                        
                            <div class="row">
                              <div class="col-sm-12 col-xl-6" v-for="(subtask,index) in subtasks" :key="index">
                                <b-card header-tag="div" header-bg-variant="secondary" class="card-absolute" >
                                  
                                    <h5 slot="header">{{ subtask.attributes.etat }}</h5>
                                  <div @click="redirect(subtask.id)">
                                    <h4>{{ subtask.titre }}</h4>    
                              <br>
                                   
                                  <div class="avaiabilty">
                                      <div class="text-success">Deadline : {{ subtask.attributes.deadline }}</div>
                                  </div>
                                  <br>
                                  <b-card-text class="mb-0">{{ subtask.attributes.description }}</b-card-text>
                                  </div>
                                  <feather  v-if="role == 'admin'" @click="id_subtask = subtask.id"  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                <feather v-if="role == 'admin'" @click="deleteee(subtask.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                </b-card>
                              </div>
                          
                            </div>
                 </div>
                 <div class="col-sm-12 p-0">
                    <div class="row"> 
                      <div class="col-sm-12">
                        <div class="card">
											<div class="card-body">
												<div class="timeline-content">
												<div class="social-chat">
														
                            <div class="your-msg " v-for="(comment,index) in comments" :key="index" >
															<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" :src="staff.image">
																<div class="media-body shadow-sm shadow-showcase"><span class="f-w-600">{{staff.name}} </span>
																	<p>{{ comment.description }}</p>
															<feather  v-if="access" type="edit" stroke="#ffcd01" v-b-modal.add ></feather> 
                                <feather @click="deleteCmnt(comment.id)" v-if="access" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                              	</div>
															</div>
														</div>
                    
								
													</div>
													<div class="comments-box" v-if="access">
														<div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" alt="" :src="staff.image">
															<div class="media-body shadow-sm shadow-showcase">
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
        <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-lg" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Add subtask</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="onSubmit">
                              <b-form-group id="example-input-group-1" label="Subask title" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form.titre"
                                  v-validate="{ required: true, min:3  }"
                                  :state="validateState('example-input-1')"
                                  aria-describedby="input-1-live-feedback"
                                  data-vv-as="project name"
                                ></b-form-input>

                                <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-3" label="Description" label-for="example-input-3">
                                <b-form-input
                                  id="example-input-3"
                                  name="example-input-3"
                                  v-model="form.description"
                                  v-validate="{ required: true ,min:3}"
                                  :state="validateState('example-input-3')"
                                  aria-describedby="input-3-live-feedback"
                                  data-vv-as="description"
                                ></b-form-input>
                                <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>

                              </b-form-group>
                            

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                   <b-form-datepicker id="example-datepickr" v-model="form.deadline" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-2" label="Status" label-for="example-input-2">
                                  <multiselect  v-model="form.etat" :options="options" label="name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                              <b-button type="submit" variant="primary">Submit</b-button>
                              <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                            </b-form>
                          </div>
                          </div>
            </b-modal>
        <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-update" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Update subtask</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="updateee">
                              <b-form-group id="example-input-group-1" label="Subask title" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form2.titre"
                                  v-validate="{ required: true, min:3  }"
                                  :state="validateState('example-input-1')"
                                  aria-describedby="input-1-live-feedback"
                                  data-vv-as="project name"
                                ></b-form-input>

                                <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-3" label="Description" label-for="example-input-3">
                                <b-form-input
                                  id="example-input-3"
                                  name="example-input-3"
                                  v-model="form2.description"
                                  v-validate="{ required: true ,min:3}"
                                  :state="validateState('example-input-3')"
                                  aria-describedby="input-3-live-feedback"
                                  data-vv-as="description"
                                ></b-form-input>
                                <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>

                              </b-form-group>
                            

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                   <b-form-datepicker id="example-datepickr" v-model="form2.deadline" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-2" label="Status" label-for="example-input-2">
                                  <multiselect  v-model="form2.etat" :options="options" label="name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                              <b-button type="submit" variant="primary">Submit</b-button>
                              <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                            </b-form>
                          </div>
                          </div>
            </b-modal>
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
                              v-model="form1.description"
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
                              v-model="form1.file"
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
                              v-model="form1.image"
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
        form1: {
          file:'',
          image:'',
          description:'',

        },
        form: {
        deadline:'',
        etat:'',
        description: '',
        titre: '',
        tache_id:parseInt(this.id, 10),
        personnel_id:''
       
       
      },
      form2: {
        deadline:'',
        etat:'',
        description: '',
        titre: '',
        tache_id:parseInt(this.id, 10),
       
       
       
      },
      id_subtask:null,
       cmnt: {
        description: '',
        tache_id:parseInt(this.id, 10),
        personnel_id:''
      },
      options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        limitMultiValue:[],
        staff:null,
       task :null,
       subtasks :null,
       comments:[],
       access : null

      }},
    created() {
      if (localStorage.getItem("role")) {
        if (localStorage.getItem("role") === "admin") {
          this.role = "admin"
        } else {
          this.role = "other"
        }
      } else {
        this.role = "client"
      }
      const user = JSON.parse(localStorage.getItem('personnel'))
     
      if(this.role == 'admin'){
       axios.get('taches/'+String(this.id)).then(res =>{
         console.log(res.data.tache);
             this.task = res.data.tache
             this.staff = res.data.personnel
             this.subtasks = res.data.soustaches
             this.comments = res.data.commentaires
              if (user.id == res.data.personnel.id) {
              this.access = true
            } else {
              this.access = false
            }
       
          });
       }
       if(this.role == 'other'){
          axios.get('tasks/'+String(this.id)).then(res =>{
             this.task = res.data.tache
             this.subtasks = res.data.soustaches
             this.staff = res.data.personnel
             this.comments = res.data.commentaires
              if (user.id == res.data.personnel.id) {
              this.access = true
            } else {
              this.access = false
            }
       
          });
       }
      
    },
    methods:{
      updateee() {
        this.form2.etat = this.form2.etat.name
        console.log(this.id_subtask);
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.put('soustaches/'+this.id_subtask,this.form2).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('Subtask updated ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });
       

    },
     onSubmit() {
        this.form.etat = this.form.etat.name
        this.form.personnel_id = this.staff.id
         this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('soustaches',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('Subtask added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });
       

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
    deleteee(id) {
 axios.delete('soustaches/'+id).then(res =>{
              this.$toastr.s('Subtask deleted ! ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },deleteCmnt(id) {
 axios.delete('comments/'+id).then(res =>{
              this.$toastr.s('Comment deleted ! ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },
    validateState(ref) {
      if (
        this.veeFields[ref] &&
        (this.veeFields[ref].dirty || this.veeFields[ref].validated)
      ) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },
    resetForm() {
      this.form = {
        name: null,
        food: null
      };

      this.$nextTick(() => {
        this.$validator.reset();
      });
    },
      redirect (id) {
        this.$router.push({path:'/app/subtask/'+id});

      },
      
    }
  };
</script>
