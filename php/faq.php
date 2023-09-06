<?php
	$faq = array(
		"Q: What is your return policy?" => "A: Our return policy is...",
		"Q: How do I contact customer service?" => "A: You can contact our customer service at...",
		"Q: Can I cancel my order?" => "A: Yes, you can cancel your order...",
		"Q: What payment methods do you accept?" => "A: We accept...",
		"Q: How long does shipping take?" => "A: Shipping takes..."
	);

	$question = $_POST['question'];
	$answer = "";

	foreach ($faq as $q => $a) {
		if (strpos($q, $question) !== false) {
			$answer = $a;
			break;
		}
	}

	echo json_encode(array('answer' => $answer));
?>
