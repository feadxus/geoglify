import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import vuetify from "./vuetify";
import fetchInterceptor from "./fetchInterceptor";
import CountryFlag from "vue-country-flag-next";
import { vMaska } from "maska/vue";
import moment from "moment-timezone";
import { createI18n } from "vue-i18n";

// Import translation files
import en from "./translations/en.json";
import pt from "./translations/pt.json";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        // Get locale from Inertia props or default to 'en'
        const locale = props.initialPage.props.locale || "en";

        // Create i18n instance with imported translations
        const i18n = createI18n({
            legacy: false,
            locale: locale,
            fallbackLocale: "en",
            messages: {
                en,
                pt,
            },
            globalInjection: true,
        });

        return createApp({ render: () => h(App, props) })
            .directive("maska", vMaska)
            .use(plugin)
            .use(ZiggyVue)
            .use(fetchInterceptor)
            .use(CountryFlag)
            .use(i18n)
            .use(vuetify)
            .mixin({
                methods: {
                    formatDateTimeUTCtoPT(value) {
                        if (!value) return "";
                        let datetimeUTC = moment.tz(value, "UTC");
                        let datetimePT = datetimeUTC
                            .clone()
                            .tz("Europe/London");
                        return datetimePT.format("DD/MM/YYYY HH:mm");
                    },
                    formatDateUTCtoPT(value) {
                        if (!value) return "";
                        let dateUTC = moment.tz(value, "UTC");
                        let datePT = dateUTC.clone().tz("Europe/London");
                        return datePT.format("DD/MM/YYYY");
                    },
                },
            })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
