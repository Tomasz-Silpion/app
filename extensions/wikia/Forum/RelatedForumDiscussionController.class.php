<?php
class RelatedForumDiscussionController extends WikiaController {
	
	public function init() {
		
	}
	
	public function index() {
		// mock data
		$messages = array(
			array(
				'blankImgUrl' => $this->wf->BlankImgUrl(),
				'metaTitle' => 'Placeholder main title',
				'threadUrl' => '#',
				'totalReplies' => $this->wf->Msg('forum-related-discussion-total-replies', 29),
				'replies' => array(
					array(
						'userName' => 'SomeDude',
						'userAvatarUrl' => $this->wf->BlankImgUrl(),
						'userUrl' => '#',
						'messageBody' => 'Message body goes here',
						'timeStamp' => '3 hour ago',
					),
					array(
						'userName' => 'SomeDude2',
						'userAvatarUrl' => $this->wf->BlankImgUrl(),
						'userUrl' => '#',
						'messageBody' => 'Message body 2 goes here',
						'timeStamp' => '1 hour ago',
					),
				),
			),
			array(
				'blankImgUrl' => $this->wf->BlankImgUrl(),
				'metaTitle' => 'Placeholder main title',
				'threadUrl' => '#',
				'totalReplies' => $this->wf->Msg('forum-related-discussion-total-replies', 14),
				'replies' => array(
					array(
						'userName' => 'SomeDude',
						'userAvatarUrl' => $this->wf->BlankImgUrl(),
						'userUrl' => '#',
						'messageBody' => 'Message body goes here',
						'timeStamp' => '3 hour ago',
					),
					array(
						'userName' => 'SomeDude2',
						'userAvatarUrl' => $this->wf->BlankImgUrl(),
						'userUrl' => '#',
						'messageBody' => 'Message body 2 goes here',
						'timeStamp' => '1 hour ago',
					),
				),
			),
		);
		
		// don't render anything if there are no discussions for this article
		if(empty($messages)) {
			return false;
		}
		
		// load assets related to this if there is a discussions section
		$this->response->addAsset( 'extensions/wikia/Forum/css/RelatedForumDiscussion.scss' );
	
		// set template rendering to mustache
		$this->response->setTemplateEngine(WikiaResponse::TEMPLATE_ENGINE_MUSTACHE);
		
		// set template data
		$this->sectionHeading = $this->wf->Msg('forum-related-discussion-heading', $this->wg->Title->getText());
		$this->messages = $messages;
		$this->seeMoreUrl = "#";
		$this->seeMoreText = "See more";
	}
	
}