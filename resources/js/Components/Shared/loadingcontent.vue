<template>
  <transition name="modal-fade">
    <div class="fixed z-10 inset-0 overflow-y-auto ">
      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 " aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-50" ></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span>

        <div
          class="inline-block justify-center align-bottom rounded-xl text-center overflow-hidden shadow-sm transition-all sm:my-8 sm:align-middle sm:max-w-fit sm:w-full"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
        <img :src="'/img/spinner.svg'">

          
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  name: "modal",
  props: {
    modalHeadline: {
      type: String,
      required: true,
    },
    deleteMessage: {
      type: String,
      required: true,
    },
  },
  methods: {
    close() {
      this.$emit("close");
    },
    deleteRecord() {
      this.$emit('deleteRecordEvent');
      this.$emit("close");
    },
  },
};
</script>

<style>
.modal-fade-enter-active{
  transition: opacity 0.2s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>
