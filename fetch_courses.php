<?php
require 'db.php';

$type = $_GET['instrument'] ?? 'all';
$level = $_GET['level'] ?? 'any';
$age = $_GET['age'] ?? 'any';

$query = "SELECT * FROM courses WHERE 1=1";

if ($type !== 'all') {
    $query .= " AND instrument = :instrument";
}
if ($level !== 'any') {
    $query .= " AND level = :level";
}
if ($age !== 'any') {
    $query .= " AND age_group = :age";
}

$query .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($query);
if ($type !== 'all') $stmt->bindValue(':instrument', $type);
if ($level !== 'any') $stmt->bindValue(':level', $level);
if ($age !== 'any') $stmt->bindValue(':age', $age);
$stmt->execute();

$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($courses) {
    foreach ($courses as $course) {
              $image = !empty($course['image_url']) ? htmlspecialchars($course['image_url']) : 'assets/img/course_placeholder.jpg';

        echo "<li class='card' data-cat='" . strtolower($course['instrument']) . " " . strtolower($course['level']) . " " . strtolower($course['age_group']) . "'>";
        echo "  <img loading='lazy' class='card-media' src='$image' alt='" . htmlspecialchars($course['title']) . "' />";
        echo "  <p class='small'>" . ucfirst($course['level']) . " · " . htmlspecialchars($course['duration']) . "</p>";
        echo "  <h3>" . htmlspecialchars($course['title']) . "</h3>";
        echo "  <p>" . htmlspecialchars($course['description']) . "</p>";
        echo "  <a class='btn btn-link learn-more' data-course-id='" . $course['course_id'] . "' href='#'>Learn More</a>";
        echo "</li>";
    }
} else {
    echo "<p>No courses found matching your filters.</p>";
}