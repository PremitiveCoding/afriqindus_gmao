<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Uploadfile from '../Shared/Uploadfile.vue';
import Progressbar from '../Shared/progressbar.vue';
import axios from 'axios';
import Loadingcontent from '../Shared/loadingcontent.vue';
export default{
  components:{
    Uploadfile,
    Progressbar,
    Loadingcontent
  },
  props:{
    client : Array,
    site : Array,
  },
  data(){
    return {
      submitting : false,
      document : [],
      documentIds : [],
      fileIncrement : 0,
    }
  },
  setup(props){
    const form = useForm({
      nom: props.site.nom,
      client_id: props.site.client_id,
      email: props.site.email,
      tel: props.site.tel,
      adresse: props.site.adresse,
      observation: props.site.observation,
      });
    return { form}
  },
  computed: {
    fullName: {
      get() {
        return `${this.client.nom} ${this.client.prenom}`;
      },
      set(newValue) {
        const m = newValue.match(/(\S*)\s+(.*)/);

        this.client.nom = m[1];
        this.client.prenom = m[2];
      }
    },
    isloading : function() {
      let k = 0
      if(this.document.length){
      for(let i=0; i<this.document.length; i++){
        if(this.document[i].loading === true){
          k++
        }
        }
      }
      if(k){
        return true
      }
      else{
        return false
      }
    },
  },
  methods: {
    closeModal(){
      let k=0
      let cancel=[]
      let splice=[]
      if(this.document.length){
        for(let i=0;i<this.document.length;i++){
          if(this.document[i].loading){
            k++;
            cancel.push({
              item : this.document[i]
            })
          }
          else if(this.document[i].source && !this.document[i].erreur && !this.document[i].imported){
            k++;
            splice.push({
              item : this.document[i],
              index : i
            })
          }
        }
      if(k){
        if(confirm('Les changements que vous avez apportés ne seront pas enregistrés, êtes vous sûr de vouloir naviguer ailleurs')){
          if(cancel.length){
            for(let j=0;j<cancel.length;j++){
              this.cancel(cancel[j].item)
            }
          }
          if(splice.length){
            for(let k=0;k<splice.length;k++){
              axios.delete(`../../document/${splice[k].item.id}`).catch((e) =>
              console.log(e)
              )
            }
          }
          this.$emit('close')
        }
      }
      else{this.$emit('close')}
      }
      else{this.$emit('close')}
    },
    updateSite(){
    this.form.documentIds = this.document.map(item => item.id);
    Inertia.post(`/sites/${this.site.id}`,{
        _method:'put',
        nom: this.form.nom,
        client_id: this.form.client_id,
        email: this.form.email,
        tel: this.form.tel,
        adresse: this.form.adresse,
        observation: this.form.observation,
        documentIds: this.form.documentIds,
    })
    this.$emit("close")
    },
    uploadMedia(files){
      Array.from(files).forEach((file,index) =>{
        let counter = this.fileIncrement;
        this.fileIncrement++
        const CancelToken = axios.CancelToken;
        const source = CancelToken.source();

        this.document.push({
            id : undefined,
            name : file.name,
            type : file.type,
            size : file.size,
            source : source,
            imported : false,
            progress : undefined,
            loading : true,
            erreur : false,
            erreuractive : false,
        })
        
        let formData = new FormData();
        formData.append('file', file,);
        axios.post(route('document.store'), formData,
        {
          cancelToken: source.token,
          onUploadProgress: e => {
            if(e.lengthComputable) {
              this.document[counter].progress = (e.loaded / e.total) * 100
            }
          }
          }, )
          .then((data) =>{
            this.document[counter].id = data.data.id;
        })
        .finally(() => this.document[counter].loading = false)
        .catch((error) => this.document[counter].erreur = error)
      });
    },
    cancel(item){
      item.source.cancel('Annulation');
    },
    removeMedia(index, item){
      if(!item.erreur){
      if(confirm("Etes-vous sur de vouloir supprimer le fichier?")){
      this.document.splice(index,1);
      this.fileIncrement--
      if(item.id) {
        axios.delete(`../document/${item.id}`).catch((e) => {
          console.log(e);
          this.document.splice(index,0,item);
          this.fileIncrement++
        })
      }
      }
      }
      else{
        this.document.splice(index,1);
      this.fileIncrement--
      if(item.id) {
        axios.delete(`../document/${item.id}`).catch((e) => {
          console.log(e);
          this.document.splice(index,0,item);
          this.fileIncrement++
        })
      }
      }
    },
    mouseEnter(i){
      this.document[i].erreuractive=true;
    },
    mouseLeave(i){
      this.document[i].erreuractive=false;
    },
    getFileSize(bytes, decimalPoint){
    if(bytes ===0) return '0 Bytes'
    let k = 1000
    let dm = decimalPoint || 1
    let sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    let i = Math.floor(Math.log(bytes) / Math.log(k))
    return parseFloat((bytes / Math.pow(k,i)).toFixed(dm)) + ' ' + sizes[i]
    },
  },
  mounted() {
    let item = []
    this.fileIncrement=this.site.documents.length
    if(this.site.documents.length){
        for(let i=0;i<this.site.documents.length;i++){
          item.push({
            id : this.site.documents[i].id,
            name : this.site.documents[i].title,
            type : this.site.documents[i].type,
            size : this.site.documents[i].size,
            source : undefined,
            imported : true,
            progress : 100,
            loading : false,
            erreur : false,
            erreuractive : false
          })
        }
      }
      else{
        item=[];
      }
      this.document = item
  }
  
}
</script>
<template>
<transition name="modal-fade">
  
    <div class="fixed z-10 inset-0 ">
      <div class="flex items-end justify-center min-h-screen sm:block sm:p-0 ">
        <div class="fixed inset-0 " aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-50" ></div>
        </div>
            <Loadingcontent v-if="submitting"/>
            <div class="flex h-screen items-center justify-center shadow-sm transform transition-all">
            <div class="grid bg-white rounded-lg  w-11/12 md:w-9/12 lg:w-1/2 overflow-y-visible">
            
            <div class="flex justify-center my-5">
              <div class="flex">
                <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations du site:</h1>
              </div>
            </div>
            <hr/>
            <form @submit.prevent="updateSite">
            <div class="overflow-y-auto max-h-96">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="titre" class="block text-sm font-medium text-gray-700">Nom</label>
              <input type="text" v-model="form.nom" id="titre" autocomplete="organization-title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
            </div>
              <div class="grid grid-cols-1">
                <label for="client" class="block text-sm font-medium text-gray-700">Client</label>
              <input type="text" id="client" v-model="fullName" autocomplete="off" class="mt-1 bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm cursor-not-allowed" disabled/>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
              <input type="text" v-model="form.email" id="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
              </div>
              <div class="grid grid-cols-1">
                <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
              <input type="text" v-model="form.tel" id="tel" autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
              </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
              <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
              <input type="text" v-model="form.adresse" id="adresse" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
              <label for="observation" class="block text-sm font-medium text-gray-700">Observation</label>
              <input type="text" v-model="form.observation" ref="inputs" id="observation" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
            </div>

            <Uploadfile @input="uploadMedia" class="grid grid-cols-1 my-5 mx-7"></Uploadfile>
                <div v-if="document.length" class="grid grid-cols-1 mb-5 mx-7">
                  <dt class="text-sm font-medium text-gray-500">Attachments</dt>
                  <dd class="mt-1 text-sm text-gray-900 col-span-6 sm:col-span-6">
                    <ul role="list" class="divide-y divide-gray-200 rounded-md">
                      <li v-for="(file,index) in document"  class="pl-3 pr-4 py-3 flex-col items-center justify-center text-sm">
                        
                        <div class="flex flex-row">
                        <div class="w-0 flex-1 flex items-center">
                          <span class="ml-2 flex-1 w-0 truncate"> {{file.name}}</span>
                        </div>
                        
                        <div class="w-0 flex-1 flex items-center">
                          <span class="ml-2 flex-1 w-0 truncate"> {{ getFileSize(file.size)}}</span>
                          <span v-if="file.loading" class="ml-2 flex-1 w-0 truncate transition"> Uploading </span>
                          <div v-if="file.erreur && file.erreur.message!=='Annulation'"  class="ml-2 text-red-600 inline-flex flex-1 truncate transition">
                            <span>Erreur</span>&nbsp;
                            <svg style="color: red " class="cursor-help" @mouseenter="mouseEnter(index)" @mouseleave="mouseLeave(index)" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M11.99 22C6.46846 21.9945 1.99632 17.5149 2 11.9933C2.00368 6.47179 6.48179 1.99816 12.0033 2C17.5249 2.00184 22 6.47845 22 12C21.9967 17.5254 17.5154 22.0022 11.99 22ZM4 12.172C4.04732 16.5732 7.64111 20.1095 12.0425 20.086C16.444 20.0622 19.9995 16.4875 19.9995 12.086C19.9995 7.6845 16.444 4.10977 12.0425 4.08599C7.64111 4.06245 4.04732 7.59876 4 12V12.172ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="#DC2626"></path> </svg>
                            <div v-if="file.erreuractive" class="w-36 text-sm mt-6 p-1 whitespace-normal text-inherit bg-red-400 text-red-600 px-1 absolute rounded bg-opacity-50 shadow-xl">
                            {{file.erreur}}
                            </div>
                          </div>
                          <span v-if="!file.imported && !file.loading && !file.erreur" class="ml-2 flex-1 w-0 truncate transition"> Uploaded </span>
                          <span v-if="file.erreur.message ==='Annulation'" class="ml-2 flex-1 w-0 truncate transition"> Annulé </span>
                        <button v-if="file.loading" type="button" @click="cancel(file)" class="ml-4 flex-shrink-0 rounded-full hover:bg-gray-300">
                          <svg width="25" height="25" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="white" fill-opacity="0.01"/><path d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z" fill="none" stroke="#333" stroke-width="1" stroke-linejoin="round"/><path d="M29.6569 18.3431L18.3432 29.6568" stroke="#333" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.3432 18.3431L29.6569 29.6568" stroke="#333" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button> 
                        <button v-if="!file.loading" type="button" @click="removeMedia(index, file)" class="ml-4 flex-shrink-0 rounded-full hover:bg-red-300">
                          <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                        </button> 
                        </div>

                        </div>
                        <Progressbar v-if="file.loading" :progress="file.progress" ></Progressbar>
                        
                      </li>
                    </ul>
                  </dd>
                </div>
              </div>
              <hr/>
            <div class='flex items-center justify-end  md:gap-8 gap-4 pt-5 pb-5 mr-7'>
              <button type="button" @click="closeModal()" class='inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium cursor-pointer rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500'>Annuler</button>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :class="{'cursor-not-allowed bg-indigo-500 hover:bg-indigo-500' : isloading}" :disabled="isloading">Sauvegarder</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>