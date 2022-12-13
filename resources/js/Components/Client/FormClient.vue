<template>

  <div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-3">
        <form @submit.prevent="submit">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="first-name" class="block text-sm font-medium text-gray-700">Nom</label>
                  <input type="text" v-model="form.nom" id="first-name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="last-name" class="block text-sm font-medium text-gray-700">Prénom</label>
                  <input type="text" v-model="form.prenom" id="last-name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6">
                  <dt class="text-sm font-medium text-gray-500">Sites</dt>
                  <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                      <li v-for="(site,index) in sites" :key="index" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                      <div class="w-0 flex-1 flex items-center">
                        <span class="ml-2 flex-1 w-0 truncate"> {{site.nom}} </span>
                      </div>
                      <div class="ml-4 flex-shrink-0 justify-center">
                      <button type="button" @click="showSiteModal(site.id)" class="flex-shrink-0 rounded-full hover:bg-blue-100 text-blue-700 cursor-pointer mr-4"> 
                      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>
                      </button>
                      <ShowSite
                      v-if="isShowSiteModalVisible == site.id"
                      @close="closeShowSiteModal"
                      :site="site">
                      </ShowSite>
                      <button type="button" @click="showEditSiteModal(site.id);" class="flex-shrink-0 rounded-full hover:bg-orange-100 text-orange-500 cursor-pointer mr-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3" id="IconChangeColor"><path d="M12 20h9" id="mainIconPathAttribute" fill="#ffffff" stroke="fillCurrent"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" id="mainIconPathAttribute" fill="#ffffff" stroke="#ff9500"></path></svg>
                      </button>
                      <EditSite
                      v-if="isEditSiteModalVisible == site.id"
                      @close="closeEditSiteModal"
                      @updateSite="updateSite"
                      :site="site">
                      </EditSite>
                      
                      <button type="button" @click="showConfirmDeleteSite(site.id)" class="flex-shrink-0 rounded-full hover:bg-red-100 cursor-pointer "> 
                      <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                      </button>
                      <div class="flex align-items justify-center">
                      <DeleteToast
                      v-if="isConfirmDeleteSiteVisible == site.id"
                      modalHeadline="Supprimer site"
                      deleteMessage="Etes-vous sûr?"
                      @deleteRecordEvent="destroy(index)"
                      @close="closeConfirmDeleteSite"
                      >
                    </DeleteToast>
                  </div>
                </div>
              </li>
              </ul>
              <div class="flex justify-end">
                <button type="button" @click="addSite()" class="flex flex-row text-sm items-center pt-2 font-medium text-indigo-600 hover:text-indigo-800">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg>Ajouter site
                </button>
                <AddSite
                v-if="showAddSiteModal"
                @close="closeAddSiteModal"
                @pushSite="pushSite"
                :id="idsite"
                >
                </AddSite>                                         
              </div>
          </dd>
        </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="ntva" class="block text-sm font-medium text-gray-700">Numéro TVA</label>
                  <input type="text"  v-model="form.ntva" id="ntva" autocomplete="fax" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email-address" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                  <input type="text" v-model="form.email" id="email-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>
                
                <div class="col-span-6 sm:col-span-3">
                  <label for="emailss-address" class="block text-sm font-medium text-gray-700">Adresse Email de société</label>
                  <input type="text" v-model="form.emailSs" id="emailss-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="emailfact-address" class="block text-sm font-medium text-gray-700">Adresse Email de facture</label>
                  <input type="text" v-model="form.emailFact" id="emailfact-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                  <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                  <input type="text" v-model="form.tele" id="tel" autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                  <label for="sitein" class="block text-sm font-medium text-gray-700">Site Internet</label>
                  <input type="text" v-model="form.siteInternet" id="sitein" autocomplete="url" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>
                
                <div class="col-span-6">
                  <label for="street-address" class="block text-sm font-medium text-gray-700">Adresse</label>
                  <input type="text" v-model="form.adresse" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6">
                  <label for="street-addressss" class="block text-sm font-medium text-gray-700">Adresse de société</label>
                  <input type="text" v-model="form.adresseSs" id="street-addressss" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                 <div class="col-span-6">
                  <label for="observation" class="block text-sm font-medium text-gray-700">Observation</label>
                  <textarea type="text" v-model="form.observation" id="observation" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" ></textarea>
                </div>

                <Uploadfile @input="uploadMedia" ></Uploadfile>
                <div v-if="document.length" class="bg-white col-span-6 sm:col-span-6">
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
                          <span v-if="!file.loading && !file.erreur" class="ml-2 flex-1 w-0 truncate transition"> Uploaded </span>
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
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :class="{'cursor-not-allowed bg-indigo-500 hover:bg-indigo-500' : isloading}" :disabled="isloading">Enregister</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3'
import Uploadfile from '../Shared/Uploadfile.vue';
import Progressbar from '../Shared/progressbar.vue';
import ShowSite from '../ClientFormSite/ShowSite.vue'
import AddSite from '../ClientFormSite/AddSite.vue';
import EditSite from '../ClientFormSite/EditSite.vue';
import DeleteToast from '../DeleteToast.vue';
import axios from 'axios';

export default {
  components:{
    ShowSite,
    Uploadfile,
    Progressbar,
    AddSite,
    DeleteToast,
    EditSite
},
  data(){
    return {
      document : [],
      documentIds : [],
      idsite: 0,
      fileIncrement : 0,
      showAddSiteModal: false,
      isConfirmDeleteSiteVisible: false,
      isEditSiteModalVisible: false,
      isShowSiteModalVisible: false,
      sites:[],
    }
  },
  setup () {
    const form = useForm({
      nom: null,
      prenom: null,
      ntva: null,
      email: null,
      emailSs:null,
      emailFact:null,
      adresse:null,
      adresseSs:null,
      tele:null,
      observation:null,
      siteInternet:null,

    })
    return { form }
  },
  computed :{
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
    submit(e){
      this.form.documentIds = this.document.map(item => item.id);
      if(this.sites.length){
        for(let i=0;i<this.sites.length;i++){
          this.sites[i].documentIds = this.sites[i].document.map(item => item.id);
        }
      }
      this.form.sites = this.sites;
      
      this.$inertia.post(`/clients`,this.form);
      e.preventDefault()
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
        axios.delete(`../../document/${item.id}`).catch((e) => {
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
        axios.delete(`../../document/${item.id}`).catch((e) => {
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
    addSite() {
      this.idsite++
      this.showAddSiteModal = true
    },
    closeAddSiteModal() {
      this.showAddSiteModal = false;
    },
    destroy(index) {
      if(this.sites[index].document.length){
        for(let i=0;i<this.sites[index].document.length;i++){
        axios.delete(`../../document/${this.sites[index].document[i].id}`).catch((e) => {
          console.log(e);
        })
        }
      }
      this.sites.splice(index,1);
    },
    showConfirmDeleteSite(record) {
      this.isConfirmDeleteSiteVisible = record
    },
    closeConfirmDeleteSite() {
      this.isConfirmDeleteSiteVisible = false
    },
    showEditSiteModal(record) {
      this.isEditSiteModalVisible = record
    },
    closeEditSiteModal() {
      this.isEditSiteModalVisible = false
    },
    showSiteModal(record) { 
      this.isShowSiteModalVisible = record
    },
    closeShowSiteModal() {
      this.isShowSiteModalVisible = false
    },
    pushSite(site){
      this.sites.push(site)
    },
    updateSite(site){
      for(let i=0;i<this.sites.length;i++){
        if(this.sites[i].id===site.id){
          this.sites[i].nom=site.nom
          this.sites[i].email=site.email
          this.sites[i].tel=site.tel
          this.sites[i].adresse=site.adresse
          this.sites[i].observation=site.observation
          this.sites[i].document=site.document
        }
      }
    },
  }

}
</script>