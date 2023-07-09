<template>
	<div id="vditor" class="inodes-vditor" />
</template>

<script>

import Vditor from 'vditor'
import 'vditor/dist/index.css'

export default {
	name: 'Vditor',
	props: ['value'],
	data() {
		return {
			contentEditor: undefined,
			inited: false,
		}
	},
	watch: {
		value(n, o) {
			if (this.inited && this.contentEditor.getValue() !== n) {
				this.contentEditor.setValue(this.value)
			}
		},
	},
	mounted() {
		this.contentEditor = new Vditor('vditor', {
			width: '100%',
			height: '100%',
			toolbarConfig: {
				pin: true,
			},
			fullscreen: {
				index: 100010,
			},
			cache: {
				enable: true,
			},
			mode: 'wysiwyg',
			after: () => {
				this.inited = true
				this.contentEditor.setValue(this.value)
			},
			input: md => {
				this.$emit('input', md)
			},
		})
	},
}
</script>
<style lang="scss">
.inodes-vditor {
	.vditor-panel {
		button {
			padding: 0 3px 0 3px;
			margin: 0;
			min-height: 0;
			background-color: white;
			border-radius: 0;
			border: none;
		}
		span {
			display: block;
			height: 0;
			input {
				margin: 0;
				min-height: 0;
				height: auto !important;
				border: none;
			}
		}
	}
}
</style>
