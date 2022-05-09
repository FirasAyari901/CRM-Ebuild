<template>
  <div>
    <br><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 project-list">
          <div class="card">
            <div class="row m-0">
              <div class="col-sm-12 p-0">
                <b-tabs content-class="mt-3">
                  <b-tab active>
                    <template v-slot:title>
                      <feather type="target"></feather> All
                    </template>
                    <b-card-text>
                      <div class="col-sm-12 p-0">
  
                            <div class="row">
                              <div class="col-xl-4 col-lg-6" v-for="(project,index) in allprojects" :key="index" :class="index < 3 ? 'mb-4' : ''">
                                <div class="project-box" @click="redirect(index)">
                                 
                              
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
                                    <feather  type="edit" stroke="#ffcd01" ></feather> 
                                     
                                 <feather style="margin-left:3px;" type="trash-2" stroke="red" ></feather>
                                </div>
                              </div>
                            </div>
                          </div>
                   
                    </b-card-text>
                  </b-tab>
                  <b-tab>
                    <template v-slot:title>
                      <feather type="info"></feather> Doing
                    </template>  
                    <b-card-text>
                      <div class="col-sm-12 p-0">
  
                            <div class="row">
                              <div class="col-xl-4 col-lg-6" v-for="(project,index) in doingprojects" :key="index" :class="index < 3 ? 'mb-4' : ''">
                                <div class="project-box">
                                  
                                  <span class="badge" :class="'badge-'+project.type">{{ project.badge }}</span>
                                  <h6>{{ project.title }}</h6>
                                  <div class="media">
                                    <img class="img-20 mr-1 rounded-circle" :src='getImgUrl(project.img)' alt="" title="">
                                    <div class="media-body">
                                      <p>{{ project.sites }}</p>
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
                                    <feather type="edit" stroke="#ffcd01" ></feather>   
                                 <feather type="trash-2" stroke="red" ></feather>
                                </div>
                              </div>
                            </div>
                          </div>
                    
                    </b-card-text>
                  </b-tab>
                  <b-tab>
                    <template v-slot:title>
                      <feather type="check-circle"></feather> Done
                    </template> 
                    <b-card-text>
                      <div class="col-sm-12 p-0">
  
                            <div class="row">
                              <div class="col-xl-4 col-lg-6" v-for="(project,index) in doneprojects" :key="index" :class="index < 3 ? 'mb-4' : ''">
                                <div class="project-box">
                                  
                                  <span class="badge" :class="'badge-'+project.type">{{ project.badge }}</span>
                                  <h6>{{ project.title }}</h6>
                                  <div class="media">
                                    <img class="img-20 mr-1 rounded-circle" :src='getImgUrl(project.img)' alt="" title="">
                                    <div class="media-body">
                                      <p>{{ project.sites }}</p>
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
                                    <feather type="edit" stroke="#ffcd01" ></feather>   
                                 <feather type="trash-2" stroke="red" ></feather>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                    
                    </b-card-text>
                  </b-tab>
                </b-tabs>
              </div>
              <div class="col-sm-6 create-project-btn">
                <div class="text-right">
                  <div class="form-group mb-0 mr-0"></div>
                  <!-- <a class="btn btn-primary" href="">
                    <i data-feather="plus-square"> </i>Create New Project</a
                  > -->
                  <b-button class="btn btn-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg @click="$bvModal.show('bv-modal-example')" >
                    <i data-feather="plus-square" > </i>Create New Project</b-button>
                    <b-modal id="bv-modal-example" centered size="lg" hide-footer>                      
                        <template #modal-title>
                            Add Team
                        </template>
                      <div class="modal-body">
                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="bm-weburl">description</label>
                            <input class="form-control" id="bm-weburl" type="text" required="" autocomplete="off">
                          </div>
                          <div class="form-group col-md-12">
                            <label for="bm-weburl">project name</label>
                            <input class="form-control" id="bm-weburl" type="text" required="" autocomplete="off">
                          </div>

                          <div class="form-group col-md-12">
                            <label for="bm-weburl">start date</label>
                             <datepicker input-class="datepicker-here form-control digits" :format="format" ></datepicker>
                          </div>
                          <div class="form-group col-md-12">
                            <label for="bm-weburl">deadline</label>
                             <datepicker input-class="datepicker-here form-control digits" :format="format" ></datepicker>
                          </div>
                        <div class="form-group col-md-12">
                        <div class="col-form-label">Select Team</div>
                         <multiselect  v-model="limitMultiValue" tag-placeholder="Add this as new tag" placeholder="Teams" 
                          label="name" track-by="code" :options="options" :multiple="false" :taggable="true" @tag="addTag"></multiselect>
                         </div>
                        <div class="form-group col-md-12">
                            <label for="bm-weburl">file CDC</label>
                            <input class="form-control" id="bm-weburl" type="file" required="" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="bm-weburl">Capture DC</label>
                            <input class="form-control" id="bm-weburl" type="file" required="" autocomplete="off">
                        </div>
                        </div>
                        <b-button class="btn "  onclick="submitBookMark()" type="submit" variant="secondary">Add</b-button>
                      </form>
                    </div>
                    </b-modal>
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
        format: 'MM/dd/yyyy',
        options: [
          { code: 1, name: 'Alabama' },
          { code: 2, name: 'Wyoming' },
          { code: 3, name: 'Coming' },
          { code: 4, name: 'Hanry Die' },
          { code: 5, name: 'John Doe' }
        ],
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
      addTag (newTag) {
        const tag = {
          name: newTag,
          code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        };
        this.options.push(tag);
        this.value.push(tag);
      },
      redirect (index) {
        this.$router.push({ path:'/app/project',query:{ id: index } });  
      },
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
    }
  };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

