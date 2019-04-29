<?php
namespace Email;

class ItemMailer extends Mailer {
    /**
     * Constructs a new instance of a mailer specifically for capstone project-related emails
     *
     * @param string $from the from address for emails
     * @param string|null $subjectTag an optional subject tag to prefix the provided subject tag with
     */
    public function __construct($from, $subjectTag = null) {
        parent::__construct($from, $subjectTag);
    }

    /**
     * Sends a confirmation email to the proposer after the have submitted their project.
     *
     * @param \Model\CapstoneProject $project 
     * @param string $link the URL allowing the user to view the project
     * @return boolean true on success, false otherwise
     */
    public function sendItemConfirmationEmail($item, $link) {
        /*
		$userName = $project->getProposer()->getFirstName() . ' ' . $project->getProposer()->getLastName();
        $pid = $project->getId();
        $title = $project->getTitle();

        $NDA_message = $project->getNdaIp()->getId() == CapstoneProjectNDAIP::NO_AGREEMENT_REQUIRED ? '' : '
        If your project requires an NDA and/or IP agreement, it must be indicated at the time the students select the 
        projects.

        If your company intends to provide proprietary materials or confidential information requiring an NDA, OSU can 
        arrange for a written agreement to reviewed and signed amongst the students, your company, and OSU.

        Such an agreement will authorize the students to use and discuss the provided materials or information with 
        each other and their instructor in confidence.

        The university will not participate in any agreement that requires students to transfer intellectual property 
        rights ownership to your company or puts overly burdensome confidentiality obligations on the students.

        Though OSU certainly appreciates your company’s sponsorship, we strongly discourage any agreements that could 
        deter students from sharing the results of their academic work at OSU with fellow students, parents or future 
        employers.

        This does not prevent a separate arrangement between you each student individually.';

        $message = "
        Dear $userName,

        Thank you for submitting your project!
        ---------------------------
        Project ID: $pid
        Project Title: $title
        ---------------------------

        Your project is now awaiting for approval from an administrator.

        Your project can now be viewed at: $link

        $NDA_message

        * Your project has the ability to be modified by an administrator for final revisions *

        Sincerely,

        Senior Design Capstone Team
        Oregon State University
        ";

        return $this->sendEmail($project->getProposer()->getEmail(), $subject, $content);
		*/
	}

   
}
