<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import FormIntervention from '../../Components/Intervention/FormIntervention.vue';

export default{
    components: {
    AppLayout,
    FormIntervention,
},
  props: {
    fournisseurs: Array,
    user: Array,
    sites: Array,
    date_debut : Date,
    date_fin : Date,
  },
}
</script>

<template>
    <AppLayout title="Création d'intervention">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Nouvelle intervention</div>
        </div>
        <div class="pb-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <FormIntervention :user_id="user.id" :sites="sites" :date_debut="date_debut" :date_fin="date_fin" :fournisseurs="fournisseurs"></FormIntervention>
                </div>
            </div>
        </div>
    </AppLayout>
</template>