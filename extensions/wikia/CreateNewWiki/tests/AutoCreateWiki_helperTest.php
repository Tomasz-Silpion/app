<?php

class AutoCreateWikiTest extends WikiaBaseTest {

	public function setUp() {
		$this->setupFile = dirname(__FILE__) . '/../CreateNewWiki_setup.php';

		parent::setUp();

		$userMock = $this->getMock('stdClass', array('getGroups'));
		$userMock->expects($this->any())
			->method('getGroups')
			->will($this->returnValue(array()));

		$this->mockGlobalVariable('wgUser', $userMock);
	}

	/**
	 * @dataProvider getDomainCheckData
	 */
	public function testCheckDomainIsCorrect($domainName, $lang, $isCorrect, $expectedErrorKey) {

		if (!$isCorrect) {
			$this->getGlobalFunctionMock( 'wfMsg' )
				->expects( $this->exactly( 1 ) )
				->method( 'wfMsg' )
				->with( $this->equalTo( $expectedErrorKey ) )
				->will( $this->returnValue( 'mocked-string' ) );
		}

		$this->mockStaticMethod('AutoCreateWiki', 'checkBadWords', true);
		$this->mockStaticMethod('AutoCreateWiki', 'checkDomainExists', false);
		$this->mockStaticMethod('AutoCreateWiki', 'getLanguageNames', array(
			'pl' => 'pl',
			'en' => 'en',
			'def' => 'def',
			'zzz' => 'zzz',
		));

		$result = AutoCreateWiki::checkDomainIsCorrect($domainName, $lang);

		if ($isCorrect) {
			$this->assertEquals('', $result);
		} else {
			$this->assertEquals('mocked-string', $result);
		}
	}

	function getDomainCheckData() {
		return array(
			array('asd', 'pl', true, null),
			array('asd', 'pl', true, null),
			array('as-d', 'en', true, null),
			array('asd', 'en', true, null),
			array('asd', 'pl', true, null),
			array('asd-', 'pl', false, 'autocreatewiki-bad-name'),
			array('asd-', 'pl', false, 'autocreatewiki-bad-name'),
			array('as)d', 'pl', false, 'autocreatewiki-bad-name'),
			array('as<d', 'pl', false, 'autocreatewiki-bad-name'),
			array('as$d', 'pl', false, 'autocreatewiki-bad-name'),
			array('as@d', 'pl', false, 'autocreatewiki-bad-name'),
			array('', 'pl', false, 'autocreatewiki-empty-field'),
			array('a', 'pl', false, 'autocreatewiki-name-too-short'),
			array('012345678901234567890123456789012345678901234567890', 'pl', false, 'autocreatewiki-name-too-long'),
			array('def', 'pl', false, 'autocreatewiki-violate-policy'),
			array('zzz', 'en', false, 'autocreatewiki-violate-policy'),
		);
	}

	/**
	 * @group Slow
	 * @slowExecutionTime 0.03061 ms
	 */
	function testCheckDomainIsCorrectBadWords() {
		$this->getGlobalFunctionMock( 'wfMsg' )
			->expects( $this->exactly( 1 ) )
			->method( 'wfMsg' )
			->with( $this->equalTo( 'autocreatewiki-violate-policy' ) )
			->will( $this->returnValue( 'mocked-string' ) );

		$this->mockStaticMethod('AutoCreateWiki', 'checkBadWords', false);
		$this->mockStaticMethod('AutoCreateWiki', 'getLanguageNames', array(
			'pl' => 'pl',
		));

		$result = AutoCreateWiki::checkDomainIsCorrect('woohooo', 'pl');

		$this->assertEquals('mocked-string', $result);
	}

	/**
	 * @group Slow
	 * @slowExecutionTime 0.03205 ms
	 */
	function testCheckDomainIsCorrectDomainExists() {
		$this->getGlobalFunctionMock( 'wfMsg' )
			->expects( $this->exactly( 1 ) )
			->method( 'wfMsg' )
			->with( $this->equalTo( 'autocreatewiki-name-taken' ) )
			->will( $this->returnValue( 'mocked-string' ) );

		$this->mockStaticMethod('AutoCreateWiki', 'checkBadWords', true);
		$this->mockStaticMethod('AutoCreateWiki', 'checkDomainExists', true);
		$this->mockStaticMethod('AutoCreateWiki', 'getLanguageNames', array(
			'pl' => 'pl',
		));

		$result = AutoCreateWiki::checkDomainIsCorrect('woohooo', 'pl');

		$this->assertEquals('mocked-string', $result);
	}

}
