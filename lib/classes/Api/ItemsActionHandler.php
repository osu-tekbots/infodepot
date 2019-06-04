<?php
namespace Api;

use Model\InfoDepotItem;
use Model\InfoDepotCourse;
use Model\User;
use Model\InfoDepotComment;
use DataAccess\QueryUtils;

/**
 * Defines the logic for how to handle AJAX requests made to modify project information.
 */
class ItemsActionHandler extends ActionHandler {

    /** @var \DataAccess\InfoDepotItemsDao */
    private $itemsDao;
    /** @var \DataAccess\UsersDao */
    private $usersDao;
    /** @var \Email\ItemMailer */
    private $mailer;
    /** @var \Util\ConfigManager */
    private $config;
    /** @var \Util\Logger */
    //private $logger;
    /** @var \DataAccess\CommentsDao */
    private $commentsDao;

    

    /**
     * Constructs a new instance of the action handler for requests on project resources.
     *
     * @param \DataAccess\InfoDepotItemsDao $itemsDao the data access object for projects
     * @param \DataAccess\CapstoneProjectsDao $usersDao the data access object for users
     * @param \Email\ItemMailer $mailer the mailer used to send project related emails
     * @param \Util\ConfigManager $config the configuration manager providing access to site config
     * @param \Util\Logger $logger the logger to use for logging information about actions
     */
	 
	/*
    public function __construct($itemsDao, $usersDao, $mailer, $config, $logger) {
        parent::__construct($logger);
        $this->itemsDao = $itemsDao;
        $this->usersDao = $usersDao;
        $this->mailer = $mailer;
        $this->config = $config;
    }
	*/

	//this constructor is without the mailer
	public function __construct($itemsDao, $usersDao, $commentsDao, $config, $logger) {
        parent::__construct($logger);
        $this->itemsDao = $itemsDao;
        $this->usersDao = $usersDao;
        $this->commentsDao = $commentsDao;
        $this->config = $config;
    }


    /**
     * Creates a new capstone project entry in the database.
     *
     * @return void
     */
    public function handleCreateItem() {
        // Ensure all the requred parameters are present
    
		//fixme: add required parameters here
		//$this->requireParam()
		//EX: $this->requireParam('uid');
		
		$body = $this->requestBody;
		
		
		$item = new InfoDepotItem();
		//fixme check this below
		$item->setTitle($body['title']);
		$item->setDetails($body['details']);
		
		$newcourse = new InfoDepotCourse($body['course'], 'NAME', 'CODE');
		$item->setCourse($newcourse);
		
		//fixme: 4/29/19 the FormatDate() function isn't working.
		//error is: <b>Fatal error</b>:  Call to undefined function Api\FormatDate()
		//im just going to modify the code so that it's compatible as-is.
		//$item->setDateCreated(FormatDate(new \DateTime()));
		//$item->setDateUpdated(FormatDate(new \DateTime()));
		$item->setDateCreated((new \DateTime())->format('Y-m-d H:i:s'));
		$item->setDateUpdated((new \DateTime())->format('Y-m-d H:i:s'));
		
		
		//fixme: hardcoded for development work, this is my user id.
		//this should be removed in future releases.
		//$user = $this->usersDao->getUser($body['uid']);
		$userid = 'NvTykUuoi7DlzDzH';
		$newuser = new User();
		$newuser->setId($userid);
		
		$item->setUser($newuser);
		
		$ok = $this->itemsDao->addNewInfoDepotItem($item);

        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to create new item'));
        }

        $this->respond(new Response(
            Response::CREATED, 
            'Successfully created new item resource', 
            array('id' => $item->getId())
        ));
    }

    /**
     * Updates the projects category in the database.
     *
     * @return void
     */
	 
	 /*
    public function handleUpdateProjectCategory() {
        // Ensure all required parameters are present
        $this->requireParam('projectId');
        $this->requireParam('categoryId');

        $body = $this->requestBody;

        $project = $this->projectsDao->getCapstoneProject($body['projectId']);
        // TODO: handle case when project is not found

        $project->getCategory()->setId($body['categoryId']);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to update project'));
        }

        $this->respond(new Response(
            Response::OK,
            'Successfully updated the project'
        ));
    }
	
	*/

    /**
     * Updates fields editable from the user interface in a project entry in the database.
     *
     * @return void
     */
    public function handleSaveItem() {
        $id = $this->getFromBody('id');
        $title = $this->getFromBody('title');
        $typeId = $this->getFromBody('typeId');
        $compensationId = $this->getFromBody('compensationId');
        $focusId = $this->getFromBody('focusId');
        $ndaIpId = $this->getFromBody('ndaIpId');
        $additionalEmails = $this->getFromBody('additionalEmails');
        $comments = $this->getFromBody('comments');
        $dateStart = $this->getFromBody('dateStart');
        $dateEnd = $this->getFromBody('dateEnd');
        $description = $this->getFromBody('description');
        $motivation = $this->getFromBody('motivation');
        $objectives = $this->getFromBody('objectives');
        $videoLink = $this->getFromBody('videoLink');
        $websiteLink = $this->getFromBody('websiteLink');
        // TODO: handle keywords

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle case when project is not found

        $dateStart = $dateStart != '' ? new \DateTime($dateStart) : null;
        $dateEnd = $dateEnd != '' ? new \DateTime($dateEnd) : null;

        $project->setTitle($title)
            ->setAdditionalEmails($additionalEmails)
            ->setProposerComments($comments)
            ->setDateStart($dateStart)
            ->setDateEnd($dateEnd)
            ->setDescription($description)
            ->setMotivation($motivation)
            ->setObjectives($objectives)
            ->setVideoLink($videoLink)
            ->setWebsiteLink($websiteLink);

        $project->getCompensation()->setId($compensationId);
        $project->getFocus()->setId($focusId);
        $project->getNdaIp()->setId($ndaIpId);
        $project->getType()->setId($typeId);

        $project->setDateUpdated(new \DateTime());

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to save project'));
        }

        $this->respond(new Response(
            Response::OK,
            'Successfully saved project'
        ));
    }

    public function handleCreateComment(){
         // Ensure all the requred parameters are present
    
		//fixme: add required parameters here
		//$this->requireParam()
        //EX: $this->requireParam('uid');
        
		$body = $this->requestBody;
		
		
		$comment = new InfoDepotComment();
		//fixme check this below
        $comment->setContent($body['content']);
        $comment->setAsRecommended(false);
        
        $userid = 'NvTykUuoi7DlzDzH';
		$newuser = new User();
        $newuser->setId($userid);
        $comment->setUser($newuser);

        $newItem = new InfoDepotComment($body['id']);
        $comment->setDepotItem($newItem);

        //fixme: 4/29/19 the FormatDate() function isn't working.
		//error is: <b>Fatal error</b>:  Call to undefined function Api\FormatDate()
		//im just going to modify the code so that it's compatible as-is.
		//$item->setDateCreated(FormatDate(new \DateTime()));
		//$item->setDateUpdated(FormatDate(new \DateTime()));
		$comment->setDateCreated((new \DateTime()));
        $comment->setDateUpdated((new \DateTime()));
		
		$ok = $this->commentsDao->addNewInfoDepotComment($comment);

        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to create new comment'));
        }

        $this->respond(new Response(
            Response::CREATED, 
            'Successfully created new comment resource', 
            array('id' => $comment->getId())
        ));
        
    }

    public function handleRatedHelpful(){
        $body = $this->requestBody;

        $projectid = $body['id'];

                // FIX ME CHANGE TO ACTUAL USER ID
        $userid = 'NvTykUuoi7DlzDzH';
		
		$ok = $this->itemsDao->upvoteInfoDepotItem($userid, $projectid);

        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to upvote info depot item'));
        }
        
        $this->respond(new Response(
            Response::CREATED, 
            'Successfully Rated Helpful', 
            array('id' => 5)
        ));
    }

    public function handleRatedUnhelpful(){
        $body = $this->requestBody;

        $projectid = $body['id'];
        // FIX ME CHANGE TO ACTUAL USER ID
        $userid = 'NvTykUuoi7DlzDzH';
		
		$ok = $this->itemsDao->downvoteInfoDepotItem($userid, $projectid);

        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to downupvote info depot item'));
        }
        
        $this->respond(new Response(
            Response::CREATED, 
            'Successfully Rated Unhelpful', 
            array('id' => 5)
        ));
    }
	
	/*
    public function handleSubmitForApproval() {
        $id = $this->getFromBody('id');

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle case when project is not found

        $project->getStatus()->setId(CapstoneProjectStatus::PENDING_APPROVAL);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to submit project for approval'));
        }

        $link = $this->getAbsoluteLinkTo('pages/editProject.php?id=' . $id) ;
        $this->mailer->sendProjectSubmissionConfirmationEmail($project, $link);

        $this->respond(new Response(
            Response::OK,
            'Successfully submitted project for approval'
        ));
    }

    public function handleDefaultImageSelected() {
        $imageId = $this->getFromBody('imageId');
        $projectId = $this->getFromBody('projectId');

        $project = $this->projectsDao->getCapstoneProject($projectId);
        // TODO: handle case when project is not found

        $image = $this->projectsDao->getCapstoneProjectImage($imageId);
        // TODO: handle case when image is not found

        $image->setProject($project);

        $image->setIsDefault(true);

        $ok = $this->projectsDao->updateCapstoneProjectDefaultImage($image);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to update capstone image'));
        }

        $this->respond(new Response(
            Response::OK,
            'Successfully updated capstone image',
            array('name' => $image->getName())
        ));
    }

    public function handleApproveProject() {
        $id = $this->getFromBody('projectId');

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle case when project is not found

        $project->getStatus()->setId(CapstoneProjectStatus::ACCEPTING_APPLICANTS);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to approve project'));
        }

        $link = $this->getAbsoluteLinkTo('pages/viewSingleProject.php?id=' . $id);
        $this->mailer->sendProjectApprovedEmail($project, $link);

        $this->respond(new Response(
            Response::OK,
            'Successfully approved project. An email has been sent to the proposer.'
        ));
    }

    public function handleRejectProject() {
        $id = $this->getFromBody('projectId');
        $reason = $this->getFromBody('reason');

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle case when project is not found

        $project->getStatus()->setId(CapstoneProjectStatus::REJECTED);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to reject project'));
        }

        $this->mailer->sendProjectRejectedEmail($project, $reason);

        $this->respond(new Response(
            Response::OK,
            'Successfully rejected project. An email has been sent to the proposer.'
        ));
    }

    public function handlePublishProject() {
        $id = $this->getFromBody('id');

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle when not found

        $project->setIsHidden(false);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to publish project'));
        }

        $this->respond(new Response(
            Response::OK,
            'Successfully published project.'
        ));
    }
	
    public function handleUnpublishProject() {
        $id = $this->getFromBody('id');

        $project = $this->projectsDao->getCapstoneProject($id);
        // TODO: handle when not found

        $project->setIsHidden(true);

        $ok = $this->projectsDao->updateCapstoneProject($project);
        if (!$ok) {
            $this->respond(new Response(Response::INTERNAL_SERVER_ERROR, 'Failed to unpublish project'));
        }

        $this->respond(new Response(
            Response::OK,
            'Successfully unpublished project.'
        ));
    }
	
	*/

    /**
     * Handles the HTTP request on the API resource. 
     * 
     * This effectively will invoke the correct action based on the `action` parameter value in the request body. If
     * the `action` parameter is not in the body, the request will be rejected. The assumption is that the request
     * has already been authorized before this function is called.
     *
     * @return void
     */
    public function handleRequest() {
        // Make sure the action parameter exists
        $action = $this->getFromBody('action');
		//$action = 'createItem';
        // Call the correct handler based on the action
        switch ($action) {
            case 'createItem':
                $this->handleCreateItem();
			/*
            case 'updateCategory':
                $this->handleUpdateProjectCategory();
			*/
            case 'saveItem':
                $this->handleSaveItem();

            case 'createComment':
                $this->handleCreateComment();
            case 'ratedHelpful':
                $this->handleRatedHelpful();
            case 'ratedUnhelpful':
                $this->handleRatedUnhelpful();
            default:
                $this->respond(new Response(Response::BAD_REQUEST, 'Invalid action on item resource'));

            
        }
    }

    private function getAbsoluteLinkTo($path) {
        return $this->config->getBaseUrl() . $path;
    }
}
