<!DOCTYPE html>
<html lang="hr">
	<head>
		<meta charset="utf-8">
	</head>
	<style>
	body { 
		font-family: DejaVu Sans, sans-serif;
		font-size: 10px;
	}
	</style>

	<body>
		<h3>U tijeku je odjava radnika {{ $ime . ' ' . $prezime }}, zaposlenom na radnom mjestu {{ $radno_mj }}.</h3>
		<h3>Zadnji radni dan je {{date("d.m.Y", strtotime($djelatnik->datum_odjave)) }}. </h3>

	</body>
</html>