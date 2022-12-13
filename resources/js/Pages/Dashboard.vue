<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';

export default{
    components: {
        AppLayout,
        Welcome
    },
    props: {
        planifiée:Number,
        achevée:Number,
        annulée:Number,
        clients:Number
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">    
                    <Welcome :clients="clients" :achevée="achevée" :annulée="annulée" :planifiée="planifiée" />
            </div>
        </div>
    </AppLayout>
</template>
