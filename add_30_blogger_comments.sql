-- Add five new comments to each of the six existing posts.
-- Existing comments are preserved. Explicit IDs are omitted so AUTO_INCREMENT assigns them.
START TRANSACTION;
INSERT INTO comments (postid, body, author) VALUES
(1, 'It is great to see a new place for everyone to share ideas.', 'alice'),
(1, 'Welcome to Blogger! I am looking forward to reading more posts.', 'bob'),
(1, 'A lovely start. I hope the blog grows into a friendly community.', 'carol'),
(1, 'Thanks for visiting the administrator blog. More updates will follow.', 'rmiller'),
(1, 'Looking forward to seeing what everyone writes about.', 'alice'),
(2, 'Congratulations on your first post. I enjoyed the introduction.', 'carol'),
(2, 'Books and everyday life sound like a great combination.', 'bob'),
(2, 'Welcome to blogging! Keep writing and you will find your style.', 'rmiller'),
(2, 'I would love to hear which books you are reading next.', 'alice'),
(2, 'A warm and honest introduction. I will keep an eye out for the next post.', 'carol'),
(3, 'What did you enjoy most about the book?', 'bob'),
(3, 'Your description has made me curious to read it myself.', 'alice'),
(3, 'I always appreciate a recommendation from another reader.', 'carol'),
(3, 'Thanks for sharing your reading notes with the community.', 'rmiller'),
(3, 'Was there a particular character that stood out for you?', 'bob'),
(4, 'PDO is a useful way to work with a database safely.', 'alice'),
(4, 'It is satisfying when a PHP query returns exactly the results you expect.', 'bob'),
(4, 'Remembering to use prepared statements is a great habit.', 'carol'),
(4, 'Good progress. Small experiments are a useful way to learn PHP.', 'rmiller'),
(4, 'I would be interested to hear what you tried with MySQL next.', 'alice'),
(5, 'Breaking the work into small steps makes a website easier to manage.', 'bob'),
(5, 'I find planning the page layout before coding really helps.', 'carol'),
(5, 'Keeping the HTML, CSS and PHP responsibilities clear is worthwhile.', 'alice'),
(5, 'Nice notes. A working small site is a great foundation for improvements.', 'rmiller'),
(5, 'Have you tried testing the layout on a phone as well?', 'bob'),
(6, 'That sounds like a relaxing way to spend a weekend.', 'alice'),
(6, 'A new town is always a good excuse to take photographs.', 'carol'),
(6, 'Did you find a favourite place while you were exploring?', 'bob'),
(6, 'Thanks for sharing the travel diary. It is nice to see a different topic here.', 'rmiller'),
(6, 'I would love to see more details about the places you visited.', 'alice');
COMMIT;

-- Verify comment counts for every post.
SELECT p.id AS postid, p.title, COUNT(c.id) AS comment_count
FROM post AS p
LEFT JOIN comments AS c ON c.postid = p.id
GROUP BY p.id, p.title
ORDER BY p.id;

-- Verify that every comment refers to an existing post and user.
SELECT c.id, c.postid, c.author
FROM comments AS c
LEFT JOIN post AS p ON p.id = c.postid
LEFT JOIN user AS u ON u.username = c.author
WHERE p.id IS NULL OR u.id IS NULL;