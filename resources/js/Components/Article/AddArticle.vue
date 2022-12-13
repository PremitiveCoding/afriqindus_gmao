<template>
<transition name="modal-fade">
    <div class="fixed z-30 inset-0">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0 ">
        <div class="fixed inset-0 " aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-50" ></div>
        </div>
            <Loadingcontent v-if="submitting"/>
            <div class="flex h-screen items-center justify-center shadow-sm transform transition-all">
            <div class="grid bg-white rounded-lg w-11/12 md:w-9/12 lg:w-1/2 ">
            
            <div class="flex justify-center my-5">
              <div class="flex">
                <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations d'article:</h1>
              </div>
            </div>
            <hr/>
            <form ref="addarticleform" @submit.prevent="submitForm">
            <div class="overflow-y-auto max-h-96">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
              <input type="text" v-model="form.nom" id="nom" autocomplete="organization-title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
            </div>
              <div class="grid grid-cols-1">
                <label for="reference" class="block text-sm font-medium text-gray-700">Référence</label>
              <input type="text" id="reference" v-model="form.reference" autocomplete="fax" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
                <label for="fournisseur" class="block text-sm font-medium text-gray-700">Fournisseur</label>
                  <div class="relative flex flex-row-reverse">
                    <input type="text" v-model="chosenfournisseur" class=" w-full focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md" disabled/>
                    <div @click="Toggleshowfournisseurs()" class="absolute hover:bg-gray-50 mt-px mr-px p-1.5 cursor-pointer rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-selector" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#374151" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"/> <polyline points="8 9 12 5 16 9" /> <polyline points="16 15 12 19 8 15" /> </svg></div>
                    <div v-if="showFournisseurs" class="absolute w-full text-sm mt-10 z-20 whitespace-normal text-inherit bg-white border text-gray-700 px-1 max-h-52 rounded shadow-md overflow-auto items-center">
                        <div class="relative flex justify-end">
                          <input type="text" placeholder="Recherche" v-model="searchfournisseurs" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                          <div class="absolute text-gray-800 mt-1.5 mr-px p-2 rounded-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/> </svg></div>
                        </div>
                        <div v-for="(fournisseur,key) in filteredfournisseurs" :key="key" class="mt-1">
                          <div @click="chooseFournisseur(fournisseur)" class="p-2 cursor-pointer hover:bg-gray-200 rounded-md border-gray-200">{{fournisseur.nom}}</div>
                        </div>
                        <div v-if="!fournisseurs.length" class="p-2 mt-1 border-b border-gray-200">Il n'existe aucun fournisseur</div>
                    </div>
                  </div>
                </div>
              <div class="grid grid-cols-1">
                <label for="marque" class="block text-sm font-medium text-gray-700">Marque</label>
              <input type="text" v-model="form.marque" id="marque" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="prixach" class="block text-sm font-medium text-gray-700">Prix achat</label>
              <input type="number" v-model="form.prixAchat" id="prixach" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
            </div>
              <div class="grid grid-cols-1">
                <label for="prixvente" class="block text-sm font-medium text-gray-700">Prix Vente</label>
              <input type="number" id="prixvente" v-model="form.prixVente" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
                <label for="emplacement" class="block text-sm font-medium text-gray-700">Emplacement</label>
              <input type="text" v-model="form.emplacement" id="emplacement" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
              <div class="grid grid-cols-1">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
              <input type="text" v-model="form.type" id="type" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-5 md:gap-8 mt-5 mx-7">
            <div class="grid grid-cols-1">
                <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
              <textarea type="text" id="designation" v-model="form.designation" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="unite" class="block text-sm font-medium text-gray-700">Unité</label>
              <input type="text" v-model="form.unite" id="unite" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
            </div>
            </div>
            <div class="flex justify-center my-5">
              <div class="flex">
                <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations de commande:</h1>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="Titre" class="block text-sm font-medium text-gray-700">Titre</label>
              <input type="text" v-model="commande.titre" id="titre" autocomplete="organization-title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-5 md:gap-8 mt-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea type="text" v-model="commande.description" id="description" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" ></textarea>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 my-5 mx-7">
              <div class="grid grid-cols-1">
              <label for="adressedelivraison" class="block text-sm font-medium text-gray-700">Adresse de livraison</label>
              <input type="text" v-model="commande.adresselivraison" id="adressedelivraison" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
              <div class="grid grid-cols-1">
              <label for="datedelivraison" class="block text-sm font-medium text-gray-700">Date de livraison</label>
              <input type="date" v-model="commande.datelivraison" id="datedelivraison" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
              </div>
            </div>
            
            </div>
            
            <hr/>
            <div class='flex items-center justify-end  md:gap-8 gap-4 pt-5 pb-5 mr-7'>
              <button type="button" @click="close" class='inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium cursor-pointer rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500'>Cancel</button>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :class="{'cursor-not-allowed bg-indigo-500 hover:bg-indigo-500' : isloading}" :disabled="isloading">Sauvegarder</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios';
import Loadingcontent from '../Shared/loadingcontent.vue';

export default {
  props:{
    index:Number,
    fournisseurs:Array,
},
  components:{
    Loadingcontent
},
  data(){
    return {
      commande: {titre: null, 
                 description:null,
                 adresselivraison:null,
                 datelivraison:null },
      submitting : false,
      articlechosen: [],
      searchfournisseurs : "",
      chosenfournisseur : "",
      showFournisseurs: false,
    }
  },
  computed: {
    filteredfournisseurs(){
      return this.fournisseurs.filter(fournisseur => 
      fournisseur.nom.toLowerCase().includes(this.searchfournisseurs.toLowerCase()))
    }
  },
  setup (props) {
    const form = useForm({
      nom: null,
      fournisseur_id: null,
      reference: null,
      marque: null,
      prixAchat: null,
      prixVente: null,
      emplacement: null,
      type: null,
      unite: null,
      designation: null,
    })
    return { form }
  },
  methods: {
    close() {
      this.$refs.addarticleform.reset();
      this.$emit("close")
    },
    submitForm() {
      this.submitting = true
      let mine = this
      axios.post(`/storearticle`,this.form)
      .then((response) => {
        mine.articlechosen = response.data.article
      })
      .finally(() => { this.commande.article_id = this.articlechosen.id
                       if(this.index!=null){
                        this.articlechosen.quantite = 0
                        this.$emit("fillcommande",this.commande,this.index)
                        this.$emit("choose",this.articlechosen,this.index)}
                       this.submitting = false 
                       this.close()})
    },
    chooseFournisseur(fournisseur){
      this.searchfournisseurs=""
      this.form.fournisseur_id= fournisseur.id
      this.chosenfournisseur= fournisseur.nom
      this.showFournisseurs= false
    },
    Toggleshowfournisseurs(){
      this.showFournisseurs= !this.showFournisseurs
    },
  }
}
</script>