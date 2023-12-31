<?php

include "objects.php";

// create new database
$db = new Database();


//3. Test: Create new slots for given lecturer id ($booker,$duration,$start_time,$end_time,$lecturer)
$slot = new ConsultationSlot(null,60,"2024-03-14 11:00:00","2024-03-14 12:00:00",1);
//$slot = new ConsultationSlot(null,60,"2024-03-27 11:00:00","2024-03-27 12:00:00",1);
$db->writeSlotToDB($slot);