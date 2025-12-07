// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import "@mdi/font/css/materialdesignicons.css";

const customeTheme = {
    dark: false,
    colors: {
        primary: "#1677ff",
        lightprimary: "#e6f4ff",
        darkprimary: "#0958d9",
        primary200: "#a1d2ff",
        secondary: "#8c8c8c",
        lightsecondary: "#f5f5f5",
        darksecondary: "#7a7878",
        secondary200: "#eeeeee",
        accent: "#ffab91",
        error: "#ff4d4f",
        lighterror: "#ffe7d3",
        info: "#13c2c2",
        success: "#52c41a",
        lightsuccess: "#eafcd4",
        warning: "#faad14",
        lightwarning: "#fff6d0",
        darkText: "#212121",
        lightText: "#8c8c8c",
        borderLight: "#e6ebf1",
        inputBorder: "#a1a1a5",
        containerBg: "#fafafb",
        background: "#ffffff",
        gray100: "#f5f5f5",
    },
};

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: "mdi",
    },
    theme: {
        defaultTheme: "customeTheme",
        themes: {
            customeTheme,
        },
    },
});

export default vuetify;
