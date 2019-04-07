<?php include __DIR__.'./head.php'?>
<?php include __DIR__.'./sidenav.php'?>
<section class="dashboard">

<?php 

$mystring = "primary,secondary";
$findme   = "primary";

if (strpos("primary,secondary", "primary") === false) {
    echo "The string '$findme' was not found in the string '$mystring'";
} else {
    echo "The string '$findme' was found in the string '$mystring'";
}
?>

</section>
<?php include __DIR__.'./foot.php'?>