<?php
/**
 * ownCloud - readlater
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Ruchita <ruchita@berkeley.edu>
 * @copyright Ruchita 2014
 */

namespace OCA\ReadLater\Controller;


use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Http\JSONResponse;

use \OCA\ReadLater\AppInfo\Application;


class PageControllerTest extends \PHPUnit_Framework_TestCase {

	private $container;

	public function setUp () {
		$app = new Application();
		$this->container = $app->getContainer();
	}


	public function testIndex () {
		// swap out request
		$this->container['Request'] = $this->getMockBuilder('\OCP\IRequest')
			->getMock();
		$this->container['UserId'] = 'john';

		$result = $this->container['PageController']->index();

		$this->assertEquals(array('user' => 'john'), $result->getParams());
		$this->assertEquals('main', $result->getTemplateName());
		$this->assertTrue($result instanceof TemplateResponse);
	}


	public function testEcho () {
		$result = $this->container['PageController']->doEcho('hi');

		$this->assertEquals(array('echo' => 'hi'), $result);
	}


}