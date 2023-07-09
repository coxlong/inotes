import axios from '@nextcloud/axios'
import { showError } from '@nextcloud/dialogs'

const request = axios.create({
	timeout: 600000,
})

const errorHandler = error => {
	showError(t('request', error.response.data.error))
	return Promise.reject(error)
}

request.interceptors.response.use(response => {
	if (response.data) {
		if (response.status === 200 || response.status === 201) {
			return Promise.resolve(response.data)
		}
		showError(t('request', 'response.status is ' + response.status))
		return Promise.reject(response)
	}
	showError(t('request', 'response.data is null'))
	return Promise.reject(response)
}, errorHandler)

export default request
