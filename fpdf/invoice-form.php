<html>
	<head>
		<title>Invoice Generator</title>
	</head>
	<body>
		<form method='post' action='invoice-result.php'>
			<table>
				<tr>
					<td>Date</td>
					<td> <input type='text' name='date' /> </td>
				</tr>
				<tr>
					<td>ID</td>
					<td> <input type='text' name='id' /> </td>
				</tr>
				<tr>
					<td>Customer ID</td>
					<td> <input type='text' name='custId' /> </td>
				</tr>
				<tr>
					<td colspan=2>
					<b>Bill to</b>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td> <input type='text' name='name' /> </td>
				</tr>
				<tr>
					<td>Company</td>
					<td> <input type='text' name='company' /> </td>
				</tr>
				<tr>
					<td>Address</td>
					<td> <input type='text' name='address' /> </td>
				</tr>
				<tr>
					<td>Phone</td>
					<td> <input type='text' name='phone' /> </td>
				</tr>
				<tr>
					<td colspan=2>
					<b>Item 1</b>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td> <input type='text' name='item1name' /> </td>
				</tr>
				<tr>
					<td>Taxable</td>
					<td> <input type='text' name='item1tax' /> </td>
				</tr>
				<tr>
					<td>Amount</td>
					<td> <input type='text' name='item1amount' /> </td>
				</tr>
				<tr>
					<td colspan=2>
					<b>Item 2</b>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td> <input type='text' name='item2name' /> </td>
				</tr>
				<tr>
					<td>Taxable</td>
					<td> <input type='text' name='item2tax' /> </td>
				</tr>
				<tr>
					<td>Amount</td>
					<td> <input type='text' name='item2amount' /> </td>
				</tr>
				<tr>
					<td colspan=2>
					<b>Item 3</b>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td> <input type='text' name='item3name' /> </td>
				</tr>
				<tr>
					<td>Taxable</td>
					<td> <input type='text' name='item3tax' /> </td>
				</tr>
				<tr>
					<td>Amount</td>
					<td> <input type='text' name='item3amount' /> </td>
				</tr>
				<tr>
					<td colspan=2>
					<input type=submit value='Generate' />
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>