<template>
	<div>
		<Breadcrumbs title="Dropzone"/>
		<div class="container-fluid">
			<div class="row">
				<vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
			</div>
		</div>
	</div>
</template>
<script>
  import vue2Dropzone from 'vue2-dropzone';
  import 'vue2-dropzone/dist/vue2Dropzone.min.css';
  
  export default {
    components: {
      vueDropzone: vue2Dropzone
    },
    data(){
      return{
        dropzoneOptions: {
          url: 'https://httpbin.org/post', // this just demo url we want to change it
          thumbnailWidth: 150,
          maxFilesize: 2,
        }
      };
    }
  };
</script>