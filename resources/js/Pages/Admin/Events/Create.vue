<script setup>
import { useForm } from '@inertiajs/vue3'
    import Form from './Form.vue'

    const form = useForm({
        title: '',
        description: '',
        event_date: '',
        location: '',
        capacity: 0,
        status: 'draft',
    })

    function submit() {
    form.post('/admin/events')
    }
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Create Event</h1>
    <Form :form="form" :mode="'create'" @submit="submit" />
  </div>
</template>
