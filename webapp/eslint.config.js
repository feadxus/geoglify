import js from "@eslint/js";
import eslintPluginVue from 'eslint-plugin-vue';
import eslintConfigPrettier from '@vue/eslint-config-prettier';

export default [
    js.configs.recommended,
    ...eslintPluginVue.configs['flat/recommended'],
    eslintConfigPrettier,
    {
        rules: {
            'vue/multi-word-component-names': 'off',
            'vue/valid-v-slot': ['error', { allowModifiers: true }],
        },
        languageOptions: {
            globals: {
                route: 'readonly',
                console: 'readonly',
                URL: 'readonly',
                window: 'readonly',
                fetch: 'readonly',
            }
        }
    }
];
