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
                         
                        <b-button id="default-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg variant="secondary">Add staff</b-button>
                        <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="modal-lg" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                             <div class="card">
                        <div class="card-header">
                            <h5>Add staff</h5>
                        </div>
                
                          <div>
    <b-form @submit.stop.prevent="onSubmit">
      <b-form-group id="example-input-group-1" label="Name" label-for="example-input-1">
        <b-form-input
          id="example-input-1"
          name="example-input-1"
          v-model="form.name"
          v-validate="{ required: true, min:3  }"
          :state="validateState('example-input-1')"
          aria-describedby="input-1-live-feedback"
          data-vv-as="Name"
        ></b-form-input>

        <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group id="example-input-group-3" label="password" label-for="example-input-3">
        <b-form-input
          id="example-input-3"
          name="example-input-3"
          v-model="form.password"
          v-validate="{ required: true ,min:3}"
          :state="validateState('example-input-3')"
          aria-describedby="input-3-live-feedback"
          data-vv-as="password"
        ></b-form-input>

        <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
      </b-form-group>
           <b-form-group id="example-input-group-7" label="num_tel" label-for="example-input-7">
        <b-form-input
          id="example-input-7"
          name="example-input-7"
          v-model="form.num_tel"
          v-validate="{ required: true,numeric, min:8,max:8  }"
          :state="validateState('example-input-7')"
          aria-describedby="input-7-live-feedback"
          data-vv-as="num_tel"
        ></b-form-input>

        <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
      </b-form-group>
         <b-form-group id="example-input-group-4" label="email" label-for="example-input-4">
        <b-form-input
          id="example-input-4"
          name="example-input-4"
          v-model="form.email"
          v-validate="{ required: true,email  }"
          :state="validateState('example-input-4')"
          aria-describedby="input-4-live-feedback"
          data-vv-as="email"
        ></b-form-input>

        <b-form-invalid-feedback id="input-4-live-feedback">{{ veeErrors.first('example-input-4') }}</b-form-invalid-feedback>
      </b-form-group>
       
       
       
       <b-form-group id="example-input-group-5" label="cv" label-for="example-input-5">
        <b-form-file
          id="example-input-5"
          name="example-input-5"
          
          v-model="form.cv"
          v-validate="{ required: true}"
          :state="validateState('example-input-5')"
          aria-describedby="input-5-live-feedback"
          data-vv-as="cv"
        ></b-form-file>

        <b-form-invalid-feedback id="input-5-live-feedback">{{ veeErrors.first('example-input-5') }}</b-form-invalid-feedback>
      </b-form-group>
       <b-form-group id="example-input-group-6" label="image" label-for="example-input-6">
        <b-form-file
          id="example-input-6"
          name="example-input-6"
          
          v-model="form.image"
          v-validate="{ required: true}"
          :state="validateState('example-input-6')"
          aria-describedby="input-6-live-feedback"
          data-vv-as="image"
        ></b-form-file>

        <b-form-invalid-feedback id="input-6-live-feedback">{{ veeErrors.first('example-input-6') }}</b-form-invalid-feedback>
      </b-form-group>
   


      <b-form-group id="example-input-group-2" label="role" label-for="example-input-2">
        <b-form-select
          id="example-input-2"
          name="example-input-2"
          v-model="form.role"
          v-validate="{ required: true }"
          :options="roles"
          :state="validateState('example-input-2')"
          aria-describedby="input-2-live-feedback"
          data-vv-as="role"
        ></b-form-select>

        <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
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
                          @filtered="onFiltered"
                        >
                        <template #cell(isons)="">
                          
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                          <span>  </span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffcd01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>

                         </template>
                        </b-table>
                      </div>

                      <b-col md="6" class="my-1 p-0">
                        <b-pagination
                          v-model="currentPage"
                          :total-rows="totalRows"
                          :per-page="perPage"
                          class="my-0"
                        ></b-pagination>
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
    name:'personnels',
    data(){
      
      return{
        roles: [
        { value: null, text: "Choose..." },
        { value: "dev backend", text: "dev backend" },
        { value: "dev frontend", text: "dev frontend" }
      ],
      form: {
        num_tel:'',
        cv:'',
        image:'',
        email:'',
        password:'',
        name: '',
        role: null,
       
       
      },
        selected: null,
        options: [
          { value: null, text: 'Please select an option' },
          { value: 'your choice is Dev frontend ', text: 'Dev frontend' },
          { value: 'your choice is Dev backend ', text: 'Dev backend' } ],
        tablefields: [
          { key: 'name', label: 'name', sortable: true, },
          { key: 'email', label: 'email', sortable: true, },
          { key: 'num_tel', label: 'num_tel', sortable: true, },
          { key: 'attributes.role', label: 'role', sortable: true, },
          {key: 'isons', label: '',  }
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
      axios.get('personnels').then((response)=>{
        this.items=response.data.staff
      })   
     console.log(this.items)
      this.totalRows = this.items.length;

    },
    methods: {
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
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
        food: null
      };

      this.$nextTick(() => {
        this.$validator.reset();
      });
    },
    onSubmit() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          this.$toastr.i('correct the errors') 
          return;
        }

        alert("Form submitted!");
        return;
      });
    }
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