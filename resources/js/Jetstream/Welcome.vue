<script>
import { Link } from '@inertiajs/inertia-vue3';
export default{
    components: {
        Link
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
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-items-center">    
            <div class="flex flex-col justify-center items-center p-4 w-60 h-40 hover:h-44 hover:w-64 transition-all bg-white shadow-sm rounded-lg">
                <div class="w-20 flex justify-center h-20 rounded-full bg-orange-400 bg-opacity-50"><img :src="'/img/working-tools-svgrepo-com.svg'"/></div>
                <div class="mt-4">{{planifiée}} Interventions planifiées </div>
            </div>
            <div class="flex flex-col justify-center items-center p-4 w-60 h-40 hover:h-44 hover:w-64 transition-all bg-white shadow-sm rounded-lg">
                <div class="flex justify-center w-20 h-20 rounded-full bg-green-500 bg-opacity-60"><img :src="'/img/shield-done-svgrepo-com.svg'"/></div>
                <div class="mt-4">{{achevée}} Interventions effectuées </div>
            </div>
            <div class="flex flex-col justify-center items-center p-4 w-60 h-40 hover:h-44 hover:w-64 transition-all bg-white shadow-sm rounded-lg">
                <div class="flex justify-center w-20 h-20 rounded-full bg-red-500 bg-opacity-50"><img :src="'/img/cancel-svgrepo-com.svg'"/></div>
                <div class="mt-4">{{annulée}} Interventions annulées </div>
            </div>
            <div class="flex flex-col justify-center items-center p-4 w-60 h-40 hover:h-44 hover:w-64 transition-all bg-white shadow-sm rounded-lg">
                <div class="flex justify-center w-20 h-20 rounded-full bg-gray-400 bg-opacity-50"><img :src="'/img/person-svgrepo-com.svg'"/></div>
                <div class="flex mt-4">{{clients}} Clients &nbsp;<Link :href="route('clients.index')" class="rounded-full text-blue-700 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right ml-auto" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/> <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/> </svg></Link></div>
            </div>
        </div>
    </div>
</template>
