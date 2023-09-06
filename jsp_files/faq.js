$(document).ready(function() {
  // make an AJAX request to get the FAQs
  $.getJSON('faq.jsp', function(data) {
    // iterate over the FAQs and create HTML elements for each one
    var faqHtml = '';
    $.each(data, function(i, faq) {
      faqHtml += '<h2>' + faq.question + '</h2>';
      faqHtml += '<p>' + faq.answer + '</p>';
    });

    // add the HTML elements to the FAQ container
    $('#faq-container').html(faqHtml);
  });
});
