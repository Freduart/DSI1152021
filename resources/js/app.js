require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';
import VueApexCharts from 'vue3-apexcharts';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(LaravelPermissionToVueJS)
    .use(VueApexCharts)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
