<style>
html {
	font-family: sans;
}

p {
	display: flex;
	align-items: center;
}

input {
	height: 40px;
}

input[type=submit] {
	background-color: #4299e1;
	border: 0;
	padding: 0px 16px;
	border-radius: 4px;
	cursor: pointer;
}

a {
	background-image: url("data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzMwMHB4JyB3aWR0aD0nMzAwcHgnICBmaWxsPSIjRkYzNDM0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMTAwIDEwMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHBhdGggZD0iTTY0LjM3NCwxNC4yNDFjLTQuNDQxLTEuNzg3LTkuMjkzLTIuNzcxLTE0LjM3NS0yLjc3MWMtMTkuNjU4LDAtMzUuODc5LDE0LjcyMy0zOC4yMzQsMzMuNzQyICBjLTAuMTk1LDEuNTctMC4yOTUsMy4xNjgtMC4yOTUsNC43ODljMCwyMS4yODEsMTcuMjUsMzguNTI3LDM4LjUyOSwzOC41MjdjMjEuMjgzLDAsMzguNTMxLTE3LjI0NiwzOC41MzEtMzguNTI3ICBDODguNTMsMzMuODAyLDc4LjUzNiwxOS45MzgsNjQuMzc0LDE0LjI0MXogTTY2LjE4OSw0Mi4xM0w0OC4wNjIsNjMuNDk1Yy0wLjI5NiwwLjM1LTAuNzE5LDAuNTMtMS4xNDUsMC41MyAgYy0wLjMyNywwLTAuNjU3LTAuMTA3LTAuOTMzLTAuMzI2bC0xMi40NC05LjljLTAuNjQ4LTAuNTE3LTAuNzU2LTEuNDYtMC4yNC0yLjEwOGMwLjUxNi0wLjY0NywxLjQ2MS0wLjc1NSwyLjEwNy0wLjIzOSAgbDExLjMwNCw4Ljk5NWwxNy4xODgtMjAuMjU3YzAuNTM1LTAuNjMzLDEuNDgtMC43MTIsMi4xMTQtMC4xNzRDNjYuNjQ4LDQwLjU1Miw2Ni43MjYsNDEuNDk4LDY2LjE4OSw0Mi4xM3oiPjwvcGF0aD48L3N2Zz4=");
	background-size: cover;
	display: inline-block;
	width: 30px;
	height: 30px;
	margin-right: 8px;
}
</style>

<form id="formulario" action="?" method="GET">
	<input type="text" name="tarea" placeholder="Task description..." required>
	<input type="submit" value="Add task">
</form>

<?php
$mysqli = new mysqli("localhost", "mytasks_user", "mytasks_password", "mytasks_database");

if(isset($_GET["tarea"])){
	$stmt = $mysqli->prepare("INSERT INTO tasks VALUES (?)");
	$stmt->bind_param("s", $_GET["tarea"]);
	$stmt->execute();
	$stmt->close();
}

if(isset($_GET["eliminar"])){
        $stmt = $mysqli->prepare("DELETE FROM tasks WHERE task = ?");
        $stmt->bind_param("s", $_GET["eliminar"]);
        $stmt->execute();
        $stmt->close();
}

$resultado = $mysqli->query("SELECT * FROM tasks");

while ($fila = $resultado->fetch_assoc()) {
	$tarea = $fila["task"];
    	echo "<p><a href='?eliminar=$tarea' onclick='audio.play()'></a>$tarea</p>";
}

?>
<script>
[...document.getElementsByTagName("p")].forEach((element) => {
	element.style.color = Math.floor(Math.random()*16777215).toString(16);
});

var audio = new Audio("data:audio/mpeg;base64,//OExAAAAAAAAAAAAFhpbmcAAAAPAAAABAAABAgAZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmZmzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzPj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj4+Pj/////////////////////////////////AAAAPExBTUUzLjEwMAR4AAAAAAAAAAAVCCQEWCEAAcwAAAQIIJrXhwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//O0xAASiFLJn0MAAEMAOW3e3993d3fROuHAwMDAAAMCcPiMHwfUGOsHAQBB3lATB8HwfB8EAQ/9pQ5/AYP///8Hz7//KAgCAIO//gQEAQOeCAJg+D4PqokyoAEAAAIF6q1pIBEVGYsKmRBI4PlcWABEwccEIsIAs3QdMxKSIVMEDTABFAQVQswICe4xxMFAOYEAIWBhgQBgIBiRKbqYBPIWHwsrTI4TVUQHmZQMY3BphYmmHRQZOxZjoSgo+koNS1SB4zNQESBQYGIeqcCxPMEAZV6laXC+k1mVSN+WxO83WWUcGwtga6G4O84A0AHZdl2aaXWn9g6vF9d1DbcS0d1YZ15WytnK5Vls1YC+zDq0ikstdWzZ5zP1B2Hu7LnOgh2mDw5ctf92mppdXx+5/////2O3a9JeoJi5GOTrkRpyV8U1Nlla1S7xq2e2oZpp//O0xPhUtCqq/5vgKfduXwa1/OJz383hV5l9Z32KPUtScXevVmsv1UnuUdA/G/1zX5bpYzQS61ly5S1bOu6h6J3oIkXY7yltUsTje6s9R1bP/7w3KSBWcQA7kGag3dqH6JuLZX80ACIBTKAXHbV7tWrVq1aeu1XLntWu4uXc09rJiIIEQIgBg+kOQUgKg1FVYWZmvVWZmZuVZmv1VWvVVWv+VVVW5VVVVrVVr4Zf2Zm+GZma/ZmZmb////////2av+GZlVVNOyoKuBp5YGjyxEDX/iIGQVBWIgVd4NA0DR1QNUxBTUUzLjEwMFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//NkxOgeep6SP8xAAFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV//MUxPEAAANIAAAAAFVVVVVVVVVVVVVV");
</script>
