package raks;

//FeedbackServlet.java
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.File;
import java.io.IOException;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import org.w3c.dom.Document;
import org.w3c.dom.Element;

public class Feedback extends HttpServlet {
 protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
     String name = request.getParameter("name");
     String email = request.getParameter("email");
     String comment = request.getParameter("comment");
     

         try {
             // Open the existing XML file
             File file = new File("feedbacks.xml");
             DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
             DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
             Document doc = dBuilder.parse(file);
             
             // Add the new feedback as an XML element
             Element feedbackElement = doc.createElement("feedback");
             Element nameElement = doc.createElement("name");
             nameElement.appendChild(doc.createTextNode(name));
             feedbackElement.appendChild(nameElement);
             Element emailElement = doc.createElement("email");
             emailElement.appendChild(doc.createTextNode(email));
             feedbackElement.appendChild(emailElement);
             Element commentElement = doc.createElement("comment");
             commentElement.appendChild(doc.createTextNode(comment));
             feedbackElement.appendChild(commentElement);
         
             doc.getDocumentElement().appendChild(feedbackElement);
             
             // Write the updated XML file back to disk
             TransformerFactory transformerFactory = TransformerFactory.newInstance();
             Transformer transformer = transformerFactory.newTransformer();
             DOMSource source = new DOMSource(doc);
             StreamResult result = new StreamResult(file);
             transformer.transform(source, result);
             
             System.out.println("Element added to XML file.");
             
         } catch (ParserConfigurationException | IOException | TransformerException | org.xml.sax.SAXException e) {
             e.printStackTrace();
         }
     
     
     response.sendRedirect("feed_form.jsp?success=true");
 }
}

