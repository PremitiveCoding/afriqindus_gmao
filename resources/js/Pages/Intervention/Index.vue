<script >
import AppLayout from '@/Layouts/AppLayout.vue';

import ListVue from '../../Components/Intervention/List.vue';

export default {
  components: {
    AppLayout,
    ListVue
},
  props: {
    interventions: Object,
  },
}
</script>

<template>
    <AppLayout title="Interventions">
        
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ListVue :interventions="interventions"/>
            </div>
        </div>
        
    </AppLayout>
</template>

