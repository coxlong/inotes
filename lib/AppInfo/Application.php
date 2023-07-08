<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: coxlong <coxlong@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\INotes\AppInfo;

use OCP\AppFramework\App;

class Application extends App {
	public const APP_ID = 'inotes';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
}
