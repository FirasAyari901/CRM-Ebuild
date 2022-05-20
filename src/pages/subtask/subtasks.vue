<template>
    <div>
      <br><br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
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
                                  <feather   type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                <feather @click="deleteee(subtask.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                
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
        tache_id:parseInt(this.id, 10),
        personnel_id:2
       
       
      },
      form2: {
          num_tel:'',
          CV:'',
          image:'',
          email:'',
          password:'',
          name: '',
          role: '',
        },
      options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        limitMultiValue:[],
       subtasks :null

      }},
    created() {
      axios.get('soustaches').then(res =>{
             this.subtasks = res.data.soustaches
          });
    },
    methods:{
     onSubmit() {
        this.form.etat = this.form.etat.name
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('soustaches',this.form).then(res =>{
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
 axios.delete('soustaches/'+id).then(res =>{
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
        this.$router.push({path:'/app/subtask/'+id});

      },
      
    }
  };
</script>
