<?php
    include_once '../../header.php';
    include_once '../../helpers/session_helper.php';
?>

    <h1 class="header">Please Signup</h1>

<?php flash('register') ?>

    <form method="post" action="../../controllers/Users.php">
        <input type="hidden" name="type" value="register">
        <input type="text" name="first_name"
               placeholder="First name">
        <input type="text" name="last_name"
                placeholder="Last name">
        <input type="text" name="adress"
               placeholder="Adress">
        <input type="text" name="city"
               placeholder="City">
        <input type="number" name="phone"
               placeholder="Phone number">
        <input type="text" name="email"
               placeholder="Email">
        <input type="password" name="password"
               placeholder="Password">
        <input type="password" name="pwdRepeat"
               placeholder="Repeat password">
        <button type="submit" name="submit">Sign Up</button>
    </form>

<?php
include_once '../../footer.php'
?>