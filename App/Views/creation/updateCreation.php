<?php
$title = "Mon Portfolio - Modification d'une création";

?>

<h1 class="text-center my-4">Modification d'une création</h1>
<?php
if (!empty($erreur)) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $erreur; ?>
    </div>
<?php
}
?>
<section class="row">
    <div class="col-2 align-self-end"><img src="<?php echo $creation->picture ?>" alt="Image de la création" class="img-fluid"></div>
    <div class="col-10"><?php echo $updateForm; ?></div>
</section>