<?php
// Test script untuk cek routing dan parameters

echo "<h1>Routing Test</h1>";
echo "<p>URL: " . $_SERVER['REQUEST_URI'] . "</p>";
echo "<p>GET parameters:</p>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<p>POST parameters:</p>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<hr>";
echo "<a href='" . BASE_URL . "'>Home</a> | ";
echo "<a href='" . BASE_URL . "task'>Task List</a> | ";
echo "<a href='" . BASE_URL . "task?page=2'>Task Page 2</a> | ";
echo "<a href='" . BASE_URL . "task?page=3&search=test'>Task Page 3 with search</a>";
?>