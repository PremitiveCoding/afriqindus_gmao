<template>
    
  <div class="bg-white shadow sm:rounded-lg">
    <Link rel="stylesheet" :href="route('clients.index')">
        <ButtonVue class="float-right mt-5 mr-5">Retour</ButtonVue>
    </Link>
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Information du Client</h3>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <LoadingContent v-if="loading"></LoadingContent>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Nom Complet</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.nom}} {{client.prenom}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Numero TVA</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.ntva}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.tele}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Sites</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <li v-for="site in client.sites" :key="client.sites.id" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                  <span class="ml-2 flex-1 w-0 truncate"> {{site.nom}} </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                  <button @click="showSiteModal(site); getSite(site.id);" class="flex-shrink-0 rounded-full hover:bg-blue-100 text-blue-700 cursor-pointer mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg>
                  </button>
                  <ShowVue
                  v-if="isShowSiteModalVisible == site.id && loaded"
                  @close="closeShowSiteModal"
                  :site="getsite">
                  </ShowVue>
                  <button @click="showEditSiteModal(site); getSite(site.id);" class="flex-shrink-0 rounded-full hover:bg-orange-100 text-orange-500 cursor-pointer mr-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3" id="IconChangeColor"><path d="M12 20h9" id="mainIconPathAttribute" fill="#ffffff" stroke="fillCurrent"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" id="mainIconPathAttribute" fill="#ffffff" stroke="#ff9500"></path></svg>
                  </button>
                  <EditVue
                  v-if="isEditSiteModalVisible == site.id && loaded"
                  @close="closeEditSiteModal"
                  :site="getsite"
                  :client="client">
                  </EditVue>
                  <button @click="showConfirmDeleteSite(site)" class="flex-shrink-0 rounded-full hover:bg-red-100 cursor-pointer" type="button">
                  <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                  </button>
                  <div class="flex align-items justify-center">
                    <DeleteToast
                      v-show="isConfirmDeleteSiteVisible == site.id"
                      modalHeadline="Supprimer site"
                      deleteMessage="Etes-vous sûr?"
                      @deleteRecordEvent="destroy(site.id)"
                      @close="closeConfirmDeleteSite"
                      >
                    </DeleteToast>
                  </div>
                </div>
              </li>
              </ul>
              <div class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                  <button @click="AddSiteModal" 
                  type="button" 
                  class="flex flex-row font-medium text-sm items-center ml-auto text-indigo-600 hover:text-indigo-800">
                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg> Ajouter un site 
                  </button>
                  <AddSite
                  v-if="showAddSiteModal"
                  @close="closeAddSiteModal"
                  :client="client">
                  </AddSite>                                         
                </div>
              </div>
            
          </dd>
        </div>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Adresse Email</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.email}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Adresse EmailSs</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.emailSs}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Addresse</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.adresse}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">AddresseSs</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.adresseSs}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Observation</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{client.observation}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Site Internet</dt>
          <a target="_blank" :href="client.siteInternet" class="mt-1 text-sm sm:mt-0 sm:col-span-2 text-indigo-600 hover:text-indigo-500"> {{client.siteInternet}} </a>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Documents</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <li v-for="document in client.documents" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                 
                  <span class="ml-2 flex-1 w-0 truncate"> {{document.title}} </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                  <a :href="route('document.download',document.id)" class="font-medium text-indigo-600 hover:text-indigo-500"> Download </a>
                </div>
              </li>
            </ul>
          </dd>
        </div>
      </dl>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import ButtonVue from '../../Jetstream/Button.vue'
import AddSite from '../Site/AddSite.vue'
import DeleteToast from '../DeleteToast.vue'
import { Inertia } from '@inertiajs/inertia'
import EditVue from '../Site/Edit.vue'
import ShowVue from '../Site/Show.vue'
import axios from 'axios'
import LoadingContent from '../Shared/loadingcontent.vue'

export default {
    
  components: {
    ButtonVue,
    Link,
    AddSite,
    DeleteToast,
    EditVue,
    ShowVue,
    LoadingContent,
},
  props:{
    client:Array,
  },
  data(){
    return{
      loaded : false,
      loading : false,
      getsite:[],
      showAddSiteModal: false,
      isConfirmDeleteSiteVisible: false,
      isEditSiteModalVisible: false,
      isShowSiteModalVisible: false,
    };
  },
  methods:{
    getSite(site){
      this.loaded = false
      this.loading = true
      this.getsite = []
      const mine = this
      axios.get(`/sites/${site}`)
      .then(function (response) {
        mine.getsite = response.data.site
      }).finally(() => {this.loaded = true
                       this.loading = false})
      
    },

    AddSiteModal() {
      this.showAddSiteModal = true
    },
    closeAddSiteModal() {
      this.showAddSiteModal = false;
    },
    destroy(id) {
        Inertia.delete(route('sites.destroy', id))
    },
    showConfirmDeleteSite(record) {
      this.isConfirmDeleteSiteVisible = record.id
    },
    closeConfirmDeleteSite() {
      this.isConfirmDeleteSiteVisible = false
    },
    showEditSiteModal(record) {
      this.isEditSiteModalVisible = record.id
    },
    closeEditSiteModal() {
      this.isEditSiteModalVisible = false
    },
    showSiteModal(record) { 
      this.isShowSiteModalVisible = record.id
    },
    closeShowSiteModal() {
      this.isShowSiteModalVisible = false
    },
  },
}
</script>