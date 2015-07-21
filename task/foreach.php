<?php

$menu = [
    'Home' => 'index.php',
    'About Us' => 'about.php',
    'Contact' => 'contact.html'
];

echo "<table>";
echo "<tr>";
foreach ($menu as $key => $value) {
    echo "<td><a href='" . $value . "'>" . $key . "</a></td>";
}
echo "</tr>";
echo "</table>";

echo '<br>';

echo date('j F, Y   h:i:s A');