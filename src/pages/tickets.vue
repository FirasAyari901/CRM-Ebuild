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
                         <b-button id="default-secondary" lass="mb-0 datatable-select" v-b-modal.add variant="secondary">Add Ticket</b-button>
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
                      <div class="col-xl-4 col-md-6 box-col-6" :key="item.id" v-for="item in tickets">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">{{ item.title }}</a></h6>
                              </div>
                         
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">{{ item.attributes.description }}</div>
                              </div>
                                <br><br>                             
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a><feather @click="deletee(item.id)" class="close"  type="trash-2"></feather>
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
                  <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'primdary' cancelVariant= 'primaryr' id="add" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Add ticket</h5>
                      </div>
                      <div>
                        <b-form @submit.stop.prevent="add">
                          <b-form-group id="example-input-group-1" label="Title" label-for="example-input-1">
                            <b-form-input
                              id="example-input-1"
                              name="example-input-1"
                              v-model="form.titre"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-2" label="Description" label-for="example-input-2">
                            <b-form-input
                              id="example-input-2"
                              name="example-input-2"
                              v-model="form.description"
                              v-validate="{ required: true }"
                              :state="validateState('example-input-2')"
                              aria-describedby="input-2-live-feedback"
                              data-vv-as="password">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                          </b-form-group>
                        <!--  <b-form-group id="example-input-group-7" label="Project" label-for="example-input-7">
                            <b-form-select
                              id="role"
                              name="example-input-7"
                              v-validate="{ required: true }"
                              :options="roles"
                              :state="validateState('example-input-7')"
                              aria-describedby="input-7-live-feedback"
                              data-vv-as="role">
                            </b-form-select>
                            <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                          </b-form-group>-->
                          <b-form-group id="example-input-group-5" label="File" label-for="example-input-5">
                            <b-form-file
                              id="example-input-5"
                              name="example-input-5"
                              @change="file"
                              v-model="form.file"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-5')"
                              aria-describedby="input-5-live-feedback"
                              data-vv-as="file">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                          </b-form-group>

                          <b-button type="submit"  variant="primary">Submit</b-button>
                          <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                        </b-form>
                      </div>                       
                    </div>
       </b-modal>
  </div>
</template>


<script>
  import axios from 'axios'; 

  export default {
    name:'personnels',
    data() {
      return{
        roles: [
          { value: null, text: 'Choose...' },
          { value: 'Scanini', text: 'Scanini' }
        ],
        form: {
          description:'',
          titre: '',
          file: '',
          projet_id: 6,
          client_id:3
        },
        id:0,
        selected: null,
        tickets:null,
     
        
      };
    },
 



    created() {
      axios.get('tickets').then((response)=>{
        console.log(response.data.tickets);
        this.tickets = response.data.tickets
      });   
      
    },
    methods: {
      file(event) {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.file = event.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        console.log(this.form);
      },
      
      deletee (id) {
        axios.delete('tickets/'+String(id));
        setTimeout(() => {
          location.reload();
        }, '1000');
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
          description:'',
          titre: '',
          file: '',
          projet_id: 6,
          client_id:3
        };
        this.$nextTick(() => {
          this.$validator.reset();
        });
      },
      add() {
        console.log(this.form)
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('tickets',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('Ticket  added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
            }
          });
          return;
        });
      },
   
    },
    test :function(){
      console.log('item');
    }
  };
</script>