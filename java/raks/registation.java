package raks;


import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.Statement;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;



/**
 * Servlet implementation class cookies1
 */
@WebServlet("/reg")
public class registation extends HttpServlet {
private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public registation() {
        super();
        // TODO Auto-generated constructor stub
    }

/**
* @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
*/
protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
// TODO Auto-generated method stub
response.getWriter().append("Served at: ").append(request.getContextPath());
}

/**
* @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
*/
protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
// TODO Auto-generated method stub
// doGet(request, response);
response.setContentType("text/html");


String uname=request.getParameter("name");
String uemail=request.getParameter("email");
String upwd=request.getParameter("pass");
String umobile=request.getParameter("contact");
RequestDispatcher dispatcher=null;
Connection con=null;


try {
	Class.forName("com.mysql.cj.jdbc.Driver");
	con=DriverManager.getConnection("jdbc:mysql://localhost:3308/farm?useSSL=false","root","root123");
	PreparedStatement pst=con.prepareStatement("insert into users(uname,upwd,uemail,umobile) values(?,?,?,?)");
	pst.setString(1, uname);
	pst.setString(2, upwd);
	pst.setString(3, uemail);
	pst.setString(4, umobile);
	
	int i=pst.executeUpdate();





} catch (Exception e) {
System.out.print(e);
e.printStackTrace();
}

Cookie cookie = new Cookie("uemail", uemail);
cookie.setMaxAge(10);
response.addCookie(cookie);
Cookie cookie1 = new Cookie("password", upwd);
cookie1.setMaxAge(10);
response.addCookie(cookie1);
response.sendRedirect("login.jsp");
}

}