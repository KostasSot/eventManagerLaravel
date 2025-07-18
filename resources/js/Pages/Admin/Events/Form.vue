<script setup>
defineProps({
  form: Object,
  mode: String
})

</script>

<template>
  <form @submit.prevent="$emit('submit')">
    <div class="mb-4">
      <label class="block">Title</label>
      <input type="text" v-model="form.title" class="w-full border rounded px-2 py-1" />
    </div>

    <div class="mb-4">
      <label class="block">Description</label>
      <textarea v-model="form.description" class="w-full border rounded px-2 py-1" />
    </div>

    <div class="mb-4">
      <label class="block">Event Date</label>
      <input type="date" v-model="form.event_date" class="w-full border rounded px-2 py-1" />
    </div>

    <div class="mb-4">
      <label class="block">Location</label>
      <input type="text" v-model="form.location" class="w-full border rounded px-2 py-1" />
    </div>

    <div class="mb-4">
      <label class="block">Capacity</label>
      <input type="number" v-model="form.capacity" class="w-full border rounded px-2 py-1" />
    </div>

    <div class="mb-4">
      <label class="block">Status</label>
      <select v-model="form.status" class="w-full border rounded px-2 py-1">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
        <option value="cancelled">Cancelled</option>
      </select>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
      {{ mode === 'create' ? 'Create Event' : 'Update Event' }}
    </button>
  </form>
</template>
