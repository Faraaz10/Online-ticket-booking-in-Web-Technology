<?php
class Website {
    private $name;
    private $description;
    private $services;

    public function __construct($name, $description, $services) {
        $this->name = $name;
        $this->description = $description;
        $this->services = $services;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getServices() {
        return $this->services;
    }

    public function displayContent() {
        echo "<h1>Welcome to " . $this->getName() . "</h1>";
        echo "<p>" . $this->getDescription() . "</p>";
        echo "<h2>Our Services</h2>";
        echo "<ul>";
        foreach ($this->getServices() as $service) {
            echo "<li>" . $service . "</li>";
        }
        echo "</ul>";
    }
}

// Example data
$name = "Faramad Voyage";
$description = "Faramad Voyage is your ultimate solution for booking train journeys across the country. We offer a seamless booking experience with detailed information and customer support.";
$services = [
    "Online Train Booking",
    "Booking Management",
    "Customer Support",
    "Special Discounts"
];

// Create an instance of the Website class
$website = new Website($name, $description, $services);
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us - <?php echo $website->getName(); ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        p { font-size: 1.2em; }
        ul { list-style-type: disc; }
    </style>
</head>
<body>
    <?php
        // Display the content of the website
        $website->displayContent();
    ?>
</body>
</html>
