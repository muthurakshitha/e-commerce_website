package raks;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.Timestamp;
import java.util.Date;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/logout")
public class Logout extends HttpServlet {
	private static final long serialVersionUID = 1L;



	   
	   protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		// doGet(request, response);
		response.setContentType("text/html");
		HttpSession session=request.getSession();
	
		String loginTime=(String) session.getAttribute("loginTime");
	
		RequestDispatcher dispatcher=null;
		String sessionId = session.getId();
		   Connection con=null;


		try {
			Date logoutTime = new Date();
			session.setAttribute("logoutTime", logoutTime);
			Class.forName("com.mysql.cj.jdbc.Driver");
			con=DriverManager.getConnection("jdbc:mysql://localhost:3308/ecommerce?useSSL=false","root","root123");
			PreparedStatement pst=con.prepareStatement("insert into lo(sessionID,uname,time_login,time_logout) values(?,?,?,?)");
			pst.setString(1, sessionId);
			pst.setString(2, session.getAttribute("name").toString());
			pst.setString(3, loginTime.toString());
			pst.setString(4, logoutTime.toString());
			
			
			
			int i=pst.executeUpdate();





		} catch (Exception e) {
		System.out.print(e);
		e.printStackTrace();
		}

		}
	   
		protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
			HttpSession session=request.getSession();
			
			session.invalidate();
			response.sendRedirect("login.jsp");
		}



}
