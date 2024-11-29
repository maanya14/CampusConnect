<?php
// Simulated posts and chat data (this would typically come from a database in a real application)
$posts = [
    ['title' => 'Annual Hackathon: Code for Change', 'description' => 'Join us for a 48-hour coding marathon to solve real-world problems. Great prizes and networking opportunities await!', 'image' => 'https://placehold.co/300x200?text=Hackathon+Event'],
    ['title' => 'Green Campus Initiative Kicks Off', 'description' => 'Be part of our sustainability drive! Join fellow students in planting trees and setting up recycling stations across campus.', 'image' => 'https://placehold.co/300x200?text=Green+Campus'],
    ['title' => 'Guest Lecture: Tech Entrepreneurship', 'description' => 'Don\'t miss out on an inspiring talk by Silicon Valley veteran and CEO of TechNova, Sarah Johnson. Limited seats available!', 'image' => 'https://placehold.co/300x200?text=Guest+Lecture'],
    ['title' => 'Annual Student Art Exhibition', 'description' => 'Explore the creative talents of our students at the upcoming art show. Photography, paintings, sculptures, and more on display.', 'image' => 'https://placehold.co/300x200?text=Art+Exhibition']
];

$chats = [
    ['name' => 'Maanya Gupta', 'lastMessage' => 'Hey, how\'s the project going?'],
    ['name' => 'Shambhavi Mishra', 'lastMessage' => 'Hey, how\'s the project going?'],
    ['name' => 'Anushka Tayal', 'lastMessage' => 'Thanks for the study notes!']
];

// Handle new chat submission (for demonstration)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new-chat-msg'])) {
    $newChatMessage = $_POST['new-chat-msg'];
    array_unshift($chats, ['name' => 'You', 'lastMessage' => $newChatMessage]);  // Add new chat at the top
}
?>
