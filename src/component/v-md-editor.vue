<template>
	<VueMarkdownEditor height="100%" :value="value" @change="changeHandler" />
</template>

<script>

import Vue from 'vue'
import VueMarkdownEditor from '@kangc/v-md-editor'

import '@kangc/v-md-editor/lib/style/base-editor.css'

import githubTheme from '@kangc/v-md-editor/lib/theme/github.js'
import createTipPlugin from '@kangc/v-md-editor/lib/plugins/tip/index.js'
import createCopyCodePlugin from '@kangc/v-md-editor/lib/plugins/copy-code/index.js'

import '@kangc/v-md-editor/lib/theme/style/github.css'
import '@kangc/v-md-editor/lib/plugins/tip/tip.css'
import '@kangc/v-md-editor/lib/plugins/copy-code/copy-code.css'

// highlightjs
import hljs from 'highlight.js'

Vue.use(VueMarkdownEditor)

VueMarkdownEditor.use(githubTheme, {
	Hljs: hljs,
	extend(md) {
	},
})

VueMarkdownEditor.use(createTipPlugin())
VueMarkdownEditor.use(createCopyCodePlugin())

export default {
	name: 'VMdEditor',
	components: {
		VueMarkdownEditor,
	},
	props: ['value'],
	data() {
		return {
			content: '111',
		}
	},
	methods: {
		changeHandler(v) {
			this.$emit('input', v)
		},
	},
}
</script>
<style scoped>
</style>
