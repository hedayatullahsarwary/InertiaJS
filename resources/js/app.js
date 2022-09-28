import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import { InertiaProgress, inertiaProgress } from '@inertiajs/progress'
import Layout from "./Shared/Layout";

createInertiaApp({
  resolve: async name => {
    let page = (await import(`./Pages/${name}`)).default;

    //---Check if do not have a layout then assign it.
    page.layout ??= Layout;

    return page;
  },

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .component("Head", Head)
      .mount(el)
  },
  
  title: title => title ? `${title} - My App` : 'My App'
});

InertiaProgress.init({
  color: 'red',
  showSpinner: true
});