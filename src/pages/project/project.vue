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
                        <div class="col-10"><h2>{{project.project_name}}</h2></div>
                        <div class="col-2">
                          <b-button v-if="role == 'admin'" id="default-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg variant="secondary">Add task</b-button>
                        </div>
                      </div>

                      <span class="badge badge-primary" >{{project.attributes.etat}}</span>
                      <br>
                      <div class="avaiabilty">
                          <div class="text-success">start date : {{project.attributes.date_debut}}</div>
                      </div>
                      <div class="avaiabilty">
                          <div class="text-success">Deadline : {{project.attributes.deadline}}</div>
                      </div>
                      <br>
                      <p>{{project.attributes.description}}</p> 
                    </div>
                </div>
                <div class="col-sm-12 p-0">
                        
                            <div class="row" >
                              <div class="col-sm-12 col-xl-6" v-for="(task,index) in tasks" :key="index">
                                <b-card header-tag="div" header-class="b-l-primary border-3" >
                                  <h5 @click="redirect(task.id)" slot="header">{{task.titre}}</h5>
                                  <span class="badge badge-primary" >{{task.attributes.etat}}</span><br>
                                  <div class="avaiabilty">
                                      <div class="text-success">Deadline : {{task.attributes.deadline}}</div>
                                  </div>
                                  <br>
                                  <b-card-text class="mb-0">{{task.attributes.description}}</b-card-text><br><br>
                                  <feather v-if="role == 'admin'"  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                <feather v-if="role == 'admin'" @click="deleteee(task.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                </b-card>

                              </div>
                        

                            </div>
                        </div>
                      
              </div>               
            </div>
        </div>
           <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-lg" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Add task</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="onSubmit">
                              <b-form-group id="example-input-group-1" label="Task title" label-for="example-input-1">
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
                              <b-form-group id="example-input-group-2" label="Staff" label-for="example-input-2">
                                  <multiselect  v-model="form.personnel_id" :options="staff" label="name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                              <b-button type="submit" variant="primary">Submit</b-button>
                              <b-button class="ml-2" @click="resetForm()">Reset</b-button>
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
        form: {
        deadline:'',
        etat:'',
        description: '',
        titre: '',
        projet_id:parseInt(this.id, 10),
        personnel_id:null
       
       
      },
      options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        limitMultiValue:[],
        staff:[],
       project :null,
       tasks :null,
       role:null
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
      if(this.role == 'admin'){
      axios.get('projets/'+String(this.id)).then(res =>{
             this.project = res.data.projet
             this.tasks = res.data.taches
             console.log(res.data.taches);
          })
      axios.get('personnels').then((response)=>{
        this.staff=response.data.staff;
      });   
       }
       if(this.role == 'other'){
         axios.get('projects/'+String(this.id)).then(res =>{
             this.project = res.data.projet
             this.tasks = res.data.taches
             console.log(res.data.taches);
          })
       }
      ;
    },
    methods:{
     onSubmit() {
        this.form.etat = this.form.etat.name
        this.form.personnel_id = this.form.personnel_id.id
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('taches',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('Task added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });
       

    },
    deleteee(id) {
 axios.delete('taches/'+id).then(res =>{
              this.$toastr.s('project deleted ! ');
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
        this.$router.push({path:'/app/task/'+id});

      },
      
    }
  };
</script>
