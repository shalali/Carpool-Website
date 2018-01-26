<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Post Information</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
     <div class="inside">
        <div class="inn">
    <div>
    <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    <?php if(isset($_SESSION['userAdded'])){ ?>
        <br/><br/>
        <a href="view_login_successful.php">Back</a>
        <br/>
        <label id="lblHelloUser">Logged in: <?php echo $_SESSION['userAdded']; ?></label>

        <h2>Communte Journeys</h2>
    </div>
    <form id="frmCommunteJourney" action="model_journey.php" method="post">
        <table>
            <tr>
                <td>
                    <label id="lblStartingPoint">Starting Point:</label>
                </td>
                <td> <input type="text" id="txtStartingPoint" name="startingPoint" required>
                </td>
            </tr>            <tr>
                <td>
                    <label id="lblDestination">Destination:</label>
                </td>
                <td>
                    <input type="text" id="txtDestinaton" name="destination" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label id="lblTravelTime" >Travel Time:</label>
                </td>
                <td>
                    <input type="text" id="txtTravelTime" name="travelTime" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label id="lblDays">Days:</label>
                </td>
                <td>
                    <input type="checkbox" name="check_list[]" value="Monday">Mon
                    <input type="checkbox" name="check_list[]" value="Tuesday">Tue
                    <input type="checkbox" name="check_list[]" value="Wednesday">Wed
                    <input type="checkbox" name="check_list[]" value="Thursday">Thur
                    <input type="checkbox" name="check_list[]" value="Friday">Fri
                    <input type="checkbox" name="check_list[]" value="Saturday">Sat
                    <input type="checkbox" name="check_list[]" value="Sunday">Sun
                </td>
            </tr>
        
            <tr>
                <td>

                </td>
                <td>
                    <input type="submit" value="Add Journey" name="aboutMeSave">

              </td>
            </tr>
        </table>
        <br>

    </form>
    <?php }else {
            header('location: view_login.php');
            exit();
    
        }?>
          </div>
        </div>
</body>


</html>
