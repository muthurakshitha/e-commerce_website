<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Feedback Form</title>
</head>
<body>
    <h1>Feedback Form</h1>
    <form action="feedback.jsp" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label for="comment">Comment:</label>
        <textarea name="comment" rows="5" cols="40" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
