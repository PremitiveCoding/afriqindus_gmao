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
                    <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations de commande:</h1>
                  </div>
                </div>
                <hr/>
                <form ref="addarticleform" @submit.prevent="submitForm">
                <div class="overflow-y-auto max-h-96">
                
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
    
    export default {
      props:{
        index:Number,
    },

      data(){
        return {
          commande: {titre: null,
                     article_id: null, 
                     description:null,
                     adresselivraison:null,
                     datelivraison:null },
        }
      },
      methods: {
        close() {
          this.$refs.addarticleform.reset();
          this.$emit("close")
        },
        submitForm() {
            this.$emit("fillcommande",this.commande,this.index)
            this.close()
        },
        
      }
    }
    </script>