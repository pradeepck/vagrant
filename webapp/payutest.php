<html>
	<head>
		<title>
			Payu Test Page
		</title>
	  <script>
		function submitForm() {
		alert("hi!!!");
		var payuForm = document.forms.payuForm;
		payuForm.submit();
		}
	</script>

	</head>
	<body onload="submitForm()" >
		<form action="/testjquery/PayUMoney_form.php" name="payuForm" method="post">
			<input type="hidden" name="amount" value="500"></input>
			<input type="hidden" name="firstname" value="Pradeep"></input>			
			<input type="hidden" name="email" value="pradeep.ck@gmail.com"></input>						
			<input type="hidden" name="phone" value="9373306729"></input>									
			<input type="hidden" name="productinfo" value="Job posting for 15 days"></input>
			<input type="hidden" name="surl" value="http://localhost/testjquery/success.php"></input>
			<input type="hidden" name="furl" value="http://localhost/testjquery/failure.php"></input>						<input type="hidden" name="service_provider" value="payu_paisa" size="64" />
            <input type="hidden" name="key" value="JBZaLc" />
			  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
			  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
			
		</form>
	</body>

</html>