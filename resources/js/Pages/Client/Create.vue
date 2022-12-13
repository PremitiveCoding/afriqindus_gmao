<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormClient from '../../Components/Client/FormClient.vue';
</script>

<template>
    <AppLayout  title="Nouveau client">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Nouveau Client</div>
        </div>
        <div class="pb-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <FormClient ></FormClient>
                </div>
            </div>
        </div>
    </AppLayout>
</template>