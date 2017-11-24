

<label for="countryName">Select Country:</label>
<select name="countryName" class="form-control country">
    <option value="">--- Select Country ---</option>
    <?php
        foreach ($country as $value) {
            echo "<option value='".$value->country_id."'>".$value->country_name."</option>";
        }
    ?>
</select>