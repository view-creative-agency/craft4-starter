import {defineConfig} from 'vite';
import manifestSRI from 'vite-plugin-manifest-sri';
import path from 'path';
import viteCompression from 'vite-plugin-compression';
import ViteRestart from 'vite-plugin-restart';

// https://vitejs.dev/config/
/** @type {import('vite').UserConfig} */
export default defineConfig(({command}) => ({
	base: command === 'serve' ? '' : '/dist/',
	publicDir: path.resolve(__dirname, 'src/public'),
	resolve: {
		alias: {
			'@': path.resolve(__dirname, 'src'),
			'@css': path.resolve(__dirname, 'src/pcss'),
			'@js': path.resolve(__dirname, 'src/js'),
		},
	},

	build: {
		outDir: path.resolve(__dirname, 'web/dist/'),
		emptyOutDir: true,
		manifest: true,
		commonjsOptions: {
			transformMixedEsModules: true,
		},
		rollupOptions: {
			input: {
				app: path.resolve(__dirname, 'src/js/app.js'),
			},
			output: {
				sourcemap: true
			},
		},
	},

	plugins: [
		manifestSRI(),
		viteCompression({
			filter: /\.(js|mjs|json|css|map)$/i
		}),
		ViteRestart({
			reload: [
				'templates/**/*',
			],
		}),
	],

	server: {
		host: '0.0.0.0',
		port: 3000,
		strictPort: true,
		// origin: 'https://localhost:3000'
	},
}));
