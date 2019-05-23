# Info Depot Web Application
Info Depot is an application that enables students to share and view information that they have found useful pertaining to their classes and projects. See [the changelog](./CHANGELOG.md) for detailed information about
updates to the website.

**Initial Development**: Spring Term 2019

**Contributors**
- Symon Ramos (ramossy@oregonstate.edu)
- Thien Nam (namt@oregonstate.edu)
- Braden Hitchcock (hitchcob@oregonstate.edu)

## Development
The following resources provide information about how to develop the website locally and the workflow for pushing
changes to the staging area and subsequently deploying them to production.

- [Local Development Setup](./docs/dev-setup.md)
- [Development Workflow](./docs/dev-workflow.md)

In addition, **create a pre-commit hook** that will ensure fill permissions are set accordingly before you commit
code. To do this, copy the `scripts/pre-commit.sh` file and save it as `pre-commit` in your local `.git/hooks`
directory. Also ensure it is executable.

```sh
cp scripts/pre-commit.sh .git/hooks/pre-commit
chmod a+x .git/hooks/pre-commit
```

## Structural Overview
- All HTML pages are rendered inside of PHP files in the `pages/` folder.

- All database management is handled by database access objects in the `lib/classes/DataAccess/` and 
  `lib/shared/classes/DataAccess/` directories. Any additional queries required to accomplish site functionality
  should be included in these DAOs (or in a new DAO in the same namespace/file location).

- All database configuration is located in a private directory *outside this repository* in a `database.ini` file.

- Third-party authentication provider IDs and secrets are located *outside this repository* in a `auth.ini` file.

- The `db/upload.php` file handles uploading images to the `images/` folder that the user provides.

- All external CSS and JS files are located in the `assets/css/` and `assets/js/` respectively. An internal CSS 
  file called `assets/css/infodepot.css` contains customized CSS proporties relevant to this application.

	> Please be aware that this CSS file is global and will modify the entire application to adhere to its standards. 
	> (EX: modifying the background color of the "body" element will modify all "body" elements of all pages, not just
	> a single one.) Please create new classes whenever applicable.

- The `modules/header.php` file contains all references to external CSS and JS files. The `header.php` and 
  `footer.php` files should be included in all files in the `pages/` directory.
  
- The `modules/mailer.php` file contains all e-mail handling functions.

- The `modules/` folder contains encapsulated code that is shared between multiple files in the `pages/` folder. 
  Whenever possible , please consolidate duplicate functionality into a single module or folder. 
  

## User Types and Website Workflow Design
**Users have the ability to: **
1. browse items.
2. create items.
3. upvote/downvote and comment on items.

## Database Architecture

Authentication data is located in a `database.ini` file **outside this repository**. The Tekbots Web Dev Team's shared
Google Drive contains documentation on the internal structure of database tables used in this site.

Database Name: `eecs_projectsubmission`
Server Name: `engr-db Groups`

## Login Authentication
Within `pages/login.php`, the `auth_providers/login_with_[authenticator].php` script is executed on login button click. 
Login credentials required to interface with the authenticator are:
- redirect_uri
- client_id
- client_secret

Each authenticator will provide different user info configurations but will have sufficient data needed to create a 
new user. All new users are defaulted as Students and are re-directed to `pages/login.php` with a new portal section.

Users must contact an administrator of this application in order to be given the access level of admin.

## Admin Interface


## Session Variables
Session variables are used to persist user data throughout the course of a user's active session. The instantiation 
of these variables occur in the following workflow:
  
1. The user visits the `pages/login.php` page. 
2. The user selects a login authentication type (EX: Google, Microsoft).
3. After successful authentication, the following session variables are instantiated and can be used in PHP throughout the entire application: 
   - `$_SESSION['userID']`: This variable is a string of numbers. 
   - `$_SESSION['accessLevel']`: This variable is a string that can be either: 
      - "Student"
      - "Admin"
   - `$_SESSION['newUser']`: This variable is a boolean (either true or false).

> **NOTE**: Please do NOT reference `$_SESSION['userID']` in javascript, as Google Authentication may provide a 
> userID that is longer than the acceptable max character length for javascript. Instead, echo the session varible in a 
> hidden div and reference that text of that div in order to use the userID in JavaScript.


## Future Implementation
- See handoff documentation in the `docs/` folder.

## Troubleshooting and Helpful Notes

### Problem
The `u_uap_provided_id` columns in the database are `VARCHAR(256)` and because Google Authentication returns an ID that 
is often times more than 64 bits, the session variable for userID can't be explicitly referenced in Javascript and will 
be truncated.
  
#### Solution 
Create a hidden div and echo out the SESSION variable there. Then reference that div in the javascript. 
		 
