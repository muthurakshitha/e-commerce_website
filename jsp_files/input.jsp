<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.util.Date" %>
<%@ page import="java.util.TimeZone" %>
<%@ page import="java.sql.*" %>
<%
   Integer loginCount = (Integer)session.getAttribute("loginCount");
   if(loginCount == null){
      loginCount = 1;
   }else{
      loginCount = loginCount + 1;
   }
   session.setAttribute("loginCount", loginCount);
   
   Date loginTime = (Date) session.getAttribute("loginTime");
   
   Date currentTime = new Date();
	long loginDuration = currentTime.getTime() - loginTime.getTime();

   String lastUser = "";
   if(session != null) {
      lastUser = (String)session.getAttribute("lastUser");
   }
   session.setAttribute("loginDuration", loginDuration);
   String sessionId = session.getId();
   Connection con=null;
   String name= (String)session.getAttribute("name");
   Cookie cookie = new Cookie("name", name);
	cookie.setDomain("localhost");
	cookie.setPath("/phppro/cart.php");
	response.addCookie(cookie);
	
	Cookie cookie1 = new Cookie("name1", name);
	cookie1.setDomain("localhost");
	cookie1.setPath("/phppro/product.php");
	response.addCookie(cookie1);
	
	Cookie cookie2 = new Cookie("nam", name);
	cookie2.setDomain("localhost");
	cookie2.setPath("/phppro/myorders.php");
	response.addCookie(cookie2);
	
	Cookie cookie3 = new Cookie("namee", name);
	cookie3.setDomain("localhost");
	cookie3.setPath("/phppro/blog.php");
	response.addCookie(cookie3);

	try {
		Class.forName("com.mysql.cj.jdbc.Driver");
		con=DriverManager.getConnection("jdbc:mysql://localhost:3308/ecommerce?useSSL=false","root","root123");
		PreparedStatement pst=con.prepareStatement("insert into logins(sessionID,uname,time_login) values(?,?,?)");
		pst.setString(1, sessionId);
		pst.setString(2, session.getAttribute("name").toString());
		pst.setString(3, loginTime.toString());
		
		
		
		int i=pst.executeUpdate();





	} catch (Exception e) {
	System.out.print(e);
	e.printStackTrace();
	}

	




   
%>








  
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<script type="text/javascript">
		window.onload = function() {
			var durationSpan = document.getElementById("duration");
			var duration = parseInt(durationSpan.innerHTML);

			setInterval(function() {
				duration++;
				durationSpan.innerHTML = duration;
			}, 1000);
		}
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link rel="stylesheet" href="agri.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-r2Iyq3C/XE1tPlXDlw8RXdWp9cYmLgHhy/j0m0g8BbMrKPtQdGb2b1+MzWiqjYiX9lN5sm5DCNlQrweyfmqjKg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>


    
<div class="container-fluid">
        <nav id="mainNavbar" class="navbar navbar-dark navbar-expand-md fixed-top "><a class="navbar-brand" href="#">
          <img id = "logo" src="imgs/agri.png" alt="" width="40" height="34">
        </a>
        <a class="navbar-brand" href="#">Green India</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav justify-content-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="input.jsp">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/phppro/process.php">Our Process</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="search.jsp">Shop</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/blog.php">Blogs</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/myorders.php">My orders</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="http://localhost/phppro/feed.php">Contact</a>
            </li>
            
          </ul>
        
        </div>  <div id="login" class="d-grid gap-2 d-md-flex justify-content-md-end">
        
          <p id="test" ><% if(session.getAttribute("name")!=null){out.print("Welcome "+ session.getAttribute("name"));}%></p>
         
          
          <% if(session.getAttribute("name").equals("Sankar")){out.print("hii");%> <a href="http://localhost/phppro/admin/dashboard.php" class="btn btn-outline-success " >Status</a>
         <%; } %>
          <a href="http://localhost/phppro/cart.php">
  <i class="fa fa-shopping-cart fa-inverse" style="margin-top:7px; margin-right:15px;"></i>
</a>
          
          <a href="logout" class="btn btn-outline-success " ><% if(session.getAttribute("name")!=null){out.print("Logout");}else{out.print("Sign Up");}%></a>
      
        </div>
      </div> 
 
  </nav>
  <div class="container-fluid" id="hi">
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="imgs/p6.jpg" class="pic"  alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Organic Products</h5>
          <p>We sell only organic products here which is 100% reliable.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="imgs/p4.jpg" class="pic" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Poultry</h5>
          <p></p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="imgs/p5.jpg" class="pic" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Agriculture field</h5>
          <p></p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>




<div class="container">

<section class="container-fluid px-0">
  <div class="row align-items-center content">
      <div class="col-md-6 order-2 order-md-1">
          <img src="imgs/p4.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-md-6 text-center order-1 order-md-2">
          <div class="row justify-content-center">
              <div class="col-10 col-lg-8 blurb mb-5 mb-md-0">
                  <h3>OUR FARM</h3>
                  <img src="imgs/agri.png" alt="" class="d-none d-lg-inline" width="40" height="34">
                  <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, iste molestiae
                      beatae, maiores deserunt
                      in voluptatibus
                      aspernatur architecto excepturi delectus soluta? Ipsa, deleniti dolorem hic consequatur
                      repellat eveniet quidem
                      voluptate necessitatibus dolorum delectus minus vitae, ut, veritatis sint ipsum magnam
                      autem nam ex deserunt debitis
                      eaque ratione! Nobis, quidem assumenda.</p>
              </div>
          </div>
      </div>
  </div>
  <div class="row align-items-center content">
      <div class="col-md-6 text-center">
          <div class="row justify-content-center">
              <div class="col-10 col-lg-8 blurb mb-5 mb-md-0">
                  <h3>OUR PRODUCTS</h3>
                  <img src="imgs/agri.png" alt="" class="d-none d-lg-inline" width="40" height="34">
                  <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, iste molestiae
                      beatae, maiores deserunt
                      in voluptatibus
                      aspernatur architecto excepturi delectus soluta? Ipsa, deleniti dolorem hic consequatur
                      repellat eveniet quidem
                      voluptate necessitatibus dolorum delectus minus vitae, ut, veritatis sint ipsum magnam
                      autem nam ex deserunt debitis
                      eaque ratione! Nobis, quidem assumenda.</p>
              </div>
          </div>
      </div>
      <div class="col-md-6">
          <img src="imgs/p7.avif" alt="" class="img-fluid">
      </div>
  </div>
  <div class="row align-items-center content">
      <div class="col-md-6 order-2 order-md-1">
          <img src="imgs/p5.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-md-6 text-center order-1 order-md-2">
          <div class="row justify-content-center">
              <div class="col-10 col-lg-8 blurb mb-5 mb-md-0">
                  <h3>OUR WORK</h3>
                  <img src="imgs/agri.png" alt="" class="d-none d-lg-inline" width="40" height="34">
                  <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, iste molestiae
                      beatae, maiores
                      deserunt
                      in voluptatibus
                      aspernatur architecto excepturi delectus soluta? Ipsa, deleniti dolorem hic consequatur
                      repellat eveniet
                      quidem
                      voluptate necessitatibus dolorum delectus minus vitae, ut, veritatis sint ipsum magnam
                      autem nam ex deserunt
                      debitis
                      eaque ratione! Nobis, quidem assumenda.</p>
              </div>
          </div>
      </div>
  </div>
</section></div>
</div>       
<div class="container one">
  
    <h1 class="filter heading display-6 d-inline">Daily Needs</h1> 

  </div>
<div class="container two" id="two">
  <div class="row">      
  <div class="col-sm-6 col-lg-4">         
      <div class="card">
        <img id= "pik" src="imgs/milk.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Milk</h5>
          <p class="card-text">Price: 30 per litre</p>
          <small class="text-muted">Last updated 3 mins ago</small>
          <div id="pur"><a href="price-calculation.jsp" class="btn btn-outline-success ">Purchase</a>
            <a href="#" class="btn btn-outline-dark">Add to cart</a>
          </div>
          
        </div>
            
      </div>
    </div>
    


    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <img id="pik" src="imgs/eggs.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Eggs</h5>
          <p class="card-text">Price: 120 per dozen</p>
          <small class="text-muted">Last updated 3 mins ago</small>
          <div id="pur"><a href="#" class="btn btn-outline-success ">Purchase</a>
            <a href="#" class="btn btn-outline-dark">Add to cart</a>
          </div>
        </div>
            
      </div>
    </div>

  
   

    <div class="col-sm-6 col-lg-4">
      <div class="card">
        <img id="pik"  src="imgs/honey.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Honey</h5>
          <p class="card-text">Price: 500 per litre</p>
          <small class="text-muted">Last updated 3 mins ago</small>
          <div id="pur"><a href="#" class="btn btn-outline-success ">Purchase</a>
            <a href="#" class="btn btn-outline-dark">Add to cart
     </a>
          </div>
        </div>
            
      </div>
    </div>
</div>
<p>Last user who logged in: <%= lastUser %></p>
<p>You have logged in ${sessionScope.loginCount} times.</p>
<p>You logged in at : <%= loginTime %></p>
<p>Your session id : <%= sessionId %></p>

<%
out.println("You've been logged in for <span id='duration'>" + (loginDuration / 1000) + "</span> seconds.");%>
</div>

<%@include file = "footer.html"%>
</body>
</html>