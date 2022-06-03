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
                            <b-button v-if="role != 'client'"  class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.createDocument @click="$bvModal.show('bv-modal-example')" >
                    <i data-feather="plus-square" > </i>Create New Document</b-button>
                    <b-modal okTitle= '' cancelTitle= '' headerClass= 'p-2 border-bottom-0' footerClass = 'p-2 border-top-0' okVariant= 'seacndary' cancelVariant= 'seacndary' id="createDocument" size="lg" title="" :ok-disabled="true" :cancel-disabled="true">
                    <div class="card">
                      <div class="card-header">
                        <h5>Add document</h5>
                      </div>                
                      <div>
                        <b-form @submit.stop.prevent="add">
                          <b-form-group id="example-input-group-7" label="Document type" label-for="example-input-7">
                             <multiselect  v-model="form.type_doc" :options="roles" label="text" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a document type"></multiselect>
                        
                            <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                          </b-form-group>
                         
                          <b-form-group id="example-input-group-7" label="Customer" label-for="example-input-7">
                           <multiselect  v-model="form.client_id" :options="customers" label="name" :searchable="false" :close-on-select="true" :show-labels="true" placeholder="Pick a customer"></multiselect>
                            <b-form-invalid-feedback id="input-7-live-feedback">{{ veeErrors.first('example-input-7') }}</b-form-invalid-feedback>
                          </b-form-group>    
                          <b-form-group id="example-input-group-2" label="Etat doc " label-for="example-input-2">
                            <b-form-input
                              id="num_tel"
                              name="example-input-2"
                              v-model="form.etat"
                              v-validate="{ required: true  }"
                              :state="validateState('example-input-2')"
                              aria-describedby="input-2-live-feedback"
                              data-vv-as="num_tel">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('example-input-2') }}</b-form-invalid-feedback>
                          </b-form-group>
                          
                          <b-form-group id="example-input-group-3" label="Info supp" label-for="example-input-3">
                            <b-form-input
                              id="email"
                              name="example-input-3"
                              v-model="form.info_supp"
                              v-validate="{ required: true,  }"
                              :state="validateState('example-input-3')"
                              aria-describedby="input-3-live-feedback"
                              data-vv-as="email">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
                          </b-form-group>

                          <h5>Operations</h5>
                          <div id="form-repeter" :key="index" v-for="(operation, index) in form.operations">
                          <b-row>
                            <b-col>
                              <b-form-group id="example-input-group-3" label="Nature" label-for="example-input-3">
                            <b-form-input
                          
                              name="example-input-3"
                              v-model="operation.nature_operation"
                              v-validate="{ required: true,  }"
                              :state="validateState('example-input-3')"
                              aria-describedby="input-3-live-feedback"
                              data-vv-as="Nature">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-3-live-feedback">{{ veeErrors.first('example-input-3') }}</b-form-invalid-feedback>
                          </b-form-group>
                          </b-col>
                            <b-col>
                             <b-form-group id="example-input-group-1" label="Amount HT" label-for="example-input-1">
                            <b-form-input
                              id="name"
                              name="example-input-1"
                              v-model="operation.montant_HT"
                              v-validate="{ required: true,numeric,  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group>
                            </b-col>
                            <b-col>
                              <b-form-group id="example-input-group-1" label="Amount TVA" label-for="example-input-1">
                            <b-form-input
                              id="name"
                              name="example-input-1"
                              v-model="operation.montant_TVA"
                              v-validate="{ required: true,numeric,  }"
                              :state="validateState('example-input-1')"
                              aria-describedby="input-1-live-feedback"
                              data-vv-as="Name">
                            </b-form-input>
                            <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback>
                          </b-form-group> 
                            </b-col>
                          </b-row>
                          <hr>
                          </div>
                          
                          <b-button @click="addForm" class="btn btn-secondary">Add operation</b-button>
                          <br><br>
                          <b-button type="submit"  variant="primary">Send PDF</b-button><span> .</span>
                          <b-button type="submit"  variant="primary">Download PDF</b-button>
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
                     
                      <div class="col-xl-4 col-md-6 box-col-6" v-for="(document,index) in documents" :key="index">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                
                              </div>
                              <div class="product-name">
                              <span class="badge badge-primary">{{ document.attributes.etat }}</span>
                              </div>
                              <br>
                              <div class="avaiabilty">
                                <div class="text-success">{{ document.attributes.created_at.substr(0, 10) }}</div>
                            </div>
                        
                            <div class="avaiabilty ">
                                <div class="text-success">document type : {{ document.type_doc }}</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">{{ document.attributes.info_supp }} </div>
                              </div>
                              <br>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 1500 TND
                              </div>
                              
                              <br>                               
                              <div class="avaiabilty">
                              <feather v-if="role != 'client'"  type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                     
                                 <feather v-if="role != 'client'" style="margin-left:3px;" type="trash-2" stroke="red" @click="deleteee(document.id)" ></feather>
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
     <div id="pdf" style="display:none" >
       <div class="row">
         <div class="col-8"> 
              <img
                  class="img-fluid"
                  src="../assets/images/logo/logoebuild.png"
                  alt=""
                
              />
         </div>
         <div class="col-2">

         </div>
         <div class="col-2">
           <h1 style="color:red">FACTURE
           </h1>
           <h3>N 1</h3>
         </div>
       </div>
       <br><br><br><br><br><br>
       <div class="row">
         <div class="col-6" style="border-left: 1px solid #cecece;border-bottom: 1px solid #cecece;border-right: 1px solid #cecece;border-top: 5px solid red;">
          <h3>CLIENT</h3>
          <h4>Achref Hamouda</h4>
         </div>
         <div class="col-2">

         </div>
         <div class="col-4" style="border-left: 1px solid #cecece;border-bottom: 1px solid #cecece;border-right: 1px solid #cecece;border-top: 5px solid red;">
          27-05-2022
         </div>
       </div> 
       <br><br><br><br>

      <b-table-simple style="border-top: 5px solid red;">
       <b-thead >

      <b-tr variant="danger">
        <b-th>Reference</b-th>
          <b-th>Description</b-th>
          <b-th>PU HT</b-th>
          <b-th>TVA</b-th>
          <b-th>Total HT</b-th>
      </b-tr>
    </b-thead>
    <b-tbody>
      <b-tr >
        <b-td>1</b-td>
        <b-td>Conception Hiérarchique du site</b-td>
        <b-td></b-td>
        <b-td>19%</b-td>
        <b-td>1000</b-td>
      </b-tr>
       <b-tr >
        <b-td>2</b-td>
        <b-td>Webdesign de site Internet - Layout général</b-td>
        <b-td></b-td>
        <b-td>19%</b-td>
        <b-td>500</b-td>
      </b-tr>
    </b-tbody>
    
  </b-table-simple>
  <br><br><br><br><br><br>
  <div class="row">
         <div class="col-3">

         </div>
          <div class="col-4" >
       <b-table-simple style="border-top: 5px solid red;">
       <b-thead >

      <b-tr variant="danger">
        <b-th>TVA</b-th>
          <b-th>Base</b-th>
          <b-th>Montant</b-th>
      </b-tr>
    </b-thead>
    <b-tbody>
      <b-tr>
        <b-td>19%</b-td>
        <b-td>1500</b-td>
        <b-td>285</b-td>
      </b-tr>
    </b-tbody>
    
  </b-table-simple>
         </div>
         <div class="col-1">

         </div>
         <div class="col-4" >
           <b-table-simple style="border-top: 5px solid red;">
      
    <b-tbody>
      <b-tr>
        <b-td>TOTAL HT</b-td>
      </b-tr>
      <b-tr>
        <b-td>BASE TVA</b-td>
      </b-tr>
      <b-tr>
        <b-td>TOTAL TVA</b-td>
      </b-tr>
      <b-tr>
        <b-td>Timbre fiscal</b-td>
      </b-tr>
    </b-tbody>
    
  </b-table-simple>
         </div>
  </div> 
  <br><br><br><br>
  <div class="row">
         
         <div class="col-8">

         </div>
         <div class="col-4" style="border-left: 1px solid #cecece;border-bottom: 1px solid #cecece;border-right: 1px solid #cecece;border-top: 5px solid red;">
          <h1>NET À PAYER  1500</h1>
         </div>
       </div> 
       <br><br><br>
        <ul>
          <h5 class="text-center">Réglement de Paiement :<br/></h5> 
          <li class="text-center"><h5>Avance de 20% du Montant Total TTC à la Commande</h5></li>
          <li class="text-center"><h5>Reste de la facture à la livraison<br/>Offre gratuite :</h5></li>
          <li class="text-center"><h5>Maintenance site 12 mois</h5></li>
          <li class="text-center"><h5>Formation back office</h5></li>
          <li class="text-center"><h5>maintenance serveur et déploiement</h5></li>
        </ul>
        <br/>
        <hr style="border-top: 5px solid red;" class="hr"/>
        <br><br>
        <div class="row"  >
        
          <div class="col-4">
           <h6>INFORMATIONS ENTREPRISE</h6>
          <h6>MF:1751386/T/A/M</h6> 
          <h6>CONTACT: 25892403</h6>
          </div>
          <div class="col-4"></div>
          <div class="col-4">
            <h6>INFORMATIONS BANCAIRE</h6> 
                   <h6>Banque Attijar</h6>   
                      <h6>IBAN 00004 00120 1200077036879 9</h6> 
          </div>
        </div>
     </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex';
   import Multiselect from 'vue-multiselect';
   import VueHtml2pdf from 'vue-html2pdf'
 import axios from 'axios'; 

  export default {
    components: {
      Multiselect,
      VueHtml2pdf
    },
    data(){
      return {
       
        roles: [
         { value: 'appraisal', text: 'appraisal' },
          { value: 'bills', text: 'bills' }
        ],
        customers: [
         
        ],
        client:null,
        date:null,
        documents:[],
        submittedDoc:null,
        submittedOperations:null,
        form: {
          type_doc:'',
          etat:'',
          info_supp:'',
          client_id :'',
          operations:[
             {
              nature_operation:'',
              montant_HT:'',
              montant_TVA:'',
             }
        ],
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
     if(this.role == 'admin'){
       axios.get('clients').then((response)=>{
         console.log(response.data.clients)
        this.customers=response.data.clients
        
      }) 
      axios.get('documents').then((response)=>{
         console.log(response.data.documents)
        this.documents=response.data.documents
      }) 
      
}
if(this.role == 'client'){
   axios.get('alldocuments').then((response)=>{
         console.log(response.data.documents)
        this.documents=response.data.documents
      }) 
      this.documents.forEach(document => {
        document.attributes.created_at = document.attributes.created_at.substr(1, 4)
      });
}
const datee = new Date(Date.now())
      this.date = datee.toLocalString()
    },
    methods:{
      addForm(){
        this.form.operations.push({
              nature_operation:'',
              montant_HT:'',
              montant_TVA:'',
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
      add() {
        const pdf = document.getElementById('pdf').innerHTML
              const originalContent = window.document.body.innerHTML;
              window.document.body.innerHTML = pdf;
              window.print();
              window.document.body.innerHTML = originalContent;
        this.client = this.form.client_id.name
        this.form.client_id = this.form.client_id.id
        this.form.type_doc = this.form.type_doc.text
        console.log(JSON.stringify(this.form));
        this.$validator.validateAll().then(result => {
          if (!result) {
            this.$toastr.i('correct the errors'); 
            return;
          }
          axios.post('documents',this.form).then(res =>{
            console.log(res.data);
           
              this.submittedDoc = res.data.document
              this.submittedOperations = res.data.operations
              
      
          });
          return;
        });
      },
      deleteee(id) {
      axios.delete('documents/'+id).then(res =>{
              this.$toastr.s('Document deleted ! ');
              setTimeout(() => {
                location.reload();
              }, '500');
           
          });
       

    },
    }
  };
</script>