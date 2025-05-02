<?php include_once __DIR__ . '/partials/layouts/layout-top.php';
require_once __DIR__ .  '/conf/connection.php';
require_once __DIR__ . '/conf/function.php';

if (isset($_SESSION['isLogin']) == false) {
    echo '<script>window.location.href = "/index.php"</script>';
}
?>

<main>

    <div class="hero_single inner_pages background-image" data-background="url(https://images.pexels.com/photos/7919/pexels-photo.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1)">
        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1>Reserve a Table</h1>
                        <p>Per consequat adolescens ex cu nibh commune</p>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->

    <div class="pattern_2">
        <div class="container margin_120_100 pb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8" data-cue="slideInUp">
                    <div class="main_title">
                        <span><em></em></span>
                        <h2>Search for Time</h2>
                        <p>or Call us at 0344 32423453</p>
                    </div>
                    <div id="wizard_container">
                        <form method="GET" action="">
                            <div class="form-group">
                                <label for="reservation_date">Select Date</label><br>
                                <input class="form-control" type="date" id="reservation_date" name="reservation_date" required>
                            </div>
                            <div class="form-group">
                                <label for="reservation_time">Available Reservation Times</label>
                                <select name="reservation_time" id="reservation_time" class="form-control" required>
                                    <option value="" selected disabled>Select a Time</option>
                                    <?php
                                    for ($hour = 10; $hour <= 20; $hour++) {
                                        $time = sprintf('%02d:00:00', $hour);
                                        echo "<option value='$time'>$time</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Hidden input for head count. This input is used to determine the number of people that will be reserving the table. The default value is 1, which means the reservation is for 1 person. -->
                            <!--  -->
                            <input type="number" id="head_count" name="head_count" value="1" hidden required>
                            <button type="submit" class="custom-button" name="search">Search</button>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_GET['search'])) {

                    $selectedDate = $_GET['reservation_date'];
                    $selectedTime = $_GET['reservation_time'];
                    $head_count = $_GET['head_count'];

                    // Query to check reserved tables
                    $reservedQuery = "SELECT table_id FROM reservations WHERE reservation_date = '$selectedDate' AND reservation_time = '$selectedTime'";
                    $reservedResult = mysqli_query($conn, $reservedQuery);

                    // Collect reserved table IDs
                    $reservedTableIDs = array();
                    while ($row = mysqli_fetch_assoc($reservedResult)) {
                        $reservedTableIDs[] = $row['table_id'];
                    }

                    // Find available tables
                    $reservedTableIDsString = implode(",", $reservedTableIDs);
                    $availabilityQuery = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";

                    // Exclude reserved tables
                    if (!empty($reservedTableIDs)) {
                        $availabilityQuery .= " AND table_id NOT IN ($reservedTableIDsString)";
                    }

                    $availabilityResult = mysqli_query($conn, $availabilityQuery);
                ?>

                    <div class="col-lg-6 col-md-8">
                        <?php if (mysqli_num_rows($availabilityResult) > 0): ?>
                            <div class="main_title">
                                <span><em></em></span>
                                <h2>New Reservation</h2>
                                <p>or Call us at 0344 32423453</p>
                            </div>
                            <div id="wizard_container">
                                <form id="reservation-form" method="POST" action="insertReservation.php">
                                    <input type="hidden" name="reservation_date" value="<?= $selectedDate ?>">
                                    <input type="hidden" name="reservation_time" value="<?= $selectedTime ?>">
                                    <input type="hidden" name="head_count" value="<?= $head_count ?>">

                                    <!-- Customer Name Input -->
                                    <div class="form-group">
                                        <?php
                                        // Get the member ID from the session
                                        $memberId = $_SESSION['memberId'] ?? 0;
                                        $memberQuery = "SELECT * FROM memberships WHERE member_id = $memberId";
                                        $memberResult = mysqli_query($conn, $memberQuery);
                                        $member = mysqli_fetch_assoc($memberResult);

                                        ?>

                                        <label for="member_name">Customer Name</label>
                                        <input class="form-control" type="text" id="member_name" value="<?= $member['member_name'] ?>" readonly>
                                        <input class="form-control" type="hidden" id="member_name" name="member_name" value="<?= $member['member_name'] ?>" hidden>

                                    </div>

                                    <!-- Table Selection -->
                                    <div class="form-group">
                                        <label for="table_id">Select Table</label>
                                        <select class="form-control" name="table_id" id="table_id" required>
                                            <?php
                                            // Loop through the available tables query result
                                            // The result set is filtered to only include tables that are available for the selected date and time
                                            while ($row = mysqli_fetch_assoc($availabilityResult)) :
                                                // Query to check if the table is available for the selected date and time
                                                $tableAvailabilityQuery = "SELECT status FROM table_availability WHERE table_id = {$row['table_id']} AND reservation_date = '$selectedDate' AND reservation_time = '$selectedTime'";
                                                $tableAvailabilityResult = mysqli_query($conn, $tableAvailabilityQuery);
                                                $tableAvailability = mysqli_fetch_assoc($tableAvailabilityResult);

                                                // If the table is available (status = 0), add an option to the select menu
                                                if ($tableAvailability['status'] == false) :
                                            ?>
                                                    <option value="<?= $row['table_id'] ?>">
                                                        For <?= $row['capacity'] ?> people (Table ID: <?= $row['table_id'] ?>)
                                                    </option>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <!-- Special Request Input -->
                                    <div class="form-group mb-3">
                                        <label for="special_request">Special Request</label><br>
                                        <textarea class="form-control" id="special_request" name="special_request"></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="custom-button">Make Reservation</button>
                                </form>
                            <?php else: ?>
                                <h3>No Tables Available</h3>
                                <p>Unfortunately, there are no tables available at the selected time. Please choose another time.</p>
                            <?php endif; ?>
                            </div>
                    </div>

                <?php } ?>


            </div>
        </div>
    </div>
</main>
<?php include_once __DIR__ . '/partials/layouts/layout-bottom.php'; ?>