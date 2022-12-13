<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Calendar
      </h2>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <Calendar @dateClick="Click" />
          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import Calendar from "../../Components/Calendar.vue";
import FormIntervention from "../../Components/Intervention/FormIntervention.vue";
import { Inertia } from '@inertiajs/inertia';
import moment from "moment";
export default {
  name: "interventions",
  components: { Calendar, AppLayout, FormIntervention },
  data() {
    return {
      showForm: false,
      newEvent: {
        title: "",
        date_at: "",
        hour: "",
        user_id: "",
        session: "",
      },
    };
  },
   computed: {
   
  },
  methods: {
    dateTime(value) {
      return moment(value).format("YYYY-MM-DD HH:MM");
    },
    Click(arg) {
      
      Inertia.get(route('interventions.create'),  {date_debut : this.dateTime(arg.startStr) ,date_fin :this.dateTime(arg.endStr)})
    },
   
  },
};
</script>

<style>
</style>