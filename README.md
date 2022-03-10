# Laravel Project

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

### TODO

-   Show posts even if user does not follow any communities. ✅
    -   Alt. Show text and link to explore communities. Print all communities with link on seperate page. ✅
-   Create post ✅
-   Create comment
-   Follow community
-   Reply to comment page
-   Optimize single post queries.
-   Fix bug where you can only see amount of top level comments.
-   Upvote/downvote route.
-   Update user
-   Search
-   Tests
-   Fix policies
-   Overall security

### Routes proposal

-   / - Front page, posts from all communities if guest, followed communities if auth.
    -   /c/{community} - Single community
        -   /edit
        -   /delete
        -   /join (?) - follow/unfollow community
        ***
        -   /p/{post} - Single post in community
            -   /edit
            -   /delete
    -   /u/{user} - Single user
        -   /edit
        -   /delete
    -   /search

### Policies

-   Post
    -   Delete
-   Community
    -   Delete
    -   Follow/Unfollow
-   User
    -   Delete
    -   Edit
