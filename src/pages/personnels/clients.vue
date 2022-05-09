<template>
  <div>   
  <!-- Container-fluid starts-->
    <br><br><br><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <br>
            <br>
            <div class="card-body">
              <b-row>
                <b-col xl="6">         
                  <b-button  id="default-secondary" lass="mb-0 datatable-select" v-b-modal.add variant="secondary">Add customer</b-button>
                  <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'secondary' cancelVariant= 'secoSndary' id="add" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Add customer</h5>
                      </div>
                      <div>
                        <b-form @submit.stop.prevent="add">
                          <b-form-group id="example-input-group-1" label="Name" label-for="example-input-1">
                            <b-form-input
                              id="example-input-1"
                              name="example-input-1"
                              v-model="form.name"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-2" label="password" label-for="example-input-2">
                            <b-form-input
                              id="example-input-2"
                              name="example-input-2"
                              v-model="form.password"
                              v-validate="{ required: true ,min:3}"
                              :state="validateState('example-input-2')"
                              aria-describedby="input-2-live-feedback"
                              data-vv-as="password">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-3" label="num_tel" label-for="example-input-3">
                            <b-form-input
                              id="example-input-3"
                              name="example-input-3"
                              v-model="form.num_tel"
                              v-validate="{ required: true,numeric, min:8,max:8  }"
                              :state="validateState('example-input-3')"
                              aria-describedby="input-3-live-feedback"
                              data-vv-as="num_tel">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-4" label="email" label-for="example-input-4">
                            <b-form-input
                              id="example-input-4"
                              name="example-input-4"
                              v-model="form.email"
                              v-validate="{ required: true,email  }"
                              :state="validateState('example-input-4')"
                              aria-describedby="input-4-live-feedback"
                              data-vv-as="email">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-5" label="raison sociale" label-for="example-input-5">
                            <b-form-input
                              id="example-input-5"
                              name="example-input-5"
                              v-model="form.raison_sociale"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-5')"
                              aria-describedby="input-5-live-feedback"
                              data-vv-as="raison_sociale">
                            </b-form-input>
                             <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-6" label="logo" label-for="example-input-6">
                            <b-form-file
                              id="example-input-6"
                              name="example-input-6"
                              @change="logo"
                              v-model="form.logo"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="logo">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-button type="submit"  variant="primary">Submit</b-button>
                          <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                        </b-form>
                      </div>                       
                    </div>
                  </b-modal>
                  <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="update_modal" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Update customer</h5>
                      </div>                
                      <div>
                        <b-form @submit.stop.prevent="updatee">
                          <b-form-group id="example-input-group-1" label="Name" label-for="example-input-1">
                            <b-form-input
                              id="example-input-1"
                              name="example-input-1"
                              v-model="form.name"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-2" label="password" label-for="example-input-2">
                            <b-form-input
                              id="example-input-2"
                              name="example-input-2"
                              v-model="form.password"
                              v-validate="{ required: true ,min:3}"
                              :state="validateState('example-input-2')"
                              aria-describedby="input-2-live-feedback"
                              data-vv-as="password">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-3" label="num_tel" label-for="example-input-3">
                            <b-form-input
                              id="example-input-3"
                              name="example-input-3"
                              v-model="form.num_tel"
                              v-validate="{ required: true,numeric, min:8,max:8  }"
                              :state="validateState('example-input-3')"
                              aria-describedby="input-3-live-feedback"
                              data-vv-as="num_tel">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-4" label="email" label-for="example-input-4">
                            <b-form-input
                              id="example-input-4"
                              name="example-input-4"
                              v-model="form.email"
                              v-validate="{ required: true,email  }"
                              :state="validateState('example-input-4')"
                              aria-describedby="input-4-live-feedback"
                              data-vv-as="email">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-5" label="raison sociale" label-for="example-input-5">
                            <b-form-input
                              id="example-input-5"
                              name="example-input-5"
                              v-model="form.raison_sociale"
                              v-validate="{ required: true, min:3  }"
                              :state="validateState('example-input-5')"
                              aria-describedby="input-5-live-feedback"
                              data-vv-as="raison sociale">
                            </b-form-input>
                             <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-form-group id="example-input-group-6" label="logo" label-for="example-input-6">
                            <b-form-file
                              id="example-input-6"
                              name="example-input-6"
                              @change="logo"
                              v-model="form.logo"
                              v-validate="{ required: true}"
                              :state="validateState('example-input-6')"
                              aria-describedby="input-6-live-feedback"
                              data-vv-as="logo">
                            </b-form-file>
                            <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
                          </b-form-group>
                          <b-button type="submit"  variant="primary">Submit</b-button>
                          <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                        </b-form>
                      </div>
                    </div>
                  </b-modal>  
                </b-col>
              </b-row>
              <br>
              <b-row>
                <b-col xl="6">
                  <b-input-group class="datatable-btn">
                    <b-form-input v-model="filter" placeholder="Type to Search"></b-form-input>
                    <b-input-group-append>
                      <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                    </b-input-group-append>
                  </b-input-group>  
                </b-col>  
                <b-col xl="6">
                  <b-form-group label-cols="2" label="Per page" class="mb-0 datatable-select">
                    <b-form-select v-model="perPage" :options="pageOptions"></b-form-select>
                  </b-form-group>
                </b-col>
              </b-row>
              <div class="table-responsive datatable-vue">
                <b-table
                  show-empty
                  stacked="md"
                  :items="items"
                  :fields="tablefields"
                  :filter="filter"
                  :current-page="currentPage"
                  :per-page="perPage"
                  @filtered="onFiltered">
                  <template #cell(icons)="data">
                    <svg @click="deletee(data.item.id)" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    <span></span>
                    <svg @click="test(data.item)" v-b-modal.update_modal   xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffcd01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                  </template>
                </b-table>
              </div>
              <b-col md="6" class="my-1 p-0">
                <b-pagination
                  v-model="currentPage"
                  :total-rows="totalRows"
                  :per-page="perPage"
                  class="my-0">
                </b-pagination>
              </b-col>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- Container-fluid Ends-->
  </div>
</template>
<script>
  import axios from 'axios'; 

  export default {
    name:'clients',
    data() {
      return {
        form: {
          num_tel:'',
          logo:'',
          email:'',
          password:'',
          name: '',
          raison_sociale: '',
          etat: '',
        },
        id:0,
        selected: null,
        tablefields: [
          { key: 'name', label: 'name', sortable: true, },
          { key: 'email', label: 'email', sortable: true, },
          { key: 'num_tel', label: 'num_tel', sortable: true, },
          { key: 'raison_sociale', label: 'raison_sociale', sortable: true, },
          { key: 'etat', label: 'etat', sortable: true, },
          { key: 'icons', label: '',  }
        ],
        items:[],
        filter: null,
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
      };
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.tablefields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key };
          });
      }
    },

    /*  created() {
  const token = JSON.parse(localStorage.getItem("token"));
  this.axios.defaults.headers.common["Authorization"] = "Bearer " + token;
  },*/

    created() {
      axios.get('clients').then((response)=>{
        this.items=response.data.staff;
      });   
      this.totalRows = this.items.length;
    },
    methods: {
      logo(event) {
        let reader = new FileReader();
        reader.onload = (event) => {
          this.form.logo = event.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        console.log(this.form);
      },
      deletee (id) {
        axios.delete('clients/'+String(id));
        setTimeout(() => {
          location.reload();
        }, '1000');
      },
      test (item) {
        console.log(item);
        this.form.name = item.name;
        this.form.logo = item.CV;
        this.form.etat = item.etat;
        this.form.email = item.email;
        this.form.password = item.password;
        this.form.raison_sociale = item.raison_sociale;
        this.form.num_tel = item.num_tel;
        this.id = item.id;
      },
      onFiltered(filteredItems) {
        this.totalRows = filteredItems.length;
        this.currentPage = 1;
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
          logo: null,
          email: null,
          password: null, 
          raison_sociale: null,
          num_tel: null,
          etat: null,
        };
        this.$nextTick(() => {
          this.$validator.reset();
        });
      },
      add() {
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('clients',this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('customer added ');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
              this.$toastr.e('User exists !');
            }
          });
          return;
        });
      },
      updatee() {
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.put('clients/'+String(this.id),this.form).then(res =>{
            if (res.data.status == 200){
              this.$toastr.s('customer updated !');
              setTimeout(() => {
                location.reload();
              }, '500');
            } else{
              this.$toastr.e('Can\'t update');
            }
          });
          return;
        });
      }
    },
    test :function(){
      console.log('item');
    }
  };
</script>
<style scoped>
  .delete{
    stroke: green;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    fill: none;
  }
</style>


