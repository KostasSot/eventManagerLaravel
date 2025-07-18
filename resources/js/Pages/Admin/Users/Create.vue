<script setup>
import Layout from '@/Layouts/Admin/Layout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user'
})

function submit() {
  form.post(route('admin.users.store'))
}
</script>

<template>
  <Layout>
    <h1 class="text-2xl font-bold mb-4">Add User</h1>

    <div class="space-y-4">
      <div>
        <label>Name</label>
        <input v-model="form.name" class="input w-full" />
      </div>
      <div>
        <label>Email</label>
        <input v-model="form.email" type="email" class="input w-full" />
      </div>
      <div>
        <label>Password</label>
        <input v-model="form.password" type="password" class="input w-full" />
      </div>
      <div>
        <label>Confirm Password</label>
        <input v-model="form.password_confirmation" type="password" class="input w-full" />
      </div>
      <div>
        <label>Role</label>
        <select v-model="form.role" class="input w-full">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <button @click="submit" class="btn bg-blue-600 text-white">Save</button>
    </div>
  </Layout>
</template>
