<template>
  <div>
    <br><br>
    <div class="container-fluid">
      <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <b-row>
                        <b-col xl="10">
                          <h4 class="mb-0">Projects</h4>
                          </b-col>
                        <b-col xl="2">
                          <b-button v-if="role == 'admin'" class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg @click="$bvModal.show('bv-modal-example')" >
                          <i data-feather="plus-square" > </i>Create New Project</b-button>                        </b-col>
                          </b-row>
                          <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-lg" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Add project</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="onSubmit">
                              <b-form-group id="example-input-group-1" label="Project name" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form.project_name"
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
                               <b-form-group id="example-input-group-2" label="Team" label-for="example-input-2">
                                  <multiselect v-model="form.equipe_id"  :options="teams" label="pseudo" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a team"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                   <b-form-datepicker id="example-datepickr" v-model="form.deadline" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                                <b-form-group id="example-input-group-4" label="Start date" label-for="example-input-4">
                                <b-form-datepicker id="example-datepicker" v-model="form.date_debut" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                              </b-form-group>
                              
                              
                              
                          <b-form-group id="example-input-group-6" label="File CDC" label-for="example-input-6">
                            <b-form-file
                              id="example-input-6"
                              name="example-input-6"
                              @change="file_cdc"
                              v-model="form.file_cdc"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="file cdc">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-6" label="Capture DC" label-for="example-input-6">
                            <b-form-file
                              name="example-input-6"
                              @change="capture_dc"
                              v-model="form.capture_dc"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="capture dc">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
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
                            <h5>Update project</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="updateee">
                              <b-form-group id="example-input-group-1" label="Project name" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form.project_name"
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
                               <b-form-group id="example-input-group-2" label="Team" label-for="example-input-2">
                                  <multiselect v-model="form.equipe_id"  :options="teams" label="pseudo" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a team"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                   <b-form-datepicker id="example-datepickr" v-model="form.deadline" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                                <b-form-group id="example-input-group-4" label="Start date" label-for="example-input-4">
                                <b-form-datepicker id="example-datepicker" v-model="form.date_debut" class="mb-2"></b-form-datepicker>

                                <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                              </b-form-group>
                              
                              
                              
                          <b-form-group id="example-input-group-6" label="File CDC" label-for="example-input-6">
                            <b-form-file
                              id="example-input-6"
                              name="example-input-6"
                              @change="file_cdc"
                              v-model="form.file_cdc"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="file cdc">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-6" label="Capture DC" label-for="example-input-6">
                            <b-form-file
                              name="example-input-6"
                              @change="capture_dc"
                              v-model="form.capture_dc"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="capture dc">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
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
                     
                    </div>

                </div>
              </div>

            </div>
      <div class="row">
        <div class="col-md-12 project-list">
          <div class="card">
            <div class="row m-0">
              <div class="col-sm-12 p-0">
         
                
                    <b-card-text>
                      <div class="col-sm-12 p-0">
                            
                            <div class="row">
                              <div class="col-xl-4 col-lg-6" v-for="(project,index) in projects" :key="index" :class="index < 3 ? 'mb-4' : ''">
                                <div class="project-box" >
                                 
                              
                                    <div @click="redirect(project.id)">
                                        <span class="badge badge-primary">
                                        {{ project.attributes.etat }}</span>
                                      <h6>{{ project.project_name }}</h6>
                                      
                                      <p>{{ project.attributes.description }}</p>
                                      <div class="row details">
                                        <div class="col-6">
                                          <span>start date </span>
                                        </div>  
                                        <div class="col-6 text-primary" >{{ project.attributes.date_debut }}</div>
                                        <div class="col-6">
                                          <span>deadline</span>
                                        </div>
                                        <div class="col-6 text-primary" >{{ project.attributes.deadline }}</div>
                                      </div>
                                    </div>
                                    <feather v-if="role == 'admin'" @click="recuperer(project.id)"  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                 <feather v-if="role == 'admin'" @click="deleteee(project.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                </div>
                              </div>
                            </div>
                          </div>
                   
                    </b-card-text>
         
              </div>
              <div class="col-sm-6 create-project-btn">
                <div class="text-right">
                  <div class="form-group mb-0 mr-0"></div>
                  <!-- <a class="btn btn-primary" href="">
                    <i data-feather="plus-square"> </i>Create New Project</a
                  > -->
                 
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
    import Datepicker from 'vuejs-datepicker';
 import axios from 'axios'; 


  export default {
    name:'projects',
    components: {
      Multiselect,
      Datepicker
    },
    data(){
      return {
        form: {
        date_debut:'',
        deadline:'',
        file_cdc:'',
        capture_dc:'',
        etat:'',
        description: '',
        project_name: '',
        equipe_id:null
       
       
      },
        projects:[],
        options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        teams: [],
        
        format: 'yyyy-MM-dd',

        
        limitMultiValue:[],
     
      };
    },

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
      this.init()
    },
    methods:{
      file_cdc(event) {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.file_cdc = event.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        console.log(this.form);
      },
      capture_dc(event) {
        console.log(this.projects);
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.capture_dc = event.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        console.log(this.form);
      },
      init(){
       if(this.role == 'admin'){
       axios.get('projets').then((response)=>{
         console.log(response.data.projets)
        this.projects=response.data.projets
      }) 
      axios.get('equipes').then((response)=>{
        this.teams=response.data.Equipes
      })
       }
      if(this.role == 'other'){
       axios.get('projects').then((response)=>{
         console.log(response.data.projets)
        this.projects=response.data.projets
      }) 
       }
       
      },
      onSubmit() {
        this.form.equipe_id = this.form.equipe_id.id
        this.form.etat = this.form.etat.name
        console.log(this.form);
       this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('projets',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('project added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });

    },
    recuperer(id){
      axios.get('projets/'+String(id)).then((response)=>{
      this.date_debut = response.data.attributes.date_debut
      this.deadline = response.data.attributes.deadline 
      this.etat = response.data.attributes.etat 
      this.description = response.data.attributes.description
      this.project_name = response.data.project_name
      this.equipe_id = this.teams.find(function(item, index) {
      	if(item.id == this.equipe_id)
	       	return true;
});
      }) 
      
      
    },
     updateee() {
        this.form.equipe_id = this.form.equipe_id.id
        this.form.etat = this.form.etat.name
        console.log(this.form);
       
          axios.post('projets',this.form).then(res =>{
              this.$toastr.s('project added ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },
    deleteee(id) {
 axios.delete('projets/'+String(id)).then(res =>{
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
      addTag (newTag) {
        const tag = {
          name: newTag,
          code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        };
        this.options.push(tag);
        this.value.push(tag);
      },
      redirect (index) {
        this.$router.push({path:'/app/project/'+String(index)});  
      },
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
    }
  };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

