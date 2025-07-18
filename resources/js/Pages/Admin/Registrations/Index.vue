<script setup>
import Layout from '@/Layouts/Admin/Layout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps(['registrations', 'users', 'events', 'filters'])

const filterForm = useForm({
  event_id: props.filters.event_id || '',
  user_id: props.filters.user_id || '',
})

const registerForm = useForm({
  user_id: '',
  event_id: '',
})

const removeForm = useForm({
  user_id: '',
  event_id: '',
})

function submitFilter() {
  filterForm.get(route('admin.registrations.index'), { preserveState: true })
}

function submitRegister() {
  registerForm.post(route('admin.registrations.store'))
}

function removeRegistration(user_id, event_id) {
  if (confirm('Remove this registration?')) {
    removeForm.user_id = user_id
    removeForm.event_id = event_id
    removeForm.delete(route('admin.registrations.destroy'))
  }
}
</script>

<template>
  <Layout>
    <h1 class="text-2xl font-bold mb-4">Event Registrations</h1>

    <div class="flex gap-4 mb-6">
      <div>
        <label>Filter by Event:</label>
        <select v-model="filterForm.event_id" class="input">
          <option value="">-- All Events --</option>
          <option v-for="event in events" :key="event.id" :value="event.id">
            {{ event.title }}
          </option>
        </select>
      </div>
      <div>
        <label>Filter by User:</label>
        <select v-model="filterForm.user_id" class="input">
          <option value="">-- All Users --</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
      </div>
      <div class="flex items-end">
        <button @click="submitFilter" class="btn bg-blue-600 text-white">Filter</button>
      </div>
    </div>

    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-2">Add Manual Registration</h2>
      <div class="flex gap-4">
        <select v-model="registerForm.user_id" class="input">
          <option value="">Select user</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>

        <select v-model="registerForm.event_id" class="input">
          <option value="">Select event</option>
          <option v-for="event in events" :key="event.id" :value="event.id">
            {{ event.title }}
          </option>
        </select>

        <button @click="submitRegister" class="btn bg-green-600 text-white">Add</button>
      </div>
    </div>

    <table class="w-full bg-white shadow">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="p-2">User</th>
          <th>Event</th>
          <th class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="reg in registrations.data" :key="reg.id" class="border-t">
          <td class="p-2">{{ reg.user_name }}</td>
          <td>{{ reg.event_title }}</td>
          <td class="text-right">
            <button
              @click="removeRegistration(reg.user_id, reg.event_id)"
              class="text-red-600"
            >Remove</button>
          </td>
        </tr>
      </tbody>
    </table>
  </Layout>
</template>
