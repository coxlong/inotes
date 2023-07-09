<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: coxlong <coxlong@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\INotes\Service;

use Exception;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;


use OCP\Files\File;
use OCP\Files\IRootFolder;
use OC\User\NoUserException;
use OCP\Files\NotFoundException;

class FileService {
	private string $userId;
	private IRootFolder $rootFolder;

	public function __construct($userId, IRootFolder $rootFolder) {
		$this->userId = $userId;
		$this->rootFolder = $rootFolder;
	}

	public function getFileById($fileId, $userId = null): File {
		$userId = $userId ?? $this->userId;

		if ($userId === null) {
			throw new Exception('user is required');
		}

		try {
			$userFolder = $this->rootFolder->getUserFolder($userId);
		} catch (\OC\User\NoUserException $e) {
			// It is a bit hacky to depend on internal exceptions here. But it is the best we can do for now
			throw new NotFoundException();
		}

		$files = $userFolder->getById($fileId);
		if (count($files) === 0) {
			throw new NotFoundException();
		}

		// Workaround to always open files with edit permissions if multiple occurences of
		// the same file id are in the user home, ideally we should also track the path of the file when opening
		usort($files, function (Node $a, Node $b) {
			return ($b->getPermissions() & Constants::PERMISSION_UPDATE) <=> ($a->getPermissions() & Constants::PERMISSION_UPDATE);
		});

		$file = array_shift($files);

		if (!$file instanceof File) {
			throw new NotFoundException();
		}

		return $file;
	}

}
