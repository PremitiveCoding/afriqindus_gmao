<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import FormInterventionVue from '../../Components/Intervention/FormIntervention.vue';
import EditVue from '../../Components/Intervention/Edit.vue';
export default {
  components: {
    AppLayout,
    FormInterventionVue, 
    EditVue, 
  },
  props: {
    intervention:Object,
    sites: Array,
    articles:Object,
  },
}
</script>
<template>
    <AppLayout title="Modification d'intervention">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Modification d'intervention</div>
        </div>
        <div class="pb-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <EditVue :intervention="intervention" :sites="sites" :articles="articles"></EditVue>
                </div>
            </div>
        </div>
    </AppLayout>
</template>