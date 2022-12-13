<template>
  <AddArticle
  :index="indexchosen"
  @close="CloseaddarticleModal"
  @choose="chooseArticle"
  v-if="isshowaddarticleModal"
  >
  </AddArticle> 
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="mt-5 md:mt-0 md:col-span-3">
        <form @submit.prevent="updateIntervention">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                
                <div class="col-span-6">

                  <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                  <input type="text" v-model="form.titre" id="titre" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="site" class="block text-sm font-medium text-gray-700">Site</label>
                  <div class="relative flex flex-row-reverse">
                    <input type="text" v-model="chosensite" class=" w-full focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-sm" disabled/>
                    <div @click="Toggleshowsites()" class="absolute hover:bg-gray-50 mt-px mr-px p-1.5 cursor-pointer rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-selector" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#374151" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <polyline points="8 9 12 5 16 9" /> <polyline points="16 15 12 19 8 15" /> </svg></div>
                    <div v-if="showSites" class="absolute w-full text-sm mt-10 z-20 whitespace-normal text-inherit bg-white border text-gray-700 px-1 max-h-52 rounded shadow-md overflow-auto items-center">
                        <div class="relative flex justify-end">
                          <input type="text" placeholder="Recherche" v-model="searchsites" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                          <div class="absolute text-gray-800 mt-1.5 mr-px p-2 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg></div>
                        </div>
                        <div v-for="(site,key) in filteredsites" :key="key" class="mt-1">
                          <div @click="chooseSite(site)" class="p-2 cursor-pointer hover:bg-gray-200 rounded-md border-gray-200">{{site.nom}}</div>
                        </div>
                        <div v-if="!sites.length" class="p-2 mt-1 border-b border-gray-200">Il n'existe aucun site</div>
                    </div>
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                  <select v-model="form.type" id="type" class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm">
                    <option  value="standard" class="p-4">Intervention standard</option>
                    <option  value="preventive" class="p-4">Intervention Préventive</option>
                    <option  value="depannage" class="p-4">Dépannage</option>
                    <option  value="reparation" class="p-4">Réparation</option>
                    <option  value="correction" class="p-4">Correction</option>
                  </select>
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="dateDb" class="block text-sm font-medium text-gray-700">Date de début</label>
                  <input type="datetime-local" v-model="form.dateDb" id="dateDb" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="DateFn" class="block text-sm font-medium text-gray-700">Date de fin</label>
                  <input type="datetime-local" v-model="form.dateFn" id="DateFn" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6">
                  <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                  <textarea type="text" v-model="form.desc" id="description" autocomplete="off" class="mt-1 min-h-fit focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" ></textarea>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="tempsNes" class="block text-sm font-medium text-gray-700">Temps nécessaire</label>
                  <input type="time" v-model="form.tempsNes" id="tempsNes" autocomplete="address-level2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="urgence" class="block text-sm font-medium text-gray-700">Urgence</label>
                  <select v-model="form.urgence" id="urgence" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <option  value="Immédiate" class="p-4">Immédiate</option>
                    <option  value="Dès que possible" class="p-4">Dès que possible</option>
                    <option  value="Au prochain arrêt" class="p-4">Au prochain arrêt</option>
                  </select>
                </div>

                <Transition>
                <div v-if="form.type==='preventive'" class="col-span-6 sm:col-span-6">
                <label for="frequence" class="block text-sm font-medium text-gray-700">Fréquence</label>
                  <select v-model="form.frequence" id="frequence" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm">
                    <option  value="Quotidien" class="p-4">Quotidien</option>
                    <option  value="Hebdomadaire" class="p-4">Hebdomadaire</option>
                    <option  value="Mensuel" class="p-4">Mensuel</option>
                    <option  value="Annuel" class="p-4">Annuel</option>
                  </select>
                </div>
                </Transition>

                <div class="col-span-6 sm:col-span-6">
                  <div class="flex">
                    <div class="block text-sm font-medium text-gray-700 w-7/12">Article</div>
                    <div class="block text-sm ml-10 font-medium text-gray-700 ">Quantité</div>
                  </div>
                  
                  <hr/>
                  <div v-for="(intarticle,index) in intarticles" :key="index">
                    <div class="relative col-span-6 my-3 flex items-center">
                        <div class="w-7/12 flex flex-row-reverse">
                          <input type="text" v-model="intarticles[index].nom" class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" disabled/>
                          <div @click="articleLoading(index)" class="absolute hover:bg-gray-50 mt-px mr-px 100 p-1.5 cursor-pointer rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-selector" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#374151" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <polyline points="8 9 12 5 16 9" /> <polyline points="16 15 12 19 8 15" /> </svg></div>
                          <div v-if="isshowarticleLoading===index" class="absolute flex justify-center w-7/12 text-sm mt-10 h-20 z-20 whitespace-normal text-inherit bg-white border text-gray-700 px-1 rounded shadow-md">
                            <img width="35" height="35" :src="'/img/spinner_modal.svg'">
                          </div>
                          <div v-if="showarticles===index" class="absolute w-7/12 text-sm mt-10 z-20 whitespace-normal text-inherit bg-white border text-gray-700 px-1 max-h-52 rounded shadow-md overflow-auto items-center">
                            <div class="relative flex justify-end">
                            <input type="text" placeholder="Recherche" v-model="searcharticles" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                            <div class="absolute text-gray-800 mt-1.5 mr-px p-2 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg></div>
                            </div>
                            <div v-for="(article,key) in filteredarticles" :key="key" class="mt-1">
                            <div @click="chooseArticle(article,index)" class="p-2 cursor-pointer hover:bg-gray-200 rounded-md border-gray-200">{{article.nom}}</div>
                            </div>
                            <div v-if="!articles.length" class="p-2 mt-1 border-b border-gray-200">Il n'existe aucun article</div>
                              <button type="button" @click="ShowaddarticleModal(index)" class="flex flex-row text-sm items-center p-2 font-medium text-indigo-600 hover:text-indigo-800">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg>Nouveau article
                              </button>
                            </div>
                          </div>

                        <div class="w-3/12">
                          <input type="number" v-model="intarticle.Qt" class="ml-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-sm" />
                        </div>
                        <button type="button" @click="removeArticle(index)" class="ml-auto flex-shrink-0 rounded-full hover:bg-red-300">
                          <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                        </button>
                    </div>
                    <hr/>
                  </div>
                      
                  <div class="flex justify-end">
                    <button type="button" @click="addArticle()" class="flex flex-row text-sm items-center pt-2 font-medium text-indigo-600 hover:text-indigo-800">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle " viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/> </svg>Ajouter article
                    </button>
                  </div>
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
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sauvegarder</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  
</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
import Uploadfile from '../Shared/Uploadfile.vue';
import Progressbar from '../Shared/progressbar.vue';
import axios from 'axios';
import AddArticle from '../Article/AddArticle.vue';
export default{
  components:{
    Uploadfile,
    Progressbar,
    AddArticle
},
  props: {
    intervention:Object,
    sites:Object,
    articles:Object,
  },
  data(){
    return {
      chosensite : "",
      searcharticles : "",
      searchsites : "",
      isshowaddarticleModal : false,
      allarticles : [],
      isshowarticleLoading : null,
      document : [],
      documentIds : [],
      fileIncrement : 0,
      intarticles : [],
      showarticles : false,
      indexinchosen : null,
      showSites: false
    }
  },
  setup(props){
    const form = useForm({
      titre: props.intervention.titre,
      site_id: props.intervention.site_id,
      document_id: props.intervention.document_id,
      type: props.intervention.type,
      desc: props.intervention.desc,
      urgence: props.intervention.urgence,
      status: props.intervention.status,
      dateDb: props.intervention.dateDb,
      dateFn: props.intervention.dateFn,
      etat: props.intervention.etat,
      tempsNes: props.intervention.tempsNes,
      frequence: props.intervention.frequence,
    });
    return{form}
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
    filteredarticles(){
      return this.allarticles.filter(article => 
      article.nom.toLowerCase().includes(this.searcharticles.toLowerCase()))
    },
    filteredsites(){
      return this.sites.filter(site => 
      site.nom.toLowerCase().includes(this.searchsites.toLowerCase()))
    }
  },
  methods: {
    updateIntervention(){
    if(this.form.type != "preventive"){
        this.form.frequence = null
      }
    this.form.articles = this.intarticles
    this.form.documentIds = this.document.map(item => item.id);
    Inertia.post(`/interventions/${this.intervention.id}`,{
        _method:'put',
        titre: this.form.titre,
        site_id: this.form.site_id,
        type: this.form.type,
        desc: this.form.desc,
        urgence: this.form.urgence,
        dateDb: this.form.dateDb,
        dateFn: this.form.dateFn,
        tempsNes: this.form.tempsNes,
        frequence: this.form.frequence,
        documentIds: this.form.documentIds,
        articles: this.form.articles
    })
   },
   articleLoading(index){
      if(this.showarticles === index){
        this.showarticles = false
      }else{
      this.isshowarticleLoading = index
      this.showarticles = false
      let mine = this
      axios.get(route('articles.index'))
      .then((response) =>{
            mine.allarticles = response.data.articles;
      }).finally(() => {this.isshowarticleLoading=false
                        this.showarticles=index})
      }
    },
    chooseArticle(article,index){
      this.searcharticles=""
      this.intarticles[index].article_id=article.id
      this.intarticles[index].nom=article.nom
      this.showarticles = false
    },
    chooseSite(site){
      this.searchsites=""
      this.form.site_id= site.id
      this.chosensite= site.nom
      this.showSites= false
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
    addArticle(){
      this.intarticles.push({
        article_id : null,
        nom : null,
        Qt : null 
        })
    },
    removeArticle(index){
      if(this.showarticles === index || this.isshowarticleLoading === index){
        this.showarticles = false
        this.isshowarticleLoading = false
      }
      this.intarticles.splice(index,1);
    },
    ShowaddarticleModal(index){
      this.showarticles = false
      this.isshowaddarticleModal = true
      this.indexchosen=index
    },
    CloseaddarticleModal(){
      this.isshowaddarticleModal = false
    },
    Toggleshowsites(){
      this.showSites = !this.showSites
    }
  },
  mounted() {
    let item = []
    let itemarticles = []
    this.fileIncrement=this.intervention.documents.length
    if(this.intervention.documents.length){
        for(let i=0;i<this.intervention.documents.length;i++){
          item.push({
            id : this.intervention.documents[i].id,
            name : this.intervention.documents[i].title,
            type : this.intervention.documents[i].type,
            size : this.intervention.documents[i].size,
            source : undefined,
            imported : true,
            progress : undefined,
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
      if(this.articles.length){
        for(let i=0;i<this.articles.length;i++){
          itemarticles.push({
            article_id : this.articles[i].id,
            nom : this.articles[i].nom,
            Qt : this.articles[i].Qt,
          })
        }
      }
      else{
        itemarticles=[];
      }
      this.intarticles = itemarticles
      for(let i=0;i<this.sites.length;i++){
        if(this.sites[i].id === this.form.site_id){
          this.chosensite=this.sites[i].nom
        }
      }
  }
}
</script>