<template>
  <div>
<br><br>    <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-6">
                  <div class="email-left-aside">
                    <div class="card">
                      <div class="card-body">
                        <div class="email-app-sidebar left-bookmark">
                          
                          <ul class="nav main-menu" role="tablist">
                            <li class="nav-item">
                              <div>
                                <br><br>
                                <b-button block id="default-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg variant="secondary" @click="$bvModal.show('bv-modal-example')">New Team</b-button>
                                    <b-modal id="bv-modal-example" centered size="lg" hide-footer>                      
                                        <template #modal-title>
                                            Add Team
                                        </template>
                                      <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" @submit.stop.prevent="addTeam">
                                        <div class="form-row">
                                          <div class="form-group col-md-12">
                                            <label for="addpseudo">Pseudo</label>
                                            <input class="form-control" id="addpseudo" type="text" required="" autocomplete="off">
                                          </div>
                                          <div class="mb-2">
                                            <div class="col-form-label">Default Placeholder</div>
                                            <multiselect  v-model="multiValue" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" 
                                              label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                                          </div>
                                        </div>
                                        <b-button class="btn "  onclick="submitBookMark()" type="submit" variant="secondary">Add</b-button>
                                      </form>
                                    </div>
                                    </b-modal>
                              </div>
                             <br><br>
                            </li>
                            <li class="nav-item"><span class="main-title"> Teams</span></li>
                          </ul><br>
                          <ul :key="item.id" v-for="item in items">
                           <li><a  class="show " id="item1" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title" v-on:click="say(item.id)">{{ item.pseudo }}</span></a></li> <br>  
                          
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-12">
                  <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                      <div class="pl-0">
                        <div class="tab-content">
                          <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0">{{team.pseudo}}</h6>
                                <ul>
                                  <li><a href="#" @click="$bvModal.show('bv-modal-edit')"><feather type="edit" stroke="#ffcd01" ></feather></a></li>    
                                  <li><a href="#"><feather type="trash-2" stroke="red" ></feather></a></li>
                                </ul>
                                <b-modal id="bv-modal-edit" centered size="lg" hide-footer>                      
                                        <template #modal-title>
                                            Update Team
                                        </template>
                                      <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="" @submit.stop.prevent="updateTeam">
                                        <div class="form-row">
                                          <div class="form-group col-md-12">
                                            <label for="pseudo">Pseudo</label>
                                            <input class="form-control" id="pseudo" type="text" required="" autocomplete="off">
                                          </div>
                                          <div class="form-group col-md-12">
                                            <div class="col-form-label">Select stuff </div>
                                            <multiselect  v-model="singleValue" :options="options" label="name" :searchable="false" :close-on-select="false" :show-labels="false" placeholder="Pick a value"></multiselect>
                                          </div>
                                        </div>
                                        <b-button class="btn "  onclick="submitBookMark()" type="submit" variant="secondary">Update </b-button>
                                      </form>
                                    </div>
                                    </b-modal>
                              </div>
                              <div class="card-body pb-0">
                                <div class="details-bookmark text-center" v-bind:class="{ 'list-bookmark' : liststyle}">
                                  <div class="row" id="bookmarkData">
                                    <div class="col-xl-3 col-md-4 xl-50" v-for="(item,index) in members" :key="index">
                                      <div class="card card-with-border bookmark-card o-hidden">
                                        <div class="details-website">
                                          <img class="img-fluid" :src='item.image' alt="">
                                          <div class="desciption-data">
                                            <div class="title-bookmark">
                                              <h6 class="title_0">{{ item.name }}</h6>
                                              <p class="weburl_0">{{ item.role }}</p>
                                              <div class="hover-block">
                                                <ul>
                                                  <li><a href="#"><feather type="trash-2"></feather></a></li>
                                                  
                                                </ul>
                                              </div>
                                              <div class="content-general">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect';
 import axios from 'axios'; 

  export default {
    name:'bookmark',
    components: {
      Multiselect
    },
    data(){
      return {
        liststyle: false,
        data : [],
        favourite : [],
        options: [
          { code: 1, name: 'Alabama' },
          { code: 2, name: 'Wyoming' },
          { code: 3, name: 'Coming' },
          { code: 4, name: 'Hanry Die' },
          { code: 5, name: 'John Doe' }
        ],
        singleValue:'',
        multiValue:[],
        items:[],
        members:[],
        team :{}
      };
    },
 
   created() {
      this.init()
    },
    methods:{

      init(){
        axios.get('equipes').then((response)=>{
        this.items=response.data.Equipes
      })
      
      axios.get('staff').then((response)=>{
        this.options=response.data.staff
      })
      
      },
       addTag (newTag) {

        const tag = {
          name: newTag,
          code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
        };
        this.options.push(tag);
        this.value.push(tag);
      },

      say: function (message) {
 
          axios.get('equipes/'+String(message)).then((response)=>{
        this.team=response.data.equipe 
        this.members=response.data.members
      })
 
      },
      updateTeam(){
       const pseudo = document.getElementById("pseudo").value
       console.log(pseudo)
       console.log(this.singleValue)
      },
      addTeam(){
       const addpseudo = document.getElementById("addpseudo").value
       console.log(addpseudo)
       const ids = this.multiValue.map(x => x.id);
       console.log(ids)
      },
     

    }
  };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
