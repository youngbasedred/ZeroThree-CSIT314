<?php
class CreateCategoryBoundary
{

    // display the create category form
    public function displayCreateCategory($errors = [])
    {
        echo "<h2>Create New Volunteer Service Category</h2>";

        if (!empty($errors)) {
            echo "<p style='color:red;'>" . implode("<br>", $errors) . "</p>";
        }

        echo "
        <form method='POST'>
            <label>Category Name:</label><br>
            <input type='text' name='category_name' required><br><br>

            <label>Description:</label><br>
            <textarea name='description' rows='3' cols='30'></textarea><br><br>

            <button type='submit' name='submit'>Create Category</button>
        </form>
        ";
    }

    // retrieve submitted form data
    public function getFormData()
    {
        return [
            'category_name' => trim($_POST['category_name'] ?? ''),
            'description' => trim($_POST['description'] ?? '')
        ];
    }

    // display success message
    public function displaySuccess($categoryID)
    {
        echo "<p style='color:green;'>✅ Category successfully created! (Category ID: $categoryID)</p>";
    }
}
