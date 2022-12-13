<template>
<div class="col-span-6 sm:col-span-6">
    <label class="block text-sm font-medium text-gray-700"> Documents </label>
    <div @drop.prevent="dropHandler($event,'dragDiv')" @dragover.prevent="dragEnter()" @dragenter.prevent="dragEnter()" @dragleave.prevent="dragLeave()" :class="{'border-gray-400 bg-gray-100' : dragOver}" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <div class="space-y-1 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <div class="flex text-sm text-gray-600">
            <input ref="picker" type="file" accept="image/*,application/pdf" class="hidden" multiple @change="change">
            <button type="button" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500" @click="browse">Upload a document</button>
            <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
        </div>
    </div>
</div>
</template>
<script>

export default{
    props:{
    },
    data() {
        return{
            dragOver:false,
        }
    },
    methods:{
        browse(){
            this.$refs.picker.click();
        },
        change(e){
            this.$emit('input', e.target.files);
            this.$refs.picker.value = null;
        },
        dropHandler(e){
            this.$emit('input', e.dataTransfer.files);
            this.$refs.picker.value = null;
            this.dragOver=false;
        },
        dragEnter(){
            this.dragOver=true;
        },
        dragLeave(){
            this.dragOver=false;
        }
    }
}
</script>