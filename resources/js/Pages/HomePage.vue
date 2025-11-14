<script setup lang="ts">
  import AppLayout from '@/Layouts/AppLayout.vue';

  interface Props {
    appName: string;
    laravelVersion: string;
  }

  const props = defineProps<Props>();
</script>

<template>
  <AppLayout title="Reservations Dashboard">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
      <h2 class="text-2xl font-semibold mb-4">Welcome to {{ props.appName }}!</h2>

      <p class="text-gray-600">
        You are successfully running Laravel **v{{ props.laravelVersion }}** with Octane,
        FrankenPHP, and Vue/TypeScript using Inertia.
      </p>

      <div class="mt-6">
        <a
          href="#"
          class="text-indigo-600 hover:text-indigo-900"
        >
          Start Building Your Reservations System
        </a>
      </div>
    </div>
  </AppLayout>
</template>
