<template>
    
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <Link rel="stylesheet" :href="route('interventions.index')">
        <ButtonVue class="float-right mt-5 mr-5">Retour</ButtonVue>
    </Link>
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Informations d'intervention</h3>
    </div>
    <div class="border-t border-gray-200">
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Titre</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.titre}}</dd>
        </div>
        <LoadingContent v-if="loading"></LoadingContent>
        <div class="relative bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 ">
          <dt class="text-sm font-medium text-gray-500">Site</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 ">
          <button @click="showSiteModal(); getSite(intervention.site.id);" class=" flex w-full rounded-full text-blue-700 cursor-pointer"><span>{{intervention.site.nom}}</span> <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi ml-auto bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg> </button>
          </dd>
            <ShowSite
            v-if="isShowSiteModalVisible && loaded"
            @close="closeShowSiteModal"
            :site="showsite">
            </ShowSite>
          
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Date début</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.dateDb}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Date fin</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.dateFn}}</dd>
        </div>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Temps Nécessaire</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.tempsNes}}</dd>
        </div>
        <div v-if="intervention.type===preventive" class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Frequence</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.frequence}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Articles</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="py-3 px-6">Nom d'article</th>
                    <th scope="col" class="py-3 px-6">Quantité</th>
                    <th scope="col" class="py-3 px-6">Détail</th>
                  </tr>
                </thead>
                <tbody> 
                  <tr v-for="(article,index) in articles" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{article.nom}}</td>
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{article.Qt}}</td>
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                      <button @click="showArticleModal(article.id)" class="text-indigo-600 hover:text-indigo-900 pr-4"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi ml-auto bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg> </button>
                    </td>
                    <ShowArticle
                      v-if="isShowArticleModalVisible === article.id"
                      @close="closeShowArticleModal"
                      :article="article">
                    </ShowArticle>
                  </tr> 
                </tbody>
              </table>
            </ul>
          </dd>  
        </div>

        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Type</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.type}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Urgence</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.urgence}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Description </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.desc}}</dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Status </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{intervention.status}}</dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">Documents</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <li v-for="document in intervention.documents" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
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
import ShowSite from '../Site/Show.vue'
import LoadingContent from '../Shared/loadingcontent.vue'
import ShowArticle from '../Article/ShowArticle.vue'
export default {
    
  components: {
    ButtonVue,
    Link ,
    ShowSite,
    LoadingContent,
    ShowArticle
  },
  props:{
    intervention:Object,
    articles:Array,
  },
  data(){
    return{
      isShowArticleModalVisible: false,
      loaded : false,
      loading : false,
      showsite:[],
      isShowSiteModalVisible:false,
    };
  },
  methods:{
    getSite(site){
      this.loaded = false
      this.loading = true
      const mine = this;
      axios.get(`/sites/${site}`)
      .then(function (response) {
        mine.showsite = response.data.site
      }).finally(() => {this.loaded = true
                       this.loading = false})
    },
    showSiteModal() {
      this.isShowSiteModalVisible = true;
    },
    closeShowSiteModal() {
      this.isShowSiteModalVisible = false;
    },
    showArticleModal(record) {
      this.isShowArticleModalVisible = record;
    },
    closeShowArticleModal() {
      this.isShowArticleModalVisible = false;
    },
  },
}
</script>