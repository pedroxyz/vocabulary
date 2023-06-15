<?php 

	error_reporting(0);
	include_once ('../database/connection.php');

	$curso = $_POST['curso'];

	$sql = "SELECT
				course,
				unit,
				exercise,
				word1,
				word2,
				correct,
				translation,
				version,
				image
			FROM vocabulary
			WHERE course = '$curso'
			ORDER BY RAND()
			LIMIT 10";

	$getData = mysqli_query( $conn, $sql );

	if( mysqli_num_rows($getData) > 0 ){

		$result = array();

		while( $row = mysqli_fetch_assoc( $getData ) ){

			array_push(
				$result, 
				array(
						'curso'			=> $row['course'],
						'unidad'		=> $row['unit'],
						'ejercicio'		=> $row['exercise'],
						'palabra1'		=> utf8_encode($row['word1']),
						'palabra2'		=> utf8_encode($row['word2']),
						'correcta'		=> utf8_encode($row['correct']),
						'traduccion'	=> utf8_encode($row['translation']),
						'version'		=> $row['version'],
						'imagen'		=> $row['image']
				)
			);

		}

		mysqli_close($conn);
		echo json_encode($result);

	} else {

		$result = array(
			'message' => 'error'
		);

		mysqli_close($conn);
		echo json_encode($result);

	}

?>