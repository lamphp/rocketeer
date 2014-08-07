<?php
namespace Abstracts;

use Rocketeer\TestCases\RocketeerTestCase;

class StorageTest extends RocketeerTestCase
{

	public function testCanSwapContents()
	{
		$matcher = ['foo' => 'caca'];
		$this->localStorage->set($matcher);
		$contents = $this->localStorage->get();
		unset($contents['hash']);

		$this->assertEquals($matcher, $contents);
	}

	public function testCanGetValue()
	{
		$this->assertEquals('bar', $this->localStorage->get('foo'));
	}

	public function testCanSetValue()
	{
		$this->localStorage->set('foo', 'baz');

		$this->assertEquals('baz', $this->localStorage->get('foo'));
	}

	public function testCanDestroy()
	{
		$this->localStorage->destroy();

		$this->assertFalse($this->files->exists(__DIR__.'/_meta/deployments.json'));
	}

	public function testCanFallbackIfFileDoesntExist()
	{
		$this->localStorage->destroy();

		$this->assertEquals(null, $this->localStorage->get('foo'));
	}
}
