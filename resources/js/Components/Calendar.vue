<template> <div>
  <FullCalendar :options="calendarOptions" />
  </div>
</template>

<script>

import '@fullcalendar/core/vdom' // solve problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
       calendarOptions: {
        plugins: [
          dayGridPlugin,
          timeGridPlugin,
          interactionPlugin // needed for dateClick
        ],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        height:"auto",
        initialView: 'dayGridMonth',
         editable: true,
        selectable: true,
        selectMirror: true,
        allDaySlot : false ,
        select: this.handleDateClick,
       }
    }
  },
  beforeMount(){
    this.$data.calendarOptions.events ={
      url : route('interventions.json'),
      method : 'GET'
    }
  },
 
  methods:{
    handleDateClick(click){
      this.$emit('dateClick',click)
    }
  }
}
</script>

<style>

</style>