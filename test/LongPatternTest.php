<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Fuse\Fuse;

// List of books - searching for long pattern length > 32
class LongPatternTest extends TestCase {
	protected static $fuse;

	public static function setUpBeforeClass() {
		static::$fuse = new Fuse((require __DIR__ . '/books.php'), [
			'keys' => ['title']
		]);
	}

	// When searching for the term "HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5"...
	public function testSearchHTML5() {
		$result = static::$fuse->search('HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5 HTML5');

		// we get a non-empty list...
		$this->assertTrue(sizeof($result) > 0);

		// ...whose first value is [ 'title' => 'HTML5', 'author' => 'Remy Sharp' ]
		$this->assertEquals($result[0], [ 'title' => 'HTML5', 'author' => 'Remy Sharp' ]);
	}
}