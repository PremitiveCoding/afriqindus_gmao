<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import ShowInterventionVue from '../../Components/Intervention/ShowIntervention.vue';
export default {
  components: {
    AppLayout, 
    ShowInterventionVue
},
  props: {
    intervention:Object,
    articles:Array
  },
}
</script>

<template>
     <AppLayout title="Détail d'intervention">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Détail d'intervention</div>
        </div>
        <div class="pb-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <ShowInterventionVue :intervention = "intervention" :articles = "articles"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>