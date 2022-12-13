<template>
<div class="w-full rounded-full h-1.5 mt-2 border">
  <div class="bg-gray-500 h-1 rounded-full" :style="{width: getProgress}"></div>
</div>
</template>
<script>

export default{
    props: {
        progress: {
            type: Number,
            default: 0
        }
    },
    computed: {
        getProgress() {
            return Math.round(this.progress) + '%'
        }
    }

}
</script>