<template>
<transition name="modal-fade">
    <div class="fixed z-10 inset-0  ">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0 ">
        <div class="fixed inset-0 " aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-50" ></div>
        </div>

            <div class="flex h-screen items-center justify-center shadow-sm transform">
            <div class="grid bg-white h-5/6 rounded-lg w-11/12 md:w-9/12 lg:w-1/2 ">
            
            <div class="flex justify-center mt-5 mb-5">
              <div class="flex">
                <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations du site:</h1>
              </div>
            </div>
            <div class="border-y border-gray-200 overflow-y-scroll">
            <dl>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Nom</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{site.nom}}</dd>
              </div>
            
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Adresse Email</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{site.email}}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Telephone</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{site.tel}}</dd>
              </div>

              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Adresse</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{site.adresse}}</dd>
              </div>

              <div v-if="site.client" class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-700">Client</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><Link :href="route('clients.show',site.client.id)" class="flex rounded-full text-blue-700 cursor-pointer"><span>{{site.client.nom}} &nbsp; </span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right ml-auto" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/> <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/> </svg></Link></dd>
                  
          
              </div>

              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Observation</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{site.observation}}</dd>
              </div>

              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Documents</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                    <li v-for="document in site.documents" class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
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
            <div class='flex items-center justify-end  md:gap-8 gap-4 pt-4 pb-4 mr-7'>
              <button type="button" @click="closeModal" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium cursor-pointer rounded-md text-white bg-gray-500 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Fermer</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default{
components:{
  Link
},
props:{
    site : Array,
  },
methods:{
    closeModal(){
        this.$emit('close')
    }
}
}
</script>