<script setup>
import { Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

defineProps({
  events: Object
})



function deleteEvent(id) {
  if (confirm('Are you sure you want to delete this event?')) {
    router.delete(`/admin/events/${id}`)
  }
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Events</h1>

    <Link href="/admin/events/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
      + New Event
    </Link>

    <table class="table-auto w-full border">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-2 border">Title</th>
          <th class="p-2 border">Date</th>
          <th class="p-2 border">Status</th>
          <th class="p-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in events.data" :key="event.id">
          <td class="p-2 border">{{ event.title }}</td>
          <td class="p-2 border">{{ event.event_date }}</td>
          <td class="p-2 border">{{ event.status }}</td>
          <td class="p-2 border">
            <Link :href="`/admin/events/${event.id}/edit`" class="text-blue-600 mr-2">Edit</Link>
            <button @click="deleteEvent(event.id)" class="text-red-600">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

