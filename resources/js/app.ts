import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import type { DefineComponent } from 'vue';
import AppLayout from './layouts/applayout.vue';

const noLayoutPages = [
	'Auth/Login',
	'Auth/Register',
	'Auth/ForgotPassword',
	'Auth/ResetPassword',
	'Auth/VerifyEmail',
	'Auth/ConfirmPassword',
	'Auth/TwoFactorChallenge',
];

createInertiaApp({
	resolve: async (name) => {
		const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue'));
		page.default.layout = noLayoutPages.includes(name) ? undefined : AppLayout;
		return page;
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.mount(el);
	},
});
