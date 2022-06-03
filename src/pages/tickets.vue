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
                          <h4 class="mb-0">Tickets</h4>
                          </b-col>
                        <b-col xl="2">
                         <b-button v-if="role == 'client'" id="default-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg variant="secondary">Add Ticket</b-button>
                        </b-col>
                      </b-row>

                    </div>

                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <px-card title="" :actions="false">
                  <div slot="with-padding">
                    <div class="row">
                      <div class="col-xl-4 col-md-6 box-col-6" v-for="(ticket,index) in tickets" :key="index">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">{{ ticket.title }}</a></h6>
                              </div>
                              <div class="price d-flex"> 
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">{{ ticket.attributes.description }}</div>
                              </div>
                                <br><br>                             
                              <div class="avaiabilty">
                              </div><a v-b-modal.modal-update v-if="role == 'client'" class="btn btn-warning btn-xs" @click="ticket_id = ticket.id" href="#">Update</a><feather v-if="role == 'client'" class="close" @click="deleteee(ticket.id)"  type="trash-2"></feather>
                            </div>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                </px-card>

        
              </div>
            </div>
          </div>
      <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-lg" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Add ticket</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="add">
                              <b-form-group id="example-input-group-1" label="title" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form.titre"
                                  v-validate="{ required: true, min:3  }"
                                  :state="validateState('example-input-1')"
                                  aria-describedby="input-1-live-feedback"
                                  data-vv-as="project name"
                                ></b-form-input>
                              </b-form-group>
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
                            @change="file"
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
                            <b-form-group id="example-input-group-2" label="Project" label-for="example-input-2">
                                  <multiselect  v-model="form.projet_id" :options="projects" label="project_name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
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
                            <h5>Update ticket</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="updateee">
                              <b-form-group id="example-input-group-1" label="title" label-for="example-input-1">
                                <b-form-input
                                  id="example-input-1"
                                  name="example-input-1"
                                  v-model="form.titre"
                                  v-validate="{ required: true, min:3  }"
                                  :state="validateState('example-input-1')"
                                  aria-describedby="input-1-live-feedback"
                                  data-vv-as="project name"
                                ></b-form-input>
                              </b-form-group>
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
                            @change="file"
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
                            <b-form-group id="example-input-group-2" label="Project" label-for="example-input-2">
                                  <multiselect  v-model="form.projet_id" :options="projects" label="project_name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
                                <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                              </b-form-group>
                              <b-button type="submit" variant="primary">Submit</b-button>
                              <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                            </b-form>
                          </div>
                          </div>
        </b-modal> 
  </div>
</template>

<script>
  import { mapState } from 'vuex';
     import Multiselect from 'vue-multiselect';
 import axios from 'axios'; 

  export default {
    components: {
      Multiselect,
    },
    data(){
      return {
        tickets:[],
        ticket_id:null,
         projects: [
        ],
          form: {
          projet_id:'',
          client_id:'',
          description:'',
          titre:'',
          file:'',

        },
      };
    },
    computed: {
      ...mapState({
        orederhistory: state => state.common.orederhistory
      })
    },
    created(){
     if (localStorage.getItem("role")) {
        if (localStorage.getItem("role") === "admin") {
          this.role = "admin"
        } else {
          this.role = "other"
        }
      } else {
        this.role = "client"
      }
if(this.role == 'client'){
      axios.get('tickets').then((response)=>{
        this.tickets=response.data.tickets
      }) 
      axios.get('allprojects').then((response)=>{
         console.log(response.data.projets)
        this.projects=response.data.projets
      }) 
}
if(this.role == 'other'){
   axios.get('showtickets').then((response)=>{
         console.log(response.data.tickets)
        this.tickets=response.data.tickets
      }) 
}
if(this.role == 'admin'){
   axios.get('alltickets').then((response)=>{
         console.log(response.data.tickets)
        this.tickets=response.data.tickets
      }) 
}
    }
    ,
    methods:{
      file(event) {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.file = event.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        
      },
      add() {
        const user = JSON.parse(localStorage.getItem('client'))
        this.form.client_id = user.id
        this.form.projet_id = this.form.projet_id.id 
        console.log(this.form);
         this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('tickets',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('ticket added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });
     
      },
      updateee() {
        const user = JSON.parse(localStorage.getItem('client'))
        this.form.client_id = user.id
        this.form.projet_id = this.form.projet_id.id 
        console.log(this.form);
         this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.put('tickets/'+this.ticket_id,this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('ticket updated ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
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
      deleteee(id) {
      axios.delete('tickets/'+id).then(res =>{
              this.$toastr.s('Ticket deleted ! ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },
    }
  };
</script>