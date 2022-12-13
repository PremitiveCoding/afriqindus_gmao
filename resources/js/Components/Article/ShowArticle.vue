<template>
<transition name="modal-fade">
    <div class="fixed z-10 inset-0 ">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 sm:block sm:p-0 ">
        <div class="fixed inset-0 " aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-50" ></div>
        </div>

            <div class="flex h-screen items-center justify-center shadow-sm transform">
            <div class="grid bg-white rounded-lg w-11/12 md:w-9/12 lg:w-1/2 ">
            
            <div class="flex justify-center mt-5 mb-5">
              <div class="flex">
                <h1 class="text-gray-800 font-bold md:text-xl text-xl">Informations d'article:</h1>
              </div>
            </div>
            <div class="border-y border-gray-200 overflow-y-scroll">
            <dl>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Nom</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{article.nom}}</dd>
              </div>
            
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Référence</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{article.reference}}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Marque</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{article.marque}}</dd>
              </div>

              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="block text-sm font-medium text-gray-700">Prix</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{article.prix}}</dd>
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
export default{
props:{
    article:Array,
  },
methods:{
    closeModal(){
        this.$emit('close')
    }
}
}
</script>