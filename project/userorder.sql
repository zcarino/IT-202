SELECT * FROM Orders WHERE user_id = :user_id;

SELECT * FROM Orders WHERE user_id = :user_id ORDER BY date_created ASC;

SELECT * FROM Orders WHERE user_id = :user_id ORDER BY date_created DESC;