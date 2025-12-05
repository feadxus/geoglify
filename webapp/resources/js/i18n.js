import { createI18n } from "vue-i18n";

// Função para carregar traduções do Laravel
function loadLocaleMessages() {
    const messages = {};

    // As traduções serão injetadas via Inertia props
    // Por enquanto, retornamos um objeto vazio que será preenchido dinamicamente
    return messages;
}

const i18n = createI18n({
    legacy: false, // Use Composition API
    locale: "en", // Idioma padrão
    fallbackLocale: "en",
    messages: loadLocaleMessages(),
    globalInjection: true, // Permite usar $t em todos os componentes
});

export default i18n;
