<script>

import { Link } from '@inertiajs/inertia-vue3'
import ButtonVue from '../../Jetstream/Button.vue';
import { Inertia } from "@inertiajs/inertia";
import PaginationVue from "../Pagination.vue";
import DeleteToast from "../DeleteToast.vue";
import ToastSuccess from '../ToastSuccess.vue';


 
export default {
  components :{
    Link,
    ButtonVue,
    PaginationVue,
    DeleteToast,
    ToastSuccess
},
  props:{
    clients : Object,
    isConfirmDeleteModalVisible : Boolean,
  },
  data() {
    return {
      isConfirmDeleteModalVisible: false,
    };
  },
  methods:{
    destroy(id) {
        Inertia.delete(route('clients.destroy', id));
    },
    showConfirmDeleteModal(record) {
      this.isConfirmDeleteModalVisible = record.id;
    },
    closeConfirmDeleteModal() {
      this.isConfirmDeleteModalVisible = false;
    },
    closeToastSuccess() {
      this.$page.props.flash.success = null;
    },
  },
}
</script>
<template>
  <Transition>
      <ToastSuccess
          v-if="$page.props.flash.success"
          class="absolute bottom-0 right-0"
          :message="$page.props.flash.success"
          @close="closeToastSuccess">
      </ToastSuccess>
  </Transition>
  <div class="flex flex-col">
    <div class="inline-flex my-8 justify-end items-center">
      <div class="mr-auto text-gray-800 text-2xl font-semibold"><h1>Clients</h1></div>
      <Link :href="route('clients.create')">
      <button
        type="button"
        data-mdb-ripple="true"
        data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 float-right bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      >Ajouter Client</button>
      </Link>
    </div>
    
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Addresse</th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
             
              <tr v-for="person in clients.data" :key="person.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ person.prenom}} {{ person.nom}} 
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ person.email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ person.tele }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                 {{ person.adresse }}
                </td>
                <td class="px-6 whitespace-nowrap py-7 ml-4 flex flex-row items-center justify-center">
                  
                  <Link :href="route('clients.show',person.id)" class="flex-shrink-0 rounded-full hover:bg-blue-100 text-blue-700 cursor-pointer mr-4"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"> <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/> <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/> </svg></Link>
                  <Link :href="route('clients.edit',person.id)" class="flex-shrink-0 rounded-full hover:bg-orange-100 text-orange-500 cursor-pointer mr-4"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3" id="IconChangeColor"><path d="M12 20h9" id="mainIconPathAttribute" fill="#ffffff" stroke="fillCurrent"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" id="mainIconPathAttribute" fill="#ffffff" stroke="#ff9500"></path></svg></Link>

                          <button
                          @click="showConfirmDeleteModal(person)"
                          class="rounded-full hover:bg-red-100 cursor-pointer"
                          type="button">
                            <svg style="color: #DC2626" xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" fill="#DC2626"></path> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" fill="#DC2626"></path> </svg>
                          </button>
                          <div class="flex align-items justify-center">
                          <DeleteToast
                            v-show="isConfirmDeleteModalVisible == person.id"
                            modalHeadline="Supprimer client"
                            deleteMessage="Etes-vous sûr?"
                            @deleteRecordEvent="destroy(person.id)"
                            @close="closeConfirmDeleteModal"
                            >
                          </DeleteToast>
                          </div>
                 
                </td>
              </tr>
            </tbody>
          </table>
          <PaginationVue class="my-4" :links="clients.links" />
          
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>

