<script setup>
import Layout from '@/Layouts/Admin/Layout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps(['user'])

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  role: props.user.role,
})

function submit() {
  form.put(route('admin.users.update', props.user.id))
}
</script>

<template>
  <Layout>
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <div class="space-y-4">
      <div>
        <label>Name</label>
        <input v-model="form.name" class="input w-full" />
      </div>
      <div>
        <label>Email</label>
        <input v-model="form.email" class="input w-full" />
      </div>
      <div>
        <label>Role</label>
        <select v-model="form.role" class="input w-full">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <button @click="submit" class="btn bg-green-600 text-white">Update</button>
    </div>
  </Layout>
</template>
