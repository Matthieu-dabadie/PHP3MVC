<?php
$title = "Mon Portfolio - Liste des créations";
?>
<div class="container">
    <h2 class="m-3">Liste de mes créations</h2>
    <a href="index.php?controller=creation&action=add"><button type="button" class="btn my-3 btn-primary">Ajouter une création</button></a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Created at</th>
                <th scope="col">Picture</th>
                <th scope="col">View</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list as $value) {
                echo "<tr>";
                echo "<td>" . $value->id_creation . "</td>";
                echo "<td>" . $value->title . "</td>";
                echo "<td>" . $value->description . "</td>";
                echo "<td>" . $value->created_at . "</td>";
                echo "<td><img src='$value->picture' class='picture'></td>";
                echo "<td><a href='index.php?controller=creation&action=showCreation&id=$value->id_creation'><i class='fas fa-eye'></i></a></td>";
                echo "<td><a href='index.php?controller=creation&action=updateCreation&id=$value->id_creation'><i class='fas fa-pen'></i></a></td>";
                echo "<td><a href='index.php?controller=creation&action=deleteCreation&id=$value->id_creation'><i class='fas fa-trash-alt'></i></a></td>";
                echo "</tr>";
            }
            ?>
    </table>
</div>