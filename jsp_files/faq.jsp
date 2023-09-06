<%@ page contentType="application/json" %>
<%
  // create an array of FAQs
  String[][] faqs = {
    {"What is AJAX?", "AJAX stands for Asynchronous JavaScript and XML. It is a set of techniques for creating fast and dynamic web pages."},
    {"How do I use AJAX in my web pages?", "You can use AJAX by making HTTP requests to a server-side script that returns data in a suitable format, such as JSON or XML."}
    // add more FAQs as needed
  };

  // convert the FAQs to JSON format
  String faqsJson = "[";
  for (int i = 0; i < faqs.length; i++) {
    String[] faq = faqs[i];
    faqsJson += "{\"question\":\"" + faq[0] + "\",\"answer\":\"" + faq[1] + "\"}";
    if (i < faqs.length - 1) {
      faqsJson += ",";
    }
  }
  faqsJson += "]";
%>
<%= faqsJson %>
