<script setup>
import { useForm, router } from '@inertiajs/vue3'
import Form from './Form.vue'

const props = defineProps({
  event: Object
})

const form = useForm({
  title: props.event.title,
  description: props.event.description,
  event_date: props.event.event_date,
  location: props.event.location,
  capacity: props.event.capacity,
  status: props.event.status
})

function submit() {
  form.put(`/admin/events/${props.event.id}`)
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Edit Event</h1>
    <Form :form="form" mode="edit" @submit="submit" />
  </div>
</template>
