<template>
	<div id="main-container" class="text-editor">
		<!-- <button @click="saveFile">
			保存
		</button>
		<input v-model="flag" type="checkbox"> -->
		<!-- <VMdEditor v-if="flag" v-model="content" /> -->
		<Vditor v-model="content" />
	</div>
</template>

<script>
import { getFile, saveFile } from '../api/files.js'

import Vditor from '../component/vditor.vue'
import VMdEditor from '../component/v-md-editor.vue'

export default {
	name: 'FileViewer',

	components: {
		Vditor,
		VMdEditor,
	},
	props: {
		filename: {
			type: String,
			default: null,
		},
		fileid: {
			type: Number,
			default: null,
		},
		active: {
			type: Boolean,
			default: false,
		},
		autofocus: {
			type: Boolean,
			default: true,
		},
		mime: {
			type: String,
			default: null,
		},
		showOutlineOutside: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			md5: '',
			content: '',
			flag: false,
		}
	},

	async mounted() {
		getFile(this.fileid).then(res => {
			this.content = res.content
			this.md5 = res.md5
			this.doneLoading()
		})
	},
	methods: {
		saveFile() {
			saveFile(this.fileid, this.content, this.md5).then(res => {
				this.md5 = res.md5
			})
		},
	},
}
</script>
<style lang="scss" scoped>
.text-editor {
	overflow: scroll;
    width: 100%;
    height: 100%;
}
</style>
<style lang="scss">
@media only screen and (max-width: 512px) {
	.text-editor {
		top: auto;
	}
}
