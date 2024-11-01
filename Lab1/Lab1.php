<?php

    $student1 = [
        "name" => "jani Makraduli",
        "age" => 20,
        "grades" => [85, 90, 78]
    ];

    $student2 = [
        "name" => "vlado Buckovski",
        "age" => 21,
        "grades" => [78, 76, 83]
    ];

    $student3 = [
        "name" => "afrim Gashi",
        "age" => 24,
        "grades" => [84, 52, 91]

    ];

    $student4 = [
        "name" => "mitko Janchev",
        "age" => 23,
        "grades" => [81, 64, 53]
    ];

    $student5 = [
        "name" => "dragi Rashkovski",
        "age" => 20,
        "grades" => [80, 65, 64]
    ];

    $students = [$student1, $student2, $student3, $student4, $student5];

    function averageGrade($student) {
        $sum = 0;
        for ($i = 0; $i < count($student["grades"]); $i++) {
            $sum += $student["grades"][$i];
        }
        return $sum / count($student["grades"]);
    }

    echo averageGrade($student1);

    function filterByAge($students, int $age) {
        $sortedArray = [];
        for ($i = 0; $i < count($students); $i++) {
            if ($students[$i]["age"] > $age) {
                array_push($sortedArray, $students[$i]);
            }
        }
        return print_r($sortedArray);
    }

    filterByAge($students, 20);

    function capitalizeFirstLetter($students) {
        foreach ($students as $student) {
            echo ucfirst($student["name"] . ", ");
        }
    }

    capitalizeFirstLetter($students);

    function displayStudents($students) {
        foreach ($students as $student) {
            echo ucfirst(PHP_EOL . "Name: " . ucfirst($student["name"])) . "," . "Age: " . $student["age"] . "," . "Average: " . averageGrade($student) . PHP_EOL;
        }
    }

    displayStudents($students);

    function sortByName($students) {
        sort($students);
        foreach ($students as $student) {
            echo ucfirst($student["name"]) . ", " . "Age: " . $student["age"] . PHP_EOL;
        }
    }

    sortByName($students);

?>