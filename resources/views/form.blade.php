<!DOCTYPE html>
<html>
<body>
    <h1> Buat Account Baru </h1>
    <h2> Sign Up Form</h2>
    <form action="/welcome" method="POST">
        @csrf
        <label for="nama_user"> First name: </label><br>
        <br>
        <input types="text" id="nama_user" name="firstname"><br>
        <br>
        <label> Last name: </label><br>
        <br>
        <input types="text" name="lastname"><br>
        <br>
        <label> Gender: </label><br>
        <br>
        <input type="radio" name="gander" values"0"> Male <br>
        <input type="radio" name="gander" values "1"> Female<br>
        <input type="radio" name="gander" values "2"> Other <br>
        <br>
        <label>Natonality:</label><br>
        <br>
        <select>
            <option name="I"> Indonesian </option>
            <option name="M"> Malaysian </option>
            <option name="S"> Singapore </option>
            <option name="T"> Thailand </option>
            <option name="J"> Japanese </option>
        </select><br>
        <br>
        <label for="language_user"> Language Spoken: </label><br>
        <br>
        <input type="checkbox" name="language" value="6"> Bahasa Indonesia <br>
        <input type="checkbox" name="language" value="7"> English <br>
        <input type="checkbox" name="language" value="8"> Other <br>
        <br>
        <label for="bio_user"> Bio: </label><br>
        <br>
        <textarea id="bio_user" cols="30" rows="10"></textarea><br>
        <input type="submit" value="Sign Up">
        
    </form>
</body>
</html>