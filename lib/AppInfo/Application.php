<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: coxlong <coxlong@qq.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\INotes\AppInfo;

use OCA\INotes\Listeners\LoadViewerListener;

use OCA\Viewer\Event\LoadViewer;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
// use OCP\AppFramework\Http\Events\BeforeTemplateRenderedEvent;
// use OCP\Security\CSP\AddContentSecurityPolicyEvent;

class Application extends App implements IBootstrap {
	public const APP_ID = 'inotes';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
	
	public function register(IRegistrationContext $context): void {
		$context->registerEventListener(LoadViewer::class, LoadViewerListener::class);
		// $context->registerEventListener(BeforeTemplateRenderedEvent::class, LoadPublicViewerListener::class);
		// $context->registerEventListener(AddContentSecurityPolicyEvent::class, CSPListener::class);
	}
	public function boot(IBootContext $context): void {
	}
}
