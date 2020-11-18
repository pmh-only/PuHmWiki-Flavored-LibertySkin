<?php
class LibertyTemplate extends BaseTemplate {

	function execute() {
		global $wgRequest;
        $request = $this->getSkin()->getRequest();
        $action = $request->getVal( 'action', 'view' );
		$title = $this->getSkin()->getTitle();
		$curid = $this->getSkin()->getTitle()->getArticleID();

		Wikimedia\AtEase\AtEase::suppressWarnings();

		$this->html( 'headelement' );
		?>
		<div class="nav-wrapper navbar-fixed-top">
            <?php $this->nav_menu(); ?>
        </div>
        <div class="content-wrapper">
            <div class="container-fluid liberty-content">
                <div class="liberty-content-header">
                    <?php if ( $this->data['sitenotice'] && $_COOKIE['alertcheck'] != "yes" ) { ?>
                        <div class="alert alert-dismissible fade in alert-info liberty-notice" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php $this->html( 'sitenotice' ) ?>
                        </div>
                    <?php } ?>
                    <?php $this->contents_toolbox(); ?>
                    <div class="title">
                        <h1>
                            <?php $this->html( 'title' ) ?>
                        </h1>
                    </div>
                    <div class="contentSub"<?php $this->html( 'userlangattributes' ) ?>>
                        <?php $this->html( 'subtitle' ) ?>
                    </div>
                </div>
                <div class="liberty-content-main">
                    <?php if ( $title->getNamespace() != NS_SPECIAL && $action != "edit" && $action != "history") { ?>
                    <?php } ?>
                    <?php if ( $this->data['catlinks'] ) {
                        $this->html( 'catlinks' );
                    } ?>
                    <?php $this->html( 'bodycontent' ) ?>
                </div>
            </div>
        </div>
		<?php
		$this->printTrail();
		$this->html('debughtml');
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
		echo "\n";
		Wikimedia\AtEase\AtEase::restoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/

    function nav_menu() {
    ?>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="/"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Recentchanges', null ), '<span class="fa fa-exchange-alt">', array( 'class' => 'nav-link', 'title' => '최근 변경된 문서 리스트를 불러옵니다. [알+쉬+h]', 'accesskey' => 'c') ); ?>
                </li>
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Randompage', null ), '<span class="fa fa-sync-alt fa-spin">', array( 'class' => 'nav-link', 'title' => '무작위 문서를 불러옵니다. [알+쉬+r]', 'accesskey' => 'r' ) ); ?>
                </li>
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'LongPages', null ), '<span class="fa fa-sort-amount-up">', array( 'class' => 'nav-link', 'title' => '위키 내에서 긴 문서별로 리스트를 불러옵니다. [알+쉬+k]', 'accesskey' => 'k' ) ); ?>
                </li>
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'ShortPages', null ), '<span class="fa fa-sort-amount-down">', array( 'class' => 'nav-link', 'title' => '위키 내에서 짧은 문서별로 리스트를 불러옵니다. [알+쉬+m]', 'accesskey' => 'm' ) ); ?>
                </li>
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'SpecialPages', null ), '<span class="fa fa-star"></span>', array( 'class' => 'nav-link', 'title' => '위키 특별문서 리스트를 불러옵니다. [알+쉬+s]', 'accesskey' => 's') ); ?>
                </li>
                <?php global $wgUser, $wgRequest;
                if ($wgUser->isLoggedIn()) { ?>
                        <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'upload', null ), '<span class="fa fa-cloud-upload-alt"></span>', array( 'class' => 'nav-link', 'title' => '파일 업로드 특별문서를 불러옵니다. [알+쉬+p]', 'accesskey' => 'p') ); ?>
                </li>
                        <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( '환경설정', null ), '<span class="fa fa-cogs"></span>', array( 'class' => 'nav-link', 'title' => '유저 설정 특별문서를 불러옵니다. [알+쉬+o]', 'accesskey' => 'o') ); ?>
                </li>
                        <li class="nav-item" style="float: right;">
                            <?=Linker::linkKnown( SpecialPage::getTitleFor( 'logout', null ), '<span class="fa fa-sign-out-alt"></span>', array( 'class' => 'nav-link', 'title' => '유저 로그아웃을 합니다. [알+쉬+u]', 'accesskey' => 'u') ); ?>
                        </li>
    
                <?php } else { ?>
                <li class="nav-item">
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'login', null ), '<span class="fa fa-sign-in-alt"></span>', array( 'class' => 'nav-link', 'title' => '유저 로그인을 합니다. [알+쉬+l]', 'accesskey' => 'l') ); ?>
                </li>
            <?php } ?>
    
            </ul>
        </div>
        <?php $this->getNotification(); ?>
        <?php $this->searchBox(); ?>
    </nav>
    <?php
    }

	function searchBox() {
    ?>
        <form action="<?php $this->text( 'wgScript' ) ?>" id="searchform" class="form-inline">
            <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
            <?php echo $this->makeSearchInput( array( "class" => "form-control", "id" => "searchInput") ); ?>
            <button type="submit" name="go" value="보기" id="searchGoButton" class="btn btn-secondary" type="button"><span class="fa fa-eye"></span></button>
            <button type="submit" name="fulltext" value="검색" id="mw-searchButton" class="btn btn-secondary" type="button"><span class="fa fa-search"></span></button>
        </form>
    <?php
	}

	function contents_toolbox() {
	    global $wgUser;
        $title = $this->getSkin()->getTitle();
        $revid = $this->getSkin()->getRequest()->getText( 'oldid' );
        $watched = $this->getSkin()->getUser()->isWatched( $this->getSkin()->getRelevantTitle() ) ? 'unwatch' : 'watch';
        $user = ( $wgUser->isLoggedIn() ) ? array_shift($userLinks) : array_pop($userLinks);

	    if ( $title->getNamespace() != NS_SPECIAL ) {
            $companionTitle = $title->isTalkPage() ? $title->getSubjectPage() : $title->getTalkPage();
            ?>
            <div class="content-tools">
                <div class="btn-group" role="group" aria-label="content-tools">
                    <?php
                    if ($revid) {
                        $editaction = array( 'action' => 'edit', 'oldid' => $revid );
                    } else {
                        $editaction = array( 'action' => 'edit' );
                    }
                    ?>
                    <?=Linker::linkKnown( $title, '편집', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 편집합니다. [알+쉬+e]', 'accesskey' => 'e' ), $editaction ); ?>
                    <?=Linker::linkKnown( $title, '추가', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '새 문단을 추가합니다. [알+쉬+n]', 'accesskey' => 'n' ), array( 'action' => 'edit', 'section' => 'new' ) ); ?>
                    <?=Linker::linkKnown( $title, '기록', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서의 편집 기록을 불러옵니다. [알+쉬+h]', 'accesskey' => 'h' ), array( 'action' => 'history' ) ); ?>
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'WhatLinksHere', $title ), '역링크', array('class' => 'btn btn-secondary tools-btn')  ); ?>
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Movepage', $title ), '옮기기', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 옮깁니다. [알+쉬+b]', 'accesskey' => 'b' )); ?>
                    <?php
                        if ( $title->quickUserCan( 'protect', $user ) ) { ?>
                            <?=Linker::linkKnown( $title, '/', array ('class' => 'btn btn-secondary tools-btn')); ?>
                            <?=Linker::linkKnown( $title, '보호', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 보호합니다. [알+쉬+q]', 'accesskey' => 'q' ), array( 'action' => 'protect' ) ); ?>
                        <?php } ?>
                        <?php if ( $title->quickUserCan( 'delete', $user ) ) { ?>
                            <?=Linker::linkKnown( $title, '삭제', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 삭제합니다. [알+쉬+d]', 'accesskey' => 'd' ), array( 'action' => 'delete' ) ); ?>
                        <?php }
                     ?>
                </div>
            </div>
        <?php
        }
	}

    function footer() {
        foreach ( $this->getFooterLinks() as $category => $links ) {
            ?>
            <ul class="footer-<?=$category;?>">
                <?php foreach ( $links as $link ) {
                ?>
                    <li class="footer-<?=$category;?>-<?=$link;?>"><?php $this->html( $link ); ?></li>
                <?php
                }
                ?>
            </ul>
            <?php
        }
        $footericons = $this->getFooterIcons( "icononly" );
        if ( count( $footericons ) > 0 ) {
        ?>
            <ul class="footer-icons">
                <?php
                    foreach ( $footericons as $blockName => $footerIcons ) {
                    ?>
                        <li class="footer-<?=htmlspecialchars( $blockName );?>ico">
                        <?php
                            foreach ( $footerIcons as $icon ) {
                                echo $this->getSkin()->makeFooterIcon( $icon );
                            }
                        ?>
                        </li>
                    <?php
                    }
                ?>
            </ul>
        <?php
        }
    }

    function getNotification() {
        $personalTools = $this->getPersonalTools();
        $noti_count = $personalTools['notifications']['links']['0']['text'];
        if ($noti_count != "0") {
            ?>
            <div id="pt-notifications" class="navbar-notification">
                <a href="#"><span class="label label-danger"><?=$noti_count;?></span></a>
            </div>
            <?php
        }
    }
} // end of class
