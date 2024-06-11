# DevTalk Schema

## Tables

- Articles
    | Column | Type | Description |
    | --- | --- | --- |
    | ID | INT | Primary Key |
    | Cover | VARCHAR | Cover Image URL |
    | Title | VARCHAR | Article Title |
    | Content | TEXT | Article Content |
    | Author | INT | Author ID |
    | Likes | INT | Number of Likes |
    | Comments | INT | Number of Comments |
    | Topic | INT | Topic ID |
    | IsPublished | BOOLEAN | Published or Draft |
    | CreatedAt | TIMESTAMP | Created Date |
    | UpdatedAt | TIMESTAMP | Updated Date |
- Comments
  - ArticleID
  - Author (UserID)
- Likes
  - ArticleID
  - UserID
- Topics
  - ID
  - Name
- Follows
  - UserID
  - TopicID
- Users
  - ID
  - Name
  - Email
  - Password
