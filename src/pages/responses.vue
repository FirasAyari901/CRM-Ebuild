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
                          <h4 class="mb-0">Responses</h4>
                          </b-col>
                        <b-col xl="2">
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
                     
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">Response number 2 </a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">Ticket 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</div>
                              </div>
                                <br><br>                             
                              <div class="avaiabilty">
                              </div>
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
                            <h5>Update response</h5>
                        </div>
                
                          <div>
                            <b-form @submit.stop.prevent="onSubmit">
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
                            <b-form-group id="example-input-group-2" label="Ticket" label-for="example-input-2">
                                  <multiselect  v-model="form.ticket" :options="options" label="name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a status"></multiselect>
     
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

  export default {
    components: {
      Multiselect,
    },
  
    data(){
      return {
          options: [
          { code: 1, name: 'Ticket 1' },
        ],
          form: {
          file:'',
          image:'',
          description:'',
          ticket:'Ticket 1'

        },
      };
    },
    computed: {
      ...mapState({
        orederhistory: state => state.common.orederhistory
      })
    },
    methods:{
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
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
      
    }
  };
</script>