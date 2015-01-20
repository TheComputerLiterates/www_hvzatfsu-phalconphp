<!DOCTYPE html>
<html>
	<head>
	
		{{ stylesheet_link("css/bootstrap.min.css")}}
		{{ stylesheet_link("css/main.css") }}
		{{ stylesheet_link("css/jquery.dataTables.min.css") }}

		{{ get_title() }}

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	</head>
	<body>
	
		<!-- Main layout moved to /layout/main.volt -->
		
		
		
		{{ content() }}
		

		
		<!-- {{ javascript_include("js/jquery-2.1.1.min.js") }} -->
		{{ javascript_include("http://code.jquery.com/jquery-1.11.1.min.js") }}
		{{ javascript_include("js/bootstrap.min.js") }}
		{{ javascript_include("js/main.js") }}
		{{ javascript_include("js/jquery.dataTables.min.js") }}

	</body>
</html>