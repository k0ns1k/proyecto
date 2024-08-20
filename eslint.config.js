import pluginVue from 'eslint-plugin-vue'
import tseslint from 'typescript-eslint'
export default [
    // add more generic rulesets here, such as:
    // js.configs.recommended,
    ...tseslint.configs['recommended'],
    ...pluginVue.configs['flat/recommended'],
    // ...pluginVue.configs['flat/vue2-recommended'], // Use this if you are using Vue.js 2.x.
    {
        rules: {
            // override/add rules settings here, such as:
            '@typescript-eslint/no-explicit-any': 'off',
            'vue/multi-word-component-names': 'off',
            '@typescript-eslint/ban-ts-comment': 'off',
        }
    }
]
