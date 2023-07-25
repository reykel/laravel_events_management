import './bootstrap';

import { createApp, h } from 'vue';

import { i18nVue } from 'laravel-vue-i18n';

import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import ElementPlus from 'element-plus';
import '../css/app.css';
//import { VueReCaptcha, useReCaptcha } from 'vue-recaptcha-v3'
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'European Events Management 2022';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
   //     const captchaKey = props.initialPage.props.recaptcha_site_key;
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(i18nVue, { 
                resolve: (lang) => import(`../../lang/${lang}.json`) 
            })
            .use(ElementPlus)
         /*   .use(VueReCaptcha, { siteKey: captchaKey,loaderOptions: {
                    useRecaptchaNet: true
                } } )*/
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
