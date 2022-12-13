<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import ShowClientVue from '../../Components/Client/ShowClient.vue';
import ToastSuccess from '../../Components/ToastSuccess.vue'

export default {
  components: {
    AppLayout, 
    ShowClientVue,
    ToastSuccess,
},
  props: {
    client:Object,
  },
  methods : {
    closeToastSuccess() {
      this.$page.props.flash.success = null;
    },
  }
}
</script>

<template>
     <AppLayout title="Détail Client">
        <div class="flex justify-center">
            <div class="text-gray-800 my-10 text-2xl font-semibold">Détail du Client</div>
        </div>
        <div class="pb-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                  <Transition>
                    <ToastSuccess
                      v-if="$page.props.flash.success"
                      :message="$page.props.flash.success"
                      @close="closeToastSuccess">
                    </ToastSuccess>
                  </Transition>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <ShowClientVue :client = "client"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>

