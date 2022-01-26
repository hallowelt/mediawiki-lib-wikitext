<?php

namespace HalloWelt\MediaWiki\Lib\WikiText\Tests;

use HalloWelt\MediaWiki\Lib\WikiText\Template;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase {

	/**
	 * @covers HalloWelt\MediaWiki\Lib\WikiText\Template::render
	 * @return void
	 */
	public function testRender() {
		$template = new Template( 'Test', [
			'field 1' => 'Value 1'
		] );
		$expectation1 = <<<HERE
{{Test
|field 1 = Value 1
}}
HERE;
		$this->assertEquals( $expectation1, $template->render() );

		$template->setName( 'Test2' );
		$template->set( 'field 2', ":Some value\n:Some other value" );
		$expectation2 = <<<HERE
{{Test2
|field 1 = Value 1
|field 2 =
:Some value
:Some other value
}}
HERE;
		$this->assertEquals( $expectation2, $template->render() );

		$template->set( 'field 2', "Hello" );
		$template->set( 0, 'World' );
		$template->setRenderFormatted( false );
		$expectation3 = "{{Test2|field 1 = Value 1|field 2 = Hello|World}}";
		$this->assertEquals( $expectation3, $template->render() );
	}
}
