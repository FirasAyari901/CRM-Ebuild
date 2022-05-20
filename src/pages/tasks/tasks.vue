<template>
    <div>
      <br><br>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
           
                <div class="col-sm-12 p-0">
                  <div class="card">
                    <div class="card-header">
                      Task List


                    </div>
                    <div class="card-body">
    <div class="row" >
                              <div class="col-sm-12 col-xl-6" v-for="(task,index) in tasks" :key="index">
                                <b-card header-tag="div" header-class="b-l-primary border-3" >
                                  <h5 @click="redirect(task.id)" slot="header">{{task.titre}}</h5>
                                  <span class="badge badge-primary" >{{task.attributes.etat}}</span><br>
                                  <div class="avaiabilty">
                                      <div class="text-success">Deadline : {{task.attributes.deadline}}</div>
                                  </div>
                                  <br>
                                  <b-card-text class="mb-0">{{task.attributes.description}}</b-card-text><br><br>
                                  <feather   type="edit" stroke="#ffcd01" v-b-modal.modal-update></feather> 
                                <feather @click="deleteee(task.id)" style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                </b-card>

                              </div>
                        

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
 import axios from 'axios'; 

  export default {
    props: ['id'],
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
        projet_id:parseInt(this.id, 10),
        personnel_id:2
       
       
      },
      options: [
          { code: 1, name: 'Open' },
          { code: 2, name: 'To Do' },
          { code: 3, name: 'Active' },
          { code: 4, name: 'Done' },
          { code: 5, name: 'Closed' }
        ],
        limitMultiValue:[],
       project :null,
       tasks :null

      }},
    created() {
      axios.get('taches').then(res =>{
             this.tasks = res.data.taches
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
          axios.post('taches',this.form).then(res =>{
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
 axios.delete('taches/'+id).then(res =>{
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
        this.$router.push({path:'/app/task/'+id});

      },
      
    }
  };
</script>
