<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ page import="java.io.*, javax.xml.parsers.*, org.w3c.dom.*, javax.xml.transform.*,org.w3c.dom.Document,org.w3c.dom.Element, javax.xml.transform.dom.*, javax.xml.transform.stream.*"%>

<%
    String name = request.getParameter("name");
    String email = request.getParameter("email");
    String comment = request.getParameter("comment");
    
   
    
    try {
        File file = new File("feedbacks.xml");
        DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
        DocumentBuilder builder = factory.newDocumentBuilder();
        Document doc = builder.newDocument();

        // add new feedback element to doc here
    } catch (Exception e) {
        e.printStackTrace();
    }

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
    Element rootElement = doc.getDocumentElement();
    rootElement.appendChild(feedbackElement);
    out.println(name); 
    out.println(email);
    out.println(commentElement);
    out.println(feedbackElement);
    out.println(rootElement);
    
    // Save the XML file
    TransformerFactory transformerFactory = TransformerFactory.newInstance();
    Transformer transformer = transformerFactory.newTransformer();
    transformer.setOutputProperty(OutputKeys.INDENT, "yes");
    DOMSource source = new DOMSource(doc);
    StreamResult result = new StreamResult(new FileOutputStream("feedbacks.xml"));
    transformer.transform(source, result);
%>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Feedback Submitted</title>
</head>
<body>

    <h1>Feedback Submitted</h1>
    <p>Thank you for your feedback!</p>
</body>
</html>
