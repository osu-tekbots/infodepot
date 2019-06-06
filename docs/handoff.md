# Handoff Documentation for end of Spring Term 2019

### Last Updated: 6/6/19


## The following features have been implemented and have been tested sufficiently:
- 80% of Data Access Object Functions (the rest of have been implemented but require additional testing)
- Browse Items Page Basic Functionality
- Browse Items Page Sorting 
- Browse Items Page Filtering
- Browse Items Page Support for Keywords 
- View Item Page Basic Functionality
- View Item Page Ability to view content from special text editor
- View Item Page Ability to upvote/downvote on items
- View Item Page Ability to create comments
- Create Item Page Basic Functionality 
- Create Item Page Text Editor (include special HTML, images, code snippets)
- API
- Action Handler for Items
- Data Access Objects 
- Models
- Admin User Interface Full Functionality (Editing user values, assigning roles)
- Admin Interface Home Screen Base Functionality



## The following features have been tentatively implemented but require additional testing: 

#### Server Side
- Data Access Object Functions that require testing (these have the following comment: "Implemented, Needs Testing")
- Parts in code where a hardcoded userid is used for testing purposes (search for "fixme" or "fix me", should be in the action handler)

#### Browse Items Page 
- Support for keywords search

#### Create Item Page
- Artifact Implementation (Only support for inclusion of files)


### View Items Page
- Pull rest of information from database that isn't currently displayed

#### Navbar
- Credential check to display certain buttons


## The following features have not been worked on and need to be implemented: 

#### Login Workflow

#### Admin Item Interface
- Ability to hide and remove items 
- Interface to see statistics of which items/categories/keywords are popular
- Ability for admins to be able to recommend/not recommend items (sticky post/featured post)
- Ability for admins to edit any items

#### My Items Page 
*note: it is recommended to copy over existing code from browse items page into my items page.*
- Display all items that are created by the user. 
- Ability to filter and sort items. 
- Button to edit and delete items. 
- Statistics (number of total items, total upvotes, total downvotes, etc).

#### Edit Items Page
*note: it is recommended to copy over existing code from create item page into my items page.*
- Ability to modify values for item.
- Ability to add and remove images.
- Ability to add and remove artifacts.
- Button to save item, mark item as public or private (in case the item is only at a draft stage).

#### General Info Page
- Add overview description of application and its purpose.
- Add description of each major page and how to interact with the application.
- Add link to email about questions and inquiries.
