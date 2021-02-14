<?php
class LibertyTemplate extends BaseTemplate {

	function execute() {
		global $wgRequest;
        $request = $this->getSkin()->getRequest();
        $action = $request->getVal( 'action', 'view' );
		$title = $this->getSkin()->getTitle();
		$curid = $this->getSkin()->getTitle()->getArticleID();

        $colors = array("red", "orange", "green", "teal", "cyan", "blue", "indigo", "purple", "pink");
        $color = $colors[array_rand($colors)];

		Wikimedia\AtEase\AtEase::suppressWarnings();

		$this->html( 'headelement' );
		?>
		<div class="nav-wrapper navbar-fixed-top" style="background-color: var(--<?php echo $color ?>);">
            <?php $this->nav_menu(); ?>
        </div>
        <div class="content-wrapper" style="--navbar-color: var(--<?php echo $color ?>);">
            <aside>
                <div class="liberty-sidebar">
                    <div class="liberty-right-fixed">
                        <ins
                            class="adsbygoogle"
                            style="display:block;width:120px;height:100rem"
                            data-ad-client="ca-pub-5402646688760293"
                            data-ad-slot="8592298515">
                        </ins>
                    </div>
                </div>
			</aside>

            <div class="container-fluid liberty-content shadow">
                <div class="liberty-content-header">
                    <?php $this->contents_toolbox(); ?>
                    <div class="title">
                        <h1 id="firstHeading">
                            <?php $this->html( 'title' ) ?>
                        </h1>
                    </div>
                    <div class="contentSub"<?php $this->html( 'userlangattributes' ) ?>>
                        <?php $this->html( 'subtitle' ) ?>
                    </div>
                </div>
                <div class="liberty-content-main" id="#content">
                    <?php $this->html( 'bodycontent' ) ?>
                    <?php if ( $this->data['catlinks'] ) {
                        $this->html( 'catlinks' );
                    } ?>
                </div>
                <ins
                    class="adsbygoogle"
                    style="display:inline-block;width:100%;height:90px"
                    data-ad-client="ca-pub-5402646688760293"
                    data-ad-slot="8783568883">
                </ins>

                <div class="mt-3 text-center">
                    프흠위키는 모든 사용자의 익명성을 존중합니다. 초상권 및 명예훼손 문의: <a href="mailto:pmhstudio.pmh@gmail.com">pmhstudio.pmh@gmail.com</a>
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
                    <li class="nav-item">
                        <?=Linker::linkKnown( SpecialPage::getTitleFor( 'logout', null ), '<span class="fa fa-sign-out-alt"></span>', array( 'class' => 'nav-link', 'title' => '유저 로그아웃을 합니다. [알+쉬+u]', 'accesskey' => 'u') ); ?>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <?=Linker::linkKnown( SpecialPage::getTitleFor( 'login', null ), '<span class="fa fa-sign-in-alt"></span>', array( 'class' => 'nav-link', 'title' => '유저 로그인을 합니다. [알+쉬+l]', 'accesskey' => 'l') ); ?>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php $this->searchBox(); ?>
    </nav>
    <?php
    }

	function searchBox() {
    ?>
        <form action="<?php $this->text( 'wgScript' ) ?>" id="searchform" class="form-inline">
            <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
            <div class="input-group">
                <?php echo $this->makeSearchInput( array( "class" => "form-control", "id" => "searchInput") ); ?>
                <div class="input-group-append">
                    <button type="submit" name="go" value="보기" id="searchGoButton" class="btn btn-secondary" type="button"><span class="fa fa-eye"></span></button>
                    <button type="submit" name="fulltext" value="검색" id="mw-searchButton" class="btn btn-secondary" type="button"><span class="fa fa-search"></span></button>
                </div>
            </div>
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
                        $mceeditaction = array( 'action' => 'tinymceedit', 'oldid' => $revid );
                    } else {
                        $editaction = array( 'action' => 'edit' );
                        $mceeditaction = array( 'action' => 'tinymceedit' );
                    }
                    ?>
                    <?=Linker::linkKnown( $title, '편집', array( 'id' => 'ca-edit', 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 편집합니다. [알+쉬+e]', 'accesskey' => 'e' ), $editaction ); ?>
                    <?=Linker::linkKnown( $title, '기록', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서의 편집 기록을 불러옵니다. [알+쉬+h]', 'accesskey' => 'h' ), array( 'action' => 'history' ) ); ?>
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Movepage', $title ), '옮기기', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 옮깁니다. [알+쉬+b]', 'accesskey' => 'b' )); ?>
                    <?=Linker::linkKnown( $title, '시각', array( 'id' => 'ca-edit', 'class' => 'btn btn-secondary tools-btn', 'title' => '시각 편집기로 문서를 편집합니다.' ), $mceeditaction ); ?>
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
} // end of class
