<?php
session_start();


if (!$_SESSION['loggedInUser']){
    header("Location: index.php");
}


include ('includes/connection.php');
include ('includes/functions.php');

if (isset($_POST['add'])){
    $clientName = $clientEmail = $clientPhone = $clientAddress = $clientCompany = $clientNotes = "";

    if (isset($_POST['clientName'])){

        $nameError = "Please enter a name <br>";
    }
    else{
        $clientName = validateFormData( $_POST["clientName"]);
    }
    if (isset($_POST['clientEmail'])){

        $nameError = "Please enter a email <br>";
    }
    else{
        $clientEmail = validateFormData( $_POST["clientEmail"]);
    }

    $clientPhone = validateFormData( $_POST["clientPhone"]);
    $clientNotes = validateFormData( $_POST["clientNotes"]);
    $clientCompany = validateFormData( $_POST["clientCompany"]);
    $clientAddress = validateFormData( $_POST["clientAddress"]);

    if ($clientName && $clientEmail){

        $query = "INSERT INTO clients (id,name,email,phone,address,company,notes,date_added)
                   VALUES (NULL ,'$clientName','$clientEmail','$clientPhone','$clientAddress','$clientNotes', CURRENT_TIMESTAMP )";

        $result = mysqli_query($conn, $query);

        if ($result){

            header("Location: clients.php?alert=success");

        }
        else{

            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }


}

mysqli_close($conn);

include('includes/header.php');

?>

<h1>Add Client</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
    <div class="form-group col-sm-6">
        <label for="client-name">Name *</label>
        <input type="text" class="form-control input-lg" id="client-name" name="clientName" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-email">Email *</label>
        <input type="text" class="form-control input-lg" id="client-email" name="clientEmail" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-phone">Phone</label>
        <input type="text" class="form-control input-lg" id="client-phone" name="clientPhone" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-address">Address</label>
        <input type="text" class="form-control input-lg" id="client-address" name="clientAddress" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-company">Company</label>
        <input type="text" class="form-control input-lg" id="client-company" name="clientCompany" value="">
    </div>
    <div class="form-group col-sm-6">
        <label for="client-notes">Notes</label>
        <textarea type="text" class="form-control input-lg" id="client-notes" name="clientNotes"></textarea>
    </div>
    <div class="col-sm-12">
            <a href="clients.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add Client</button>
    </div>
</form>

<?php
include('includes/footer.php');
?>