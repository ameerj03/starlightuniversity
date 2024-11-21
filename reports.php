<div class="md-4 mb-3 form-group">
    <label for="receiver">To</label>
    <select name="receiver" id="receiver" class="form-select form-select-md md-4 mb-3">
        <option selected disabled>Select...</option>
        <?php
        $select_users= "SELECT * FROM user WHERE role='student'";
        $select_users_query = $conn->query($select_users);
        if ($select_users_query->num_rows > 0) {
            while ($rows = $select_users_query->fetch_assoc()) {
                echo '<option value="' . $rows['id'] . '">' . $rows['name'] . ' ' . $rows['lastname'] . '</option>';
                
            }
        }
        ?>
    </select>
</div>