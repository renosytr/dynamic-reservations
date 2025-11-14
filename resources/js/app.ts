import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import type { DefineComponent } from 'vue';

void createInertiaApp({
  title: (title) => `${title} - Dynamic Reservations`,

  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
    const page = pages[`./Pages/${name}.vue`] as { default: DefineComponent };
    return page.default;
  },

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});
