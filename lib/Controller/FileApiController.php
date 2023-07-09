<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: coxlong <coxlong@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\INotes\Controller;

use OCA\INotes\AppInfo\Application;
use OCA\INotes\Service\FileService;
use OCP\AppFramework\ApiController;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;

class FileApiController extends ApiController {
	private FileService $service;
	private ?string $userId;

	use Errors;

	public function __construct(IRequest $request,
								FileService $service,
								?string $userId) {
		parent::__construct(Application::APP_ID, $request);
		$this->service = $service;
		$this->userId = $userId;
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 */
	public function index(): DataResponse {
		$fileId = (int)$this->request->getParam('fileId');
		$file = $this->service->getFileById($fileId);

		return new DataResponse(['content' => $file->getContent(), 'md5' => $file->hash('md5'), 'ft' => $fileId]);
	}

	/**
	 * @CORS
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 */
	public function update(): DataResponse {
		$fileId = (int)$this->request->getParam('fileId');
		$content = (string)$this->request->getParam('content');
		$history = (string)$this->request->getParam('history');


		$file = $this->service->getFileById($fileId);

		$file_md5 = $file->hash('md5');

		if ($history != $file_md5) {
			return new DataResponse([
				'error' => '文件已被其他地方更新'
			], Http::STATUS_BAD_REQUEST);
		}

		$file->putContent($content);

		return new DataResponse([
			'md5' => $file->hash('md5'),
		]);
	}

}
