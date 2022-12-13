<script >
import AppLayout from '@/Layouts/AppLayout.vue';

import ListVue from '../../Components/Client/List.vue';

export default {
  components: {
    AppLayout,
    ListVue
},
  props: {
    clients: Object,
  },
}
</script>

<template>
    <AppLayout title="Clients">
        
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ListVue :clients="clients"/>
            </div>
        </div>
        
    </AppLayout>
</template>

