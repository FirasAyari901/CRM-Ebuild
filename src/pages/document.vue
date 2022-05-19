<template>
  <div>
      <br><br>
      <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <b-row>
                        <b-col xl="9">
                          <h4 class="mb-0">Documents</h4>
                          </b-col>
                          <b-col xl="3">
                            <b-button class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.createDocument @click="$bvModal.show('bv-modal-example')" >
                    <i data-feather="plus-square" > </i>Create New Document</b-button>
                    <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="createDocument" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Update document</h5>
                      </div>                
                      <div>
                        <b-form @submit.stop.prevent="updatee">
                          <b-form-group id="example-input-group-7" label="Type doc" label-for="example-input-7">
                            <b-form-select
                              id="role"
                              name="example-input-7"
                              v-model="form.Typedoc"
                              v-validate="{ required: true }"
                              :options="roles"
                              :state="validateState('example-input-7')"
                              aria-describedby="input-7-live-feedback"
                              data-vv-as="role">
                            </b-form-select>
                            <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-1" label="Amount HT" label-for="example-input-1">
                            <b-form-input
                              id="name"
                              name="example-input-1"
                              v-model="form.AmountHT"
                              v-validate="{ required: true,numeric,  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>     
                          <b-form-group id="example-input-group-2" label="Status " label-for="example-input-2">
                            <b-form-input
                              id="num_tel"
                              name="example-input-2"
                              v-model="form.Etatdoc"
                              v-validate="{ required: true  }"
                              :state="validateState('example-input-2')"
                              aria-describedby="input-2-live-feedback"
                              data-vv-as="num_tel">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-3" label="Description" label-for="example-input-3">
                            <b-form-input
                              id="email"
                              name="example-input-3"
                              v-model="form.Infosupp"
                              v-validate="{ required: true,  }"
                              :state="validateState('example-input-3')"
                              aria-describedby="input-3-live-feedback"
                              data-vv-as="email">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
                          </b-form-group>

                          
                          
                          <b-button type="submit"  variant="primary">Submit</b-button>
                        </b-form>
                      </div>
                    </div>
                  </b-modal>  
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
                                
                              </div>
                              <div class="product-name">
                              <span class="badge badge-primary">comfirmed</span>
                              </div>
                              <br>
                              <div class="avaiabilty">
                                <div class="text-success">20/04/2022</div>
                            </div>
                            <div class="avaiabilty ">
                                <div class="text-success">document type : appraisal</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </div>
                              </div>
                              <br>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 1300 TND
                              </div>
                              
                              <br>                               
                              <div class="avaiabilty">
                              <feather  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                     
                                 <feather style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                
                              </div>
                              <div class="product-name">
                              <span class="badge badge-primary">created</span>
                              </div>
                              <br>
                              <div class="avaiabilty">
                                <div class="text-success">20/04/2022</div>
                            </div>
                            <div class="avaiabilty ">
                                <div class="text-success">document type : bills</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </div>
                              </div>
                              <br>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              
                              <br>                               
                              <div class="avaiabilty">
                              <feather  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                     
                                 <feather style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                
                              </div>
                              <div class="product-name">
                              <span class="badge badge-primary">comfirmed</span>
                              </div>
                              <br>
                              <div class="avaiabilty">
                                <div class="text-success">20/04/2022</div>
                            </div>
                            <div class="avaiabilty ">
                                <div class="text-success">document type : appraisal</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem </div>
                              </div>
                              <br>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 1020 TND
                              </div>
                              
                              <br>                               
                              <div class="avaiabilty">
                              <feather  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                     
                                 <feather style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
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
      <!-- Container-fluid Ends-->
  </div>
</template>

<script>
  import { mapState } from 'vuex';
  
  export default {
    data(){
      return {
        roles: [
          { value: 'bills', text: 'bills' },
          { value: 'appraisal', text: 'appraisal' }
        ],
        form: {
          Typedoc:'',
          AmountHT:'',
          Etatdoc:'',
          Infosupp:'',
          operations:[ {
          nature:'',
          AmountHT:'',
          AmountTVA:'',
        }],
        },
        
      };
    },
    computed: {
      ...mapState({
        orederhistory: state => state.common.orederhistory
      })
    },
    methods:{
      addForm(){
        this.form.operations.push({
          nature:'',
          AmountHT:'',
          AmountTVA:'',
        })
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
      updatee() {
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          console.log(this.form)
          return;
        });
      },
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
    }
  };
</script>