<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%@ page import="java.sql.*" %>
<%@ page import="java.util.*" %>
<%@ page import="raks.Product" %>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Cards</title>
    <link rel="stylesheet" href="agri.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

    
<%@include file = "header.html"%>
<div class="container-fluid"> 
<div class="container">
<div class="cont">
       <div class="search_box">
        <form method="get" class="d-flex justify-content-end try"  >
             <button type="submit" class="mm"><i class="fa fa-search" aria-hidden="true"></i></button>
           
                <input type="text" name="search" id="search" class="form-control me-2" placeholder="Enter a product name">
        
     
            <button type="submit" class="mm"><i class="fa fa-microphone " aria-hidden="true"></i></button>
        </form>
        </div>   </div>
        <div class="row">
        
        <%
    
    String searchTerm = request.getParameter("search");
    
    List<Product> productList = new ArrayList<>();
    if (searchTerm !="") {
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
    <div class="col-sm-4">
        <div class="card mb-4 border-0">
        <img id="pik" src="<%= product.getImage() %>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><%= product.getName() %></h5>
               
                <p class="card-text">Rs <%= product.getPrice() %></p>
                       <div id="pur">
              <form method="post" action="http://localhost/phppro/product.php">
              <input type="hidden" name="itemId" value="<%= product.getName() %>">
         
              <button type="submit" class="btn btn-outline-dark"><i class="glyphicon glyphicon-shopping-cart"></i>View details</button>
            </form>
          </div>
            </div>
        </div>
    </div>
    
    <%
            }

            // Close the result set, statement, and connection
            rs.close();
            stmt.close();
            conn.close();
        } catch (Exception ex) {
            out.println("Error: " + ex.getMessage());
        }}
    else{%>
    	<p><center>NOT AVAILABLE</center></p>
    
   <% }
%>
 
        </div>
    </div>
<div class="container">
    <div class="row">
        <%
        if(searchTerm==null){
        	     
        	 
            try {
                // Connect to the database
                Class.forName("com.mysql.jdbc.Driver");
                Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3308/ecommerce", "root", "root123");

                // Create a statement
                Statement stmt = conn.createStatement();

                // Execute the query
                ResultSet rs = stmt.executeQuery("SELECT * FROM products");

                // Loop through the result set and create a Bootstrap card for each product
                while (rs.next()) {
                    int id = rs.getInt("id");
                    String name = rs.getString("name");
                    String description = rs.getString("description");
                    double price = rs.getDouble("price");
                    String image=rs.getString("image_url");

                    Product product = new Product(id, name, description, price, image);
        %>
       
        <div class="col-sm-4">
            <div class="card mb-4 border-0">
            <img id="pik" src="<%= product.getImage() %>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><%= product.getName() %></h5>
                 
                    <p class="card-text">Rs <%= product.getPrice() %></p>
                          <div id="pur">
                  <form method="post" action="http://localhost/phppro/product.php">
              <input type="hidden" name="itemId" value="<%= product.getName() %>">
             
              <button type="submit" class="btn btn-outline-dark"><i class="glyphicon glyphicon-shopping-cart"></i>View details</button>
            </form>
            
          </div>
                </div>
            </div>
        </div>
        
        <%
                }

                // Close the result set, statement, and connection
                rs.close();
                stmt.close();
                conn.close();
            } catch (Exception ex) {
                out.println("Error: " + ex.getMessage());
            }}
      %>
    </div>

</div></div>
     <footer >
        <p>Copyright © 2023 Agriculture Products Inc.</p>
        <p>
          <a href="http://localhost/phppro/feed.php">Contact Us</a> | 
          <a href="http://localhost/phppro/process.php">About Us</a> | 
          <a href="#">Terms of Use</a>
        </p>
      </footer>
</body>
</html>
