<img src="https://i.giphy.com/media/gFgwnADVzsek0/giphy.webp" style="width:100%">

# Duckpond

Simple Reddit clone written in Laravel 9.

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
