import FileViewer from './views/file-viewer.vue'

OCA.Viewer.registerHandler({
	id: 'md',

	mimes: [
		'text/markdown',
	],
	theme: 'default',

	component: FileViewer,
})
