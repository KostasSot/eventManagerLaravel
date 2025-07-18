<script setup>
import Layout from '@/Layouts/Admin/Layout.vue'
import { router } from '@inertiajs/vue3'

defineProps(['users'])

function destroy(id) {
  if (confirm('Are you sure you want to delete this user?')) {
    router.delete(route('admin.users.destroy', id))
  }
}
</script>

<template>
  <Layout>
    <div class="flex justify-between mb-4">
      <h1 class="text-xl font-bold">Users</h1>
      <a :href="route('admin.users.create')" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add User</a>
    </div>

    <table class="w-full bg-white shadow">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="p-2">Name</th>
          <th>Email</th>
          <th>Role</th>
          <th class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users.data" :key="user.id" class="border-t">
          <td class="p-2">{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role }}</td>
          <td class="text-right space-x-2">
            <a :href="route('admin.users.edit', user.id)" class="text-blue-600">Edit</a>
            <button @click="destroy(user.id)" class="text-red-600">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </Layout>
</template>
