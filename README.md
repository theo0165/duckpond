<img src="https://i.giphy.com/media/gFgwnADVzsek0/giphy.webp" style="width:100%">

# Duckpond

![](https://img.shields.io/github/workflow/status/theo0165/duckpond/Test?label=tests) ![](https://img.shields.io/github/workflow/status/theo0165/duckpond/Lint?label=lint)

Simple Reddit clone written in Laravel 9. Demo screenshots available [here](https://github.com/theo0165/duckpond/tree/main/screenshots)

**Built by**

-   [Theo Sandell](https://github.com/theo0165)
-   [Patrik Staaf](https://github.com/patrikstaaf)

### Install guide

1. Clone the repository

    - ```bash
        git clone https://github.com/theo0165/duckpond

        cd duckpond
      ```

2. Create .env file
    - ```bash
        cp .env.example .env
      ```
3. Update .env with your own values.
4. Install dependencies for php and node.js
    - ```bash
        npm install
        composer install
      ```
5. Generate application key
    - ```bash
        php artisan key:generate
      ```
6. Run migrations and populate database for testing
    - ```bash
        php artisan migrate:fresh --seed
      ```
    - This will take up to 30 seconds
7. Start dev servers
    - ```bash
        npm run dev
        php artisan serve
      ```
8. Visit the website on http://localhost:8000

# Code Review

Code review written by [Christopher](https://github.com/chrs-m),
[Oliver](https://github.com/davisdavisdavis) &
[Sophie](https://github.com/sowulff).

1. No installation guide (during time of code review)
1. CreateReplayController :15 : $data as a variable name could be more specific.
1. ShowUserController :12 : is this comment supposed to be there?
1. GuestTest :328 : This test is in a comment, can be deleted since it’s not being used.
1. In the table comments there is a column named parent_id, maybe specify more.
1. All tests “includes” the faker class but it is never used.
1. Most of the controllers have unused request classes.
1. Comment on what q would be in search controller.
1. A lot of files have the “boiler” code left.
1. The code could benefit a lot from comments explaining more specific variables.
1. DeleteCommentController.php:16 has commented dd left in code
1. ShowPostController.php:13 do not use $request
1. [minor]Controller/submit breaks structure with small letters
1. StoreSubmitController.php:25 has commented dd left in code
1. ShowUserProfileController.php:12 commented code left in prod
1. UserFollowCommunityController.php $checkIfFollow-naming. Check if whats follow what?
1. Maybe pagination on front page?
1. Models/Comment.php:52 has some commented code
1. Models/Post.php:25 has some commented code
1. Good use of built in functions etc.
1. Very good html structure.
1. Good grouping of routes.
1. Overall a very well made project, especially considered the time frame ⭐️

### Tables/Models

-   User
    -   Email
    -   Username
    -   Password
    -   Is admin?
-   Post
    -   Title
    -   Value
    -   Type
        -   Text/link
    -   User id
-   Community
    -   Title
    -   Owner (user id)
-   Vote
    -   Post id
    -   Comment id
    -   User id
    -   Up/down (true/false)
-   Comment
    -   User id
    -   Text
    -   Post id -> post
    -   Parent id -> comment
-   Post on community
    -   User id
    -   Post id
    -   Commnunity id

### Relationships

-   User
    -   Has Many
        -   Posts
        -   Comment
        -   Community
-   Post
    -   Has Many
        -   Comments
    -   Belongs to
        -   User
        -   Community
-   Community
    -   Has many
        -   Posts
    -   Belongs to
        -   User
-   Comment

    -   Has many
        -   Comments
    -   Belongs to
        -   Post/comment
        -   User

-   Vote
    -   Belongs to
        -   Post/Comment

### Features

-   Users
    -   Admin (?)
        -   Can delete posts
    -   Profile page, public
        -   Posts
        -   Comments (?)
        -   Settings for own user.
            -   Update
                -   Password
                -   Email
-   "Communties"
    -   Can visited seperate from front page
        -   Can only see posts from that community
    -   User can delete
    -   Posts
        -   Text/link
        -   Upvote/Downvote
        -   Comment
            -   Upvote/downvote
            -   Delete
        -   Delete
    -   User can create
    -   User can follow
        -   Posts from followed communties on front page
-   Front page
    -   Sort by most upvoted last 24hr
-   Search
    -   Communities
    -   User
    -   Post (?)
-   Sort by controversial
    -   Many upvotes and downvotes

### Deliminations

-   No mods on communties
    -   Only super user
