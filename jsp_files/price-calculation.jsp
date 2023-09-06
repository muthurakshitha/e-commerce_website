<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.sql.*" %>
<%@ page import="java.util.*" %>
<%@ page import="raks.Product" %>
<%@ page import="java.text.*, java.util.*, javax.servlet.http.Cookie"%>
<html>
<head>
	<title>Calculate Price</title>
	    <link rel="stylesheet" href="price.css">
	    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>



	<%
	
    String searchTerm = request.getParameter("itemId");
	Cookie cookie = new Cookie("item", searchTerm);
	cookie.setDomain("localhost");
	cookie.setPath("/phppro/cart.php");
	response.addCookie(cookie);

    List<Product> productList = new ArrayList<>();

    String sql = "SELECT * FROM products WHERE name LIKE ?";
    try {
    	Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3308/ecommerce", "root", "root123");
         PreparedStatement stmt = conn.prepareStatement(sql);
        stmt.setString(1, "%" + searchTerm + "%");
        ResultSet rs = stmt.executeQuery();
        	while (rs.next()) {
                int id = rs.getInt("id");
                String name = rs.getString("name");
                String description = rs.getString("description");
                double price = rs.getDouble("price");
                String image=rs.getString("image_url");
                if (name == null) {
                    out.print("The object is null");
                } 
                Product product = new Product(id, name, description, price, image);
          
   %>
   
   <h1 class="text-center"><%= product.getName() %></h1>
    <div class="container main">
      
        <img  src="<%= product.getImage() %>" class="img" alt="...">
            <div class="car">
                <h5 class="title"><%= product.getName() %></h5>
                <p class="text"><%= product.getDescription() %></p>
                <p class="price">Rs <%= product.getPrice() %></p>
                     
             <form method="post" class="form" action="price-calculation.jsp">
		     <input type="hidden" name="Id" value="<%= product.getPrice() %>">                 
			<label for="quantity">Quantity:</label>
			<input type="text" id="quantity" name="quantity" value="1"/><br/>
			
			<input type="submit" value="Calculate" name="calculateBtn" />
			
		</form>
		  <div id="pur"><a href="http://localhost/phppro/cart.php" class="btn btn-outline-success ">Purchase</a>
          </div>
                 <%

 
    
            }
        	
            // Close the result set, statement, and connection
           
            if (request.getParameter("calculateBtn") != null) {
        		double itemPrice = Double.parseDouble(request.getParameter("Id"));
        		int quantity = Integer.parseInt(request.getParameter("quantity"));
        		double totalPrice = itemPrice * quantity;
        		 session.setAttribute("totalPrice", totalPrice);
        		   
        		
        	}
            
            
        } catch (Exception ex) {
            out.println("Error: " + ex.getMessage());
        }

    out.println("<p>Total Price: Rs" + session.getAttribute("totalPrice")+ "</p>");
    %>
   
            </div> </div>
 

	<a href="http://localhost/phppro/comments.php">comments</a>
	
</body>
</html>
