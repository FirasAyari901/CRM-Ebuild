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
                          <b-button class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg @click="$bvModal.show('bv-modal-example')" >
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
                                  <multiselect  v-model="form.team" :options="teams" label="name" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a team"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                    <datepicker input-class="datepicker-here form-control digits" value-type="YYYY-MM-DD" format="YYYY-MM-DD" v-model="form.deadline" ></datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                                <b-form-group id="example-input-group-4" label="Start date" label-for="example-input-4">
                                   <datepicker input-class="datepicker-here form-control digits" :format="format" v-model="form.date_debut"></datepicker>


                                <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                              </b-form-group>
                              
                              
                              
                              <b-form-group id="example-input-group-5" label="File CDC" label-for="example-input-5">
                                <b-form-file
                                  id="example-input-5"
                                  name="example-input-5"
                                  
                                  v-model="form.file_cdc"
                                  v-validate="{ required: true}"
                                  :state="validateState('example-input-5')"
                                  aria-describedby="input-5-live-feedback"
                                  data-vv-as="file CDC"
                                ></b-form-file>

                                <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-6" label="Capture DC" label-for="example-input-6">
                                <b-form-file
                                  id="example-input-6"
                                  name="example-input-6"
                                  
                                  v-model="form.capture_dc"
                                  v-validate="{ required: true}"
                                  :state="validateState('example-input-6')"
                                  aria-describedby="input-6-live-feedback"
                                  data-vv-as="capture DC"
                                ></b-form-file>

                                <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                              </b-form-group>
                          


                              <b-form-group id="example-input-group-2" label="Status" label-for="example-input-2">
                                  <multiselect  v-model="form.status" :options="options" label="name" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a status"></multiselect>
     
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
                                  <multiselect  v-model="form.team" :options="teams" label="name" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a team"></multiselect>
     
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>

                                  <b-form-group id="example-input-group-7" label="Deadline" label-for="example-input-7">
                                    <datepicker input-class="datepicker-here form-control digits" value-type="YYYY-MM-DD" format="YYYY-MM-DD" v-model="form.deadline" ></datepicker>

                                <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                              </b-form-group>
                                <b-form-group id="example-input-group-4" label="Start date" label-for="example-input-4">
                                   <datepicker input-class="datepicker-here form-control digits" :format="format" v-model="form.date_debut"></datepicker>


                                <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                              </b-form-group>
                              
                              
                              
                              <b-form-group id="example-input-group-5" label="File CDC" label-for="example-input-5">
                                <b-form-file
                                  id="example-input-5"
                                  name="example-input-5"
                                  
                                  v-model="form.file_cdc"
                                  v-validate="{ required: true}"
                                  :state="validateState('example-input-5')"
                                  aria-describedby="input-5-live-feedback"
                                  data-vv-as="file CDC"
                                ></b-form-file>

                                <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-form-group id="example-input-group-6" label="Capture DC" label-for="example-input-6">
                                <b-form-file
                                  id="example-input-6"
                                  name="example-input-6"
                                  
                                  v-model="form.capture_dc"
                                  v-validate="{ required: true}"
                                  :state="validateState('example-input-6')"
                                  aria-describedby="input-6-live-feedback"
                                  data-vv-as="capture DC"
                                ></b-form-file>

                                <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                              </b-form-group>
                          


                              <b-form-group id="example-input-group-2" label="Status" label-for="example-input-2">
                                  <multiselect  v-model="form.status" :options="options" label="name" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a status"></multiselect>
     
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
                              <div class="col-xl-4 col-lg-6" v-for="(project,index) in allprojects" :key="index" :class="index < 3 ? 'mb-4' : ''">
                                <div class="project-box" >
                                 
                              
                                    <div @click="redirect(index)">
                                        <span class="badge" :class="'badge-'+project.type">
                                        {{ project.badge }}</span>
                                      <h6>{{ project.title }}</h6>
                                      <div class="media">
                                        <img class="img-20 mr-1 rounded-circle" :src='getImgUrl(project.img)' alt="" title="">
                                        <div class="media-body">
                                          <p>{{ project.sites }} </p>
                                        </div>
                                      </div>
                                      <p>{{ project.desc }}</p>
                                      <div class="row details">
                                        <div class="col-6">
                                          <span>start date </span>
                                        </div>  
                                        <div class="col-6 text-primary" :class="'text-'+project.type">{{ project.startdate }}</div>
                                        <div class="col-6">
                                          <span>deadline</span>
                                        </div>
                                        <div class="col-6 text-primary" :class="'text-'+project.type">{{ project.deadline }}</div>
                                      </div>
                                    </div>
                                    <feather  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                     
                                 <feather style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
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
  import { mapState } from 'vuex';
  import Multiselect from 'vue-multiselect';
    import Datepicker from 'vuejs-datepicker';


  export default {
    components: {
      Multiselect,
      Datepicker
    },
    data(){
      return {
        options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        teams: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        status:'',
        
        format: 'yyyy-MM-dd',

        form: {
        date_debut:'',
        deadline:'',
        file_cdc:'',
        capture_dc:'',
        etat:'',
        description: '',
        project_name: '',
       
       
      },
        limitMultiValue:[],
     
      };
    },
    computed: {
      ...mapState({
        allprojects: state => state.common.allprojects,
        doingprojects: state => state.common.doingprojects,
        doneprojects: state => state.common.doneprojects
      })
    },
    methods:{
      onSubmit() {
              console.log(this.form);

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
        this.$router.push({path:'/app/project/1'});  
      },
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
    }
  };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

