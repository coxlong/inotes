import { generateUrl } from '@nextcloud/router'
import request from '../utils/request.js'

/**
 *
 * @param fileId
 */
export function getFile(fileId) {
	return request({
		url: generateUrl('/apps/inotes/api'),
		method: 'get',
		params: { fileId },
	})
}

/**
 *
 * @param fileId
 * @param content
 * @param history
 */
export function saveFile(fileId, content, history) {
	return request({
		url: generateUrl('/apps/inotes/api'),
		method: 'put',
		data: { fileId, content, history },
	})
}
