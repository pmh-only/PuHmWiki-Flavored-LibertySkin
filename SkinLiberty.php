<?php
class SkinLiberty extends SkinTemplate {

	public $skinname = 'liberty';
	public $stylename = 'Liberty';
	public $template = 'LibertyTemplate';

    public function initPage( OutputPage $out ) {
        parent::initPage( $out );
        $out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1' );
        $out->addMeta( 'keywords', 'wiki,' . $this->getSkin()->getTitle() );
		
		/* IOS 기기 및 모바일 크롬에서의 웹앱 옵션 켜기 및 상단바 투명화 */
		$out->addMeta('apple-mobile-web-app-capable', 'Yes');
		$out->addMeta('apple-mobile-web-app-status-bar-style', 'black-translucent');
		$out->addMeta('mobile-web-app-capable', 'Yes');
		
        $out->addModules('skins.liberty.bootstrap');
        $out->addModules('skins.liberty.layoutjs');
    }

	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
 	        $out->addHeadItem( 'font-awesome', '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">' );
		$out->addModuleStyles( array(
			'skins.liberty.styles'
		) );
	}
	function addToBodyAttributes( $out, &$bodyAttrs ) {
        $bodyAttrs['class'] .= " Liberty width-size";
    }
}
