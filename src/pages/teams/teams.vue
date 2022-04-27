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
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        <div class="form-row">
                                          <div class="form-group col-md-12">
                                            <label for="bm-weburl">nickname</label>
                                            <input class="form-control" id="bm-weburl" type="text" required="" autocomplete="off">
                                          </div>
                                          <div class="mb-2">
                                            <div class="col-form-label">Select stuff </div>
                                            <multiselect   v-model="limitMultiValue" 
                                              label="name"  track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
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
                            <li><a  class="show " id="pills-favourites-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title" v-on:click="say('pills_favourites')"> Team 1 ({{ favourite.length }})</span></a></li>
                            <li><a  class="show " id="pills-favourites-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title" v-on:click="say('pills_favourites')"> Team 2 ({{ favourite.length }})</span></a></li>
                            <li><a  class="show " id="pills-favourites-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title" v-on:click="say('pills_favourites')"> Team 3 ({{ favourite.length }})</span></a></li>
                            <li><a  class="show " id="pills-favourites-tab" data-toggle="pill" href="javascript:void(0)" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title" v-on:click="say('pills_favourites')"> Team 4 ({{ favourite.length }})</span></a></li>

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
                          <div class="tab-pane fade" v-bind:class="(activeclass==='pills_created') ? 'active show': ''" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0">Team i</h6>
                                <ul>
                                  <li><a href="#" @click="$bvModal.show('bv-modal-edit')"><feather type="edit" stroke="#ffcd01" ></feather></a></li>    
                                  <li><a href="#"><feather type="trash-2" stroke="red" ></feather></a></li>
                                </ul>
                                <b-modal id="bv-modal-edit" centered size="lg" hide-footer>                      
                                        <template #modal-title>
                                            Update Team
                                        </template>
                                      <div class="modal-body">
                                      <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                        <div class="form-row">
                                          <div class="form-group col-md-12">
                                            <label for="bm-weburl">nickname</label>
                                            <input class="form-control" id="bm-weburl" type="text" required="" autocomplete="off">
                                          </div>
                                          <div class="mb-2">
                                            <div class="col-form-label">Select stuff </div>
                                            <multiselect   v-model="limitMultiValue" 
                                              label="name"  track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
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
                                    <div class="col-xl-3 col-md-4 xl-50" v-for="(item,index) in bookmark" :key="index">
                                      <div class="card card-with-border bookmark-card o-hidden">
                                        <div class="details-website">
                                          <img class="img-fluid" :src='getImgUrl(item.image)' alt="">
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
  import { mapState } from 'vuex';
  import Multiselect from 'vue-multiselect';

  export default {
    name:'bookmark',
    components: {
      Multiselect
    },
    data(){
      return {
        liststyle: false,
        data : [],
        activeclass : 'pills_created',
        favourite : [],
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
        bookmark: state => state.common.bookmark,
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
      getImgUrl(path) {
        return require('@/assets/images/'+path);
      },
      say: function (message) {
        this.activeclass = message;
      },
      setFavourite(item) {
        let objIndex = this.favourite.findIndex((obj => obj.id === item.id));
        if (objIndex > -1) {
          this.favourite.splice(objIndex, 1);
        } else {
          this.favourite.push(item);
        }
      },
      getActive(itemId) {
        let objIndex = this.favourite.findIndex((obj => obj.id === itemId));
        if (objIndex > -1) {
          return true;
        } else {
          return false;
        }
      }
    }
  };
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>