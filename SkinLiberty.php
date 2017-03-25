<?php
class SkinLiberty extends SkinTemplate {

	public $skinname = 'liberty';
	public $stylename = 'Liberty';
	public $template = 'LibertyTemplate';

    public function initPage( OutputPage $out ) {
        parent::initPage( $out );
        $out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1' );
        $out->addMeta( 'description', '여러분의 기여를 기다리는 공작위키 입니다!' );
        $out->addMeta( 'keywords', 'wiki,위키, 공작위키, ' . $this->getSkin()->getTitle() );
		
		/* 네이버 웹마스터 도구 */
		$out->addMeta('naver-site-verification', '39d1af689838db1df56bf1dc043c8a6da855ea3c');
		
		/* IOS 기기 및 모바일 크롬에서의 웹앱 옵션 켜기 및 상단바 투명화 */
		$out->addMeta('apple-mobile-web-app-capable', 'Yes');
		$out->addMeta('apple-mobile-web-app-status-bar-style', 'black-translucent');
		$out->addMeta('mobile-web-app-capable', 'Yes');
		
		/* 모바일에서의 테마 컬러 적용 */
		//크롬, 파이어폭스 OS, 오페라
		$out->addMeta('theme-color', '#00BCD4');
		//윈도우 폰
		$out->addMeta('msapplication-navbutton-color', '#00BCD4'); 
		
		/* OpenGraph */
		$out->addMeta('og:image','https://kongjak.ml/skins/Liberty/img/logo.png' );
		$out->addMeta('og:locale', 'ko_KR' );
		
        $out->addModuleScripts( array(
            'skins.liberty.bootstrap'
        ) );
        $out->addModuleScripts( array(
            'skins.liberty.layoutjs'
        ) );
    }

	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
 	        $out->addHeadItem( 'font-awesome', '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />' );
		$out->addModuleStyles( array(
			'skins.liberty.styles'
		) );
	}
	function addToBodyAttributes( $out, &$bodyAttrs ) {
        $bodyAttrs['class'] .= " Liberty width-size";
    }
}