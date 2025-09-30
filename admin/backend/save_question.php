function saveEmploymentSector($conn, $data) {
    try {
        // Start transaction
        $conn->beginTransaction();

        // Get student_id from session or form data
        $student_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        if (!$student_id) {
            throw new Exception("Student ID not found");
        }

        // Get employment sector from form data
        $sector = isset($_POST['employment_sector']) ? $_POST['employment_sector'] : null;
        if (!$sector) {
            throw new Exception("Employment sector not provided");
        }

        // Check if record exists
        $checkStmt = $conn->prepare("SELECT id FROM employment_sector WHERE student_id = ?");
        $checkStmt->execute([$student_id]);
        $existingRecord = $checkStmt->fetch();

        if ($existingRecord) {
            // Update existing record
            $stmt = $conn->prepare("UPDATE employment_sector SET sector = ?, updated_at = NOW() WHERE student_id = ?");
            $stmt->execute([$sector, $student_id]);
        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO employment_sector (student_id, sector, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");
            $stmt->execute([$student_id, $sector]);
        }

        // Commit transaction
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollBack();
        error_log("Error saving employment sector: " . $e->getMessage());
        throw $e;
    }
} 