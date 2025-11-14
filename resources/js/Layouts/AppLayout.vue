<script setup lang="ts">
  import { Head } from '@inertiajs/vue3';

  interface Props {
    title: string;
  }

  const props = defineProps<Props>();
</script>

<template>
  <Head :title="props.title" />

  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ props.title }}</h1>
      </div>
    </header>

    <main>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <slot />
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
  /* You can add custom styles here */
</style>
