<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import FormClientVue from '../../Components/Client/FormClient.vue';
import EditVue from '../../Components/Client/Edit.vue';
export default {
  components: {
    AppLayout,
    FormClientVue, 
    EditVue, 
  },
  props: {
    client:Object,
  },
}
</script>
<template>
    <AppLayout title="Modification du client">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Modification du Client</div>
        </div>
        <div class="pb-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <EditVue :client="client"></EditVue>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
