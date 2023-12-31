<?php

class Lecturer
{
    public $firstname, $lastname, $pw = null;

    public function __construct($firstname, $lastname, $pw)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->pw = $pw;
    }

    public function pw_isvalid()
    {
        if (strlen($this->pw) >= 6 && preg_match('/[A-Z]/', $this->pw)) {
            return true;
        } else return false;
    }
}


class Student extends Lecturer
{
    public $matrnr, $email = null;

    public function __construct($firstname, $lastname, $matrnr, $email, $pw)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->matrnr = $matrnr;
        $this->email = $email;
        $this->pw = $pw;
    }
}


class ConsultationSlot
{
    public $booker, $duration, $start_time, $end_time, $lecturer = null;

    public function __construct($booker, $duration, $start_time, $end_time, $lecturer, $status = "available")
    {
        $this->booker = $booker;
        $this->duration = $duration;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->lecturer = $lecturer;
        $this->status = $status;
    }

    public function show()
    {
        if ($this->booker === "null" || is_null($this->booker)) {
            $this->booker = " ";
        }
        $a = 1;
        echo "<h2>Consulting Slot</h2>";
        echo "<ul>";
        echo "<li>" . htmlspecialchars("Booker") . ": " . htmlspecialchars($this->booker) . "</li>";
        echo "<li>" . htmlspecialchars("Duration") . ": " . htmlspecialchars($this->duration) . "</li>";
        echo "<li>" . htmlspecialchars("Start_Time") . ": " . htmlspecialchars($this->start_time) . "</li>";
        echo "<li>" . htmlspecialchars("End_Time") . ": " . htmlspecialchars($this->end_time) . "</li>";
        echo "<li>" . htmlspecialchars("Lecturer") . ": " . htmlspecialchars($this->lecturer) . "</li>";
        echo "<li>" . htmlspecialchars("Status") . ": " . htmlspecialchars($this->status) . "</li>";
        echo "</ul>";
        echo "_____________________________________________________________________________________";
    }
}


class Database
{
    protected $db;

    public function __construct($filename = "myportfolio.db")
    {
        try {
            $this->db = new SQLite3($filename);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function writeStudentToDB($student)
    {
        $sql = "INSERT INTO student(id,first_name,last_name,mtr,email,pw) VALUES (?,?,?,?,?,?)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(2, $student->firstname, SQLITE3_TEXT);
            $stmt->bindValue(3, $student->lastname, SQLITE3_TEXT);
            $stmt->bindValue(4, $student->matrnr, SQLITE3_TEXT);
            $stmt->bindValue(5, $student->email, SQLITE3_TEXT);
            $stmt->bindValue(6, $student->pw, SQLITE3_TEXT);
            $stmt->execute();
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function writeLecturerToDB($lecturer)
    {
        $sql = "INSERT INTO lecturer(id,first_name,last_name,pw) VALUES (?,?,?,?)";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(2, $lecturer->firstname, SQLITE3_TEXT);
            $stmt->bindValue(3, $lecturer->lastname, SQLITE3_TEXT);
            $stmt->bindValue(4, $lecturer->pw, SQLITE3_TEXT);
            $stmt->execute();
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function writeSlotToDB($slot)
    {
        $status_default = "available";
        $sql = "INSERT INTO consultation_slot(id,booker,duration,start_time, end_time, lecturer, status) VALUES (?,?,?,?,?,?,?)";
        try {
            // $this-> db->exec($sql);
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(2, $slot->booker, SQLITE3_TEXT);
            $stmt->bindValue(3, $slot->duration, SQLITE3_NUM);
            $stmt->bindValue(4, $slot->start_time, SQLITE3_TEXT);
            $stmt->bindValue(5, $slot->end_time, SQLITE3_TEXT);
            $stmt->bindValue(6, $slot->lecturer, SQLITE3_INTEGER);
            $stmt->bindValue(7, $status_default, SQLITE3_TEXT);
            $stmt->execute();
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSlotsByLecId($id)
    {
        $result = null;
        $slot = null;
        $row = null;
        $slots = array();

        try {
            $sql = "SElECT * FROM consultation_slot WHERE lecturer = :lecturer";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':lecturer', $id);
            $result = $stmt->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $slot = new ConsultationSlot($row["booker"], $row["duration"], $row["start_time"], $row["end_time"], $row["lecturer"], $row["status"]);
                array_push($slots, $slot);
            }
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $slots;
    }

    private function confirmSlotId($id)
    {
        $result = null;
        $slot_id = null;
        $row = null;
        $val = null;
        $slots_ids = array();
        $sql = "SElECT id FROM consultation_slot";

        try {
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $slot_id = $row["id"];
                if ($row["id"] == $id) {
                    // Schleifenabbruch, und die Funktion wird mit dem Rückgabewert true verlassen
                    return true;
                }
            }
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        // Die-while Schleife lieferte keinen Treffer, also war die Überprüfung nicht erfolgreich, Rückgabewert = false
        return false;
    }

    private function confirmBookerId($bookerID)
    {
        $result = null;
        $row = null;
        $sql = "SElECT id FROM student";

        try {
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                //$booker_id = $row["id"];
                if ($row["id"] == $bookerID) {
                    // Treffer => Schleifenabbruch, und die Funktion wird mit dem Rückgabewert true verlassen
                    return true;
                }
            }
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        // Die-while Schleife lieferte keinen Treffer, also war die Überprüfung nicht erfolgreich, Rückgabewert = false
        return false;
    }


    private function confirmReservationStatus($slotID)
    {
        $result = null;
        $row = null;
        $sql = "SElECT status FROM consultation_slot where id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $slotID);
            $result = $stmt->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                if ($row["status"] === "available") {
                    // Treffer => Schleifenabbruch, und die Funktion wird mit dem Rückgabewert true verlassen
                    return true;
                }
            }
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        // Der Vergleich lieferte keinen Treffer, also war die Überprüfung nicht erfolgreich, Rückgabewert = false
        return false;
    }

    private function updateReservationStatus($slotID, $bookerID, $status)
    {
        $result = null;
        $row = null;
        $sql = "UPDATE consultation_slot SET booker = :bookerID,status = :status where id = :slotID";

        try {
            // Update-Vorgang
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':slotID', $slotID);
            $stmt->bindValue(':bookerID', $bookerID);
            $stmt->bindValue(':status', $status);
            $stmt->execute();

            // Überprüfung des Update-Vorgangs
            $sql_check = "SELECT booker,status FROM consultation_slot where id = :slotID";
            $stmt_check = $this->db->prepare($sql_check);
            $stmt_check->bindValue(':slotID', $slotID);
            $result_check = $stmt_check->execute();

            // Der Datensatz mit der angefragten SlotID muss die übergebene BookerID enthalten und als Status "reserved" zurückgeben
            $row = $result_check->fetchArray(SQLITE3_ASSOC);
            if ($row["status"] === $status and $row["booker"] === $bookerID) {
                // Der Update-Vorgang hat offensichtlich funktioniert
                return true;
            }
            $this->db->close();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        // Die Update-Operation hat nicht funktioniert
        return false;
    }

    public function reserveSlot($slotID, $bookerID)
    {
        $checkSlotId = $this->confirmSlotId($slotID);
        if (!$checkSlotId) {
            echo "Given Slot id not found";
            return false;
        };
        $checkBookerId = $this->confirmBookerId($bookerID);
        if (!$checkBookerId) {
            echo "Given Student Id not found";
            return false;
        };
        $checkStatus = $this->confirmReservationStatus($slotID, $bookerID);
        if (!$checkStatus) {
            echo "Given slot is already booked";
            return false;
        }

        // Wenn die obenstehenden Überprüfungen erfolgreich waren, wird nun die Tabelle aktualisiert
        $successfulReservation = $this->updateReservationStatus($slotID, $bookerID, "reserved");
        if (!$successfulReservation) {
            echo "A technical issue occured, please try again later";
            return false;
        }
        return true;
    }
}