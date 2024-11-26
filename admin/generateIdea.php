<?php
// Define an array with ingredient-based mix ideas
$ideas = [
    "Combine spaghetti noodles with coconut milk and a hint of garlic for a creamy fusion.",
    "Mix bihon noodles with peanut sauce and sprinkle with fried garlic for an Asian twist.",
    "Top sotanghon noodles with sweet coconut syrup and crushed nuts for a unique blend of sweet and savory.",
    "Use rice flour from maha-biko with stir-fried vegetables for a gluten-free noodle base.",
    "Layer bihon with a coconut caramel sauce for a dessert-inspired twist.",
    "Pair palabok shrimp sauce with garlic spaghetti noodles for a seafood delight.",
    "Sauté garlic with rice flour and coconut milk for a rich, creamy base sauce.",
    "Combine bihon noodles with crushed peanuts and lemon zest for added texture and flavor.",
    "Use spaghetti noodles with a sprinkle of shredded coconut and fried garlic for fusion flavor.",
    "Mix sotanghon noodles with a creamy coconut milk sauce and dash of pepper.",
    "Blend peanut sauce with garlic bihon noodles for a crunchy and creamy combination.",
    "Top palabok sauce with shredded chicken and toasted coconut for a tropical twist.",
    "Combine ground pork with rice flour for a filling base in a noodle stir-fry.",
    "Sauté mushrooms with garlic and serve over bihon noodles for a hearty dish.",
    "Add sliced green onions and sesame seeds to palabok sauce for a fresh topping.",
    "Use coconut milk as a base with spaghetti noodles and a pinch of chili flakes.",
    "Create a spicy garlic paste with shrimp and serve with sotanghon noodles.",
    "Layer shredded cabbage and bihon noodles with coconut garlic sauce.",
    "Combine fried tofu with bihon noodles and a soy-based dressing.",
    "Use spaghetti with a creamy garlic peanut sauce for an Asian fusion touch.",
    "Make a coconut-based sauce with thinly sliced vegetables over bihon noodles.",
    "Combine grilled shrimp with sotanghon noodles and a tangy lime dressing.",
    "Top spaghetti with shredded carrots and a hint of garlic for freshness.",
    "Mix coconut cream with chili garlic sauce over palabok noodles.",
    "Add sliced bell peppers and a hint of garlic to coconut-sautéed spaghetti.",
    "Create a curry-coconut sauce with sotanghon for a tropical-inspired twist.",
    "Use shredded pork and sesame oil with bihon noodles for a rich base.",
    "Layer crispy onions with coconut peanut sauce on top of sotanghon noodles.",
    "Add green onions and soy sauce with garlic sotanghon for an umami taste.",
    "Use crispy fried garlic over bihon noodles with peanut dressing.",
    "Mix diced chicken with sotanghon and a hint of ginger for an earthy flavor.",
    "Combine crushed peanuts with coconut and lime zest for a noodle topping.",
    "Use spaghetti with shredded vegetables and a garlic-soy sauce dressing.",
    "Make a spicy peanut sauce with sotanghon and top with sliced cucumbers.",
    "Mix rice flour with shredded cabbage and spicy chili for a savory stir-fry.",
    "Layer spaghetti with coconut garlic sauce and a sprinkle of sesame seeds.",
    "Add lime zest and grilled shrimp to garlic bihon noodles for a fresh taste.",
    "Mix palabok sauce with diced mushrooms and a touch of garlic.",
    "Top sotanghon noodles with spicy coconut cream and crushed peanuts.",
    "Combine tofu with garlic bihon noodles and a squeeze of lemon juice.",
    "Layer spaghetti with coconut shrimp sauce for a seafood-infused twist.",
    "Use a garlic peanut sauce with sotanghon and fresh cilantro.",
    "Add green beans and sliced red peppers to coconut rice flour noodles.",
    "Use shredded coconut with crispy garlic over bihon noodles for added flavor.",
    "Mix ground pork with soy sauce and sliced bell peppers over bihon noodles.",
    "Make a rich coconut cream sauce with spaghetti and crushed peanuts.",
    "Top bihon noodles with shrimp, garlic, and a hint of chili flakes.",
    "Add grilled vegetables over sotanghon with a coconut-garlic sauce.",
    "Combine shredded chicken with garlic bihon noodles for a savory base.",
    "Use coconut milk with lemon zest and garlic as a creamy sotanghon sauce.",
    "Add chopped peanuts and green onions over coconut palabok noodles."
];

// Check if the array is not empty
if (!empty($ideas)) {
    // Randomly select one idea
    $selectedIdea = $ideas[array_rand($ideas)];

    // Return the idea as a JSON response
    echo json_encode([
        'status' => 'success',
        'generated_text' => $selectedIdea
    ]);
} else {
    // Handle the case where the array is empty
    echo json_encode([
        'status' => 'error',
        'message' => 'No ideas are available at the moment.'
    ]);
}
?>
