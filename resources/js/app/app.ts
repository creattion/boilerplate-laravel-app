import '../../css/app/app.css';
import './bootstrap';

import AuthLayout from '@app/Layouts/AuthLayout.vue';
import DashboardLayout from '@app/Layouts/DashboardLayout.vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { vMaska } from 'maska/vue';
import money from 'v-money3';
import { createApp, DefineComponent, h } from 'vue';
import { modal } from '../../../vendor/emargareten/inertia-modal';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title} | ${appName}`,
  resolve: async (name) => {
    const page = await resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
    );

    if (name.startsWith('Auth/')) {
      page.default.layout = page.default.layout || AuthLayout;

      return page;
    }

    page.default.layout = page.default.layout || DashboardLayout;

    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(modal, {
        resolve: (name: string) =>
          resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
          ),
      })
      .use(money)
      .directive('maska', vMaska)
      .use(ZiggyVue)
      .mount(el);
  },
  progress: {
    color: '#ff6200',
  },
});
