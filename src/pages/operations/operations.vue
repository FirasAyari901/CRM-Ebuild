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
                          <h4 class="mb-0">Operations</h4>
                          </b-col>
                        <b-col xl="2">
                         <b-button id="default-secondary" lass="mb-0 datatable-select" v-b-modal.modal-lg variant="secondary">Add Operation</b-button>
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
                                <h6><a href="#">Operation 1</a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">opreation type : type 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price TVA</div>: 210 TND
                              </div>
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a><feather class="close"  type="trash-2"></feather>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">Operation 1</a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">opreation type : type 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price TVA</div>: 210 TND
                              </div>
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a><feather class="close"  type="trash-2"></feather>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">Operation 1</a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">opreation type : type 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price TVA</div>: 210 TND
                              </div>
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a>
                              <feather class="close"  type="trash-2"></feather><span></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">Operation 1</a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">opreation type : type 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price TVA</div>: 210 TND
                              </div>
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a>
                              <feather class="close"  type="trash-2"></feather><span></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-md-6 box-col-6">
                        <div class="prooduct-details-box">                                 
                          <div class="media">
                            <div class="media-body ml-3">
                              <div class="product-name">
                                <h6><a href="#">Operation 1</a></h6>
                              </div>
                              <div class="avaiabilty">
                                <div class="text-success">opreation type : type 1</div>
                            </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price HT</div>: 210 TND
                              </div>
                              <div class="price d-flex"> 
                                <div class="text-muted mr-2">price TVA</div>: 210 TND
                              </div>
                              <div class="avaiabilty">
                              </div><a class="btn btn-warning btn-xs" href="#">Update</a>
                              <feather class="close"  type="trash-2"></feather><span></span>
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
    }
  };
</script>