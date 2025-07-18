<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-700">Admin Panel</h1>
      <div class="text-sm text-gray-600">{{ page.props.auth.user.name }}</div>
    </header>

    <!-- Flash message -->
    <div v-if="page.props.flash.success" class="p-4 bg-green-100 text-green-800 border border-green-300 m-4 rounded">
      {{ page.props.flash.success }}
    </div>

    <!-- Page content -->
    <main class="p-6">
      <slot />
    </main>
  </div>
</template>
